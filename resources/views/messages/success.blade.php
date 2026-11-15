@extends('layouts.app')

@section('title', 'Pesan Berhasil Disimpan — Kapsul Waktu ' . $code)
@section('meta_description', 'Kapsul waktu berhasil disegel dan sedang memulai perjalanannya menuju masa depan.')

@section('content')
<div class="container container-narrow">

  <div class="success-card">
    <!-- Wax Seal Badge with Orbital Ring -->
    <div class="seal-icon-badge" aria-hidden="true">
      <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        <path d="m9 12 2 2 4-4"></path>
      </svg>
    </div>

    <span class="badge-success-pill">MESSAGE SEALED · KAPSUL WAKTU AKTIF</span>
    <h1 class="success-title serif">Pesan berhasil disegel.</h1>
    <p class="success-subtitle">
      Pesanmu telah tersimpan aman di server dan kini sedang memulai perjalanannya melintasi waktu menuju masa depan.
    </p>

    <!-- Visual Journey Timeline (Requirement 8 & 10) -->
    <div class="journey-timeline-card">
      <div class="journey-timeline-header">
        <span class="mono">TIMELINE PERJALANAN WAKTU</span>
        <span class="status-live-tag">SEDANG BERJALAN</span>
      </div>
      <div class="cosmic-timeline">
        <div class="timeline-track"></div>
        <div class="timeline-progress" style="width: 50%;"></div>

        <!-- Node 1: Created -->
        <div class="timeline-step completed">
          <div class="step-dot">✓</div>
          <span class="step-text-title">DIBUAT</span>
          <span class="step-text-date">{{ $createdAt->format('Y') }}</span>
        </div>

        <!-- Node 2: Sealed -->
        <div class="timeline-step active">
          <div class="step-dot">●</div>
          <span class="step-text-title">DISEGEL</span>
          <span class="step-text-date">{{ $createdAt->translatedFormat('d M') }}</span>
        </div>

        <!-- Node 3: Waiting -->
        <div class="timeline-step">
          <div class="step-dot">···</div>
          <span class="step-text-title">TRANSIT</span>
          <span class="step-text-date">MENUNGGU</span>
        </div>

        <!-- Node 4: Unlock -->
        <div class="timeline-step">
          <div class="step-dot">○</div>
          <span class="step-text-title">UNLOCK</span>
          <span class="step-text-date">{{ $unlockAt->format('Y') }}</span>
        </div>
      </div>
    </div>

    <!-- Code Display Box -->
    <div class="code-box">
      <span class="code-label">KODE KUNCI PESAN KAMU:</span>
      <div class="code-value mono" id="messageCode">{{ $code }}</div>
      <p class="code-warning">
        Simpan kode ini dengan baik. Kode ini diperlukan untuk membuka dan membaca pesan ketika waktunya tiba.
      </p>

      <div class="code-actions">
        <button type="button" class="btn btn-primary" onclick="copyText('{{ $code }}', 'Kode {{ $code }} berhasil disalin!')">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Salin Kode
        </button>

        <a href="{{ route('messages.show', ['code' => $code]) }}" class="btn btn-secondary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
            <polyline points="15 3 21 3 21 9"></polyline>
            <line x1="10" y1="14" x2="21" y2="3"></line>
          </svg>
          Halaman Pesan
        </a>

        <!-- Share Button (Requirement 17 & 18) -->
        <button type="button" class="btn btn-secondary" onclick="openShareModal({ url: '{{ route('messages.share', ['share_token' => $shareToken]) }}', title: 'Pesan Untuk Masa Depan' })">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
          Bagikan Pesan
        </button>
      </div>
    </div>

    <!-- Receipt Meta -->
    <div class="meta-receipt">
      <div class="receipt-row">
        <span class="receipt-label">Pengirim:</span>
        <span class="receipt-val font-semibold">{{ $senderName }}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Penerima:</span>
        <span class="receipt-val font-semibold">{{ $recipientName }}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Judul Pesan:</span>
        <span class="receipt-val">{{ $title }}</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Waktu Pembukaan:</span>
        <span class="receipt-val highlight">{{ $unlockAt->translatedFormat('d F Y, H:i') }} WIB</span>
      </div>
      <div class="receipt-row">
        <span class="receipt-label">Tautan Publik Kapsul:</span>
        <span class="receipt-val mono text-link" style="word-break: break-all;">
          {{ route('messages.share', ['share_token' => $shareToken]) }}
        </span>
      </div>
    </div>

    <div class="reminder-callout">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: var(--gold);">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="16" x2="12" y2="12"></line>
        <line x1="12" y1="8" x2="12.01" y2="8"></line>
      </svg>
      <p>
        <strong>Simpan kode baik-baik:</strong> Tanpa akun atau login, kode di atas adalah satu-satunya kunci untuk membuka surat ini saat waktunya tiba.
      </p>
    </div>

  </div>

</div>
@endsection

@section('styles')
<style>
  .container-narrow { max-width: 680px; }
  .success-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 48px 40px;
    box-shadow: var(--shadow-md);
    text-align: center;
  }
  .seal-icon-badge {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent-soft);
    color: var(--accent-dark);
    display: grid;
    place-items: center;
    margin: 0 auto 16px;
    border: 2px solid rgba(70, 104, 90, 0.2);
  }
  .badge-success-pill {
    display: inline-block;
    padding: 4px 12px;
    border-radius: var(--radius-pill);
    background: var(--accent-soft);
    color: var(--accent-dark);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 12px;
  }
  .success-title {
    font-size: clamp(28px, 4.5vw, 38px);
    line-height: 1.2;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 12px;
  }
  .success-subtitle {
    color: var(--muted);
    font-size: 15px;
    line-height: 1.6;
    max-width: 520px;
    margin: 0 auto 28px;
  }

  /* Journey Timeline Card */
  .journey-timeline-card {
    background: var(--paper-warm);
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    padding: 20px 22px 14px;
    margin-bottom: 28px;
    text-align: left;
  }
  .journey-timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--muted);
  }
  .status-live-tag {
    color: var(--accent-dark);
    background: var(--accent-soft);
    padding: 2px 8px;
    border-radius: var(--radius-pill);
  }

  .code-box {
    background: var(--paper-warm);
    border: 2px dashed var(--line);
    border-radius: var(--radius-md);
    padding: 28px 20px;
    margin-bottom: 28px;
  }
  .code-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.16em;
    color: var(--muted);
    margin-bottom: 8px;
  }
  .code-value {
    font-size: clamp(30px, 6vw, 42px);
    font-weight: 700;
    color: var(--accent-dark);
    letter-spacing: 0.16em;
    line-height: 1.2;
    margin-bottom: 12px;
  }
  .code-warning {
    color: var(--ink-soft);
    font-size: 14px;
    line-height: 1.6;
    max-width: 440px;
    margin: 0 auto 24px;
  }
  .code-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .meta-receipt {
    background: var(--surface);
    border: 1px solid var(--line-subtle);
    border-radius: 12px;
    padding: 18px 22px;
    margin-bottom: 24px;
    text-align: left;
  }
  .receipt-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 9px 0;
    border-bottom: 1px solid var(--line-subtle);
    font-size: 13px;
  }
  .receipt-row:last-child { border-bottom: none; }
  .receipt-label { color: var(--muted); }
  .receipt-val { color: var(--ink); font-weight: 500; }
  .receipt-val.highlight { color: var(--accent-dark); font-weight: 600; }

  .reminder-callout {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    background: var(--gold-soft);
    border: 1px solid rgba(176, 135, 78, 0.25);
    border-radius: 12px;
    font-size: 13px;
    line-height: 1.5;
    text-align: left;
    color: #634b26;
  }

  @media (max-width: 600px) {
    .success-card { padding: 32px 18px; }
    .code-actions { flex-direction: column; }
    .code-actions .btn { width: 100%; }
    .receipt-row { flex-direction: column; align-items: flex-start; gap: 4px; }
  }
</style>
@endsection
