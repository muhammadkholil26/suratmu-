<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#080b09">
  <title>@yield('title', 'Gerbang Waktu — Pesan Untuk Masa Depan')</title>
  <meta name="description" content="Masuki kapsul waktu dan mulai perjalananmu menembus ruang dan waktu menuju masa depan.">

  <!-- Open Graph -->
  <meta property="og:site_name" content="Pesan Untuk Masa Depan">
  <meta property="og:title" content="@yield('title', 'Gerbang Waktu — Pesan Untuk Masa Depan')">
  <meta property="og:description" content="Tulis pesan hari ini, biarkan waktu menentukan saat kata-katamu siap dibuka.">
  <meta property="og:type" content="website">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      color-scheme: dark;
      --bg-deep: #080b09;
      --bg-card: rgba(14, 19, 16, 0.88);
      --bg-input: #121815;
      --ink-primary: #f2f5f1;
      --ink-secondary: #cad3cc;
      --ink-muted: #7e8d83;
      --ink-subtle: #556259;
      --line-subtle: rgba(142, 162, 150, 0.16);
      --line-bright: rgba(142, 162, 150, 0.28);
      --gold-engraved: #c5a468;
      --gold-soft: rgba(197, 164, 104, 0.14);
      --gold-border: rgba(197, 164, 104, 0.28);
      --accent: #5e8c79;
      --accent-bright: #7bb39c;
      --accent-glow: rgba(94, 140, 121, 0.25);
      --danger: #df7a73;
      --danger-soft: rgba(223, 122, 115, 0.15);
      --success: #68b087;
      --success-soft: rgba(104, 176, 135, 0.15);
      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 22px;
      --radius-pill: 9999px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body {
      min-height: 100vh;
      background-color: var(--bg-deep);
      color: var(--ink-primary);
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 15px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      overflow-x: hidden;
      position: relative;
    }

    .serif { font-family: 'Playfair Display', Georgia, serif; }
    .mono { font-family: 'JetBrains Mono', monospace; }

    /* ============================================================
       ANTIQUE CELESTIAL ENGRAVING CANVAS BACKGROUND
       Living, slow-motion engraved antique scientific illustration
       ============================================================ */
    .engraved-cosmos-canvas {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
      background: radial-gradient(circle at 50% 45%, #0f1612 0%, #080b09 70%, #050706 100%);
    }

    /* Subtle paper texture overlay */
    .engraved-cosmos-canvas::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image: 
        radial-gradient(circle at 20% 30%, rgba(197, 164, 104, 0.035) 1px, transparent 1px),
        radial-gradient(circle at 80% 70%, rgba(142, 162, 150, 0.03) 1px, transparent 1px);
      background-size: 40px 40px, 60px 60px;
      opacity: 0.8;
    }

    .celestial-svg-master {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Color classes for engraving lines */
    .engr-gold { stroke: var(--gold-engraved); }
    .engr-sage { stroke: var(--ink-subtle); }
    .engr-sage-bright { stroke: #8ea296; }
    .engr-fill-gold { fill: var(--gold-engraved); }
    .engr-fill-sage { fill: #8ea296; }

    /* ============================================================
       ULTRA-SLOW, ORGANIC LIVING ANIMATIONS (30s - 90s)
       ============================================================ */
    
    /* 1. Slow Astrolabe & Orbit Rotations */
    @keyframes orbitRotateClockwise {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    @keyframes orbitRotateCounter {
      from { transform: rotate(0deg); }
      to { transform: rotate(-360deg); }
    }

    .anim-spin-slow {
      transform-origin: center center;
      animation: orbitRotateClockwise 75s linear infinite;
    }
    .anim-spin-reverse {
      transform-origin: center center;
      animation: orbitRotateCounter 95s linear infinite;
    }
    .anim-spin-medium {
      transform-origin: center center;
      animation: orbitRotateClockwise 48s linear infinite;
    }

    /* 2. Living Engraved Stroke Drawing (stroke-dashoffset flow) */
    @keyframes livingEngravingDraw {
      0% {
        stroke-dashoffset: 1200;
        opacity: 0.35;
      }
      50% {
        stroke-dashoffset: 0;
        opacity: 0.85;
      }
      100% {
        stroke-dashoffset: -1200;
        opacity: 0.35;
      }
    }

    .anim-living-stroke {
      stroke-dasharray: 600;
      animation: livingEngravingDraw 32s ease-in-out infinite;
    }

    .anim-living-stroke-reverse {
      stroke-dasharray: 800;
      animation: livingEngravingDraw 42s ease-in-out infinite reverse;
    }

    /* 3. Time Trajectory Flow */
    @keyframes trajectoryDashOffset {
      0% { stroke-dashoffset: 0; }
      100% { stroke-dashoffset: -240; }
    }

    .anim-trajectory-flow {
      stroke-dasharray: 6 10;
      animation: trajectoryDashOffset 28s linear infinite;
    }

    /* 4. Subtle Star Breathing / Twinkles */
    @keyframes starPulseGlow {
      0%, 100% { opacity: 0.25; transform: scale(0.92); }
      50% { opacity: 0.95; transform: scale(1.18); }
    }

    .anim-star-1 { transform-origin: center; animation: starPulseGlow 9s ease-in-out infinite; }
    .anim-star-2 { transform-origin: center; animation: starPulseGlow 13s ease-in-out infinite 2s; }
    .anim-star-3 { transform-origin: center; animation: starPulseGlow 16s ease-in-out infinite 5s; }
    .anim-star-4 { transform-origin: center; animation: starPulseGlow 11s ease-in-out infinite 3.5s; }

    /* 5. Time Capsule Micro-Float */
    @keyframes capsuleGentleFloat {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
      }
      50% {
        transform: translateY(-8px) rotate(1.2deg);
      }
    }

    .anim-capsule-float {
      animation: capsuleGentleFloat 18s ease-in-out infinite;
    }

    /* ============================================================
       PAGE WRAPPER & CENTRAL GATEWAY
       ============================================================ */
    .auth-viewport {
      position: relative;
      z-index: 10;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 20px 48px;
    }

    /* Central Gateway Card */
    .auth-portal-card {
      width: min(480px, 100%);
      background: var(--bg-card);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid var(--gold-border);
      border-radius: var(--radius-lg);
      padding: clamp(32px, 6vw, 48px) clamp(24px, 5vw, 42px);
      box-shadow: 
        0 24px 60px rgba(0, 0, 0, 0.65),
        0 0 0 1px rgba(255, 255, 255, 0.04) inset,
        0 0 40px rgba(197, 164, 104, 0.06);
      position: relative;
      overflow: hidden;
      transition: border-color .3s ease, box-shadow .3s ease;
    }

    /* Antique corner filigree accents inside card */
    .auth-portal-card::before,
    .auth-portal-card::after {
      content: "";
      position: absolute;
      width: 24px;
      height: 24px;
      pointer-events: none;
      opacity: 0.6;
    }

    .auth-portal-card::before {
      top: 10px;
      left: 10px;
      border-top: 1px solid var(--gold-engraved);
      border-left: 1px solid var(--gold-engraved);
    }

    .auth-portal-card::after {
      bottom: 10px;
      right: 10px;
      border-bottom: 1px solid var(--gold-engraved);
      border-right: 1px solid var(--gold-engraved);
    }

    /* Header & Branding */
    .auth-gateway-header {
      text-align: center;
      margin-bottom: 28px;
      position: relative;
    }

    /* Time Capsule Emblem */
    .capsule-gateway-emblem {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(197, 164, 104, 0.14) 0%, rgba(94, 140, 121, 0.06) 60%, transparent 100%);
      border: 1px solid var(--gold-border);
      color: var(--gold-engraved);
      margin-bottom: 16px;
      box-shadow: 0 0 24px rgba(197, 164, 104, 0.15);
      position: relative;
    }

    .capsule-gateway-emblem svg {
      width: 28px;
      height: 28px;
    }

    .brand-eyebrow {
      display: inline-block;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--gold-engraved);
      margin-bottom: 6px;
    }

    .gateway-title {
      font-size: clamp(24px, 4.8vw, 30px);
      font-weight: 500;
      color: var(--ink-primary);
      line-height: 1.25;
      margin-bottom: 8px;
      letter-spacing: -0.01em;
    }

    .gateway-subtitle {
      font-size: 14px;
      color: var(--ink-muted);
      line-height: 1.5;
    }

    /* Status & Alerts */
    .auth-flash-banner {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 12px 16px;
      border-radius: var(--radius-sm);
      font-size: 13.5px;
      line-height: 1.5;
      margin-bottom: 22px;
    }

    .auth-flash-banner.success {
      background: var(--success-soft);
      border: 1px solid rgba(104, 176, 135, 0.35);
      color: #9fe2bd;
    }

    .auth-flash-banner.error {
      background: var(--danger-soft);
      border: 1px solid rgba(223, 122, 115, 0.35);
      color: #ff9b94;
    }

    /* Form Fields */
    .auth-form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--ink-secondary);
      letter-spacing: 0.02em;
    }

    .form-control-wrap {
      position: relative;
    }

    .form-control {
      width: 100%;
      height: 48px;
      background: var(--bg-input);
      border: 1px solid var(--line-bright);
      border-radius: var(--radius-sm);
      padding: 0 16px;
      font-size: 14.5px;
      color: var(--ink-primary);
      font-family: inherit;
      outline: none;
      transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }

    .form-control::placeholder {
      color: var(--ink-subtle);
      font-size: 14px;
    }

    .form-control:focus {
      border-color: var(--gold-engraved);
      background: #141b18;
      box-shadow: 0 0 0 3px rgba(197, 164, 104, 0.15);
    }

    .form-control.is-invalid {
      border-color: var(--danger);
      background: rgba(45, 20, 18, 0.5);
    }

    .form-control.is-invalid:focus {
      box-shadow: 0 0 0 3px rgba(223, 122, 115, 0.18);
    }

    .field-error-msg {
      font-size: 12px;
      color: var(--danger);
      margin-top: 4px;
    }

    /* Links row: Lupa password */
    .form-meta-row {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-top: -6px;
    }

    .forgot-link {
      font-size: 12.5px;
      color: var(--ink-muted);
      text-decoration: none;
      transition: color .2s ease;
    }

    .forgot-link:hover {
      color: var(--gold-engraved);
      text-decoration: underline;
    }

    /* Primary Submit Button */
    .btn-auth-submit {
      width: 100%;
      height: 50px;
      background: linear-gradient(135deg, var(--gold-engraved) 0%, #aa8749 100%);
      color: #0c110e;
      border: none;
      border-radius: var(--radius-sm);
      font-family: inherit;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 0.04em;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 6px;
      transition: all .25s ease;
      box-shadow: 0 4px 16px rgba(197, 164, 104, 0.22);
    }

    .btn-auth-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 24px rgba(197, 164, 104, 0.35);
      background: linear-gradient(135deg, #d3b275 0%, #ba9452 100%);
    }

    .btn-auth-submit:active {
      transform: translateY(0);
      box-shadow: 0 2px 8px rgba(197, 164, 104, 0.2);
    }

    /* Gateway Footer */
    .gateway-footer {
      margin-top: 26px;
      padding-top: 20px;
      border-top: 1px solid var(--line-subtle);
      text-align: center;
      font-size: 13.5px;
      color: var(--ink-muted);
    }

    .gateway-footer a {
      color: var(--gold-engraved);
      font-weight: 600;
      text-decoration: none;
      margin-left: 4px;
      transition: color .2s ease;
    }

    .gateway-footer a:hover {
      color: #e5c58a;
      text-decoration: underline;
    }

    /* Ambient Coordinates in footer */
    .gateway-coordinates {
      margin-top: 24px;
      font-size: 10.5px;
      letter-spacing: 0.16em;
      color: var(--ink-subtle);
      text-align: center;
      text-transform: uppercase;
    }

    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
      .anim-spin-slow,
      .anim-spin-reverse,
      .anim-spin-medium,
      .anim-living-stroke,
      .anim-living-stroke-reverse,
      .anim-trajectory-flow,
      .anim-star-1,
      .anim-star-2,
      .anim-star-3,
      .anim-star-4,
      .anim-capsule-float {
        animation: none !important;
      }
    }
  </style>

  @yield('styles')
</head>
<body>

  <!-- ============================================================
       ANTIQUE SCIENTIFIC CELESTIAL ENGRAVING CANVAS (LIVING BACKGROUND)
       ============================================================ -->
  <div class="engraved-cosmos-canvas" aria-hidden="true">
    <svg class="celestial-svg-master" viewBox="0 0 1600 1000" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <defs>
        <!-- Engraving Hatch Pattern -->
        <pattern id="hatchGrid" width="24" height="24" patternUnits="userSpaceOnUse">
          <line x1="0" y1="0" x2="24" y2="24" stroke="rgba(142, 162, 150, 0.04)" stroke-width="0.8" />
        </pattern>
        <!-- Subtle Glow Filter -->
        <filter id="softGlow" x="-20%" y="-20%" width="140%" height="140%">
          <feGaussianBlur stdDeviation="3" result="blur" />
          <feComposite in="SourceGraphic" in2="blur" operator="over" />
        </filter>
      </defs>

      <!-- Global coordinate grid overlay -->
      <rect width="100%" height="100%" fill="url(#hatchGrid)" />

      <!-- ========================================================
           CLUSTER 1 (TOP-LEFT): ANTIQUE ASTRONOMICAL ASTROLABE
           Engraved coordinate dials, rotating declination ring
           ======================================================== -->
      <g transform="translate(180, 160)">
        <!-- Outer Astrolabe Border -->
        <circle cx="0" cy="0" r="240" stroke="rgba(197, 164, 104, 0.18)" stroke-width="1.2" />
        <circle cx="0" cy="0" r="232" stroke="rgba(142, 162, 150, 0.12)" stroke-width="0.8" stroke-dasharray="2 4" />
        <circle cx="0" cy="0" r="218" stroke="rgba(197, 164, 104, 0.12)" stroke-width="1" />

        <!-- Degree Marks on Rim -->
        <g stroke="rgba(197, 164, 104, 0.25)" stroke-width="1">
          <line x1="0" y1="-240" x2="0" y2="-226" />
          <line x1="0" y1="240" x2="0" y2="226" />
          <line x1="-240" y1="0" x2="-226" y2="0" />
          <line x1="240" y1="0" x2="226" y2="0" />
          <line x1="-170" y1="-170" x2="-160" y2="-160" />
          <line x1="170" y1="170" x2="160" y2="160" />
          <line x1="170" y1="-170" x2="160" y2="-160" />
          <line x1="-170" y1="170" x2="-160" y2="160" />
        </g>

        <!-- Rotating Dial Inner Ring (Slow Clockwise: 75s) -->
        <g class="anim-spin-slow">
          <circle cx="0" cy="0" r="160" stroke="rgba(142, 162, 150, 0.22)" stroke-width="1" stroke-dasharray="8 6 2 6" />
          <ellipse cx="0" cy="0" rx="160" ry="62" stroke="rgba(197, 164, 104, 0.25)" stroke-width="1.2" transform="rotate(-32)" />
          <circle cx="138" cy="-80" r="4" fill="#c5a468" opacity="0.6" />
          <circle cx="-138" cy="80" r="2.5" fill="#8ea296" opacity="0.5" />
          <!-- Crosshairs -->
          <line x1="-160" y1="0" x2="160" y2="0" stroke="rgba(142, 162, 150, 0.15)" stroke-width="0.8" />
          <line x1="0" y1="-160" x2="0" y2="160" stroke="rgba(142, 162, 150, 0.15)" stroke-width="0.8" />
        </g>

        <!-- Inner Astrolabe Core -->
        <circle cx="0" cy="0" r="60" stroke="rgba(197, 164, 104, 0.28)" stroke-width="1.2" />
        <circle cx="0" cy="0" r="54" stroke="rgba(142, 162, 150, 0.18)" stroke-dasharray="3 3" />
        <circle cx="0" cy="0" r="5" fill="#c5a468" opacity="0.8" />

        <!-- Living Engraving Filigree Arc (Draws slowly in & out) -->
        <path d="M-80 -200 C 40 -260, 240 -160, 280 20 C 310 160, 200 280, 20 310" 
              class="anim-living-stroke" 
              stroke="rgba(197, 164, 104, 0.35)" 
              stroke-width="1.4" />
      </g>

      <!-- ========================================================
           CLUSTER 2 (SWEEPING TIMELINE): FROM PAST TO FUTURE
           Traversing from top left, sweeping under the form, to right
           ======================================================== -->
      <g>
        <!-- Primary Time Trajectory Curve -->
        <path d="M 80 480 C 320 440, 520 620, 800 660 C 1080 700, 1340 540, 1520 340" 
              stroke="rgba(197, 164, 104, 0.15)" 
              stroke-width="1.5" />

        <!-- Active flowing dashed line on time trajectory -->
        <path d="M 80 480 C 320 440, 520 620, 800 660 C 1080 700, 1340 540, 1520 340" 
              class="anim-trajectory-flow" 
              stroke="rgba(197, 164, 104, 0.45)" 
              stroke-width="1.5" />

        <!-- Parallel echo trajectory -->
        <path d="M 120 520 C 350 480, 540 650, 810 690 C 1080 730, 1320 580, 1500 390" 
              stroke="rgba(142, 162, 150, 0.1)" 
              stroke-width="1" 
              stroke-dasharray="3 8" />

        <!-- Epoch nodes along trajectory -->
        <!-- Origin (Hari Ini / Titik Awal) -->
        <g transform="translate(220, 452)">
          <circle cx="0" cy="0" r="4.5" fill="#c5a468" opacity="0.8" />
          <circle cx="0" cy="0" r="10" stroke="rgba(197, 164, 104, 0.35)" stroke-dasharray="2 3" />
          <text x="-48" y="24" fill="#8ea296" font-family="'JetBrains Mono', monospace" font-size="9" letter-spacing="0.2em" opacity="0.7">HARI INI</text>
        </g>

        <!-- Transit Node (Perjalanan Waktu) -->
        <g transform="translate(780, 658)">
          <circle cx="0" cy="0" r="3" fill="#8ea296" opacity="0.6" />
          <circle cx="0" cy="0" r="8" stroke="rgba(142, 162, 150, 0.3)" stroke-dasharray="2 4" />
          <text x="-32" y="24" fill="#8ea296" font-family="'JetBrains Mono', monospace" font-size="8.5" letter-spacing="0.18em" opacity="0.5">TRANSIT</text>
        </g>

        <!-- Arrival Node (Masa Depan) -->
        <g transform="translate(1380, 480)">
          <circle cx="0" cy="0" r="5" fill="#c5a468" opacity="0.85" />
          <circle cx="0" cy="0" r="13" stroke="rgba(197, 164, 104, 0.4)" stroke-dasharray="3 3" />
          <text x="20" y="4" fill="#c5a468" font-family="'JetBrains Mono', monospace" font-size="9" letter-spacing="0.2em" opacity="0.8">MASA DEPAN</text>
        </g>
      </g>

      <!-- ========================================================
           CLUSTER 3 (BOTTOM-RIGHT): CELESTIAL PLANET WITH RINGS
           Engraved scientific diagram of a ringed celestial body
           ======================================================== -->
      <g transform="translate(1360, 780)">
        <!-- Multi-layered Orbit Ring (Counter Clockwise: 95s) -->
        <g class="anim-spin-reverse">
          <ellipse cx="0" cy="0" rx="260" ry="74" stroke="rgba(197, 164, 104, 0.22)" stroke-width="1.4" transform="rotate(-24)" />
          <ellipse cx="0" cy="0" rx="290" ry="82" stroke="rgba(142, 162, 150, 0.12)" stroke-width="0.9" stroke-dasharray="4 6" transform="rotate(-24)" />
          <circle cx="210" cy="-65" r="4.5" fill="#c5a468" opacity="0.65" />
          <circle cx="-190" cy="55" r="3" fill="#8ea296" opacity="0.5" />
        </g>

        <!-- Planet Core Body -->
        <circle cx="0" cy="0" r="92" stroke="rgba(197, 164, 104, 0.3)" stroke-width="1.3" fill="rgba(8, 11, 9, 0.6)" />
        <circle cx="0" cy="0" r="84" stroke="rgba(142, 162, 150, 0.15)" stroke-width="0.8" />

        <!-- Classical Engraving Latitude Contours -->
        <path d="M-78 -30 Q 0 45 78 -30" stroke="rgba(142, 162, 150, 0.2)" stroke-width="1" />
        <path d="M-88 10 Q 0 90 88 10" stroke="rgba(142, 162, 150, 0.2)" stroke-width="1" />
        <path d="M-60 -60 Q 0 10 60 -60" stroke="rgba(142, 162, 150, 0.15)" stroke-width="0.8" stroke-dasharray="2 3" />

        <!-- Living Engraving Filigree Around Planet -->
        <path d="M-180 80 C -120 180, 40 220, 160 160 C 240 120, 270 20, 220 -80" 
              class="anim-living-stroke-reverse" 
              stroke="rgba(142, 162, 150, 0.3)" 
              stroke-width="1.2" />
      </g>

      <!-- ========================================================
           CLUSTER 4 (UPPER CENTER): FLOATING TIME CAPSULE SYMBOL
           Subtly levitating above the central form
           ======================================================== -->
      <g transform="translate(800, 110)" class="anim-capsule-float">
        <!-- Orbit Aura -->
        <ellipse cx="0" cy="0" rx="88" ry="24" stroke="rgba(197, 164, 104, 0.22)" stroke-width="1" stroke-dasharray="3 4" transform="rotate(-15)" />
        <circle cx="0" cy="0" r="42" stroke="rgba(142, 162, 150, 0.16)" stroke-width="0.8" />

        <!-- Engraved Cylindrical Capsule Body -->
        <g stroke="#c5a468" stroke-width="1.3">
          <!-- Capsule Top Cap -->
          <path d="M-18 -16 C -18 -26, 18 -26, 18 -16 Z" fill="rgba(197, 164, 104, 0.12)" />
          <!-- Cylinder Body -->
          <rect x="-18" y="-16" width="36" height="34" rx="2" fill="rgba(14, 19, 16, 0.7)" />
          <!-- Capsule Bottom Cap -->
          <path d="M-18 18 C -18 28, 18 28, 18 18 Z" fill="rgba(197, 164, 104, 0.12)" />
          <!-- Central Glass Observation Window / Seal -->
          <circle cx="0" cy="1" r="7.5" fill="rgba(197, 164, 104, 0.25)" stroke="#c5a468" stroke-width="1" />
          <circle cx="0" cy="1" r="2.5" fill="#c5a468" />
          <!-- Latitudinal Seal Bands -->
          <line x1="-18" y1="-8" x2="18" y2="-8" stroke-dasharray="1 2" opacity="0.8" />
          <line x1="-18" y1="10" x2="18" y2="10" stroke-dasharray="1 2" opacity="0.8" />
        </g>

        <!-- Chronometer Ticks Surrounding Capsule -->
        <g stroke="rgba(142, 162, 150, 0.3)" stroke-width="1">
          <line x1="0" y1="-36" x2="0" y2="-44" />
          <line x1="0" y1="36" x2="0" y2="44" />
          <line x1="-36" y1="0" x2="-44" y2="0" />
          <line x1="36" y1="0" x2="44" y2="0" />
        </g>
      </g>

      <!-- ========================================================
           CONSTELLATIONS & SUBTLE ENGRAVED TWINKLE STARS
           ======================================================== -->
      <!-- Star 1 (Top Left) -->
      <g transform="translate(480, 180)" class="anim-star-1">
        <path d="M0 -12 Q0 0 12 0 Q0 0 0 12 Q0 0 -12 0 Q0 0 0 -12 Z" fill="#c5a468" opacity="0.65" />
        <circle cx="0" cy="0" r="1.5" fill="#f2f5f1" />
      </g>
      <!-- Star 2 (Top Right) -->
      <g transform="translate(1120, 160)" class="anim-star-2">
        <path d="M0 -14 Q0 0 14 0 Q0 0 0 14 Q0 0 -14 0 Q0 0 0 -14 Z" fill="#c5a468" opacity="0.75" />
        <circle cx="0" cy="0" r="1.8" fill="#f2f5f1" />
      </g>
      <!-- Star 3 (Bottom Left) -->
      <g transform="translate(360, 720)" class="anim-star-3">
        <path d="M0 -10 Q0 0 10 0 Q0 0 0 10 Q0 0 -10 0 Q0 0 0 -10 Z" fill="#8ea296" opacity="0.6" />
        <circle cx="0" cy="0" r="1.3" fill="#f2f5f1" />
      </g>
      <!-- Star 4 (Bottom Right) -->
      <g transform="translate(1180, 680)" class="anim-star-4">
        <path d="M0 -11 Q0 0 11 0 Q0 0 0 11 Q0 0 -11 0 Q0 0 0 -11 Z" fill="#c5a468" opacity="0.7" />
        <circle cx="0" cy="0" r="1.5" fill="#f2f5f1" />
      </g>

      <!-- Antique Constellation Connectors (Subtle dotted lines) -->
      <g stroke="rgba(142, 162, 150, 0.14)" stroke-width="0.8" stroke-dasharray="2 4">
        <line x1="480" y1="180" x2="560" y2="240" />
        <line x1="560" y1="240" x2="640" y2="210" />
        <circle cx="560" cy="240" r="2" fill="#8ea296" opacity="0.4" />
        <circle cx="640" cy="210" r="2" fill="#8ea296" opacity="0.4" />

        <line x1="1120" y1="160" x2="1040" y2="220" />
        <line x1="1040" y1="220" x2="980" y2="260" />
        <circle cx="1040" cy="220" r="2" fill="#8ea296" opacity="0.4" />
        <circle cx="980" cy="260" r="2" fill="#8ea296" opacity="0.4" />
      </g>
    </svg>
  </div>

  <!-- ============================================================
       CENTRAL GATEWAY CONTENT
       ============================================================ -->
  <main class="auth-viewport">
    @yield('content')
  </main>

  @yield('scripts')
</body>
</html>

