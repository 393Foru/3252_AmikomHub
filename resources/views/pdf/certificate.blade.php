<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kehadiran</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            /* Warna atau pola default jika tidak ada gambar latar belakang */
            background-color: #f8f9fa;
        }
        .certificate-container {
            width: 100%;
            height: 100%;
            padding: 50px;
            box-sizing: border-box;
            position: relative;
        }
        .border-inner {
            border: 4px double #4F46E5;
            height: 100%;
            box-sizing: border-box;
            padding: 40px;
            text-align: center;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            font-size: 48px;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .subheader {
            font-size: 24px;
            color: #555;
            margin-bottom: 50px;
        }
        .presented-to {
            font-size: 18px;
            color: #777;
            margin-bottom: 10px;
            font-style: italic;
        }
        .name {
            font-size: 52px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #ccc;
            display: inline-block;
            padding-bottom: 5px;
            min-width: 500px;
        }
        .description {
            font-size: 20px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .date {
            font-size: 18px;
            font-weight: bold;
            color: #4F46E5;
        }
        .signature-section {
            margin-top: 60px;
            width: 100%;
        }
        .signature-box {
            display: inline-block;
            width: 250px;
            text-align: center;
            margin: 0 50px;
        }
        .signature-line {
            border-bottom: 1px solid #333;
            margin-bottom: 10px;
            height: 60px;
        }
        .signature-title {
            font-size: 16px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="border-inner">
            <div class="header">Certificate of Attendance</div>
            <div class="subheader">AmikomHub Event Platform</div>
            
            <div class="presented-to">This certificate is proudly presented to</div>
            <div class="name">{{ $transaction->customer_name }}</div>
            
            <div class="description">
                In recognition of their active participation and attendance at the event<br>
                <strong>"{{ $transaction->event->title }}"</strong>
            </div>
            
            <div class="date">
                Held on {{ \Carbon\Carbon::parse($transaction->event->date)->format('F jS, Y') }}
            </div>

            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-title">Event Organizer</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-title">AmikomHub Director</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
