@extends('layouts.app')

@section('title', 'Pesan Untuk Masa Depan — Kotak Waktu Digital')
@section('meta_description', 'Tulis sesuatu hari ini, lalu biarkan waktu menentukan kapan pesan itu akan terbuka. Kapsul waktu digital tanpa login.')

@section('content')
<div class="container container-landing">

  <!-- ================= HERO SECTION ================= -->
  <section class="hero-section">
    <!-- Celestial Background Orbit Canvas (Low-contrast, subtle) -->
    <div class="hero-celestial-canvas" aria-hidden="true">
      <svg class="celestial-svg" viewBox="0 0 1200 680" fill="none" stroke="#D6D6D1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
        
        <!-- Sweeping trajectory connecting Now to Future -->
        <path d="M 50 510 C 220 490, 390 390, 540 260 C 670 150, 840 90, 990 110 C 1100 125, 1160 205, 1120 315 C 1080 425, 950 485, 810 465" />
        <path d="M 110 550 C 260 530, 420 440, 570 310 C 700 190, 870 135, 1020 150 C 1110 160, 1160 220, 1130 300" stroke-dasharray="3 6" opacity="0.65" />

        <!-- Origin Node (Hari Ini) -->
        <circle cx="50" cy="510" r="3.5" fill="#D6D6D1" />
        <circle cx="50" cy="510" r="8" stroke-dasharray="2 3" />
        <text x="24" y="536" fill="#D6D6D1" font-family="'JetBrains Mono', monospace" font-size="9" letter-spacing="0.16em" stroke="none">HARI INI</text>

        <!-- Mid Transit Node -->
        <circle cx="540" cy="260" r="2.5" fill="#D6D6D1" />
        <circle cx="540" cy="260" r="6" stroke-dasharray="1.5 3" />

        <!-- Arrival Node (Masa Depan) -->
        <circle cx="990" cy="110" r="3.5" fill="#D6D6D1" />
        <circle cx="990" cy="110" r="9" stroke-dasharray="2 3" />
        <text x="1014" y="94" fill="#D6D6D1" font-family="'JetBrains Mono', monospace" font-size="9" letter-spacing="0.16em" stroke="none">MASA DEPAN</text>

        <!-- Editorial Celestial Chronometer -->
        <g transform="translate(690, 75)">
          <circle cx="0" cy="0" r="20" />
          <circle cx="0" cy="0" r="15" stroke-dasharray="2 3" opacity="0.75" />
          <circle cx="0" cy="0" r="1.5" fill="#D6D6D1" />
          <line x1="0" y1="0" x2="0" y2="-10" />
          <line x1="0" y1="0" x2="8" y2="0" />
          <line x1="0" y1="-20" x2="0" y2="-17" />
          <line x1="20" y1="0" x2="17" y2="0" />
          <line x1="0" y1="20" x2="0" y2="17" />
          <line x1="-20" y1="0" x2="-17" y2="0" />
        </g>

        <!-- Constellation Twinkles -->
        <g class="twinkle-star">
          <path d="M 120 52 Q 120 60 128 60 Q 120 60 120 68 Q 120 60 112 60 Q 120 60 120 52 Z" />
          <circle cx="170" cy="85" r="1.5" fill="#D6D6D1" />
          <path d="M 120 60 L 170 85 L 220 70" stroke-dasharray="2 3" opacity="0.6" />
          <circle cx="220" cy="70" r="2" fill="#D6D6D1" />
        </g>
        <g class="twinkle-star" style="animation-delay: 2s;">
          <path d="M 460 38 Q 460 44 466 44 Q 460 44 460 50 Q 460 44 454 44 Q 460 44 460 38 Z" />
          <path d="M 1140 210 Q 1140 217 1147 217 Q 1140 217 1140 224 Q 1140 217 1133 217 Q 1140 217 1140 210 Z" />
        </g>
      </svg>
    </div>

    <div class="hero-grid">
      <!-- Left Content -->
      <div class="hero-content">
       
        <h1 class="hero-title serif">
          Tulis sesuatu untuk <em>masa depan.</em>
        </h1>
        <p class="hero-description">
          Beberapa pesan tidak perlu dikirim hari ini. Biarkan waktu dan takdir menentukan saat kata-katamu siap untuk dibuka kembali.
        </p>

        <div class="hero-actions">
          <a href="{{ route('messages.create') }}" class="btn btn-primary btn-hero">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 20h9"></path>
              <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
            Buat Pesan
          </a>
          <a href="{{ route('messages.openForm') }}" class="btn btn-secondary btn-hero">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Buka Pesan
          </a>
        </div>

        <div class="hero-stats">
          <div class="stat-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span>Terkunci oleh Waktu</span>
          </div>
          <div class="stat-divider">•</div>
          <div class="stat-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
            </svg>
            <span>Kode adalah Kunci</span>
          </div>
          <div class="stat-divider">•</div>
          <div class="stat-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="8.5" cy="7" r="4"></circle>
              <line x1="18" y1="8" x2="23" y2="13"></line>
              <line x1="23" y1="8" x2="18" y2="13"></line>
            </svg>
            <span>Tanpa Registrasi</span>
          </div>
        </div>
      </div>

      <!-- Right Visual: Planet + Orbit + Timeline + Letter Capsule (Requirement 3) -->
      <div class="hero-visual" aria-hidden="true">
        <!-- Floating Planet Orbit Illustration -->
        <div class="cosmic-orbit-anchor floating-orbit">
          <svg viewBox="0 0 340 340" fill="none" stroke="#D6D6D1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="hero-planet-svg">
            <!-- Large Editorial Planet -->
            <circle cx="170" cy="170" r="58" fill="#fcfbf8" />
            <!-- Contour lines -->
            <path d="M125 145 Q170 190 220 180" />
            <path d="M138 190 Q172 210 205 200" />
            <!-- Planetary Rings -->
            <ellipse cx="170" cy="170" rx="125" ry="34" transform="rotate(-24 170 170)" />
            <ellipse cx="170" cy="170" rx="142" ry="38" transform="rotate(-24 170 170)" stroke-dasharray="3 5" opacity="0.65" />
            <!-- Orbiting satellite moon -->
            <circle cx="260" cy="105" r="3.5" fill="#D6D6D1" />
            <ellipse cx="170" cy="170" rx="160" ry="75" transform="rotate(-24 170 170)" stroke-dasharray="2 6" opacity="0.4" />
          </svg>
        </div>

        <!-- The Traveling Time Capsule Card -->
        <div class="capsule-card">
          <div class="envelope-top-bar">
            <span class="wax-seal">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="m9 12 2 2 4-4"></path>
              </svg>
            </span>
            <div class="envelope-meta">
              <span class="meta-label">KAPSUL WAKTU</span>
              <span class="meta-date">Transit Menuju Masa Depan</span>
            </div>
          </div>

          <div class="letter-preview">
            <div class="letter-quote serif">
              “Semoga saat kamu membaca surat ini, segala hal yang dulu kamu khawatirkan sudah menjadi kebahagiaan yang kamu syukuri.”
            </div>
          </div>

          <!-- Hero Timeline Trajectory (Requirement 3: 2026 ────── 2030 ────── 2035) -->
          <div class="hero-mini-timeline">
            <div class="h-timeline-line">
              <div class="h-timeline-node past">2026</div>
              <div class="h-timeline-node current active">
                <span class="capsule-node-indicator">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="6" />
                  </svg>
                </span>
                <span class="node-tag">pesanmu</span>
              </div>
              <div class="h-timeline-node future">2030</div>
              <div class="h-timeline-node future">2035</div>
            </div>
          </div>

          <div class="capsule-footer">
            <div class="capsule-code mono">XXXX-XXXX</div>
            <div class="capsule-status">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              Terkunci Aman
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CARA KERJA TIMELINE SECTION (Requirement 7 & 8) ================= -->
  <section class="how-section">
    <div class="section-header">
      <span class="section-kicker">ALUR PERJALANAN WAKTU</span>
      <h2 class="section-title serif">Tiga langkah menuju masa depan</h2>
      <p class="section-subtitle">
        Pesanmu disimpan sebagai kapsul waktu yang melintasi tahun demi tahun hingga waktu yang kamu tentukan.
      </p>
    </div>

    <!-- Integrated Celestial Timeline Bar (Connecting Steps 01 -> 02 -> 03) -->
    <div class="connected-timeline-container" aria-hidden="true">
      <div class="time-track-bar">
        <div class="time-track-line"></div>
        <div class="time-track-progress"></div>
      </div>
      <div class="time-nodes-row">
        <div class="t-node-point active">
          <span class="node-year mono">{{ date('Y') }}</span>
          <span class="node-dot-symbol">●</span>
          <span class="node-desc">TULIS</span>
        </div>
        <div class="t-node-point">
          <span class="node-year mono">{{ date('Y') + 1 }}</span>
          <span class="node-dot-symbol">●</span>
          <span class="node-desc">DISEGEL</span>
        </div>
        <div class="t-node-point">
          <span class="node-year mono">{{ date('Y') + 5 }}+</span>
          <span class="node-dot-symbol">●</span>
          <span class="node-desc">TERBUKA</span>
        </div>
      </div>
    </div>

    <!-- 3 Connected Steps Grid -->
    <div class="steps-grid">
      <!-- Step 1 -->
      <div class="step-card">
        <div class="step-card-header">
          <div class="step-number">FASE 01</div>
          <div class="step-badge-year mono">{{ date('Y') }}</div>
        </div>
        <div class="step-icon">
          <!-- Feather Quill / Pen Icon -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
        </div>
        <h3 class="step-title">Tulis Pesanmu</h3>
        <p class="step-desc">
          Tuliskan harapan, cerita masa kini, atau pesan rahasia untuk dirimu sendiri maupun orang tercinta di masa depan.
        </p>
        <div class="step-orbit-subtle" aria-hidden="true">
          <svg viewBox="0 0 80 40" fill="none" stroke="#D6D6D1" stroke-width="1">
            <ellipse cx="40" cy="20" rx="36" ry="12" stroke-dasharray="2 4" />
            <circle cx="68" cy="14" r="2" fill="#D6D6D1" />
          </svg>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step-card">
        <div class="step-card-header">
          <div class="step-number">FASE 02</div>
          <div class="step-badge-year mono">TRANSIT</div>
        </div>
        <div class="step-icon">
          <!-- Astronomical Clock / Seal Icon -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
        <h3 class="step-title">Kunci Waktu</h3>
        <p class="step-desc">
          Tentukan tanggal dan waktu pembukaan. Sistem mengunci surat di server dan memberikan kode unik 8 karakter sebagai kunci.
        </p>
        <div class="step-orbit-subtle" aria-hidden="true">
          <svg viewBox="0 0 80 40" fill="none" stroke="#D6D6D1" stroke-width="1">
            <circle cx="40" cy="20" r="14" stroke-dasharray="2 3" />
            <line x1="40" y1="20" x2="40" y2="12" />
            <line x1="40" y1="20" x2="48" y2="20" />
          </svg>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-card">
        <div class="step-card-header">
          <div class="step-number">FASE 03</div>
          <div class="step-badge-year mono">MASA DEPAN</div>
        </div>
        <div class="step-icon">
          <!-- Planet & Key Icon -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="7.5" cy="15.5" r="5.5"></circle>
            <path d="m21 2-2 2m-6 6 7 7-4 4-7-7"></path>
          </svg>
        </div>
        <h3 class="step-title">Buka & Bagikan</h3>
        <p class="step-desc">
          Saat waktu tiba, masukkan kode kunci untuk membuka surat, simpan salinan dokumen PDF resmi, atau bagikan ke media sosial.
        </p>
        <div class="step-orbit-subtle" aria-hidden="true">
          <svg viewBox="0 0 80 40" fill="none" stroke="#D6D6D1" stroke-width="1">
            <circle cx="40" cy="20" r="10" />
            <ellipse cx="40" cy="20" rx="22" ry="7" transform="rotate(-18 40 20)" />
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= PHILOSOPHY / QUOTE BANNER ================= -->
  <section class="quote-section">
    <div class="quote-card">
      <div class="quote-celestial-accent" aria-hidden="true">
        <svg viewBox="0 0 240 24" fill="none" stroke="#D6D6D1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="10" y1="12" x2="90" y2="12" stroke-dasharray="2 4" />
          <path d="M120 4 Q120 12 128 12 Q120 12 120 20 Q120 12 112 12 Q120 12 120 4 Z" />
          <circle cx="102" cy="12" r="1.5" fill="#D6D6D1" />
          <circle cx="138" cy="12" r="1.5" fill="#D6D6D1" />
          <line x1="150" y1="12" x2="230" y2="12" stroke-dasharray="2 4" />
        </svg>
      </div>

      <div class="quote-icon serif">“</div>
      <p class="quote-text serif">
        Waktu adalah jarak terjauh yang bisa kita tempuh. Namun lewat sebaris kata yang ditulis hari ini, kamu sedang berbicara langsung dengan dirimu di masa yang akan datang.
      </p>
      <div class="quote-action">
        <a href="{{ route('messages.create') }}" class="btn btn-primary">
          Mulai Menulis Kapsul Waktu
        </a>
      </div>
    </div>
  </section>

  <!-- ================= KODEKU — Kapsul Waktuku ================= -->
  @auth
  <section id="kodeku" class="kodeku-section">
    <div class="kodeku-header">
      <div>
        <span class="section-kicker">KAPSUL WAKTUKU</span>
        <h2 class="section-title serif" style="margin-top: 6px;">Kodeku</h2>
        <p class="section-subtitle" style="margin-top: 4px;">
          Pesan masa depan yang kamu simpan. Hanya kamu yang bisa melihat ini.
        </p>
      </div>
      <a href="{{ route('messages.create') }}" class="btn btn-secondary kodeku-new-btn">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        Buat Pesan Baru
      </a>
    </div>

    @if ($myMessages->isEmpty())
      <div class="kodeku-empty">
        <div class="kodeku-empty-icon" aria-hidden="true">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 7h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1z"/>
            <path d="m4 8 8 5.5L20 8"/>
          </svg>
        </div>
        <p class="kodeku-empty-title">Belum ada kapsul waktu.</p>
        <p class="kodeku-empty-sub">Tuliskan pesan pertamamu untuk seseorang di masa depan.</p>
        <a href="{{ route('messages.create') }}" class="btn btn-primary" style="margin-top: 16px; min-height: 42px; padding: 0 20px; font-size: 14px;">
          Buat Pesan Pertama
        </a>
      </div>
    @else
      <div class="kodeku-list">
        @foreach ($myMessages as $msg)
          @php $isUnlocked = $msg->isUnlocked(); @endphp
          <a href="{{ route('messages.show', ['code' => $msg->code]) }}" class="kodeku-row" title="Buka pesan {{ $msg->code }}">
            <div class="kodeku-code mono">{{ $msg->code }}</div>
            <div class="kodeku-info">
              <span class="kodeku-title">{{ $msg->title ?: 'Surat Untuk Masa Depan' }}</span>
              @if ($msg->recipient_name)
                <span class="kodeku-recipient">untuk {{ $msg->recipient_name }}</span>
              @endif
            </div>
            <div class="kodeku-unlock-date">
              {{ $msg->unlock_at->format('d M Y') }}
            </div>
            <div class="kodeku-status {{ $isUnlocked ? 'status-open' : 'status-locked' }}">
              @if ($isUnlocked)
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 9.9-1"/>
                </svg>
                Terbuka
              @else
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Masih Terkunci
              @endif
            </div>
          </a>
        @endforeach
      </div>

      @if ($myMessages->count() >= 5)
        <div class="kodeku-see-all">
          <a href="{{ route('messages.openForm') }}" class="kodeku-see-all-link">
            Gunakan kode untuk melihat pesan lainnya
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      @endif
    @endif
  </section>
  @endauth

</div>
@endsection

@section('styles')
<style>
  .container-landing { position: relative; }

  /* Hero Section */
  .hero-section {
    position: relative;
    padding: 56px 0 72px;
    overflow: visible;
  }

  .hero-celestial-canvas {
    position: absolute;
    top: -24px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% + 140px);
    max-width: 1280px;
    height: 100%;
    min-height: 600px;
    pointer-events: none;
    z-index: 0;
    overflow: visible;
  }

  .celestial-svg {
    width: 100%;
    height: 100%;
    display: block;
    overflow: visible;
  }

  .hero-grid {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 48px;
    align-items: center;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: var(--radius-pill);
    background: var(--accent-soft);
    color: var(--accent-dark);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-bottom: 24px;
  }

  .pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 0 3px rgba(70, 104, 90, 0.2);
  }

  .hero-title {
    font-size: clamp(38px, 5.5vw, 64px);
    line-height: 1.12;
    letter-spacing: -0.035em;
    color: var(--ink);
    margin-bottom: 20px;
  }

  .hero-title em {
    font-style: italic;
    color: var(--accent);
  }

  .hero-description {
    font-size: 18px;
    line-height: 1.7;
    color: var(--ink-soft);
    margin-bottom: 32px;
    max-width: 520px;
  }

  .hero-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 36px;
  }

  .btn-hero {
    min-height: 52px;
    padding: 0 28px;
    font-size: 15px;
  }

  .hero-stats {
    display: flex;
    align-items: center;
    gap: 14px;
    color: var(--muted);
    font-size: 13px;
    flex-wrap: wrap;
  }

  .stat-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .stat-divider { color: var(--line); }

  /* Hero Visual: Card + Background Planet Anchor */
  .hero-visual {
    position: relative;
    z-index: 2;
  }

  .cosmic-orbit-anchor {
    position: absolute;
    top: -45px;
    right: -45px;
    width: 310px;
    height: 310px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.85;
  }

  .hero-planet-svg {
    width: 100%;
    height: 100%;
    display: block;
  }

  .capsule-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    padding: 32px;
    position: relative;
    z-index: 2;
    transform: rotate(1deg);
    transition: transform .3s ease, box-shadow .3s ease;
  }

  .capsule-card:hover {
    transform: rotate(0deg) translateY(-4px);
    box-shadow: 0 30px 70px rgba(34, 38, 36, .12);
  }

  .envelope-top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 18px;
    border-bottom: 1px dashed var(--line);
    margin-bottom: 20px;
  }

  .wax-seal {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--gold-soft);
    color: var(--gold);
    display: grid;
    place-items: center;
    border: 1px solid rgba(176, 135, 78, 0.3);
  }

  .envelope-meta { text-align: right; }
  .meta-label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--muted);
  }
  .meta-date {
    font-size: 12px;
    font-weight: 600;
    color: var(--accent-dark);
  }

  .letter-preview { margin-bottom: 20px; }
  .letter-quote {
    padding: 16px 20px;
    background: var(--paper-warm);
    border-left: 2px solid var(--accent);
    border-radius: 0 10px 10px 0;
    font-size: 14px;
    line-height: 1.6;
    color: var(--ink-soft);
    font-style: italic;
  }

  /* Hero Mini Timeline Bar */
  .hero-mini-timeline {
    background: var(--surface-muted);
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 20px;
  }
  .h-timeline-line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
  }
  .h-timeline-line::before {
    content: "";
    position: absolute;
    left: 10px;
    right: 10px;
    height: 2px;
    background: var(--line);
    z-index: 1;
  }
  .h-timeline-node {
    position: relative;
    z-index: 2;
    background: var(--surface);
    border: 1px solid var(--line);
    padding: 3px 8px;
    border-radius: var(--radius-pill);
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    color: var(--muted);
  }
  .h-timeline-node.active {
    background: var(--accent);
    border-color: var(--accent-dark);
    color: #fff;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(70, 104, 90, 0.3);
  }
  .capsule-node-indicator {
    display: inline-block;
    vertical-align: middle;
    margin-right: 2px;
  }
  .node-tag {
    font-size: 10px;
    letter-spacing: 0.05em;
  }

  .capsule-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 18px;
    border-top: 1px solid var(--line-subtle);
  }

  .capsule-code {
    font-size: 14px;
    font-weight: 700;
    color: var(--muted);
    letter-spacing: 0.1em;
  }

  .capsule-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--accent);
  }

  /* How It Works Section */
  .how-section {
    position: relative;
    padding: 64px 0;
    border-top: 1px solid var(--line-subtle);
  }

  .section-header {
    text-align: center;
    max-width: 580px;
    margin: 0 auto 36px;
  }

  .section-kicker {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.16em;
    color: var(--accent);
    margin-bottom: 12px;
  }

  .section-title {
    font-size: clamp(28px, 4vw, 38px);
    line-height: 1.2;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 14px;
  }

  .section-subtitle {
    color: var(--muted);
    font-size: 15px;
    line-height: 1.6;
  }

  /* Connected Timeline Bar */
  .connected-timeline-container {
    max-width: 780px;
    margin: 0 auto 40px;
    position: relative;
  }
  .time-track-bar {
    position: relative;
    height: 2px;
    background: var(--line);
    margin-bottom: 14px;
  }
  .time-track-progress {
    position: absolute;
    top: 0;
    left: 0;
    width: 35%;
    height: 100%;
    background: var(--accent);
  }
  .time-nodes-row {
    display: flex;
    justify-content: space-between;
  }
  .t-node-point {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
  }
  .node-year {
    font-size: 12px;
    font-weight: 700;
    color: var(--ink-soft);
  }
  .node-dot-symbol {
    color: var(--line);
    font-size: 12px;
    line-height: 1;
  }
  .t-node-point.active .node-dot-symbol {
    color: var(--accent);
  }
  .node-desc {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--muted);
  }

  .steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .step-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    padding: 32px 26px;
    position: relative;
    overflow: hidden;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  }

  .step-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
    border-color: var(--accent-soft);
  }

  .step-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }

  .step-number {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    font-weight: 700;
    color: var(--gold);
    letter-spacing: 0.1em;
  }

  .step-badge-year {
    font-size: 10px;
    font-weight: 700;
    color: var(--accent-dark);
    background: var(--accent-soft);
    padding: 3px 8px;
    border-radius: var(--radius-pill);
    letter-spacing: 0.05em;
  }

  .step-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: var(--accent-soft);
    color: var(--accent-dark);
    display: grid;
    place-items: center;
    margin-bottom: 20px;
  }

  .step-title {
    font-size: 18px;
    font-weight: 700;
    letter-spacing: -0.015em;
    color: var(--ink);
    margin-bottom: 10px;
  }

  .step-desc {
    color: var(--muted);
    font-size: 14px;
    line-height: 1.65;
  }

  .step-orbit-subtle {
    margin-top: 18px;
    height: 30px;
    opacity: 0.7;
    pointer-events: none;
  }
  .step-orbit-subtle svg {
    width: 70px;
    height: 100%;
    display: block;
  }

  /* Quote / Callout Section */
  .quote-section { padding: 40px 0 20px; }
  .quote-card {
    background: linear-gradient(135deg, var(--surface) 0%, var(--paper-warm) 100%);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 48px 40px;
    text-align: center;
    position: relative;
    max-width: 820px;
    margin: 0 auto;
    box-shadow: var(--shadow-sm);
  }
  .quote-celestial-accent {
    width: 180px;
    margin: 0 auto 12px;
    pointer-events: none;
  }
  .quote-celestial-accent svg {
    width: 100%;
    height: auto;
    display: block;
  }
  .quote-icon {
    font-size: 64px;
    line-height: 1;
    color: var(--accent);
    opacity: 0.25;
    margin-bottom: -16px;
  }
  .quote-text {
    font-size: clamp(19px, 2.5vw, 24px);
    line-height: 1.6;
    color: var(--ink);
    font-style: italic;
    max-width: 660px;
    margin: 0 auto 28px;
  }

  @media (max-width: 860px) {
    .hero-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .hero-visual {
      max-width: 440px;
      margin: 0 auto;
    }
    .cosmic-orbit-anchor {
      top: -30px;
      right: -20px;
      width: 240px;
      height: 240px;
    }
    .connected-timeline-container { display: none; }
    .steps-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }
    .quote-card { padding: 36px 24px; }
  }

  @media (max-width: 600px) {
    .hero-celestial-canvas {
      opacity: 0.6;
      width: 110%;
    }
    .cosmic-orbit-anchor {
      display: none;
    }
  }

  /* ── Kodeku Section ───────────────────────────────────────────── */
  .kodeku-section {
    padding: 56px 0 72px;
    border-top: 1px solid var(--line-subtle);
  }

  .kodeku-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
    flex-wrap: wrap;
  }

  .kodeku-new-btn {
    min-height: 40px;
    padding: 0 18px;
    font-size: 13px;
    flex-shrink: 0;
  }

  /* Empty state */
  .kodeku-empty {
    background: var(--surface);
    border: 1px dashed var(--line);
    border-radius: var(--radius-md);
    padding: 48px 24px;
    text-align: center;
  }

  .kodeku-empty-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: var(--accent-soft);
    color: var(--accent);
    margin-bottom: 16px;
  }

  .kodeku-empty-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--ink);
    margin: 0 0 6px;
  }

  .kodeku-empty-sub {
    font-size: 14px;
    color: var(--muted);
    margin: 0;
  }

  /* Message list */
  .kodeku-list {
    display: flex;
    flex-direction: column;
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    overflow: hidden;
    background: var(--surface);
  }

  .kodeku-row {
    display: grid;
    grid-template-columns: auto 1fr auto auto;
    align-items: center;
    gap: 16px;
    padding: 16px 20px;
    text-decoration: none;
    color: var(--ink);
    border-bottom: 1px solid var(--line-subtle);
    transition: background .18s ease;
  }

  .kodeku-row:last-child {
    border-bottom: none;
  }

  .kodeku-row:hover {
    background: var(--accent-soft);
  }

  .kodeku-code {
    font-size: 13px;
    font-weight: 600;
    color: var(--accent-dark);
    letter-spacing: 0.05em;
    background: var(--accent-soft);
    border: 1px solid var(--line);
    border-radius: var(--radius-sm);
    padding: 4px 10px;
    white-space: nowrap;
  }

  .kodeku-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
  }

  .kodeku-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .kodeku-recipient {
    font-size: 12px;
    color: var(--muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .kodeku-unlock-date {
    font-size: 12px;
    color: var(--muted);
    white-space: nowrap;
  }

  .kodeku-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.02em;
    border-radius: var(--radius-pill);
    padding: 4px 10px;
    white-space: nowrap;
  }

  .kodeku-status.status-locked {
    background: var(--gold-soft);
    color: var(--gold);
    border: 1px solid color-mix(in srgb, var(--gold) 25%, transparent);
  }

  .kodeku-status.status-open {
    background: var(--accent-soft);
    color: var(--accent-dark);
    border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
  }

  /* See all link */
  .kodeku-see-all {
    margin-top: 16px;
    text-align: right;
  }

  .kodeku-see-all-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: var(--accent);
    text-decoration: none;
  }

  .kodeku-see-all-link:hover {
    color: var(--accent-dark);
    text-decoration: underline;
  }

  /* Responsive kodeku */
  @media (max-width: 640px) {
    .kodeku-row {
      grid-template-columns: 1fr auto;
      grid-template-rows: auto auto;
    }
    .kodeku-code {
      grid-column: 1;
      grid-row: 1;
      width: fit-content;
    }
    .kodeku-status {
      grid-column: 2;
      grid-row: 1;
    }
    .kodeku-info {
      grid-column: 1 / -1;
      grid-row: 2;
    }
    .kodeku-unlock-date {
      display: none;
    }
    .kodeku-header {
      flex-direction: column;
      align-items: flex-start;
    }
    .kodeku-new-btn {
      width: 100%;
      justify-content: center;
    }
  }
</style>
@endsection
