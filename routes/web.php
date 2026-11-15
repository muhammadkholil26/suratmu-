<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Pesan Untuk Masa Depan
|--------------------------------------------------------------------------
*/

// ── Auth Routes (tidak butuh login) ──────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login',   [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register',[AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

// ── Public Share Routes (boleh diakses tanpa login via share token) ──────
Route::get('/pesan/share/{share_token}',      [MessageController::class, 'share'])->name('messages.share');
Route::get('/pesan/share/{share_token}/pdf',  [MessageController::class, 'sharePdf'])->name('messages.sharePdf');

// ── Protected Routes (wajib login) ───────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Homepage — dengan data Kodeku milik user yang login
    Route::get('/', function () {
        $myMessages = \App\Models\Message::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('welcome', compact('myMessages'));
    })->name('home');

    // Buat & simpan pesan
    Route::get('/buat-pesan',          [MessageController::class, 'create'])->name('messages.create');
    Route::post('/pesan',              [MessageController::class, 'store'])->name('messages.store');
    Route::get('/pesan/{code}/sukses', [MessageController::class, 'success'])->name('messages.success');

    // Buka pesan via kode
    Route::get('/buka-pesan',  [MessageController::class, 'openForm'])->name('messages.openForm');
    Route::post('/buka-pesan', [MessageController::class, 'open'])->name('messages.open');

    // Detail & aksi pesan
    Route::get('/pesan/{code}',       [MessageController::class, 'show'])->name('messages.show');
    Route::get('/pesan/{code}/edit',  [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/pesan/{code}',       [MessageController::class, 'update'])->name('messages.update');
    Route::get('/pesan/{code}/pdf',   [MessageController::class, 'downloadPdf'])->name('messages.downloadPdf');

});
