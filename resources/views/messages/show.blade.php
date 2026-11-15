@extends('layouts.app')

@section('title', ($isUnlocked ? ($isOpened ? 'Pesan Terbuka: ' . $title : 'Ready to Open — Kapsul Waktu') : 'Message Sealed — ' . $code))
@section('meta_description', 'Kapsul waktu ' . $code . ' — Dari ' . $senderName . ' untuk ' . $recipientName)

@section('og_title', 'Pesan Untuk Masa Depan — Kapsul Waktu Digital')
@section('og_description', 'Sebuah pesan sedang mengarungi ruang dan waktu. Dibuka pada: ' . $unlockAt->translatedFormat('d F Y'))
@section('og_url', route('messages.share', ['share_token' => $shareToken]))

@section('content')
<div class="container container-narrow">

  @if (!$isUnlocked)
    <!-- ================= 1. LOCKED / IN TRANSIT STATE ================= -->
    <div class="letter-display-card locked-card">
      
      <!-- Subtle Floating Space Visual -->
      <div class="capsule-space-orbit floating-orbit" aria-hidden="true">
        <svg viewBox="0 0 160 160" fill="none" stroke="#D6D6D1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <!-- Orbital Ellipse -->
          <ellipse cx="80" cy="80" rx="68" ry="22" transform="rotate(-20 80 80)" />
          <ellipse cx="80" cy="80" rx="74" ry="24" transform="rotate(-20 80 80)" stroke-dasharray="2 4" opacity="0.6" />
          <!-- Time Capsule Pod in Transit -->
          <circle cx="80" cy="80" r="26" fill="#fcfbf8" />
          <path d="M64 74 Q80 86 96 82" />
          <circle cx="130" cy="56" r="3" fill="#D6D6D1" />
          <!-- Star sparkle -->
          <path d="M28 36 Q28 42 34 42 Q28 42 28 48 Q28 42 22 42 Q28 42 28 36 Z" />
        </svg>
      </div>

      <div class="locked-header text-center">
        <span class="status-kicker status-locked">MESSAGE SEALED · IN TIME TRANSIT</span>
        <h1 class="letter-title serif">Pesan Sedang Menempuh Perjalanan Waktu</h1>
        <p class="locked-desc">
          Pesan ini belum mencapai waktunya dan tersimpan rapat di server sampai tanggal tujuan tiba.
        </p>
      </div>

      <!-- Destination Banner -->
      <div class="unlock-banner">
        <span class="unlock-banner-label mono">DESTINATION / WAKTU PEMBUKAAN:</span>
        <div class="unlock-banner-time serif">
          {{ $unlockAt->translatedFormat('d F Y, H:i') }} WIB
        </div>
      </div>

      <!-- Live Cosmic Countdown -->
      <div class="countdown-wrapper">
        <div class="countdown-label mono">WAKTU TERSISA MENUJU SAAT PEMBUKAAN:</div>
        <div class="countdown-grid" id="countdownGrid" data-target="{{ $unlockAt->toIso8601String() }}">
          <div class="countdown-box">
            <span class="count-val mono" id="countYears">0</span>
            <span class="count-unit">Tahun</span>
          </div>
          <div class="countdown-box">
            <span class="count-val mono" id="countDays">0</span>
            <span class="count-unit">Hari</span>
          </div>
          <div class="countdown-box">
            <span class="count-val mono" id="countHours">00</span>
            <span class="count-unit">Jam</span>
          </div>
          <div class="countdown-box">
            <span class="count-val mono" id="countMins">00</span>
            <span class="count-unit">Menit</span>
          </div>
          <div class="countdown-box">
            <span class="count-val mono" id="countSecs">00</span>
            <span class="count-unit">Detik</span>
          </div>
        </div>
      </div>

      <!-- Timeline Progress (Requirement 8 & 33) -->
      <div class="card-timeline-box">
        <div class="cosmic-timeline">
          <div class="timeline-track"></div>
          <div class="timeline-progress" style="width: 50%;"></div>
          <div class="timeline-step completed">
            <div class="step-dot">✓</div>
            <span class="step-text-title">DIBUAT</span>
            <span class="step-text-date">{{ $createdAt->format('Y') }}</span>
          </div>
          <div class="timeline-step active">
            <div class="step-dot">●</div>
            <span class="step-text-title">DISEGEL</span>
            <span class="step-text-date">IN TRANSIT</span>
          </div>
          <div class="timeline-step">
            <div class="step-dot">○</div>
            <span class="step-text-title">TERBUKA</span>
            <span class="step-text-date">{{ $unlockAt->format('Y') }}</span>
          </div>
        </div>
      </div>

      <!-- Metadata Box (Safe info only, no message body) -->
      <div class="letter-meta-box">
        <div class="meta-row">
          <span class="meta-name">Kode Kunci:</span>
          <span class="meta-data mono font-semibold">{{ $code }}</span>
        </div>
        <div class="meta-row">
          <span class="meta-name">Dari (Pengirim):</span>
          <span class="meta-data font-semibold">{{ $senderName }}</span>
        </div>
        <div class="meta-row">
          <span class="meta-name">Untuk (Penerima):</span>
          <span class="meta-data font-semibold">{{ $recipientName }}</span>
        </div>
        <div class="meta-row">
          <span class="meta-name">Judul Pesan:</span>
          <span class="meta-data">{{ $title }}</span>
        </div>
        <div class="meta-row">
          <span class="meta-name">Disimpan pada:</span>
          <span class="meta-data">{{ $createdAt->translatedFormat('d F Y') }}</span>
        </div>
      </div>

      <!-- Actions -->
      <div class="card-bottom-actions">
        @if (!$isShareView && $message->canBeEdited())
          <!-- Edit Button (Requirement 7) -->
          <a href="{{ route('messages.edit', ['code' => $code]) }}" class="btn btn-secondary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 20h9"></path>
              <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
            Edit Pesan
          </a>
        @endif

        <button type="button" class="btn btn-secondary" onclick="openShareModal({ url: '{{ route('messages.share', ['share_token' => $shareToken]) }}', title: 'Pesan Untuk Masa Depan' })">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
          Bagikan Pesan
        </button>

        <button type="button" class="btn btn-outline" onclick="copyText('{{ route('messages.share', ['share_token' => $shareToken]) }}', 'Link kapsul berhasil disalin.')">
          Salin Link
        </button>
      </div>
    </div>

  @elseif ($isUnlocked && !$isOpened)
    <!-- ================= 2. READY TO OPEN STATE (Requirement 10 & 11) ================= -->
    <div class="letter-display-card ready-to-open-card text-center" id="readyCard">
      <div class="ready-orbit-icon floating-orbit" aria-hidden="true">
        <svg viewBox="0 0 80 80" fill="none" stroke="#b0874e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="40" cy="40" r="28" fill="#fcfbf8" />
          <ellipse cx="40" cy="40" rx="38" ry="12" transform="rotate(-20 40 40)" />
          <polyline points="32 40 38 46 48 34" stroke="var(--accent)" stroke-width="2" />
        </svg>
      </div>

      <span class="status-kicker status-ready">DESTINATION REACHED · SIAP DIBUKA</span>
      <h1 class="letter-title serif">Waktu Pembukaan Telah Tiba</h1>
      <p class="locked-desc">
        Kapsul waktu ini telah menyelesaikan perjalanannya menembus tahun dan siap untuk dibuka.
      </p>

      <div class="ready-meta-box">
        <p><strong>Dari:</strong> {{ $senderName }} &nbsp;•&nbsp; <strong>Untuk:</strong> {{ $recipientName }}</p>
        <p class="serif" style="font-size: 17px; margin-top: 6px; color: var(--ink);">“{{ $title }}”</p>
      </div>

      <!-- Big Unlock Trigger Button (Requirement 11: 1-2 sec unlock animation) -->
      <div class="ready-actions">
        <button type="button" class="btn btn-primary btn-hero" id="triggerOpenAnimationBtn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="7.5" cy="15.5" r="5.5"></circle>
            <path d="m21 2-2 2m-6 6 7 7-4 4-7-7"></path>
          </svg>
          Buka Pesan Sekarang
        </button>
      </div>

      <!-- Unlock Animation Overlay (Requirement 11) -->
      <div id="unlockAnimationOverlay" class="unlock-animation-overlay">
        <div class="unlock-anim-content">
          <div class="unlock-spinner-orbit">
            <svg viewBox="0 0 100 100" fill="none" stroke="var(--accent)" stroke-width="2">
              <circle cx="50" cy="50" r="36" stroke-dasharray="8 6" style="animation: orbit-spin 4s linear infinite;" />
              <circle cx="50" cy="50" r="16" fill="var(--gold-soft)" stroke="var(--gold)" />
            </svg>
          </div>
          <h3 class="serif" style="font-size: 24px; color: var(--ink); margin-top: 16px;">Membuka Segel Waktu...</h3>
          <p style="color: var(--muted); font-size: 13px;">Surat sedang dikeluarkan dari kapsul digital.</p>
        </div>
      </div>
    </div>

  @else
    <!-- ================= 3. OPENED STATE (Requirement 12, 13, 14, 15, 17) ================= -->
    <div class="letter-display-card unlocked-card">
      <div class="unlocked-seal" aria-hidden="true">
        <div class="seal-ring">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
      </div>

      <div class="unlocked-header text-center">
        <span class="status-kicker status-unlocked">TIME CAPSULE OPENED</span>
        <h1 class="letter-title serif">Kapsul Waktu Telah Terbuka</h1>
      </div>

      <!-- Digital Letter Parchment (Requirement 12) -->
      <article class="letter-parchment">
        <!-- Letter Top Metadata -->
        <div class="letter-top-info">
          <div class="letter-meta-side">
            <span class="to-label">FROM / PENGIRIM:</span>
            <div class="to-name serif">{{ $senderName }}</div>
          </div>
          <div class="letter-meta-side text-right-desktop">
            <span class="to-label">TO / PENERIMA:</span>
            <div class="to-name serif">{{ $recipientName }}</div>
          </div>
        </div>

        <div class="letter-title-row">
          <h2 class="letter-subject serif">{{ $title }}</h2>
        </div>

        <div class="letter-divider"></div>

        <!-- The Message Body (Safely escaped & formatted) -->
        <div class="letter-body-content serif">
          {!! nl2br(e($messageContent)) !!}
        </div>

        <div class="letter-closing">
          <div class="closing-mark serif">~ ~ ~</div>
        </div>

        <!-- Timestamps (Requirement 12 & 13) -->
        <div class="letter-timestamps">
          <div class="timestamp-col">
            <span class="ts-label">Dibuat pada:</span>
            <span class="ts-val">{{ $createdAt->translatedFormat('d F Y, H:i') }} WIB</span>
          </div>
          <div class="timestamp-col">
            <span class="ts-label">Dibuka pada:</span>
            <span class="ts-val highlight">{{ $unlockAt->translatedFormat('d F Y, H:i') }} WIB</span>
          </div>
        </div>

        <!-- Timeline: CREATED -> SEALED -> OPENED (Requirement 12 & 33) -->
        <div class="opened-timeline-wrap">
          <div class="cosmic-timeline">
            <div class="timeline-track"></div>
            <div class="timeline-progress" style="width: 100%;"></div>
            <div class="timeline-step completed">
              <div class="step-dot">✓</div>
              <span class="step-text-title">DIBUAT</span>
              <span class="step-text-date">{{ $createdAt->format('Y') }}</span>
            </div>
            <div class="timeline-step completed">
              <div class="step-dot">✓</div>
              <span class="step-text-title">DISEGEL</span>
              <span class="step-text-date">{{ $createdAt->translatedFormat('d M') }}</span>
            </div>
            <div class="timeline-step active">
              <div class="step-dot">✓</div>
              <span class="step-text-title">TERBUKA</span>
              <span class="step-text-date">{{ $unlockAt->format('Y') }}</span>
            </div>
          </div>
        </div>
      </article>

      <!-- Completion Banner (Requirement 14) -->
      <div class="journey-complete-banner text-center">
        <p class="serif complete-phrase">“This message has completed its journey through time.”</p>
        <span class="complete-sub">Pesan ini telah sampai pada masa yang dinantikan.</span>
      </div>

      <!-- Bottom Actions: PDF & Share (Requirement 14, 15, 17) -->
      <div class="unlocked-actions">
        <!-- Download PDF -->
        @if ($isShareView)
          <a href="{{ route('messages.sharePdf', ['share_token' => $shareToken]) }}" class="btn btn-primary" download>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="7 10 12 15 17 10"></polyline>
              <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
            Download PDF
          </a>
        @else
          <a href="{{ route('messages.downloadPdf', ['code' => $code]) }}" class="btn btn-primary" download>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="7 10 12 15 17 10"></polyline>
              <line x1="12" y1="15" x2="12" y2="3"></line>
            </svg>
            Download PDF
          </a>
        @endif

        <!-- Share Modal Button -->
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

        <a href="{{ route('messages.create') }}" class="btn btn-outline">
          Tulis Pesan Baru
        </a>
      </div>
    </div>
  @endif

</div>
@endsection

@section('styles')
<style>
  .container-narrow { max-width: 720px; }
  .text-center { text-align: center; }

  .letter-display-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    padding: 44px 36px;
    position: relative;
    overflow: hidden;
  }

  /* Locked / In Transit Styles */
  .capsule-space-orbit {
    width: 90px;
    height: 90px;
    margin: 0 auto 16px;
  }
  .capsule-space-orbit svg { width: 100%; height: 100%; display: block; }

  .status-kicker {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    padding: 4px 14px;
    border-radius: var(--radius-pill);
    margin-bottom: 12px;
  }
  .status-locked { background: var(--surface-muted); color: var(--muted); }
  .status-ready { background: var(--gold-soft); color: var(--gold); }
  .status-unlocked { background: var(--accent-soft); color: var(--accent-dark); }

  .letter-title {
    font-size: clamp(28px, 4.5vw, 40px);
    line-height: 1.15;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 8px;
  }
  .locked-desc { font-size: 15px; color: var(--muted); margin-bottom: 28px; }

  .unlock-banner {
    background: var(--paper-warm);
    border: 1px solid var(--line);
    border-radius: 14px;
    padding: 22px;
    text-align: center;
    margin-bottom: 28px;
  }
  .unlock-banner-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--muted);
    margin-bottom: 6px;
  }
  .unlock-banner-time {
    font-size: clamp(22px, 3.5vw, 28px);
    font-weight: 600;
    color: var(--ink);
  }

  .countdown-wrapper { margin-bottom: 28px; text-align: center; }
  .countdown-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.14em;
    color: var(--muted);
    margin-bottom: 12px;
  }
  .countdown-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
    max-width: 520px;
    margin: 0 auto;
  }
  .countdown-box {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 12px 6px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .count-val {
    font-size: 24px;
    font-weight: 700;
    color: var(--accent-dark);
    line-height: 1.1;
  }
  .count-unit {
    font-size: 10px;
    color: var(--muted);
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .card-timeline-box {
    background: var(--paper-warm);
    border: 1px solid var(--line-subtle);
    border-radius: 12px;
    padding: 12px 18px;
    margin-bottom: 28px;
  }

  .letter-meta-box {
    border-top: 1px solid var(--line-subtle);
    border-bottom: 1px solid var(--line-subtle);
    padding: 16px 0;
    margin-bottom: 28px;
  }
  .meta-row {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 13px;
  }
  .meta-name { color: var(--muted); }
  .meta-data { color: var(--ink); }

  .card-bottom-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  /* Ready to Open Style */
  .ready-orbit-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 16px;
  }
  .ready-meta-box {
    background: var(--paper-warm);
    border: 1px solid var(--line);
    border-radius: 14px;
    padding: 20px;
    max-width: 480px;
    margin: 0 auto 28px;
    font-size: 14px;
  }
  .ready-actions { margin-top: 8px; }

  /* Unlock Animation Overlay */
  .unlock-animation-overlay {
    position: absolute;
    inset: 0;
    background: rgba(253, 252, 248, 0.96);
    backdrop-filter: blur(8px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10;
  }
  .unlock-animation-overlay.active {
    display: flex;
    animation: capsule-reveal .3s ease both;
  }
  .unlock-spinner-orbit {
    width: 84px;
    height: 84px;
    margin: 0 auto;
  }

  /* Opened Style */
  .unlocked-seal { text-align: center; margin-bottom: 16px; }
  .seal-ring {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent-soft);
    color: var(--accent-dark);
    display: grid;
    place-items: center;
    margin: 0 auto;
    border: 2px solid rgba(70, 104, 90, 0.25);
  }

  .letter-parchment {
    background: var(--paper-warm);
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    padding: 40px 36px;
    margin: 28px 0;
    position: relative;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, .02);
    animation: capsule-reveal .4s ease both;
  }

  .letter-top-info {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 18px;
  }
  .to-label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--muted);
    text-transform: uppercase;
    margin-bottom: 4px;
  }
  .to-name {
    font-size: 22px;
    font-weight: 600;
    color: var(--ink);
  }
  .text-right-desktop { text-align: right; }

  .letter-title-row { margin-bottom: 12px; }
  .letter-subject {
    font-size: 26px;
    color: var(--accent-dark);
    letter-spacing: -0.015em;
  }

  .letter-divider {
    height: 1px;
    background: var(--line);
    margin: 16px 0 24px;
  }

  .letter-body-content {
    font-size: 18px;
    line-height: 1.85;
    color: var(--ink);
    white-space: pre-wrap;
    word-break: break-word;
    min-height: 120px;
  }

  .letter-closing { text-align: center; margin-top: 32px; }
  .closing-mark { font-size: 22px; color: var(--gold); letter-spacing: 0.2em; }

  .letter-timestamps {
    margin-top: 32px;
    padding-top: 20px;
    border-top: 1px dashed var(--line);
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    flex-wrap: wrap;
    gap: 12px;
  }
  .ts-label { color: var(--muted); margin-right: 6px; }
  .ts-val { color: var(--ink-soft); font-weight: 500; }
  .ts-val.highlight { color: var(--accent-dark); font-weight: 600; }

  .opened-timeline-wrap {
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid var(--line-subtle);
  }

  .journey-complete-banner {
    padding: 16px 20px;
    background: var(--surface-muted);
    border-radius: 12px;
    margin-bottom: 28px;
  }
  .complete-phrase {
    font-size: 16px;
    font-style: italic;
    color: var(--ink);
    margin-bottom: 4px;
  }
  .complete-sub {
    font-size: 12px;
    color: var(--muted);
  }

  .unlocked-actions {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  @media (max-width: 600px) {
    .letter-display-card { padding: 30px 20px; }
    .letter-parchment { padding: 24px 18px; }
    .letter-top-info { flex-direction: column; gap: 12px; }
    .text-right-desktop { text-align: left; }
    .countdown-grid { gap: 6px; }
    .count-val { font-size: 18px; }
    .card-bottom-actions, .unlocked-actions { flex-direction: column; }
    .card-bottom-actions .btn, .unlocked-actions .btn { width: 100%; }
    .letter-timestamps { flex-direction: column; gap: 6px; }
  }
</style>
@endsection

@section('scripts')
@if (!$isUnlocked)
<script>
  // Countdown Timer with Year support
  (function () {
    const grid = document.getElementById('countdownGrid');
    if (!grid) return;

    const targetDate = new Date(grid.getAttribute('data-target')).getTime();
    const yearsEl = document.getElementById('countYears');
    const daysEl = document.getElementById('countDays');
    const hoursEl = document.getElementById('countHours');
    const minsEl = document.getElementById('countMins');
    const secsEl = document.getElementById('countSecs');

    function update() {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance <= 0) {
        window.location.reload();
        return;
      }

      const totalDays = Math.floor(distance / (1000 * 60 * 60 * 24));
      const years = Math.floor(totalDays / 365);
      const remainingDays = totalDays % 365;
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      if (yearsEl) yearsEl.textContent = years;
      if (daysEl) daysEl.textContent = remainingDays;
      if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
      if (minsEl) minsEl.textContent = String(minutes).padStart(2, '0');
      if (secsEl) secsEl.textContent = String(seconds).padStart(2, '0');
    }

    update();
    setInterval(update, 1000);
  })();
</script>
@elseif ($isUnlocked && !$isOpened)
<script>
  // Reveal animation logic (Requirement 11)
  const triggerBtn = document.getElementById('triggerOpenAnimationBtn');
  const overlay = document.getElementById('unlockAnimationOverlay');

  if (triggerBtn && overlay) {
    triggerBtn.addEventListener('click', () => {
      overlay.classList.add('active');
      setTimeout(() => {
        const url = new URL(window.location.href);
        url.searchParams.set('open', '1');
        window.location.href = url.toString();
      }, 1500);
    });
  }
</script>
@endif
@endsection
