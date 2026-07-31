<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bagaimana pengalaman Anda?</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td, p, a, h1, h2, h3 {font-family: Arial, sans-serif !important;}
    </style>
    <![endif]-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', Arial, sans-serif; 
            background-color: #f1f5f9; 
            margin: 0; 
            padding: 40px 20px; 
            color: #334155; 
        }
        
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: #ffffff; 
            border-radius: 24px; 
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); 
        }
        
        .header-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .header-banner h1 { 
            color: #ffffff; 
            font-size: 28px; 
            font-weight: 800;
            margin: 0; 
            line-height: 1.3;
        }
        
        .content { 
            padding: 40px 30px;
            font-size: 16px; 
            line-height: 1.6; 
            text-align: center;
        }
        
        .event-card { 
            background: #f8fafc; 
            border: 1px solid #e2e8f0;
            padding: 24px; 
            border-radius: 16px; 
            margin: 30px 0; 
        }
        
        .event-label {
            font-size: 12px;
            font-weight: 800;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .event-card h2 { 
            margin: 0 0 8px 0; 
            font-size: 22px; 
            color: #0f172a; 
            font-weight: 800;
        }

        .event-date {
            color: #64748b;
            font-size: 15px;
            margin: 0;
            font-weight: 600;
        }
        
        .btn { 
            display: inline-block; 
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff !important; 
            text-decoration: none; 
            padding: 16px 32px; 
            border-radius: 50px; 
            font-weight: 800; 
            font-size: 16px;
            margin: 10px 0 20px 0; 
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.39);
        }
        
        .footer { 
            background: #f8fafc;
            text-align: center; 
            font-size: 13px; 
            color: #94a3b8; 
            padding: 30px; 
        }

        .highlight {
            font-weight: 800;
            color: #0f172a;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Banner -->
        <div class="header-banner">
            <h1>Bagaimana Pengalaman Anda?</h1>
        </div>

        <div class="content">
            <p>Halo <span class="highlight">{{ $transaction->customer_name }}</span>,</p>
            <p>Terima kasih telah berpartisipasi dalam event kami kemarin.</p>
            
            <div class="event-card">
                <div class="event-label">Event Diikuti</div>
                <h2>{{ $transaction->event->title }}</h2>
                <p class="event-date">{{ \Carbon\Carbon::parse($transaction->event->date)->translatedFormat('l, d F Y') }}</p>
            </div>
            
            <p style="margin-bottom: 30px; color: #475569;">Untuk membantu penyelenggara (<span class="highlight">{{ $transaction->event->owner->name ?? 'Partner Kami' }}</span>) memberikan acara yang lebih baik lagi di masa depan, kami sangat menghargai jika Anda dapat meluangkan waktu sejenak untuk memberikan ulasan dan penilaian (rating).</p>
            
            <a href="{{ $reviewUrl }}" class="btn">Berikan Penilaian Saya</a>
            
            <p style="margin-top: 30px; font-size: 14px; color: #94a3b8;">Tautan ini bersifat pribadi dan khusus untuk Anda sebagai peserta terdaftar.</p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Eventama. All rights reserved.
        </div>
    </div>
</body>
</html>
