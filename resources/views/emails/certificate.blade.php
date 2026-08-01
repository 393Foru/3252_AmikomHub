<!DOCTYPE html>
<html>
<head>
    <title>E-Certificate Kehadiran</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #4F46E5; text-align: center;">Terima Kasih Atas Kehadiran Anda!</h2>
        
        <p>Halo <strong>{{ $transaction->customer_name }}</strong>,</p>
        
        <p>Terima kasih telah berpartisipasi dan hadir dalam acara <strong>{{ $transaction->event->title }}</strong> yang diselenggarakan pada tanggal {{ \Carbon\Carbon::parse($transaction->event->date)->format('d F Y') }}.</p>
        
        <p>Sebagai bentuk apresiasi kami, terlampir E-Certificate elektronik (PDF) atas nama Anda.</p>
        
        <p>Semoga ilmu dan pengalaman yang didapatkan bermanfaat. Sampai jumpa di event-event AmikomHub selanjutnya!</p>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #999; text-align: center;">
            Email ini dibuat secara otomatis oleh sistem AmikomHub. Mohon tidak membalas email ini.
        </p>
    </div>
</body>
</html>
