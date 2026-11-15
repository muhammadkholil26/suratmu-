@extends('layouts.app')

@section('title', 'Buka Pesan Masa Depan — Masukkan Kode Kunci')
@section('meta_description', 'Buka pesan dan kapsul waktu masa depan menggunakan kode rahasia unik milikmu.')

@section('content')
<div class="container container-narrow">

  <!-- Header Section -->
  <div class="page-header text-center">
    <div class="key-icon-badge" aria-hidden="true">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="7.5" cy="15.5" r="5.5"></circle>
        <path d="m21 2-2 2m-6 6 7 7-4 4-7-7"></path>
        <path d="m15.5 7.5 3 3"></path>
      </svg>
    </div>
    <div class="capsule-sub-badge">
      <span class="mono">KUNCI KAPSUL WAKTU</span>
    </div>
    <h1 class="page-title serif">Buka Pesan Masa Depan</h1>
    <p class="page-description">
      Masukkan kode rahasia yang kamu miliki untuk memeriksa atau membuka surat.
    </p>
  </div>

  @if ($errors->has('code'))
    <div class="alert alert-danger" role="alert">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 1px;">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <div>
        <strong style="display: block; margin-bottom: 2px;">Pesan tidak ditemukan.</strong>
        <span>Pastikan kode yang kamu masukkan benar.</span>
      </div>
    </div>
  @endif

  <!-- Key Entry Card -->
  <div class="card card-open">
    <form action="{{ route('messages.open') }}" method="POST" id="openMessageForm">
      @csrf

      <div class="form-group text-center">
        <label for="code" class="form-label code-input-label">
          KODE PESAN
        </label>
        <div class="code-input-wrapper">
          <input
            type="text"
            id="code"
            name="code"
            class="form-control code-input mono @error('code') is-invalid @enderror"
            value="{{ old('code', request('code')) }}"
            placeholder="KF7X-29PA"
            maxlength="9"
            required
            autocomplete="off"
            autofocus
            spellcheck="false"
          >
        </div>
        <p class="form-hint">
          Format kode terdiri dari 8 karakter huruf dan angka (contoh: <code>KF7X-29PA</code>).
        </p>
      </div>

      <div class="open-actions">
        <button type="submit" class="btn btn-primary btn-block btn-open">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Buka Kapsul Waktu
        </button>
      </div>
    </form>

    <div class="open-footer-help">
      <p>
        Belum memiliki pesan untuk masa depan?
        <a href="{{ route('messages.create') }}">Buat pesan baru di sini</a>.
      </p>
    </div>
  </div>

</div>
@endsection

@section('styles')
<style>
  .container-narrow { max-width: 540px; }
  .text-center { text-align: center; }
  .page-header { margin-bottom: 32px; }
  .capsule-sub-badge {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--accent-dark);
    background: var(--accent-soft);
    padding: 3px 10px;
    border-radius: var(--radius-pill);
    margin-bottom: 8px;
  }
  .key-icon-badge {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--accent-soft);
    color: var(--accent-dark);
    display: grid;
    place-items: center;
    margin: 0 auto 14px;
    border: 1px solid rgba(70, 104, 90, 0.2);
  }
  .page-title {
    font-size: clamp(28px, 4.5vw, 38px);
    line-height: 1.15;
    letter-spacing: -0.025em;
    color: var(--ink);
    margin-bottom: 8px;
  }
  .page-description { color: var(--muted); font-size: 15px; }

  .card-open {
    padding: 38px 32px;
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
  }
  .code-input-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.16em;
    color: var(--muted);
    margin-bottom: 12px;
  }
  .code-input-wrapper {
    max-width: 320px;
    margin: 0 auto;
  }
  .code-input {
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 0.14em;
    padding: 14px 16px;
    border-radius: 14px;
    text-transform: uppercase;
    background: var(--paper-warm);
    border: 2px solid var(--line);
  }
  .code-input:focus {
    border-color: var(--accent);
    background: var(--surface);
  }
  .open-actions { margin-top: 24px; }
  .btn-block { width: 100%; }
  .btn-open { min-height: 50px; font-size: 15px; }
  .open-footer-help {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--line-subtle);
    text-align: center;
    font-size: 13px;
    color: var(--muted);
  }
  .open-footer-help a {
    color: var(--accent);
    text-decoration: none;
    font-weight: 600;
  }
  .open-footer-help a:hover { text-decoration: underline; }

  @media (max-width: 500px) {
    .card-open { padding: 28px 20px; }
    .code-input { font-size: 24px; letter-spacing: 0.1em; }
  }
</style>
@endsection

@section('scripts')
<script>
  const codeInput = document.getElementById('code');
  if (codeInput) {
    codeInput.addEventListener('input', (e) => {
      let val = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
      if (val.length > 4) {
        val = val.slice(0, 4) + '-' + val.slice(4, 8);
      }
      e.target.value = val;
    });
  }
</script>
@endsection
