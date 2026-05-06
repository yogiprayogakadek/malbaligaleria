<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application — {{ $application->vacancy->title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', Helvetica, Arial, sans-serif; background-color: #f4f4f4; color: #1a1a1a; -webkit-font-smoothing: antialiased; }
        .wrapper { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .header { padding: 40px 0; text-align: center; border-bottom: 1px solid #f0f0f0; background-color: #fafafa; }
        .header img { height: 60px; margin-bottom: 16px; }
        .header h1 { font-family: 'Playfair Display', serif; font-size: 18px; color: #1a1a1a; text-transform: uppercase; letter-spacing: 2px; }
        .alert-badge { display: inline-block; background: #fff; border: 1px solid #28a745; color: #28a745; padding: 4px 14px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px; }
        .body { padding: 50px 40px; }
        .intro-text { font-size: 15px; color: #666; line-height: 1.8; margin-bottom: 30px; }
        .section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #D4AF37; font-weight: 700; margin-bottom: 15px; border-bottom: 1px solid #f0f0f0; padding-bottom: 8px; }
        .info-card { background-color: #fafafa; border: 1px solid #f0f0f0; border-radius: 8px; padding: 24px; margin-bottom: 30px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px; border-bottom: 1px solid #f5f5f5; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #888; }
        .info-value { color: #1a1a1a; font-weight: 600; }
        .status-badge { display: inline-block; background: #fff; border: 1px solid #D4AF37; color: #D4AF37; padding: 2px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .message-box { font-size: 14px; color: #666; line-height: 1.8; margin: 30px 0; padding-left: 20px; border-left: 2px solid #D4AF37; }
        .cta { text-align: center; margin: 40px 0 20px; }
        .cta a { display: inline-block; background-color: #1a1a1a; color: #ffffff; text-decoration: none; padding: 16px 40px; border-radius: 2px; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; }
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
            Thank you for your interest in joining Mal Bali Galeria. We have successfully received your application. Our team will carefully review your profile for the following position:
        </p>

        <div class="info-card">
            <h3>Application Details</h3>
            <div class="info-row">
                <span class="info-label">Position</span>
                <span class="info-value">{{ $application->vacancy->title }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Department</span>
                <span class="info-value">{{ $application->vacancy->department }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Employment Type</span>
                <span class="info-value">{{ $application->vacancy->type_label }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Submission Date</span>
                <span class="info-value">{{ $application->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Application Status</span>
                <span class="info-value"><span class="status-badge">Under Review</span></span>
            </div>
        </div>

        <div class="message-box">
            <p>Our HR team will evaluate your application within the next <strong>7–14 working days</strong>. Should your qualifications meet our current requirements, we will reach out to you via your registered contact details.</p>
        </div>

        <div class="cta">
            <a href="{{ url('/career') }}">Explore More Careers</a>
        </div>
    </div>

    <div class="footer">
        <p>
            This is an automated system notification.<br>
            Please do not reply to this email. For inquiries, contact us at:<br>
            <a href="mailto:hr@malbaligaleria.com">hr@malbaligaleria.com</a> | (0361) 755277
        </p>
        <p style="margin-top: 20px; font-size: 10px; letter-spacing: 1px; color: #ccc;">© {{ date('Y') }} MAL BALI GALERIA. ALL RIGHTS RESERVED.</p>
    </div>
</div>
</body>
</html>
