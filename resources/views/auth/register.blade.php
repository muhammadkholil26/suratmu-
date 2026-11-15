@extends('layouts.auth')

@section('title', 'Daftar Kapsul Waktu — Pesan Untuk Masa Depan')

@section('content')
<div class="auth-portal-card">

  <!-- Header & Gateway Branding -->
  <div class="auth-gateway-header">
    <div class="capsule-gateway-emblem" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <!-- Quill / Key / Time capsule creation motif -->
        <path d="M12 20h9" />
        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
        <circle cx="19" cy="5" r="1.5" fill="currentColor" />
      </svg>
    </div>

    <span class="brand-eyebrow">PESAN UNTUK MASA DEPAN</span>
    <h1 class="gateway-title serif">Buat Kapsul Waktumu.</h1>
    <p class="gateway-subtitle">Mulai perjalananmu menuju masa depan.</p>
  </div>

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

  <!-- Register Form -->
  <form method="POST" action="{{ route('auth.register.post') }}" class="auth-form" novalidate>
    @csrf

    <!-- Nama Field -->
    <div class="form-group">
      <label for="name" class="form-label">Nama</label>
      <div class="form-control-wrap">
        <input
          type="text"
          id="name"
          name="name"
          value="{{ old('name') }}"
          placeholder="Nama lengkapmu"
          class="form-control @error('name') is-invalid @enderror"
          autocomplete="name"
          maxlength="100"
          required
          autofocus
        >
      </div>
      @error('name')
        <div class="field-error-msg">{{ $message }}</div>
      @enderror
    </div>

    <!-- Email Field -->
    <div class="form-group">
      <label for="email" class="form-label">Email</label>
      <div class="form-control-wrap">
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="nama@email.com"
          class="form-control @error('email') is-invalid @enderror"
          autocomplete="email"
          required
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
          placeholder="Minimal 8 karakter"
          class="form-control @error('password') is-invalid @enderror"
          autocomplete="new-password"
          minlength="8"
          required
        >
      </div>
      @error('password')
        <div class="field-error-msg">{{ $message }}</div>
      @enderror
    </div>

    <!-- Konfirmasi Password Field -->
    <div class="form-group">
      <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
      <div class="form-control-wrap">
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Ulangi password"
          class="form-control"
          autocomplete="new-password"
          required
        >
      </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-submit">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <polyline points="12 6 12 12 14 14" />
      </svg>
      <span>Buat Akun</span>
    </button>
  </form>

  <!-- Footer Navigation -->
  <div class="gateway-footer">
    Sudah punya akun?
    <a href="{{ route('auth.login') }}">Masuk di sini</a>
  </div>

  <div class="gateway-coordinates mono" aria-hidden="true">
    TRANSIT PROTOCOL · INITIALIZE TIME CAPSULE
  </div>
</div>
@endsection
