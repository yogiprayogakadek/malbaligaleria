<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Profile - {{ $application->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 40px;
            background: #fff;
        }

        .header {
            border-bottom: 2px solid #2c5f5d;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-logo {
            font-weight: 700;
            font-size: 24px;
            color: #2c5f5d;
            letter-spacing: 1px;
        }

        .header-logo span {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: #777;
            letter-spacing: 2px;
            margin-top: 4px;
        }

        .header-meta {
            text-align: right;
            font-size: 13px;
            color: #666;
        }

        .document-title {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
            color: #111;
            text-align: center;
            border: 1px solid #ddd;
            padding: 8px;
            background: #f8f9fa;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #2c5f5d;
            border-bottom: 1px solid #ddd;
            padding-bottom: 6px;
            margin-top: 30px;
            margin-bottom: 16px;
        }

        .grid-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-item {
            display: flex;
            border-bottom: 1px dashed #eee;
            padding-bottom: 6px;
        }

        .info-label {
            font-weight: 500;
            color: #666;
            width: 150px;
            flex-shrink: 0;
            font-size: 13px;
        }

        .info-value {
            color: #111;
            font-size: 13px;
            font-weight: 600;
        }

        .cover-letter-box {
            background: #fafafa;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 6px;
            font-size: 13px;
            line-height: 1.6;
            white-space: pre-wrap;
            color: #444;
        }

        .footer {
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 20px;
            font-size: 11px;
            color: #888;
            text-align: center;
        }

        .no-print-btn {
            background: #2c5f5d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 20px;
            font-family: inherit;
        }

        .no-print-btn:hover {
            background: #1c3f3e;
        }

        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align: right;">
        <button class="no-print-btn" onclick="window.print()">Print Document</button>
    </div>

    <div class="header">
        <div class="header-logo">
            MAL BALI GALERIA
            <span>HUMAN RESOURCES DEPARTMENT</span>
        </div>
        <div class="header-meta">
            Printed: {{ now()->format('d M Y, H:i') }}
        </div>
    </div>

    <div class="document-title">
        Job Application Summary
    </div>

    <div class="section-title">Candidate Details</div>
    <div class="grid-info">
        <div class="info-item">
            <div class="info-label">Full Name:</div>
            <div class="info-value">{{ $application->name }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Status:</div>
            <div class="info-value" style="text-transform: capitalize;">{{ $application->status_label }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Email:</div>
            <div class="info-value">{{ $application->email }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Phone / WhatsApp:</div>
            <div class="info-value">{{ $application->phone }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Address:</div>
            <div class="info-value">{{ $application->address ?? 'Not specified' }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Applied Date:</div>
            <div class="info-value">{{ $application->created_at->format('d M Y, H:i') }}</div>
        </div>
    </div>

    <div class="section-title">Job Vacancy Information</div>
    <div class="grid-info">
        <div class="info-item">
            <div class="info-label">Job Position:</div>
            <div class="info-value">{{ $application->vacancy->title }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Department:</div>
            <div class="info-value">{{ $application->vacancy->department }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Job Type:</div>
            <div class="info-value">{{ $application->vacancy->type_label }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Location:</div>
            <div class="info-value">{{ $application->vacancy->location }}</div>
        </div>
    </div>

    @if($application->cover_letter)
        <div class="section-title">Cover Letter</div>
        <div class="cover-letter-box">{{ $application->cover_letter }}</div>
    @endif

    @if($application->notes)
        <div class="section-title">Internal HR Notes</div>
        <div class="cover-letter-box" style="background-color: #fffdf5; border-color: #f7e6c4;">{{ $application->notes }}</div>
    @endif

    <div class="footer">
        Mal Bali Galeria &copy; {{ date('Y') }} — Confidentially Managed Candidate Profile
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Auto trigger print dialog on page load
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
