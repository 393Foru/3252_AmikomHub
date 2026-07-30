<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket - Eventama</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 40px 15px;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
        }
        .ticket {
            background-color: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .header {
            background: #4f46e5;
            background: linear-gradient(135deg, #4f46e5 0%, #0ea5e9 100%);
            padding: 40px 30px;
            color: #ffffff;
        }
        .header-top {
            display: block;
            margin-bottom: 25px;
        }
        .brand {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .status {
            float: right;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .event-title {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            line-height: 1.3;
            clear: both;
        }
        .body-section {
            padding: 35px 30px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding-bottom: 25px;
            vertical-align: top;
        }
        .label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0 0 6px 0;
        }
        .value {
            font-size: 16px;
            color: #0f172a;
            font-weight: 600;
            margin: 0;
            line-height: 1.4;
            word-break: break-word;
            padding-right: 15px;
        }
        .action-link {
            display: inline-block;
            margin-top: 8px;
            font-size: 12px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }
        .action-link:hover {
            text-decoration: underline;
        }
        .divider {
            border-top: 2px dashed #e2e8f0;
            margin: 5px 0 30px 0;
        }
        .reminders-box {
            background-color: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #f1f5f9;
        }
        .reminders-title {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .reminders-list {
            margin: 0;
            padding-left: 20px;
            font-size: 13px;
            color: #475569;
            line-height: 1.6;
        }
        .reminders-list li {
            margin-bottom: 6px;
        }
        .qr-section {
            text-align: center;
        }
        .qr-border {
            display: inline-block;
            padding: 15px;
            border-radius: 20px;
            border: 2px solid #f1f5f9;
            margin-bottom: 15px;
        }
        .qr-code {
            display: block;
            width: 150px;
            height: 150px;
        }
        .order-id {
            font-family: 'SF Mono', ui-monospace, 'Courier New', monospace;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }
        .qr-text {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
        .footer p {
            color: #94a3b8;
            font-size: 13px;
            margin: 6px 0;
        }
        .support-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket">
            <div class="header">
                <div class="header-top">
                    <span class="brand">Eventama</span>
                    <span class="status">PAID</span>
                </div>
                <h2 class="event-title">{{ $transaction->event->title }}</h2>
            </div>
            
            <div class="body-section">
                <table class="info-table">
                    <tr>
                        <td colspan="2">
                            <p class="label">Pemesan</p>
                            <p class="value">{{ $transaction->customer_name }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <p class="label">Tanggal & Waktu</p>
                            <p class="value">{{ \Carbon\Carbon::parse($transaction->event->date)->format('d M Y, H:i') }}</p>
                            <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($transaction->event->title) }}&dates={{ \Carbon\Carbon::parse($transaction->event->date)->format('Ymd\THis') }}/{{ \Carbon\Carbon::parse($transaction->event->date)->addHours(2)->format('Ymd\THis') }}&location={{ urlencode($transaction->event->location) }}" target="_blank" class="action-link">🗓️ Simpan ke Kalender</a>
                        </td>
                        <td style="width: 50%;">
                            <p class="label">Lokasi</p>
                            <p class="value">{{ $transaction->event->location }}</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($transaction->event->location) }}" target="_blank" class="action-link">📍 Buka di Peta</a>
                        </td>
                    </tr>
                </table>
                
                <div class="divider"></div>

                <div class="qr-section">
                    <div class="qr-border">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($transaction->order_id) }}&margin=0" alt="QR Code" class="qr-code">
                    </div>
                    <p class="order-id">{{ $transaction->order_id }}</p>
                    <p class="qr-text" style="margin-bottom: 30px;">Scan saat check-in</p>
                </div>

                <div class="reminders-box" style="margin-bottom: 0;">
                    <p class="reminders-title">📌 Hal yang perlu diperhatikan</p>
                    <ul class="reminders-list">
                        <li>Siapkan E-Ticket ini (QR Code) sebelum memasuki area gate pemeriksaan.</li>
                        <li>Pastikan kecerahan layar HP Anda maksimal saat proses scan tiket.</li>
                        <li>Datanglah lebih awal untuk menghindari antrean masuk.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Butuh bantuan? Hubungi <a href="mailto:support@eventama.com" class="support-link">support@eventama.com</a></p>
            <p style="margin-top: 20px;">Terima kasih telah menggunakan Eventama.</p>
            <p>&copy; {{ date('Y') }} Eventama. All rights reserved.</p>
        </div>
    </div>
</body>
</html>