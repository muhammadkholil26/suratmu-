@extends('layouts.app')

@section('title', 'Buat Pesan Untuk Masa Depan — Siapkan Kapsul Waktu')
@section('meta_description', 'Tulis pesanmu hari ini dan tentukan kapan pesan tersebut boleh dibuka. Kapsul waktu digital tanpa registrasi.')

@section('content')
<div class="container container-narrow">

  <!-- Celestial Background Accent (Low Contrast) -->
  <div class="create-celestial-decor" aria-hidden="true">
    <svg viewBox="0 0 700 240" fill="none" stroke="#D6D6D1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
      <ellipse cx="620" cy="60" rx="48" ry="16" transform="rotate(-18 620 60)" />
      <circle cx="620" cy="60" r="22" />
      <path d="M598 55 Q620 70 642 66" />
      <!-- Small orbital arc -->
      <path d="M50 160 C 200 120, 400 130, 580 80" stroke-dasharray="3 6" opacity="0.6" />
      <!-- 4-point Star -->
      <path d="M120 40 Q120 46 126 46 Q120 46 120 52 Q120 46 114 46 Q120 46 120 40 Z" />
      <circle cx="150" cy="65" r="1.5" fill="#D6D6D1" />
    </svg>
  </div>

  <!-- Header Section -->
  <div class="page-header">
    <div class="capsule-sub-badge">
      <span class="mono">MISSION: TIME TRANSIT</span>
    </div>
    <h1 class="page-title serif">Buat Pesan Untuk Masa Depan</h1>
    <p class="page-description">
      Tulis pesanmu hari ini dan tentukan kapan kapsul waktu ini boleh dibuka.
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
        <strong>Ada yang perlu diperiksa kembali:</strong>
        <ul style="margin: 6px 0 0 16px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <!-- Writing Sheet Card -->
  <div class="letter-card">

    <form action="{{ route('messages.store') }}" method="POST" id="createMessageForm" novalidate>
      @csrf

      <div class="form-row-two-col">
        <!-- Sender Name (Requirement 5: Pengirim) -->
        <div class="form-group">
          <label for="sender_name" class="form-label">
            Nama Pengirim <span class="required">*</span>
          </label>
          <input
            type="text"
            id="sender_name"
            name="sender_name"
            class="form-control @error('sender_name') is-invalid @enderror"
            value="{{ old('sender_name') }}"
            placeholder="Contoh: Kholil, atau Aku di Tahun 2026"
            maxlength="100"
            required
            autocomplete="off"
          >
          @error('sender_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <p class="form-hint">Nama pengirim surat saat tiba di masa depan.</p>
        </div>

        <!-- Recipient Name (Requirement 5: Penerima) -->
        <div class="form-group">
          <label for="recipient_name" class="form-label">
            Nama Penerima
          </label>
          <input
            type="text"
            id="recipient_name"
            name="recipient_name"
            class="form-control @error('recipient_name') is-invalid @enderror"
            value="{{ old('recipient_name') }}"
            placeholder="Contoh: Diriku di Masa Depan, Sahabatku, Anakku"
            maxlength="100"
            autocomplete="off"
          >
          @error('recipient_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <p class="form-hint">Kepada siapa pesan ini ditujukan.</p>
        </div>
      </div>

      <!-- Title (Requirement 5: Judul) -->
      <div class="form-group">
        <label for="title" class="form-label">
          Judul Pesan
        </label>
        <input
          type="text"
          id="title"
          name="title"
          class="form-control @error('title') is-invalid @enderror"
          value="{{ old('title') }}"
          placeholder="Contoh: Catatan Hari Ini untuk Hari Esok yang Lebih Tenang"
          maxlength="150"
          autocomplete="off"
        >
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Message Content (Requirement 5: Isi Pesan) -->
      <div class="form-group">
        <div class="label-with-counter">
          <label for="message_text" class="form-label">
            Isi Pesan <span class="required">*</span>
          </label>
          <span class="char-counter" id="charCounter">0 / 5000</span>
        </div>
        <textarea
          id="message_text"
          name="message"
          rows="9"
          class="form-control form-textarea serif @error('message') is-invalid @enderror"
          placeholder="Tuliskan harapan, cerita kehidupan hari ini, refleksi, atau rahasia yang ingin kamu baca kembali di masa depan..."
          maxlength="5000"
          required
        >{{ old('message') }}</textarea>
        @error('message')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <p class="form-hint">Maksimal 5000 karakter. Pesan akan tersimpan aman dan tidak akan dikirimkan ke siapa pun sebelum waktu yang ditentukan.</p>
      </div>

      <!-- Date and Time Picker (Requirement 5: Tanggal & Waktu Buka) -->
      <div class="form-row-datetime">
        <!-- Unlock Date -->
        <div class="form-group">
          <label for="unlock_date" class="form-label">
            Tanggal dapat dibuka <span class="required">*</span>
          </label>
          <input
            type="date"
            id="unlock_date"
            name="unlock_date"
            class="form-control @error('unlock_date') is-invalid @enderror"
            value="{{ old('unlock_date') }}"
            required
          >
          @error('unlock_date')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Unlock Time -->
        <div class="form-group">
          <label for="unlock_time" class="form-label">
            Waktu dapat dibuka <span class="required">*</span>
          </label>
          <input
            type="time"
            id="unlock_time"
            name="unlock_time"
            class="form-control @error('unlock_time') is-invalid @enderror"
            value="{{ old('unlock_time', '20:00') }}"
            required
          >
          @error('unlock_time')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <!-- Quick Date Presets -->
      <div class="date-presets">
        <span class="presets-label">Pilihan cepat:</span>
        <button type="button" class="preset-pill" data-offset-days="30">1 Bulan</button>
        <button type="button" class="preset-pill" data-offset-days="180">6 Bulan</button>
        <button type="button" class="preset-pill" data-offset-days="365">1 Tahun</button>
        <button type="button" class="preset-pill" data-offset-days="1095">3 Tahun</button>
        <button type="button" class="preset-pill" data-offset-days="1825">5 Tahun</button>
      </div>

      <!-- Actions Row: Preview & Submit (Requirement 6) -->
      <div class="form-submit-row">
        <div class="submit-note">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span>Pesan akan disegel dan kamu akan menerima kode kunci unik 8 karakter.</span>
        </div>

        <div class="actions-group">
          <!-- Preview Button (Requirement 6) -->
          <button type="button" id="openPreviewModalBtn" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            Preview Surat
          </button>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
              <polyline points="17 21 17 13 7 13 7 21"></polyline>
              <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            Simpan Pesan
          </button>
        </div>
      </div>

    </form>
  </div>

  <!-- ================= PREVIEW BEFORE SAVING MODAL (Requirement 6) ================= -->
  <div id="previewModal" class="share-modal-backdrop" aria-hidden="true">
    <div class="share-modal-card preview-paper-card">
      <div class="preview-header-stamp">
        <div class="prev-badge-title mono">TIME CAPSULE · PREVIEW</div>
        <div class="prev-badge-status">BELUM DISEGEL</div>
      </div>

      <div class="preview-letter-parchment">
        <div class="preview-meta-grid">
          <div>
            <span class="p-meta-lbl">FROM:</span>
            <span class="p-meta-val" id="prevSenderName">—</span>
          </div>
          <div>
            <span class="p-meta-lbl">TO:</span>
            <span class="p-meta-val" id="prevRecipientName">—</span>
          </div>
          <div class="full-col">
            <span class="p-meta-lbl">UNLOCK DATE:</span>
            <span class="p-meta-val highlight" id="prevUnlockDate">—</span>
          </div>
        </div>

        <div class="preview-divider"></div>

        <h3 class="preview-title serif" id="prevTitle">—</h3>
        <div class="preview-body serif" id="prevBody">—</div>

        <div class="preview-bottom-timeline">
          <span>{{ date('Y') }} (DIBUAT)</span>
          <div class="prev-timeline-arrow"></div>
          <span id="prevTimelineYear">MASA DEPAN</span>
        </div>
      </div>

      <div class="preview-actions">
        <button type="button" id="closePreviewBtn" class="btn btn-secondary">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20h9"></path>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
          </svg>
          Edit Pesan
        </button>
        <button type="button" id="confirmSaveFromPreviewBtn" class="btn btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          Simpan & Segel Pesan
        </button>
      </div>
    </div>
  </div>

</div>
@endsection

@section('styles')
<style>
  .container-narrow {
    max-width: 740px;
    position: relative;
  }

  .create-celestial-decor {
    position: absolute;
    top: -20px;
    right: -40px;
    width: 280px;
    height: 120px;
    pointer-events: none;
    z-index: 0;
    opacity: 0.7;
  }
  .create-celestial-decor svg {
    width: 100%;
    height: 100%;
    display: block;
  }

  .page-header {
    margin-bottom: 32px;
    position: relative;
    z-index: 2;
  }

  .capsule-sub-badge {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.14em;
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
    font-size: clamp(30px, 4.5vw, 42px);
    line-height: 1.15;
    letter-spacing: -0.03em;
    color: var(--ink);
    margin-bottom: 10px;
  }

  .page-description {
    color: var(--muted);
    font-size: 15px;
    line-height: 1.6;
  }

  /* Letter Card */
  .letter-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 40px;
    box-shadow: var(--shadow-md);
    position: relative;
    z-index: 2;
  }

  .letter-stamp {
    position: absolute;
    top: 36px;
    right: 40px;
    width: 60px;
    height: 72px;
    border: 2px dashed rgba(176, 135, 78, 0.45);
    background: var(--paper-warm);
    display: grid;
    place-items: center;
    border-radius: 4px;
    pointer-events: none;
  }

  .stamp-inner {
    text-align: center;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--gold);
    line-height: 1.25;
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

  .date-presets {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: -12px;
    margin-bottom: 28px;
  }

  .presets-label {
    font-size: 12px;
    color: var(--muted);
    font-weight: 500;
  }

  .preset-pill {
    background: var(--surface-muted);
    border: 1px solid var(--line);
    border-radius: var(--radius-pill);
    padding: 4px 12px;
    font-size: 12px;
    font-weight: 500;
    color: var(--ink-soft);
    cursor: pointer;
    transition: all .2s ease;
  }
  .preset-pill:hover {
    background: var(--accent-soft);
    border-color: var(--accent);
    color: var(--accent-dark);
  }

  .form-submit-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding-top: 24px;
    border-top: 1px solid var(--line-subtle);
  }

  .submit-note {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--muted);
    line-height: 1.4;
  }

  .actions-group {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
  }

  .btn-submit {
    min-height: 50px;
    padding: 0 32px;
    font-size: 15px;
  }

  /* Preview Modal Parchment Style */
  .preview-paper-card {
    max-width: 620px;
    padding: 36px 32px;
  }
  .preview-header-stamp {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 14px;
    border-bottom: 1px dashed var(--line);
    margin-bottom: 20px;
  }
  .prev-badge-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    color: var(--accent-dark);
  }
  .prev-badge-status {
    font-size: 10px;
    font-weight: 700;
    color: var(--gold);
    background: var(--gold-soft);
    padding: 3px 8px;
    border-radius: var(--radius-pill);
  }
  .preview-letter-parchment {
    background: var(--paper-warm);
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    padding: 24px 22px;
    margin-bottom: 24px;
  }
  .preview-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    font-size: 13px;
  }
  .preview-meta-grid .full-col { grid-column: span 2; }
  .p-meta-lbl {
    font-size: 10px;
    font-weight: 700;
    color: var(--muted);
    display: block;
    letter-spacing: 0.08em;
  }
  .p-meta-val {
    color: var(--ink);
    font-weight: 600;
  }
  .p-meta-val.highlight { color: var(--accent-dark); }
  .preview-divider {
    height: 1px;
    background: var(--line-subtle);
    margin: 16px 0;
  }
  .preview-title {
    font-size: 20px;
    color: var(--ink);
    margin-bottom: 12px;
  }
  .preview-body {
    font-size: 15px;
    line-height: 1.8;
    color: var(--ink-soft);
    white-space: pre-wrap;
    max-height: 220px;
    overflow-y: auto;
  }
  .preview-bottom-timeline {
    margin-top: 20px;
    padding-top: 14px;
    border-top: 1px dashed var(--line);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: var(--muted);
  }
  .prev-timeline-arrow {
    flex: 1;
    height: 1px;
    background: var(--line);
    margin: 0 12px;
    position: relative;
  }
  .prev-timeline-arrow::after {
    content: "";
    position: absolute;
    right: 0;
    top: -2px;
    width: 0;
    height: 0;
    border-top: 2px solid transparent;
    border-bottom: 2px solid transparent;
    border-left: 4px solid var(--muted);
  }
  .preview-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
  }

  @media (max-width: 640px) {
    .letter-card { padding: 24px 20px; }
    .letter-stamp { display: none; }
    .form-row-two-col { grid-template-columns: 1fr; gap: 0; }
    .form-row-datetime { grid-template-columns: 1fr; }
    .form-submit-row { flex-direction: column; align-items: stretch; }
    .actions-group { width: 100%; flex-direction: column; }
    .actions-group .btn { width: 100%; }
    .preview-actions { flex-direction: column; }
    .preview-actions .btn { width: 100%; }
  }
</style>
@endsection

@section('scripts')
<script>
  const dateInput = document.getElementById('unlock_date');
  const timeInput = document.getElementById('unlock_time');
  const textarea = document.getElementById('message_text');
  const counter = document.getElementById('charCounter');
  const senderInput = document.getElementById('sender_name');
  const recipientInput = document.getElementById('recipient_name');
  const titleInput = document.getElementById('title');
  const form = document.getElementById('createMessageForm');

  // Set minimum date to today
  if (dateInput) {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    dateInput.min = `${year}-${month}-${day}`;
  }

  // Live character counter
  if (textarea && counter) {
    function updateCounter() {
      const length = textarea.value.length;
      counter.textContent = `${length} / 5000`;
      if (length > 4900) {
        counter.style.color = 'var(--danger)';
      } else {
        counter.style.color = 'var(--muted)';
      }
    }
    textarea.addEventListener('input', updateCounter);
    updateCounter();
  }

  // Quick preset pills
  const presetButtons = document.querySelectorAll('.preset-pill');
  presetButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const days = parseInt(btn.getAttribute('data-offset-days'), 10);
      const targetDate = new Date();
      targetDate.setDate(targetDate.getDate() + days);

      const y = targetDate.getFullYear();
      const m = String(targetDate.getMonth() + 1).padStart(2, '0');
      const d = String(targetDate.getDate()).padStart(2, '0');

      if (dateInput) {
        dateInput.value = `${y}-${m}-${d}`;
        dateInput.focus();
      }
    });
  });

  // Preview Modal logic (Requirement 6)
  const openPreviewBtn = document.getElementById('openPreviewModalBtn');
  const closePreviewBtn = document.getElementById('closePreviewBtn');
  const previewModal = document.getElementById('previewModal');
  const confirmSaveBtn = document.getElementById('confirmSaveFromPreviewBtn');

  if (openPreviewBtn && previewModal) {
    openPreviewBtn.addEventListener('click', () => {
      // Validate basic required fields first
      if (!senderInput.value.trim()) {
        alert('Silakan isi Nama Pengirim terlebih dahulu.');
        senderInput.focus();
        return;
      }
      if (!textarea.value.trim()) {
        alert('Silakan tulis Isi Pesan terlebih dahulu.');
        textarea.focus();
        return;
      }
      if (!dateInput.value) {
        alert('Silakan tentukan Tanggal Buka terlebih dahulu.');
        dateInput.focus();
        return;
      }

      // Populate preview fields
      document.getElementById('prevSenderName').textContent = senderInput.value.trim();
      document.getElementById('prevRecipientName').textContent = recipientInput.value.trim() || 'Sahabat Masa Depan';
      document.getElementById('prevTitle').textContent = titleInput.value.trim() || 'Surat Untuk Masa Depan';
      document.getElementById('prevBody').textContent = textarea.value.trim();
      
      const timeVal = timeInput.value || '20:00';
      document.getElementById('prevUnlockDate').textContent = `${dateInput.value} pukul ${timeVal} WIB`;
      
      // Target year
      const targetYear = dateInput.value.split('-')[0] || 'MASA DEPAN';
      document.getElementById('prevTimelineYear').textContent = targetYear;

      previewModal.classList.add('open');
    });

    closePreviewBtn.addEventListener('click', () => {
      previewModal.classList.remove('open');
    });

    confirmSaveBtn.addEventListener('click', () => {
      previewModal.classList.remove('open');
      form.submit();
    });
  }
</script>
@endsection
