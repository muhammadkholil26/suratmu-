<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * Show the form for creating a new message.
     */
    public function create(): View
    {
        return view('messages.create');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sender_name' => ['required', 'string', 'max:100'],
            'recipient_name' => ['nullable', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
            'unlock_date' => ['nullable', 'required_without:unlock_at', 'date_format:Y-m-d'],
            'unlock_time' => ['nullable', 'required_with:unlock_date', 'date_format:H:i'],
            'unlock_at' => ['nullable', 'required_without:unlock_date', 'date'],
        ], [
            'sender_name.required' => 'Nama pengirim wajib diisi.',
            'sender_name.max' => 'Nama pengirim maksimal 100 karakter.',
            'message.required' => 'Isi pesan wajib diisi.',
            'message.max' => 'Isi pesan maksimal 5000 karakter.',
            'unlock_date.required_without' => 'Tanggal dapat dibuka wajib diisi.',
            'unlock_date.date_format' => 'Format tanggal tidak valid (YYYY-MM-DD).',
            'unlock_time.required_with' => 'Waktu dapat dibuka wajib diisi.',
            'unlock_time.date_format' => 'Format waktu tidak valid (HH:MM).',
            'unlock_at.required_without' => 'Tanggal dan waktu buka wajib ditentukan.',
        ]);

        $timezone = config('app.timezone', 'Asia/Jakarta');

        if ($request->filled('unlock_date') && $request->filled('unlock_time')) {
            try {
                $unlockAt = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $request->input('unlock_date') . ' ' . $request->input('unlock_time'),
                    $timezone
                );
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->withErrors(['unlock_date' => 'Format tanggal dan waktu tidak valid.']);
            }
        } else {
            $unlockAt = Carbon::parse($request->input('unlock_at'), $timezone);
        }

        // Validate that unlock_at is strictly in the future
        if ($unlockAt->lessThanOrEqualTo(Carbon::now($timezone))) {
            return back()
                ->withInput()
                ->withErrors([
                    'unlock_date' => 'Tanggal dan waktu buka tidak boleh berada di masa lalu.',
                    'unlock_at' => 'Tanggal dan waktu buka tidak boleh berada di masa lalu.',
                ]);
        }

        $code = Message::generateUniqueCode();
        $shareToken = Message::generateUniqueShareToken();

        $senderName = trim($request->input('sender_name'));
        $recipientName = trim($request->input('recipient_name')) ?: 'Sahabat Masa Depan';
        $title = trim($request->input('title')) ?: 'Surat Untuk Masa Depan';

        $message = Message::create([
            'user_id'        => Auth::id(),
            'code'           => $code,
            'share_token'    => $shareToken,
            'sender_name'    => $senderName,
            'recipient_name' => $recipientName,
            'title'          => $title,
            'message'        => trim($request->input('message')),
            'unlock_at'      => $unlockAt,
        ]);

        return redirect()->route('messages.success', ['code' => $message->code]);
    }

    /**
     * Show the confirmation / success screen after creating a message.
     */
    public function success(string $code): View|RedirectResponse
    {
        $normalizedCode = Message::normalizeCode($code);
        $message = Message::where('code', $normalizedCode)->first();

        if (!$message) {
            return redirect()
                ->route('messages.openForm')
                ->withErrors(['code' => 'Pesan tidak ditemukan. Pastikan kode yang kamu masukkan benar.']);
        }

        return view('messages.success', [
            'message' => $message,
            'code' => $message->code,
            'shareToken' => $message->share_token,
            'senderName' => $message->sender_name,
            'recipientName' => $message->recipient_name,
            'title' => $message->title,
            'unlockAt' => $message->unlock_at,
            'createdAt' => $message->created_at,
        ]);
    }

    /**
     * Show the form to unlock / look up a message by code.
     */
    public function openForm(): View
    {
        return view('messages.open');
    }

    /**
     * Process the open message form submission.
     */
    public function open(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ], [
            'code.required' => 'Kode pesan wajib diisi.',
        ]);

        $normalizedCode = Message::normalizeCode($request->input('code'));
        $messageExists = Message::where('code', $normalizedCode)->exists();

        if (!$messageExists) {
            return back()
                ->withInput()
                ->withErrors(['code' => 'Pesan tidak ditemukan. Pastikan kode yang kamu masukkan benar.']);
        }

        return redirect()->route('messages.show', ['code' => $normalizedCode]);
    }

    /**
     * Display the specified message, sealed status, or ready to open state.
     */
    public function show(Request $request, string $code): View|RedirectResponse
    {
        $normalizedCode = Message::normalizeCode($code);
        $message = Message::where('code', $normalizedCode)->first();

        if (!$message) {
            return redirect()
                ->route('messages.openForm')
                ->withErrors(['code' => 'Pesan tidak ditemukan. Pastikan kode yang kamu masukkan benar.']);
        }

        $isUnlocked = $message->isUnlocked();

        // Check if user requested to open/reveal the unlocked time capsule
        $isOpened = false;
        if ($isUnlocked) {
            if ($request->query('open') === '1' || $message->opened_at !== null) {
                $isOpened = true;
                $message->markAsOpened();
            }
        }

        // Server-side security: NEVER send message content if not unlocked and not opened!
        return view('messages.show', [
            'message' => $message,
            'code' => $message->code,
            'shareToken' => $message->share_token,
            'senderName' => $message->sender_name,
            'recipientName' => $message->recipient_name,
            'title' => $message->title,
            'unlockAt' => $message->unlock_at,
            'createdAt' => $message->created_at,
            'openedAt' => $message->opened_at,
            'isUnlocked' => $isUnlocked,
            'isOpened' => $isOpened,
            'messageContent' => ($isUnlocked && $isOpened) ? $message->message : null,
            'isShareView' => false,
        ]);
    }

    /**
     * Show the edit form for a message before its unlock time.
     */
    public function edit(string $code): View|RedirectResponse
    {
        $normalizedCode = Message::normalizeCode($code);
        $message = Message::where('code', $normalizedCode)->first();

        if (!$message) {
            return redirect()
                ->route('messages.openForm')
                ->withErrors(['code' => 'Pesan tidak ditemukan.']);
        }

        // Ownership check: user lain tidak boleh mengedit pesan privat milik user ini
        if ($message->user_id && $message->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit pesan ini.');
        }

        if (!$message->canBeEdited()) {
            return redirect()
                ->route('messages.show', ['code' => $message->code])
                ->withErrors(['edit' => 'Pesan yang telah mencapai waktu buka telah memasuki fase final dan tidak dapat diubah lagi.']);
        }

        return view('messages.edit', [
            'message' => $message,
            'code' => $message->code,
        ]);
    }

    /**
     * Update an existing message before unlock time.
     */
    public function update(Request $request, string $code): RedirectResponse
    {
        $normalizedCode = Message::normalizeCode($code);
        $message = Message::where('code', $normalizedCode)->first();

        if (!$message) {
            return redirect()
                ->route('messages.openForm')
                ->withErrors(['code' => 'Pesan tidak ditemukan.']);
        }

        // Ownership check: user lain tidak boleh mengedit pesan privat milik user ini
        if ($message->user_id && $message->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit pesan ini.');
        }

        if (!$message->canBeEdited()) {
            return redirect()
                ->route('messages.show', ['code' => $message->code])
                ->withErrors(['edit' => 'Pesan yang telah terbuka tidak dapat diubah lagi.']);
        }

        $request->validate([
            'sender_name' => ['required', 'string', 'max:100'],
            'recipient_name' => ['nullable', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
            'unlock_date' => ['required', 'date_format:Y-m-d'],
            'unlock_time' => ['required', 'date_format:H:i'],
        ]);

        $timezone = config('app.timezone', 'Asia/Jakarta');

        try {
            $unlockAt = Carbon::createFromFormat(
                'Y-m-d H:i',
                $request->input('unlock_date') . ' ' . $request->input('unlock_time'),
                $timezone
            );
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['unlock_date' => 'Format tanggal dan waktu tidak valid.']);
        }

        if ($unlockAt->lessThanOrEqualTo(Carbon::now($timezone))) {
            return back()
                ->withInput()
                ->withErrors(['unlock_date' => 'Tanggal dan waktu buka tidak boleh berada di masa lalu.']);
        }

        $message->update([
            'sender_name' => trim($request->input('sender_name')),
            'recipient_name' => trim($request->input('recipient_name')) ?: 'Sahabat Masa Depan',
            'title' => trim($request->input('title')) ?: 'Surat Untuk Masa Depan',
            'message' => trim($request->input('message')),
            'unlock_at' => $unlockAt,
        ]);

        return redirect()
            ->route('messages.show', ['code' => $message->code])
            ->with('status', 'Pesan berhasil diperbarui.');
    }

    /**
     * Download message as an aesthetic PDF (Only after unlock time).
     */
    public function downloadPdf(string $code): Response
    {
        $normalizedCode = Message::normalizeCode($code);
        $message = Message::where('code', $normalizedCode)->firstOrFail();

        // Server-side security check: STRICTLY forbid downloading before unlock
        if (!$message->isUnlocked()) {
            abort(403, 'Pesan masih tersegel dalam perjalanan waktu dan belum dapat diunduh.');
        }

        $message->markAsOpened();

        $pdf = Pdf::loadView('messages.pdf', [
            'message' => $message,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download($message->getPdfFilename());
    }

    /**
     * Public share page accessed via secure share token.
     */
    public function share(Request $request, string $share_token): View
    {
        $message = Message::where('share_token', $share_token)->firstOrFail();

        $isUnlocked = $message->isUnlocked();
        $isOpened = false;

        if ($isUnlocked) {
            if ($request->query('open') === '1' || $message->opened_at !== null) {
                $isOpened = true;
                $message->markAsOpened();
            }
        }

        return view('messages.show', [
            'message' => $message,
            'code' => $message->code,
            'shareToken' => $message->share_token,
            'senderName' => $message->sender_name,
            'recipientName' => $message->recipient_name,
            'title' => $message->title,
            'unlockAt' => $message->unlock_at,
            'createdAt' => $message->created_at,
            'openedAt' => $message->opened_at,
            'isUnlocked' => $isUnlocked,
            'isOpened' => $isOpened,
            'messageContent' => ($isUnlocked && $isOpened) ? $message->message : null,
            'isShareView' => true,
        ]);
    }

    /**
     * Public PDF download via secure share token (Only after unlock time).
     */
    public function sharePdf(string $share_token): Response
    {
        $message = Message::where('share_token', $share_token)->firstOrFail();

        if (!$message->isUnlocked()) {
            abort(403, 'Pesan masih tersegel dalam perjalanan waktu dan belum dapat diunduh.');
        }

        $message->markAsOpened();

        $pdf = Pdf::loadView('messages.pdf', [
            'message' => $message,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download($message->getPdfFilename());
    }
}
