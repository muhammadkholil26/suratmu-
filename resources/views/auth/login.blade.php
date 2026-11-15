@extends('layouts.auth')

@section('title', 'Masuk — Pesan Untuk Masa Depan')

@section('content')
<div class="auth-portal-card">

  <!-- Header & Gateway Branding -->
  <div class="auth-gateway-header">
    <div class="capsule-gateway-emblem" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <!-- Envelope / Capsule Motif with Orbital Ring -->
        <path d="M4 7h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1z" />
        <path d="m4 8 8 5.5L20 8" />
        <ellipse cx="12" cy="12" rx="10.5" ry="4.5" transform="rotate(-26 12 12)" stroke-dasharray="2 3" opacity="0.85" />
      </svg>
    </div>

    <span class="brand-eyebrow">PESAN UNTUK MASA DEPAN</span>
    <h1 class="gateway-title serif">Selamat Datang Kembali.</h1>
    <p class="gateway-subtitle">Lanjutkan perjalananmu menuju masa depan.</p>
  </div>

  <!-- Session Success Flash (e.g. from register) -->
  @if (session('status'))
    <div class="auth-flash-banner success" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:1px;">
        <circle cx="12" cy="12" r="10" />
        <polyline points="9 12 12 15 16 10" />
      </svg>
      <div>{{ session('status') }}</div>
    </div>
  @endif

  <!-- Validation Errors Flash -->
  @if ($errors->any())
    <div class="auth-flash-banner error" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:1px;">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="8" x2="12" y2="12" />
        <line x1="12" y1="16" x2="12.01" y2="16" />
      </svg>
      <div>{{ $errors->first() }}</div>
    </div>
  @endif

  <!-- Login Form -->
  <form method="POST" action="{{ route('auth.login.post') }}" class="auth-form" novalidate>
    @csrf

    <!-- Email Field -->
    <div class="form-group">
      <label for="email" class="form-label">Email</label>
      <div class="form-control-wrap">
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Masukkan email"
          class="form-control @error('email') is-invalid @enderror"
          autocomplete="email"
          required
          autofocus
        >
      </div>
      @error('email')
        <div class="field-error-msg">{{ $message }}</div>
      @enderror
    </div>

    <!-- Password Field -->
    <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <div class="form-control-wrap">
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Masukkan password"
          class="form-control @error('password') is-invalid @enderror"
          autocomplete="current-password"
          required
        >
      </div>
      @error('password')
        <div class="field-error-msg">{{ $message }}</div>
      @enderror
    </div>

    <!-- Lupa Password & Remember -->
    <div class="form-meta-row">
      <a href="javascript:void(0)" class="forgot-link" onclick="handleForgotPassword()">
        Lupa password?
      </a>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-submit">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
        <polyline points="10 17 15 12 10 7" />
        <line x1="15" y1="12" x2="3" y2="12" />
      </svg>
      <span>Masuk</span>
    </button>
  </form>

  <!-- Footer Navigation -->
  <div class="gateway-footer">
    Belum punya akun?
    <a href="{{ route('auth.register') }}">Buat akun</a>
  </div>

  <div class="gateway-coordinates mono" aria-hidden="true">
    COORD: 00°00'00"N · TIME TRANSIT PROTOCOL
  </div>
</div>
@endsection

@section('scripts')
<script>
  function handleForgotPassword() {
    alert("Sistem pemulihan kata sandi otomatis melalui email sedang dalam pemeliharaan. Jika kamu lupa kata sandi akunmu, silakan hubungi admin atau daftarkan akun baru.");
  }
</script>
@endsection
