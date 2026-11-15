@extends('layouts.app')

@section('title', 'Edit Pesan — Kapsul Waktu ' . $code)

@section('content')
<div class="container container-narrow">

  <div class="page-header">
    <a href="{{ route('messages.show', ['code' => $code]) }}" class="back-link">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
      Kembali ke Kapsul Pesan
    </a>
    <div class="capsule-sub-badge">
      <span class="mono">STATUS: DALAM PERJALANAN WAKTU (DAPAT DIEDIT)</span>
    </div>
    <h1 class="page-title serif">Edit Pesan Kapsul Waktu</h1>
    <p class="page-description">
      Kamu dapat memperbarui isi surat atau mengubah tanggal pembukaan selama pesan belum mencapai waktu unlock.
    </p>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <div>
        <strong>Ada yang perlu diperiksa:</strong>
        <ul style="margin: 6px 0 0 16px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <div class="letter-card">
    <form action="{{ route('messages.update', ['code' => $code]) }}" method="POST" id="editMessageForm">
      @csrf
      @method('PUT')

      <div class="form-row-two-col">
        <!-- Sender Name -->
        <div class="form-group">
          <label for="sender_name" class="form-label">Nama Pengirim <span class="required">*</span></label>
          <input
            type="text"
            id="sender_name"
            name="sender_name"
            class="form-control @error('sender_name') is-invalid @enderror"
            value="{{ old('sender_name', $message->sender_name) }}"
            maxlength="100"
            required
          >
          @error('sender_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Recipient Name -->
        <div class="form-group">
          <label for="recipient_name" class="form-label">Nama Penerima</label>
          <input
            type="text"
            id="recipient_name"
            name="recipient_name"
            class="form-control @error('recipient_name') is-invalid @enderror"
            value="{{ old('recipient_name', $message->recipient_name) }}"
            maxlength="100"
          >
          @error('recipient_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <!-- Title -->
      <div class="form-group">
        <label for="title" class="form-label">Judul Pesan</label>
        <input
          type="text"
          id="title"
          name="title"
          class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title', $message->title) }}"
          maxlength="150"
        >
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Message Content -->
      <div class="form-group">
        <div class="label-with-counter">
          <label for="message_text" class="form-label">Isi Pesan <span class="required">*</span></label>
          <span class="char-counter" id="charCounter">0 / 5000</span>
        </div>
        <textarea
          id="message_text"
          name="message"
          rows="9"
          class="form-control form-textarea serif @error('message') is-invalid @enderror"
          maxlength="5000"
          required
        >{{ old('message', $message->message) }}</textarea>
        @error('message')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Date and Time Picker -->
      <div class="form-row-datetime">
        <div class="form-group">
          <label for="unlock_date" class="form-label">Tanggal dapat dibuka <span class="required">*</span></label>
          <input
            type="date"
            id="unlock_date"
            name="unlock_date"
            class="form-control @error('unlock_date') is-invalid @enderror"
            value="{{ old('unlock_date', $message->unlock_at->format('Y-m-d')) }}"
            required
          >
          @error('unlock_date')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="unlock_time" class="form-label">Waktu dapat dibuka <span class="required">*</span></label>
          <input
            type="time"
            id="unlock_time"
            name="unlock_time"
            class="form-control @error('unlock_time') is-invalid @enderror"
            value="{{ old('unlock_time', $message->unlock_at->format('H:i')) }}"
            required
          >
          @error('unlock_time')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="form-submit-row">
        <a href="{{ route('messages.show', ['code' => $code]) }}" class="btn btn-secondary">
          Batal
        </a>
        <button type="submit" class="btn btn-primary btn-submit">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
            <polyline points="17 21 17 13 7 13 7 21"></polyline>
            <polyline points="7 3 7 8 15 8"></polyline>
          </svg>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>

</div>
@endsection

@section('styles')
<style>
  .container-narrow { max-width: 740px; }
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
  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 500;
    color: var(--muted);
    text-decoration: none;
    margin-bottom: 14px;
    transition: color .2s ease;
  }
  .back-link:hover { color: var(--accent-dark); }
  .page-title {
    font-size: clamp(28px, 4.5vw, 38px);
    line-height: 1.15;
    letter-spacing: -0.03em;
    color: var(--ink);
    margin-bottom: 8px;
  }
  .page-description { color: var(--muted); font-size: 15px; }
  .letter-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 40px;
    box-shadow: var(--shadow-md);
  }
  .required { color: var(--accent); }
  .form-row-two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  .label-with-counter {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .char-counter {
    font-size: 12px;
    color: var(--muted);
    font-family: 'JetBrains Mono', monospace;
  }
  .form-textarea {
    resize: vertical;
    min-height: 180px;
    font-size: 16px;
    line-height: 1.7;
    background: var(--paper-warm);
  }
  .form-row-datetime {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 16px;
  }
  .form-submit-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 24px;
    border-top: 1px solid var(--line-subtle);
  }
  .btn-submit { min-height: 48px; padding: 0 28px; }
  @media (max-width: 640px) {
    .letter-card { padding: 24px 20px; }
    .form-row-two-col { grid-template-columns: 1fr; gap: 0; }
    .form-row-datetime { grid-template-columns: 1fr; }
    .form-submit-row { flex-direction: column-reverse; gap: 12px; }
    .form-submit-row .btn { width: 100%; }
  }
</style>
@endsection

@section('scripts')
<script>
  const textarea = document.getElementById('message_text');
  const counter = document.getElementById('charCounter');
  if (textarea && counter) {
    function updateCounter() {
      counter.textContent = `${textarea.value.length} / 5000`;
    }
    textarea.addEventListener('input', updateCounter);
    updateCounter();
  }
</script>
@endsection

