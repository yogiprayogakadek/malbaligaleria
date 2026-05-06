<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Update — Mal Bali Galeria</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', Helvetica, Arial, sans-serif; background-color: #f4f4f4; color: #1a1a1a; -webkit-font-smoothing: antialiased; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .header { padding: 40px 0; text-align: center; border-bottom: 1px solid #f0f0f0; }
        .header img { height: 60px; margin-bottom: 12px; }
        .header h1 { font-family: 'Playfair Display', serif; font-size: 20px; color: #1a1a1a; text-transform: uppercase; letter-spacing: 2px; }
        .body { padding: 50px 40px; }
        .greeting { font-size: 16px; color: #1a1a1a; margin-bottom: 24px; line-height: 1.6; }
        .greeting strong { color: #D4AF37; }
        .intro-text { font-size: 15px; color: #666; line-height: 1.8; margin-bottom: 30px; }
        .status-card { background-color: #fafafa; border: 1px solid #f0f0f0; border-radius: 8px; padding: 30px; margin-bottom: 30px; text-align: center; }
        .status-label { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .status-value { font-size: 24px; color: #D4AF37; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px; border-bottom: 1px solid #f5f5f5; text-align: left; }
        .info-label { color: #888; }
        .info-value { color: #1a1a1a; font-weight: 600; }
        .message-box { font-size: 14px; color: #666; line-height: 1.8; margin: 30px 0; padding-left: 20px; border-left: 2px solid #D4AF37; }
        .cta { text-align: center; margin: 40px 0 20px; }
        .cta a { display: inline-block; background-color: #1a1a1a; color: #ffffff; text-decoration: none; padding: 16px 40px; border-radius: 2px; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
        .footer { padding: 40px; text-align: center; background-color: #ffffff; border-top: 1px solid #f0f0f0; }
        .footer p { color: #999; font-size: 12px; line-height: 2; margin-bottom: 10px; }
        .footer a { color: #D4AF37; text-decoration: none; font-weight: 600; }
        @media only screen and (max-width: 600px) {
            .wrapper { margin: 0; width: 100%; }
            .body { padding: 30px 20px; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="MBG Logo">
        <h1>Mal Bali Galeria</h1>
    </div>

    <div class="body">
        <p class="greeting">
            Hi <strong>{{ $application->name }}</strong>,
        </p>
        <p class="intro-text">
            We are writing to provide you with an update regarding your job application for the following position:
        </p>

        <div class="status-card">
            <span class="status-label">Current Status</span>
            <span class="status-value">{{ $application->status_label }}</span>
            
            <div style="margin-top: 25px; border-top: 1px solid #eeeeee; padding-top: 15px;">
                <div class="info-row" style="border: none;">
                    <span class="info-label">Position</span>
                    <span class="info-value">{{ $application->vacancy->title }}</span>
                </div>
            </div>
        </div>

        @if($application->notes)
        <div class="message-box">
            <p><strong>HR Notes:</strong></p>
            <p>{{ $application->notes }}</p>
        </div>
        @endif

        <p class="intro-text" style="font-size: 14px;">
            If you have any further questions or need additional information, please feel free to reach out to our recruitment team.
        </p>

        <div class="cta">
            <a href="{{ url('/career') }}">Visit Career Portal</a>
        </div>
    </div>

    <div class="footer">
        <p>
            This is an automated system notification regarding your application status.<br>
            © {{ date('Y') }} MAL BALI GALERIA. ALL RIGHTS RESERVED.
        </p>
    </div>
</div>
</body>
</html>
