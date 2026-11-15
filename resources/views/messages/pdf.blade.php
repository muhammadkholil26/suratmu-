<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Kapsul Waktu — {{ $message->title ?? 'Pesan Untuk Masa Depan' }}</title>
  <style>
    @page {
      margin: 30mm 25mm 25mm 25mm;
    }
    body {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      color: #222624;
      background-color: #ffffff;
      line-height: 1.6;
      font-size: 11pt;
    }
    .serif {
      font-family: Georgia, 'Times New Roman', serif;
    }
    .mono {
      font-family: 'Courier New', Courier, monospace;
    }

    /* Container Parchment Border */
    .capsule-document {
      border: 1px solid #e3e3dc;
      padding: 24px;
      position: relative;
    }

    /* Top Seal / Header */
    .doc-header {
      border-bottom: 2px solid #e3e3dc;
      padding-bottom: 16px;
      margin-bottom: 20px;
    }
    .header-table {
      width: 100%;
    }
    .kicker {
      font-size: 8pt;
      font-weight: bold;
      letter-spacing: 2px;
      color: #46685a;
      text-transform: uppercase;
    }
    .main-title {
      font-size: 18pt;
      margin: 4px 0 0 0;
      color: #222624;
    }
    .stamp-cell {
      text-align: right;
      vertical-align: top;
    }
    .code-stamp {
      display: inline-block;
      border: 1px dashed #b0874e;
      padding: 6px 12px;
      font-size: 11pt;
      font-weight: bold;
      color: #b0874e;
      letter-spacing: 2px;
    }

    /* Meta Table */
    .meta-table {
      width: 100%;
      margin-bottom: 20px;
      font-size: 10pt;
      border-collapse: collapse;
    }
    .meta-table td {
      padding: 4px 0;
    }
    .meta-label {
      color: #727a75;
      font-size: 8pt;
      font-weight: bold;
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    .meta-val {
      font-size: 11pt;
      font-weight: bold;
      color: #222624;
    }

    .divider {
      height: 1px;
      background-color: #e3e3dc;
      margin: 16px 0 24px 0;
    }

    /* Message Subject & Body */
    .subject-title {
      font-size: 16pt;
      color: #324c41;
      margin: 0 0 16px 0;
    }
    .message-body {
      font-size: 11.5pt;
      line-height: 1.85;
      color: #222624;
      white-space: pre-wrap;
      word-wrap: break-word;
      min-height: 200px;
    }

    /* Footer Timestamps & Timeline */
    .doc-footer {
      margin-top: 36px;
      padding-top: 16px;
      border-top: 1px dashed #e3e3dc;
    }
    .footer-table {
      width: 100%;
      font-size: 9pt;
      color: #727a75;
    }
    .footer-center {
      text-align: center;
      margin-top: 20px;
      font-size: 9pt;
      color: #727a75;
      font-style: italic;
    }
  </style>
</head>
<body>

  <div class="capsule-document">
    <!-- Header -->
    <div class="doc-header">
      <table class="header-table">
        <tr>
          <td>
            <div class="kicker">TIME CAPSULE · PESAN UNTUK MASA DEPAN</div>
            <h1 class="main-title serif">Kapsul Waktu Digital</h1>
          </td>
          <td class="stamp-cell">
            <div class="code-stamp mono">{{ $message->code }}</div>
          </td>
        </tr>
      </table>
    </div>

    <!-- Metadata Grid -->
    <table class="meta-table">
      <tr>
        <td style="width: 50%;">
          <div class="meta-label">FROM / PENGIRIM:</div>
          <div class="meta-val serif">{{ $message->sender_name }}</div>
        </td>
        <td style="width: 50%; text-align: right;">
          <div class="meta-label">TO / PENERIMA:</div>
          <div class="meta-val serif">{{ $message->recipient_name }}</div>
        </td>
      </tr>
    </table>

    <div class="divider"></div>

    <!-- Subject Title -->
    @if ($message->title)
      <h2 class="subject-title serif">{{ $message->title }}</h2>
    @endif

    <!-- Letter Body -->
    <div class="message-body serif">
{{ $message->message }}
    </div>

    <!-- Footer Timeline -->
    <div class="doc-footer">
      <table class="footer-table">
        <tr>
          <td>
            <strong>Dibuat pada:</strong> {{ $message->created_at->translatedFormat('d F Y, H:i') }} WIB
          </td>
          <td style="text-align: right;">
            <strong>Dibuka pada:</strong> {{ $message->unlock_at->translatedFormat('d F Y, H:i') }} WIB
          </td>
        </tr>
      </table>

      <div class="footer-center serif">
        “This message has completed its journey through time.”
        <br>
        <span style="font-size: 7.5pt; font-family: sans-serif; font-style: normal; color: #a5aea7;">
          Dokumen otentik dikeluarkan melalui sistem Pesan Untuk Masa Depan
        </span>
      </div>
    </div>
  </div>

</body>
</html>

