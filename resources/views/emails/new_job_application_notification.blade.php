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
        .info-value { color: #1a1a1a; font-weight: 600; text-align: right; }
        .cover-letter { background-color: #ffffff; border: 1px dashed #e0e0e0; border-radius: 8px; padding: 20px; font-size: 14px; color: #555; line-height: 1.8; font-style: italic; margin-bottom: 30px; }
        .cta { text-align: center; margin: 40px 0 10px; }
        .cta a { display: inline-block; background-color: #D4AF37; color: #ffffff; text-decoration: none; padding: 16px 40px; border-radius: 2px; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }
        .footer { padding: 40px; text-align: center; background-color: #fafafa; border-top: 1px solid #f0f0f0; }
        .footer p { color: #999; font-size: 12px; line-height: 2; }
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
        <div class="alert-badge">🔔 New Job Application</div>
        <h1>{{ $application->vacancy->title }}</h1>
    </div>

    <div class="body">
        <p class="intro-text">
            A new candidate has just submitted an application for the position of <strong style="color: #D4AF37;">{{ $application->vacancy->title }}</strong>. Please review the applicant's profile below.
        </p>

        <p class="section-title">Applicant Profile</p>
        <div class="info-card">
            <div class="info-row">
                <span class="info-label">Full Name</span>
                <span class="info-value">{{ $application->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email Address</span>
                <span class="info-value">{{ $application->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone Number</span>
                <span class="info-value">{{ $application->phone }}</span>
            </div>
            @if($application->address)
            <div class="info-row">
                <span class="info-label">Current Address</span>
                <span class="info-value">{{ $application->address }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Submission Time</span>
                <span class="info-value">{{ $application->created_at->format('d M Y, H:i') }} WITA</span>
            </div>
        </div>

        @if($application->cover_letter)
        <p class="section-title">Cover Letter</p>
        <div class="cover-letter">
            "{{ $application->cover_letter }}"
        </div>
        @endif

        <div class="cta">
            <a href="{{ route('admin.career.application.show', $application->uuid) }}">
                Open Admin Panel
            </a>
        </div>
    </div>

    <div class="footer">
        <p>
            This is an automated administrative notification from the Mal Bali Galeria Recruitment System.<br>
            © {{ date('Y') }} MAL BALI GALERIA. ALL RIGHTS RESERVED.
        </p>
    </div>
</div>
</body>
</html>
