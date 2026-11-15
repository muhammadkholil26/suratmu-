<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper: buat user dan kembalikan instance untuk actingAs().
     */
    private function makeUser(): User
    {
        return User::factory()->create();
    }

    /**
     * Test 1: Pengguna dapat membuat pesan (CREATE -> SEALED).
     */
    public function test_user_can_create_message(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)->post(route('messages.store'), [
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Sahabatku',
            'title'          => 'Harapan di Masa Depan',
            'message'        => 'Semoga ketika kamu membaca ini, kamu sudah menjadi orang yang lebih baik.',
            'unlock_date'    => Carbon::now()->addYears(5)->format('Y-m-d'),
            'unlock_time'    => '20:00',
        ]);

        $message = Message::first();
        $this->assertNotNull($message);
        $this->assertEquals('Kholil', $message->sender_name);
        $this->assertEquals('Sahabatku', $message->recipient_name);
        $this->assertNotNull($message->share_token);
        $this->assertEquals($user->id, $message->user_id);

        $response->assertRedirect(route('messages.success', ['code' => $message->code]));

        // Check success page displays MESSAGE SEALED
        $successResponse = $this->actingAs($user)->get(route('messages.success', ['code' => $message->code]));
        $successResponse->assertStatus(200);
        $successResponse->assertSee('MESSAGE SEALED');
        $successResponse->assertSee($message->code);
    }

    /**
     * Test 2: Sistem menghasilkan kode unik dengan format XXXX-XXXX.
     */
    public function test_system_generates_unique_code(): void
    {
        $code = Message::generateUniqueCode();

        $this->assertMatchesRegularExpression('/^[A-Z0-9]{4}-[A-Z0-9]{4}$/', $code);
        $this->assertEquals(9, strlen($code));
    }

    /**
     * Test 3: Pesan tersimpan di database.
     */
    public function test_message_is_saved_in_database(): void
    {
        $user       = $this->makeUser();
        $unlockDate = Carbon::now()->addYear()->format('Y-m-d');
        $unlockTime = '14:30';

        $this->actingAs($user)->post(route('messages.store'), [
            'sender_name'    => 'Ahmad',
            'recipient_name' => 'Nabil',
            'title'          => 'Rencana Masa Depan',
            'message'        => 'Harapan untuk masa depan di tahun depan.',
            'unlock_date'    => $unlockDate,
            'unlock_time'    => $unlockTime,
        ]);

        $this->assertDatabaseHas('messages', [
            'sender_name'    => 'Ahmad',
            'recipient_name' => 'Nabil',
            'title'          => 'Rencana Masa Depan',
            'message'        => 'Harapan untuk masa depan di tahun depan.',
        ]);

        $saved = Message::where('sender_name', 'Ahmad')->first();
        $this->assertNotNull($saved->code);
        $this->assertNotNull($saved->share_token);
        $this->assertNotNull($saved->unlock_at);
    }

    /**
     * Test 4: Kode yang salah menghasilkan pesan tidak ditemukan.
     */
    public function test_invalid_code_returns_not_found_message(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->from(route('messages.openForm'))
            ->post(route('messages.open'), [
                'code' => 'INVALID-CODE',
            ]);

        $response->assertRedirect(route('messages.openForm'));
        $response->assertSessionHasErrors('code');

        $followResponse = $this->actingAs($user)->get(route('messages.openForm'));
        $followResponse->assertSee('Pesan tidak ditemukan.');
        $followResponse->assertSee('Pastikan kode yang kamu masukkan benar.');
    }

    /**
     * Test 5: Sebelum unlock, pesan berstatus MESSAGE SEALED dan isi pesan tidak dikirim.
     */
    public function test_locked_message_shows_sealed_status_and_hides_content(): void
    {
        $user   = $this->makeUser();
        $secret = 'SECRET_TEXT_NOT_VISIBLE_BEFORE_UNLOCK_7788';

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'KF7X-29PA',
            'share_token'    => 'token-secret-12345',
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Penerima Rahasia',
            'title'          => 'Surat Tersegel',
            'message'        => $secret,
            'unlock_at'      => Carbon::now()->addYears(2),
        ]);

        $response = $this->actingAs($user)->get(route('messages.show', ['code' => $message->code]));

        $response->assertStatus(200);
        $response->assertSee('MESSAGE SEALED');
        $response->assertSee('Pesan Sedang Menempuh Perjalanan Waktu');
        $response->assertDontSee($secret);
        $response->assertDontSee('TIME CAPSULE OPENED');
    }

    /**
     * Test 6: Share link sebelum unlock menampilkan MESSAGE SEALED dan tidak bocor.
     */
    public function test_share_link_before_unlock_shows_message_sealed_without_body(): void
    {
        $secret = 'CONFIDENTIAL_MESSAGE_FOR_SHARE_TEST';

        $message = Message::create([
            'code'           => 'A8KD-71QM',
            'share_token'    => 'share-token-xyz-99',
            'sender_name'    => 'Pengirim',
            'recipient_name' => 'Penerima',
            'title'          => 'Surat Rahasia',
            'message'        => $secret,
            'unlock_at'      => Carbon::now()->addDays(20),
        ]);

        // Share route tidak butuh auth
        $response = $this->get(route('messages.share', ['share_token' => $message->share_token]));

        $response->assertStatus(200);
        $response->assertSee('MESSAGE SEALED');
        $response->assertDontSee($secret);
    }

    /**
     * Test 7: Ketika unlock_at tiba, status menjadi READY TO OPEN.
     */
    public function test_ready_to_open_status_when_unlock_time_arrived(): void
    {
        $user   = $this->makeUser();
        $secret = 'SURAT_WAKTU_TIBA_UNLOCKED';

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'P4ZX-92RT',
            'share_token'    => 'token-unlocked-55',
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Teman',
            'title'          => 'Surat Telah Tiba',
            'message'        => $secret,
            'unlock_at'      => Carbon::now()->subMinute(),
        ]);

        $response = $this->actingAs($user)->get(route('messages.show', ['code' => $message->code]));

        $response->assertStatus(200);
        $response->assertSee('Waktu Pembukaan Telah Tiba');
        $response->assertSee('Buka Pesan Sekarang');
        $response->assertDontSee($secret);
    }

    /**
     * Test 8: Aksi buka pesan menampilkan TIME CAPSULE OPENED dan isi surat.
     */
    public function test_open_action_reveals_message_and_marks_opened(): void
    {
        $user   = $this->makeUser();
        $secret = 'SURAT_AKHIRNYA_DIBUKA_SELAMAT';

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'M7TR-4KQP',
            'share_token'    => 'token-revealed-88',
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Teman',
            'title'          => 'Surat Terbuka',
            'message'        => $secret,
            'unlock_at'      => Carbon::now()->subMinute(),
        ]);

        $response = $this->actingAs($user)->get(route('messages.show', ['code' => $message->code, 'open' => '1']));

        $response->assertStatus(200);
        $response->assertSee('TIME CAPSULE OPENED');
        $response->assertSee($secret);
        $response->assertSee('Download PDF');
        $response->assertSee('Bagikan Pesan');

        $message->refresh();
        $this->assertNotNull($message->opened_at);
    }

    /**
     * Test 9: Download PDF berhasil setelah unlock time.
     */
    public function test_download_pdf_succeeds_after_unlock(): void
    {
        $user = $this->makeUser();

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'PDFX-1122',
            'share_token'    => 'token-pdf-valid',
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Muhammad',
            'title'          => 'Surat PDF',
            'message'        => 'Isi surat untuk cetak PDF time capsule.',
            'unlock_at'      => Carbon::now()->subHours(2),
        ]);

        $response = $this->actingAs($user)->get(route('messages.downloadPdf', ['code' => $message->code]));

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
        $this->assertStringContainsString('pesan-untuk-masa-depan', $response->headers->get('content-disposition'));
    }

    /**
     * Test 10: Download PDF ditolak dengan HTTP 403 Forbidden sebelum unlock.
     */
    public function test_download_pdf_is_forbidden_before_unlock(): void
    {
        $user = $this->makeUser();

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'BLOK-9988',
            'share_token'    => 'token-pdf-blocked',
            'sender_name'    => 'Kholil',
            'recipient_name' => 'Muhammad',
            'title'          => 'Surat Belum Waktunya',
            'message'        => 'Tidak boleh diunduh sekarang!',
            'unlock_at'      => Carbon::now()->addDays(5),
        ]);

        $response = $this->actingAs($user)->get(route('messages.downloadPdf', ['code' => $message->code]));
        $response->assertStatus(403);

        $sharePdfResponse = $this->get(route('messages.sharePdf', ['share_token' => $message->share_token]));
        $sharePdfResponse->assertStatus(403);
    }

    /**
     * Test 11: Public share link mengizinkan pembukaan setelah waktunya tiba.
     */
    public function test_public_share_link_allows_opening_after_unlock(): void
    {
        $secret = 'PESAN_PUBLIC_SHARE_BERHASIL_DIBUKA';

        $message = Message::create([
            'code'           => 'PUBL-3344',
            'share_token'    => 'token-public-ok-77',
            'sender_name'    => 'Pengirim Publik',
            'recipient_name' => 'Penerima Publik',
            'title'          => 'Surat Publik',
            'message'        => $secret,
            'unlock_at'      => Carbon::now()->subMinutes(10),
        ]);

        $response = $this->get(route('messages.share', ['share_token' => $message->share_token, 'open' => '1']));

        $response->assertStatus(200);
        $response->assertSee('TIME CAPSULE OPENED');
        $response->assertSee($secret);
    }

    /**
     * Test 12: Pengguna dapat mengedit pesan sebelum waktunya tiba.
     */
    public function test_user_can_edit_message_before_unlock(): void
    {
        $user = $this->makeUser();

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'EDIT-1234',
            'share_token'    => 'token-edit-ok',
            'sender_name'    => 'Nama Lama',
            'recipient_name' => 'Penerima Lama',
            'title'          => 'Judul Lama',
            'message'        => 'Pesan sebelum diedit.',
            'unlock_at'      => Carbon::now()->addMonths(2),
        ]);

        $newUnlockDate = Carbon::now()->addMonths(3)->format('Y-m-d');

        $response = $this->actingAs($user)->put(route('messages.update', ['code' => $message->code]), [
            'sender_name'    => 'Nama Baru',
            'recipient_name' => 'Penerima Baru',
            'title'          => 'Judul Baru',
            'message'        => 'Pesan setelah diperbarui.',
            'unlock_date'    => $newUnlockDate,
            'unlock_time'    => '19:30',
        ]);

        $response->assertRedirect(route('messages.show', ['code' => $message->code]));

        $message->refresh();
        $this->assertEquals('Nama Baru', $message->sender_name);
        $this->assertEquals('Penerima Baru', $message->recipient_name);
        $this->assertEquals('Pesan setelah diperbarui.', $message->message);
    }

    /**
     * Test 13: Pengguna tidak dapat mengedit pesan setelah waktunya tiba.
     */
    public function test_user_cannot_edit_message_after_unlock(): void
    {
        $user = $this->makeUser();

        $message = Message::create([
            'user_id'        => $user->id,
            'code'           => 'NOED-5678',
            'share_token'    => 'token-noedit',
            'sender_name'    => 'Final Name',
            'recipient_name' => 'Final Recipient',
            'title'          => 'Final Title',
            'message'        => 'Pesan yang sudah final.',
            'unlock_at'      => Carbon::now()->subDay(),
        ]);

        $response = $this->actingAs($user)->get(route('messages.edit', ['code' => $message->code]));
        $response->assertRedirect(route('messages.show', ['code' => $message->code]));

        $updateResponse = $this->actingAs($user)->put(route('messages.update', ['code' => $message->code]), [
            'sender_name' => 'Hacker Name',
            'message'     => 'Mencoba meretas pesan yang sudah terbuka',
            'unlock_date' => Carbon::now()->addDay()->format('Y-m-d'),
            'unlock_time' => '12:00',
        ]);
        $updateResponse->assertRedirect(route('messages.show', ['code' => $message->code]));

        $message->refresh();
        $this->assertEquals('Final Name', $message->sender_name);
    }

    /**
     * Test 14: Tanggal masa lalu ditolak pada pembuatan pesan.
     */
    public function test_past_date_is_rejected(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)
            ->from(route('messages.create'))
            ->post(route('messages.store'), [
                'sender_name' => 'Kholil',
                'message'     => 'Pesan masa lalu yang tidak valid',
                'unlock_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'unlock_time' => '10:00',
            ]);

        $response->assertRedirect(route('messages.create'));
        $response->assertSessionHasErrors(['unlock_date']);

        $this->assertEquals(0, Message::where('sender_name', 'Kholil')->count());
    }

    /**
     * Test 15: User yang belum login diarahkan ke /login saat akses homepage.
     */
    public function test_unauthenticated_user_redirected_to_login(): void
    {
        $response = $this->get(route('home'));
        $response->assertRedirect(route('auth.login'));
    }

    /**
     * Test 16: User dapat register dan diarahkan ke /login (tidak auto-login).
     */
    public function test_user_can_register_and_redirects_to_login(): void
    {
        $response = $this->post(route('auth.register.post'), [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('auth.login'));
        $response->assertSessionHas('status');
        $this->assertGuest();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /**
     * Test 16b: Halaman auth memiliki layout mandiri tanpa navbar homepage.
     */
    public function test_auth_pages_do_not_contain_homepage_navbar(): void
    {
        $loginRes = $this->get(route('auth.login'));
        $loginRes->assertStatus(200);
        $loginRes->assertSee('Selamat Datang Kembali.');
        $loginRes->assertDontSee('Tulis Surat');
        $loginRes->assertDontSee('Beranda');

        $registerRes = $this->get(route('auth.register'));
        $registerRes->assertStatus(200);
        $registerRes->assertSee('Buat Kapsul Waktumu.');
        $registerRes->assertDontSee('Tulis Surat');
        $registerRes->assertDontSee('Beranda');
    }

    /**
     * Test 17: User dapat login dan logout.
     */
    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'email'    => 'login@example.com',
            'password' => bcrypt('secret123'),
        ]);

        // Login
        $loginResponse = $this->post(route('auth.login.post'), [
            'email'    => 'login@example.com',
            'password' => 'secret123',
        ]);
        $loginResponse->assertRedirect(route('home'));
        $this->assertAuthenticated();

        // Logout
        $logoutResponse = $this->actingAs($user)->post(route('auth.logout'));
        $logoutResponse->assertRedirect(route('auth.login'));
        $this->assertGuest();
    }

    /**
     * Test 18: Kodeku hanya menampilkan pesan milik user yang login (isolasi data).
     */
    public function test_kodeku_only_shows_own_messages(): void
    {
        $userA = $this->makeUser();
        $userB = $this->makeUser();

        Message::create([
            'user_id'     => $userA->id,
            'code'        => 'USRA-1111',
            'share_token' => 'tok-a-1',
            'sender_name' => 'User A',
            'message'     => 'Pesan milik User A',
            'unlock_at'   => Carbon::now()->addYear(),
        ]);

        Message::create([
            'user_id'     => $userB->id,
            'code'        => 'USRB-2222',
            'share_token' => 'tok-b-2',
            'sender_name' => 'User B',
            'message'     => 'Pesan milik User B RAHASIA',
            'unlock_at'   => Carbon::now()->addYear(),
        ]);

        $response = $this->actingAs($userA)->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('USRA-1111');
        $response->assertDontSee('USRB-2222');
        $response->assertDontSee('Pesan milik User B RAHASIA');
    }

    /**
     * Test 19: User tidak dapat mengedit pesan milik user lain (Authorization).
     */
    public function test_user_cannot_edit_other_users_message(): void
    {
        $userA = $this->makeUser();
        $userB = $this->makeUser();

        $message = Message::create([
            'user_id'     => $userB->id,
            'code'        => 'USRB-3333',
            'share_token' => 'tok-b-3',
            'sender_name' => 'User B',
            'message'     => 'Pesan milik User B',
            'unlock_at'   => Carbon::now()->addYear(),
        ]);

        // User A mencoba membuka form edit milik User B
        $response = $this->actingAs($userA)->get(route('messages.edit', ['code' => $message->code]));
        $response->assertStatus(403);

        // User A mencoba update pesan milik User B
        $updateResponse = $this->actingAs($userA)->put(route('messages.update', ['code' => $message->code]), [
            'sender_name' => 'Hacker',
            'message'     => 'Modifikasi ilegal',
            'unlock_date' => Carbon::now()->addYear()->format('Y-m-d'),
            'unlock_time' => '12:00',
        ]);
        $updateResponse->assertStatus(403);
    }

    /**
     * Test 20: Struktur navbar: Beranda, Buat Pesan, Buka Pesan, Kodeku, Theme Toggle, Profil.
     */
    public function test_navbar_structure_and_order(): void
    {
        $user = User::factory()->create(['name' => 'Ahmad']);
        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
        $content = $response->getContent();

        // Must see navigation items
        $this->assertStringContainsString('Beranda', $content);
        $this->assertStringContainsString('Buat Pesan', $content);
        $this->assertStringContainsString('Buka Pesan', $content);
        $this->assertStringContainsString('Kodeku', $content);
        $this->assertStringContainsString('themeToggleBtn', $content);
        $this->assertStringContainsString('Ahmad', $content);

        // Verify order in HTML: Beranda -> Buat Pesan -> Buka Pesan -> Kodeku -> themeToggleBtn -> Profil
        // Extract only <header> element to test navbar items sequence
        preg_match('/<header class="site-header">.*?<\/header>/s', $content, $matches);
        $this->assertNotEmpty($matches, 'Header element must exist');
        $headerHtml = $matches[0];

        $posBeranda = strpos($headerHtml, 'Beranda');
        $posBuat = strpos($headerHtml, 'Buat Pesan');
        $posBuka = strpos($headerHtml, 'Buka Pesan');
        $posKodeku = strpos($headerHtml, 'Kodeku');
        $posToggle = strpos($headerHtml, 'themeToggleBtn');
        $posProfile = strpos($headerHtml, 'Ahmad');

        $this->assertNotFalse($posBeranda, 'posBeranda should not be false');
        $this->assertNotFalse($posBuat, 'posBuat should not be false');
        $this->assertNotFalse($posBuka, 'posBuka should not be false');
        $this->assertNotFalse($posKodeku, 'posKodeku should not be false');
        $this->assertNotFalse($posToggle, 'posToggle should not be false');
        $this->assertNotFalse($posProfile, 'posProfile should not be false');
        $this->assertTrue($posBeranda < $posBuat, 'Beranda should be before Buat Pesan');
        $this->assertTrue($posBuat < $posBuka, 'Buat Pesan should be before Buka Pesan');
        $this->assertTrue($posBuka < $posKodeku, 'Buka Pesan should be before Kodeku');
        $this->assertTrue($posKodeku < $posToggle, 'Kodeku should be before Theme Toggle');
        $this->assertTrue($posToggle < $posProfile, 'Theme Toggle should be before Profil');
    }
}
