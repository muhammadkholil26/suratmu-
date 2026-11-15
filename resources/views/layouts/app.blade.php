<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f7f6f2">
  <title>@yield('title', 'Pesan Untuk Masa Depan') — Kotak Waktu Digital</title>
  <meta name="description" content="@yield('meta_description', 'Tulis sesuatu hari ini, lalu biarkan waktu menentukan kapan pesan itu akan terbuka. Time capsule digital tanpa login.')">

  <!-- Open Graph / Social Meta -->
  <meta property="og:site_name" content="Pesan Untuk Masa Depan">
  <meta property="og:title" content="@yield('og_title', 'Pesan Untuk Masa Depan — Kotak Waktu Digital')">
  <meta property="og:description" content="@yield('og_description', 'Sebuah pesan sedang mengarungi ruang dan waktu menuju masa depan.')">
  <meta property="og:type" content="website">
  <meta property="og:url" content="@yield('og_url', url()->current())">
  <meta property="og:image" content="{{ asset('images/space/planet-01.svg') }}">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="@yield('og_title', 'Pesan Untuk Masa Depan')">
  <meta name="twitter:description" content="@yield('og_description', 'Sebuah pesan sedang mengarungi ruang dan waktu menuju masa depan.')">

  <!-- Theme Script (Instant check before render to prevent flash) -->
  <script>
    (function() {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.setAttribute('data-theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
      }
    })();
  </script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,400&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      color-scheme: light;
      --paper: #f7f6f2;
      --paper-warm: #fcfbf8;
      --surface: #ffffff;
      --surface-muted: #eeede7;
      --ink: #222624;
      --ink-soft: #4a524e;
      --muted: #727a75;
      --line: #e3e3dc;
      --line-subtle: #eeeee8;
      --accent: #46685a;
      --accent-dark: #324c41;
      --accent-soft: #e7eeea;
      --gold: #b0874e;
      --gold-soft: #f7f2e8;
      --danger: #b24d45;
      --danger-soft: #fbf0ef;
      --shadow-sm: 0 2px 8px rgba(34, 38, 36, .04);
      --shadow-md: 0 12px 36px rgba(34, 38, 36, .06);
      --shadow-lg: 0 24px 60px rgba(34, 38, 36, .09);
      --radius-sm: 8px;
      --radius-md: 16px;
      --radius-lg: 24px;
      --radius-pill: 9999px;
    }

    /* Dark Mode Theme (Hitam / Deep Charcoal Space) */
    :root[data-theme="dark"] {
      color-scheme: dark;
      --paper: #131715;
      --paper-warm: #1a201c;
      --surface: #202723;
      --surface-muted: #2a342f;
      --ink: #f0f3ee;
      --ink-soft: #cad2cc;
      --muted: #8b968e;
      --line: #2e3832;
      --line-subtle: #242c27;
      --accent: #78a390;
      --accent-dark: #9fc3b2;
      --accent-soft: #24352b;
      --gold: #d4ab75;
      --gold-soft: #382c1b;
      --danger: #df7a73;
      --danger-soft: #381f1d;
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, .4);
      --shadow-md: 0 12px 36px rgba(0, 0, 0, .5);
      --shadow-lg: 0 24px 60px rgba(0, 0, 0, .6);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      background-color: var(--paper);
      color: var(--ink);
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 15px;
      line-height: 1.65;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      -webkit-font-smoothing: antialiased;
      overflow-x: hidden;
      position: relative;
      transition: background-color .3s ease, color .3s ease;
    }

    /* Background celestial texture */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background-image: radial-gradient(circle at 15% 20%, rgba(214, 214, 209, 0.28) 1px, transparent 1px),
                        radial-gradient(circle at 85% 35%, rgba(214, 214, 209, 0.22) 1.2px, transparent 1.2px),
                        radial-gradient(circle at 50% 80%, rgba(214, 214, 209, 0.25) 1px, transparent 1px);
      background-size: 280px 280px, 360px 360px, 320px 320px;
      pointer-events: none;
      z-index: 0;
      opacity: 0.8;
      transition: opacity .3s ease;
    }

    :root[data-theme="dark"] body::before {
      background-image: radial-gradient(circle at 15% 20%, rgba(142, 162, 150, 0.16) 1px, transparent 1px),
                        radial-gradient(circle at 85% 35%, rgba(142, 162, 150, 0.14) 1.2px, transparent 1.2px),
                        radial-gradient(circle at 50% 80%, rgba(142, 162, 150, 0.16) 1px, transparent 1px);
    }

    :root[data-theme="dark"] .celestial-svg {
      stroke: #45524b;
    }
    :root[data-theme="dark"] .celestial-svg text {
      fill: #6e7f76;
    }
    :root[data-theme="dark"] .celestial-svg circle[fill="#D6D6D1"] {
      fill: #6e7f76;
    }

    .serif { font-family: 'Playfair Display', Georgia, serif; }
    .mono { font-family: 'JetBrains Mono', monospace; }

    .container {
      width: min(1040px, calc(100% - 40px));
      margin-inline: auto;
      position: relative;
      z-index: 1;
    }

    /* Header & Navigation */
    .site-header {
      position: sticky;
      top: 0;
      z-index: 50;
      background: rgba(247, 246, 242, 0.94);
      backdrop-filter: blur(14px);
      border-bottom: 1px solid var(--line);
      transition: background-color .3s ease, border-color .3s ease;
    }

    :root[data-theme="dark"] .site-header {
      background: rgba(19, 23, 21, 0.94);
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 72px;
      gap: 16px;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: var(--ink);
      font-weight: 700;
      font-size: 16px;
      letter-spacing: -0.01em;
      flex-shrink: 0;
    }

    /* Brand mark: Envelope + Orbit */
    .brand-mark {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: var(--accent);
      color: #fff;
      display: grid;
      place-items: center;
      box-shadow: 0 4px 14px rgba(70, 104, 90, 0.25);
      position: relative;
    }

    .brand-mark svg {
      width: 22px;
      height: 22px;
    }

    /* Nav Right & Controls */
    .nav-right-area {
      display: flex;
      align-items: center;
      gap: 26px; /* Jarak proporsional antara menu dan controls (20-28px) */
      margin-left: auto;
    }

    /* Menu Navigasi: Beranda, Buat Pesan, Buka Pesan, Kodeku */
    .nav-menu {
      display: flex;
      align-items: center;
      gap: 22px; /* Jarak proporsional antar menu navigasi (20-28px) */
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .nav-link {
      display: inline-flex;
      align-items: center;
      padding: 6px 12px;
      border-radius: var(--radius-pill);
      color: var(--ink-soft);
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      transition: all .2s ease;
      white-space: nowrap;
    }

    .nav-link:hover {
      color: var(--ink);
      background: var(--surface-muted);
    }

    .nav-link.active {
      color: var(--accent-dark);
      background: var(--accent-soft);
      font-weight: 600;
    }

    /* Controls Group: Theme Toggle (☾) dan Profil */
    .nav-controls {
      display: flex;
      align-items: center;
      gap: 24px; /* Jarak lebih jelas antara ☾ dan Profil (20-28px) */
    }

    /* Crescent Moon Theme Toggle Button — Area klik sendiri sekitar 40px x 40px */
    .theme-toggle-btn {
      width: 40px;
      height: 40px;
      min-width: 40px;
      min-height: 40px;
      border-radius: 50%;
      border: 1px solid var(--line);
      background: var(--surface);
      color: var(--ink);
      display: grid;
      place-items: center;
      cursor: pointer;
      transition: all .25s ease;
      padding: 0;
      box-shadow: var(--shadow-sm);
      flex-shrink: 0;
    }

    .theme-toggle-btn:hover {
      border-color: var(--accent);
      color: var(--accent-dark);
      background: var(--paper-warm);
      transform: translateY(-1px);
      box-shadow: var(--shadow-md);
    }

    .theme-toggle-btn svg {
      width: 18px;
      height: 18px;
      transition: transform .35s ease;
    }

    .theme-toggle-btn:active svg {
      transform: scale(0.9) rotate(-18deg);
    }

    /* Profil — Posisi paling kanan navbar */
    .nav-profile {
      display: flex;
      align-items: center;
      flex-shrink: 0;
    }

    .profile-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 4px 6px 4px 10px;
      background: var(--surface);
      border: 1px solid var(--line);
      border-radius: var(--radius-pill);
      box-shadow: var(--shadow-sm);
      transition: all .2s ease;
    }

    .profile-pill:hover {
      border-color: var(--accent);
    }

    .profile-avatar-icon {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: var(--accent-soft);
      color: var(--accent-dark);
      display: grid;
      place-items: center;
      flex-shrink: 0;
    }

    .profile-user-name {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--ink);
      max-width: 130px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .profile-logout-form {
      display: inline-flex;
      margin: 0;
      padding: 0;
    }

    .profile-logout-btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: none;
      border: 1px solid var(--line-subtle);
      border-radius: var(--radius-pill);
      padding: 3px 8px;
      font-size: 12px;
      font-weight: 500;
      color: var(--ink-soft);
      cursor: pointer;
      font-family: inherit;
      transition: all .2s ease;
    }

    .profile-logout-btn:hover {
      border-color: var(--danger);
      color: var(--danger);
      background: var(--danger-soft);
    }

    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      padding: 8px;
      color: var(--ink);
      cursor: pointer;
    }

    @media (max-width: 860px) {
      .mobile-menu-btn { display: block; order: 3; }
      .nav-right-area { gap: 12px; }
      .nav-controls { gap: 10px; }
      .profile-user-name { display: none; }
      .profile-logout-btn .logout-text { display: none; }
      .nav-menu {
        display: none;
        position: absolute;
        top: 72px;
        left: 0;
        right: 0;
        background: var(--paper);
        border-bottom: 1px solid var(--line);
        flex-direction: column;
        padding: 16px 20px 24px;
        gap: 8px;
        box-shadow: var(--shadow-md);
      }
      .nav-menu.open { display: flex; }
      .nav-link { width: 100%; justify-content: center; }
    }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      min-height: 48px;
      padding: 0 24px;
      border-radius: var(--radius-pill);
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all .2s ease;
      line-height: 1;
    }

    .btn:active { transform: scale(0.98); }

    .btn-primary {
      background: var(--accent);
      color: #ffffff;
      box-shadow: 0 4px 14px rgba(70, 104, 90, 0.22);
    }

    .btn-primary:hover {
      background: var(--accent-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(70, 104, 90, 0.28);
    }

    .btn-secondary {
      background: var(--surface);
      color: var(--ink);
      border-color: var(--line);
      box-shadow: var(--shadow-sm);
    }

    .btn-secondary:hover {
      border-color: var(--accent);
      background: var(--surface);
      transform: translateY(-2px);
      color: var(--accent-dark);
    }

    .btn-outline {
      background: transparent;
      color: var(--ink-soft);
      border-color: var(--line);
    }

    .btn-outline:hover {
      border-color: var(--ink-soft);
      color: var(--ink);
      background: var(--surface-muted);
    }

    main {
      flex: 1;
      padding: 40px 0 80px;
      position: relative;
      z-index: 1;
    }

    /* Forms */
    .form-group { margin-bottom: 24px; }
    .form-label {
      display: block;
      margin-bottom: 8px;
      font-size: 13px;
      font-weight: 600;
      color: var(--ink);
      letter-spacing: -0.01em;
    }
    .form-hint {
      margin-top: 6px;
      font-size: 12px;
      color: var(--muted);
    }
    .form-control {
      width: 100%;
      padding: 13px 16px;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: var(--surface);
      color: var(--ink);
      font-size: 15px;
      font-family: inherit;
      transition: all .2s ease;
      outline: none;
    }
    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--accent-soft);
    }
    .form-control.is-invalid {
      border-color: var(--danger);
      background: var(--danger-soft);
    }
    .invalid-feedback {
      display: block;
      margin-top: 6px;
      color: var(--danger);
      font-size: 13px;
      font-weight: 500;
    }

    /* Alerts */
    .alert {
      padding: 16px 20px;
      border-radius: 14px;
      margin-bottom: 24px;
      font-size: 14px;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      line-height: 1.5;
    }
    .alert-danger {
      background: var(--danger-soft);
      border: 1px solid rgba(178, 77, 69, 0.25);
      color: var(--danger);
    }
    .alert-success {
      background: var(--accent-soft);
      border: 1px solid rgba(70, 104, 90, 0.25);
      color: var(--accent-dark);
    }

    /* Subtle Cosmic Animations */
    @keyframes orbit-float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-7px) rotate(1deg); }
    }
    @keyframes star-twinkle {
      0%, 100% { opacity: 0.35; transform: scale(0.96); }
      50% { opacity: 0.95; transform: scale(1.08); }
    }
    @keyframes orbit-spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    @keyframes capsule-reveal {
      0% { opacity: 0; transform: translateY(18px) scale(0.98); filter: blur(4px); }
      100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
    }

    .twinkle-star {
      animation: star-twinkle 6s ease-in-out infinite;
      transform-origin: center;
    }
    .floating-orbit {
      animation: orbit-float 16s ease-in-out infinite alternate;
    }

    /* Timeline Stepper UI */
    .cosmic-timeline {
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      margin: 28px 0;
      padding: 0 10px;
    }
    .timeline-track {
      position: absolute;
      top: 14px;
      left: 30px;
      right: 30px;
      height: 2px;
      background: var(--line);
      z-index: 1;
    }
    .timeline-progress {
      position: absolute;
      top: 14px;
      left: 30px;
      height: 2px;
      background: var(--accent);
      z-index: 2;
      transition: width .5s ease;
    }
    .timeline-step {
      position: relative;
      z-index: 3;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .step-dot {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: var(--surface);
      border: 2px solid var(--line);
      color: var(--muted);
      display: grid;
      place-items: center;
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 6px;
      transition: all .3s ease;
    }
    .timeline-step.completed .step-dot {
      background: var(--accent-soft);
      border-color: var(--accent);
      color: var(--accent-dark);
    }
    .timeline-step.active .step-dot {
      background: var(--accent);
      border-color: var(--accent-dark);
      color: #fff;
      box-shadow: 0 0 0 4px var(--accent-soft);
    }
    .step-text-title {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--ink);
    }
    .step-text-date {
      font-size: 11px;
      color: var(--muted);
    }

    /* Footer */
    .site-footer {
      border-top: 1px solid var(--line);
      padding: 48px 0 36px;
      color: var(--muted);
      font-size: 13px;
      text-align: center;
      background: var(--paper);
      position: relative;
    }

    .footer-cosmic-banner {
      max-width: 500px;
      margin: 0 auto 24px;
      padding-bottom: 24px;
      border-bottom: 1px dashed var(--line);
    }

    .footer-orbit-art {
      width: 64px;
      height: 64px;
      margin: 0 auto 12px;
    }

    .footer-cosmic-title {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.16em;
      color: var(--accent-dark);
      text-transform: uppercase;
      margin-bottom: 4px;
    }

    .footer-timeline-journey {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      color: var(--muted);
      margin-top: 8px;
    }

    .footer-timeline-line {
      width: 60px;
      height: 1px;
      background: var(--line);
      position: relative;
    }
    .footer-timeline-line::after {
      content: "";
      position: absolute;
      right: 0;
      top: -3px;
      width: 0;
      height: 0;
      border-top: 3px solid transparent;
      border-bottom: 3px solid transparent;
      border-left: 5px solid var(--muted);
    }

    .footer-inner {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
    }

    .footer-links {
      display: flex;
      gap: 20px;
      list-style: none;
    }

    .footer-links a {
      color: var(--muted);
      text-decoration: none;
      transition: color .2s ease;
    }
    .footer-links a:hover { color: var(--ink); }

    /* Toast Notification */
    .toast-container {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 1000;
      pointer-events: none;
    }

    .toast {
      background: var(--ink);
      color: var(--paper);
      padding: 12px 22px;
      border-radius: var(--radius-pill);
      font-size: 13px;
      font-weight: 500;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 10px;
      transform: translateY(20px);
      opacity: 0;
      transition: all .25s ease;
      pointer-events: auto;
    }

    .toast.show { transform: translateY(0); opacity: 1; }

    /* Modal / Bottom Sheet for Sharing */
    .share-modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(18, 22, 20, 0.55);
      backdrop-filter: blur(4px);
      z-index: 100;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .share-modal-backdrop.open { display: flex; }

    .share-modal-card {
      background: var(--surface);
      border: 1px solid var(--line);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      width: 100%;
      max-width: 520px;
      padding: 32px 28px;
      position: relative;
      animation: capsule-reveal .25s ease both;
    }

    .share-modal-close {
      position: absolute;
      top: 18px;
      right: 18px;
      background: transparent;
      border: none;
      padding: 6px;
      color: var(--muted);
      cursor: pointer;
      border-radius: 50%;
    }
    .share-modal-close:hover { color: var(--ink); background: var(--surface-muted); }

    .share-modal-header { text-align: center; margin-bottom: 24px; }
    .share-modal-kicker {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.16em;
      color: var(--accent);
      text-transform: uppercase;
      margin-bottom: 6px;
      display: block;
    }
    .share-modal-title { font-size: 22px; letter-spacing: -0.02em; color: var(--ink); }
    .share-modal-subtitle { font-size: 13px; color: var(--muted); margin-top: 4px; }

    .share-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
      margin-bottom: 20px;
    }

    .share-btn-platform {
      display: flex;
      align-items: center;
      gap: 10px;
      min-height: 48px;
      padding: 0 16px;
      border-radius: 12px;
      border: 1px solid var(--line);
      background: var(--surface);
      color: var(--ink);
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all .2s ease;
    }
    .share-btn-platform:hover {
      border-color: var(--accent);
      background: var(--paper-warm);
      transform: translateY(-2px);
    }
    .share-btn-platform svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      color: var(--accent);
    }

    .share-link-box {
      display: flex;
      gap: 8px;
      background: var(--paper-warm);
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 6px 6px 6px 14px;
      align-items: center;
    }
    .share-link-input {
      flex: 1;
      border: none;
      background: transparent;
      font-size: 12px;
      color: var(--ink);
      font-family: 'JetBrains Mono', monospace;
      outline: none;
    }

    @media (max-width: 560px) {
      .share-modal-backdrop { align-items: flex-end; padding: 0; }
      .share-modal-card { max-width: 100%; border-radius: 24px 24px 0 0; padding: 28px 20px 36px; }
      .share-grid { grid-template-columns: 1fr; }
    }
  </style>
  @yield('styles')
</head>
<body>

  <!-- Navigation -->
  <header class="site-header">
    <div class="container navbar">
      <a href="{{ route('home') }}" class="brand">
        <!-- Brand Mark: Envelope + Orbit -->
        <div class="brand-mark" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <!-- Envelope -->
            <path d="M4 7h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1z" />
            <path d="m4 8 8 5.5L20 8" />
            <!-- Cosmic Orbit Ring -->
            <ellipse cx="12" cy="12" rx="10.5" ry="4.5" transform="rotate(-26 12 12)" stroke-dasharray="2 3" opacity="0.9" />
          </svg>
        </div>
        <span>Pesan Untuk Masa Depan</span>
      </a>

      <!-- Right Area with Navigation & Crescent Moon Theme Toggle -->
      <div class="nav-right-area">
        <!-- Main Navigation Links: Beranda, Buat Pesan, Buka Pesan, Kodeku -->
        <ul class="nav-menu" id="navMenu">
          <li>
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
              Beranda
            </a>
          </li>
          <li>
            <a href="{{ route('messages.create') }}" class="nav-link {{ request()->routeIs('messages.create') ? 'active' : '' }}">
              Buat Pesan
            </a>
          </li>
          <li>
            <a href="{{ route('messages.openForm') }}" class="nav-link {{ request()->routeIs('messages.openForm') ? 'active' : '' }}">
              Buka Pesan
            </a>
          </li>
          <li>
            <a href="{{ route('home') }}#kodeku" class="nav-link">
              Kodeku
            </a>
          </li>
        </ul>

        <!-- Controls: Theme Toggle (☾) and Profil -->
        <div class="nav-controls">
          <!-- Crescent Moon Button to toggle Dark (Hitam) and Light (Putih) mode — Area klik 40px x 40px -->
          <button id="themeToggleBtn" class="theme-toggle-btn" type="button" aria-label="Ganti mode gelap/terang" title="Ganti mode gelap (Hitam/Putih)">
            <svg id="themeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
              <!-- Crescent Moon SVG -->
              <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
          </button>

          <!-- Profil (Posisi paling kanan navbar) -->
          <div class="nav-profile">
            @auth
            <div class="profile-pill">
              <div class="profile-avatar-icon" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
              </div>
              <span class="profile-user-name" title="{{ auth()->user()->name }}">{{ Str::limit(auth()->user()->name, 14) }}</span>
              <form method="POST" action="{{ route('auth.logout') }}" class="profile-logout-form">
                @csrf
                <button type="submit" class="profile-logout-btn" title="Keluar">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  <span class="logout-text">Keluar</span>
                </button>
              </form>
            </div>
            @else
            <a href="{{ route('auth.login') }}" class="nav-link">Masuk</a>
            @endauth
          </div>
        </div>

        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu navigasi">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Cosmic Time Capsule Footer -->
  <footer class="site-footer">
    <div class="container footer-inner">
      <div class="footer-cosmic-banner" aria-hidden="true">
        <!-- Floating Editorial Orbit Planet Art -->
        <div class="footer-orbit-art floating-orbit">
          <svg viewBox="0 0 64 64" fill="none" stroke="#D6D6D1" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="32" cy="32" r="14" fill="var(--paper-warm)" />
            <path d="M22 28 Q32 37 42 34" />
            <ellipse cx="32" cy="32" rx="28" ry="8" transform="rotate(-22 32 32)" />
            <ellipse cx="32" cy="32" rx="31" ry="9" transform="rotate(-22 32 32)" stroke-dasharray="2 4" opacity="0.6" />
            <circle cx="50" cy="18" r="1.8" fill="#D6D6D1" />
          </svg>
        </div>
        <div class="footer-cosmic-title">YOUR MESSAGE IS TRAVELING THROUGH TIME & SPACE</div>
        <p class="serif" style="font-size: 14px; color: var(--ink-soft); font-style: italic;">
          “Beberapa pesan tidak perlu dikirim hari ini.”
        </p>
        <div class="footer-timeline-journey">
          <span>{{ date('Y') }}</span>
          <div class="footer-timeline-line"></div>
          <span>FUTURE</span>
        </div>
      </div>

      <ul class="footer-links">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li>•</li>
        <li><a href="{{ route('messages.create') }}">Buat Pesan</a></li>
        <li>•</li>
        <li><a href="{{ route('messages.openForm') }}">Buka Pesan</a></li>
      </ul>
      <p style="margin-top: 4px; font-size: 12px; color: var(--muted);">
        &copy; {{ date('Y') }} Pesan Untuk Masa Depan. Kotak waktu digital tanpa akun dan tanpa jejak.
      </p>
    </div>
  </footer>

  <!-- Toast Notification -->
  <div class="toast-container">
    <div id="toastMessage" class="toast">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span id="toastText">Link berhasil disalin!</span>
    </div>
  </div>

  <!-- Universal Share Modal & Bottom Sheet -->
  <div id="shareModalBackdrop" class="share-modal-backdrop" aria-hidden="true">
    <div class="share-modal-card">
      <button type="button" class="share-modal-close" id="closeShareModalBtn" aria-label="Tutup">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>

      <div class="share-modal-header">
        <span class="share-modal-kicker">KAPSUL WAKTU DIGITAL</span>
        <h3 class="share-modal-title serif">Bagikan Pesan</h3>
        <p class="share-modal-subtitle">Bagikan perjalanan pesan ini melewati ruang dan waktu.</p>
      </div>

      <div class="share-grid">
        <!-- WhatsApp -->
        <a id="shareWaBtn" href="#" target="_blank" rel="noopener noreferrer" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
          </svg>
          WhatsApp
        </a>

        <!-- Telegram -->
        <a id="shareTgBtn" href="#" target="_blank" rel="noopener noreferrer" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
          </svg>
          Telegram
        </a>

        <!-- Facebook -->
        <a id="shareFbBtn" href="#" target="_blank" rel="noopener noreferrer" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
          </svg>
          Facebook
        </a>

        <!-- X / Twitter -->
        <a id="shareXBtn" href="#" target="_blank" rel="noopener noreferrer" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4l11.7 16h4.3L8.3 4zM4 20l6.7-7.3M13.3 11.3L20 4"></path>
          </svg>
          X (Twitter)
        </a>

        <!-- Email -->
        <a id="shareEmailBtn" href="#" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          Email
        </a>

        <!-- Native Share (Web Share API) -->
        <button type="button" id="nativeShareTriggerBtn" class="share-btn-platform">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
          Bagikan Lainnya
        </button>
      </div>

      <!-- Copy Link Input -->
      <div class="share-link-box">
        <input type="text" id="shareLinkUrlInput" class="share-link-input" readonly value="">
        <button type="button" class="btn btn-primary" id="copyShareLinkBtn" style="min-height: 38px; padding: 0 16px; font-size: 13px;">
          Salin Link
        </button>
      </div>
    </div>
  </div>

  <script>
    // Theme Toggle (Hitam / Putih - Dark / Light Mode)
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');

    function updateThemeIcon(isDark) {
      if (!themeIcon || !themeToggleBtn) return;
      if (isDark) {
        // Sun icon (click to switch back to light / putih mode)
        themeIcon.innerHTML = `
          <circle cx="12" cy="12" r="5"></circle>
          <line x1="12" y1="1" x2="12" y2="3"></line>
          <line x1="12" y1="21" x2="12" y2="23"></line>
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
          <line x1="1" y1="12" x2="3" y2="12"></line>
          <line x1="21" y1="12" x2="23" y2="12"></line>
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        `;
        themeToggleBtn.setAttribute('title', 'Ganti ke mode putih (siang)');
        themeToggleBtn.setAttribute('aria-label', 'Ganti ke mode putih (siang)');
      } else {
        // Crescent Moon icon (click to switch to dark / hitam mode)
        themeIcon.innerHTML = `
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        `;
        themeToggleBtn.setAttribute('title', 'Ganti ke mode hitam (malam)');
        themeToggleBtn.setAttribute('aria-label', 'Ganti ke mode hitam (malam)');
      }
    }

    if (themeToggleBtn) {
      const isInitiallyDark = document.documentElement.getAttribute('data-theme') === 'dark';
      updateThemeIcon(isInitiallyDark);

      themeToggleBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme === 'dark');
        showToast(newTheme === 'dark' ? 'Mode malam (hitam) aktif.' : 'Mode siang (putih) aktif.');
      });
    }

    // Mobile navigation toggle
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const navMenu = document.getElementById('navMenu');
    if (mobileBtn && navMenu) {
      mobileBtn.addEventListener('click', () => {
        navMenu.classList.toggle('open');
      });
    }

    // Helper Toast
    function showToast(message) {
      const toast = document.getElementById('toastMessage');
      const text = document.getElementById('toastText');
      if (!toast || !text) return;
      text.textContent = message;
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    }

    // Copy to clipboard helper
    function copyText(text, successMsg = 'Link berhasil disalin!') {
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
          showToast(successMsg);
        }).catch(() => {
          fallbackCopyText(text, successMsg);
        });
      } else {
        fallbackCopyText(text, successMsg);
      }
    }

    function fallbackCopyText(text, successMsg) {
      const tempInput = document.createElement('input');
      tempInput.value = text;
      document.body.appendChild(tempInput);
      tempInput.select();
      try {
        document.execCommand('copy');
        showToast(successMsg);
      } catch (err) {
        alert('Gagal menyalin otomatis. Silakan salin manual: ' + text);
      }
      document.body.removeChild(tempInput);
    }

    // Universal Share Modal Controller
    let currentShareData = { url: window.location.href, title: 'Pesan Untuk Masa Depan' };

    function openShareModal(data = {}) {
      const shareUrl = data.url || window.location.href;
      const title = data.title || 'Pesan Untuk Masa Depan';
      currentShareData = { url: shareUrl, title: title };

      const input = document.getElementById('shareLinkUrlInput');
      if (input) input.value = shareUrl;

      // WhatsApp text
      const waText = encodeURIComponent(`Sebuah pesan telah menunggu untuk dibuka.\n\nBuka pesan:\n${shareUrl}`);
      const waBtn = document.getElementById('shareWaBtn');
      if (waBtn) waBtn.href = `https://api.whatsapp.com/send?text=${waText}`;

      // Telegram text
      const tgText = encodeURIComponent(`Sebuah pesan telah dikirim melalui waktu.`);
      const tgBtn = document.getElementById('shareTgBtn');
      if (tgBtn) tgBtn.href = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${tgText}`;

      // Facebook
      const fbBtn = document.getElementById('shareFbBtn');
      if (fbBtn) fbBtn.href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;

      // X / Twitter
      const xText = encodeURIComponent(`Sebuah pesan dari masa lalu akhirnya tiba.`);
      const xBtn = document.getElementById('shareXBtn');
      if (xBtn) xBtn.href = `https://twitter.com/intent/tweet?text=${xText}&url=${encodeURIComponent(shareUrl)}`;

      // Email
      const emailSubj = encodeURIComponent(`Pesan Untuk Masa Depan`);
      const emailBody = encodeURIComponent(`Saya meninggalkan sebuah pesan untukmu.\n\nPesan ini dapat dibuka melalui link berikut:\n${shareUrl}`);
      const emailBtn = document.getElementById('shareEmailBtn');
      if (emailBtn) emailBtn.href = `mailto:?subject=${emailSubj}&body=${emailBody}`;

      const modal = document.getElementById('shareModalBackdrop');
      if (modal) modal.classList.add('open');
    }

    function closeShareModal() {
      const modal = document.getElementById('shareModalBackdrop');
      if (modal) modal.classList.remove('open');
    }

    document.getElementById('closeShareModalBtn')?.addEventListener('click', closeShareModal);
    document.getElementById('shareModalBackdrop')?.addEventListener('click', (e) => {
      if (e.target.id === 'shareModalBackdrop') closeShareModal();
    });

    document.getElementById('copyShareLinkBtn')?.addEventListener('click', () => {
      const input = document.getElementById('shareLinkUrlInput');
      if (input) {
        copyText(input.value, 'Link berhasil disalin.');
      }
    });

    // Native Share Sheet
    document.getElementById('nativeShareTriggerBtn')?.addEventListener('click', () => {
      if (navigator.share) {
        navigator.share({
          title: currentShareData.title,
          text: 'Sebuah pesan telah menunggu untuk dibuka.',
          url: currentShareData.url
        }).then(() => {
          showToast('Pesan siap dibagikan.');
          closeShareModal();
        }).catch(() => {});
      } else {
        copyText(currentShareData.url, 'Link berhasil disalin.');
      }
    });
  </script>
  @yield('scripts')
</body>
</html>
