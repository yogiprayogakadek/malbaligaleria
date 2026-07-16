<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Outline Report - {{ date('Y-m-d') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2a3547;
            background-color: #fff;
            margin: 0;
            padding: 30px;
            font-size: 11px;
            line-height: 1.5;
        }

        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .logo-area h2 {
            margin: 0 0 4px 0;
            font-size: 20px;
            font-weight: 700;
            color: #000;
            letter-spacing: -0.5px;
        }

        .logo-area p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }

        .meta-area {
            text-align: right;
        }

        .meta-area p {
            margin: 0 0 4px 0;
            font-size: 11px;
            color: #64748b;
        }

        .meta-area strong { color: #2a3547; }

        .filter-badge-row {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .filter-badge {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            color: #475569;
        }

        /* ── Outline tree ── */
        .outline-root {
            margin-top: 10px;
        }

        .outline-item {
            margin: 0;
            padding: 0;
        }

        .outline-row {
            display: flex;
            align-items: flex-start;
            gap: 0;
            border-bottom: 1px solid #f1f5f9;
            padding: 6px 0;
        }

        .outline-row:last-child { border-bottom: none; }

        /* Indent connector */
        .outline-indent {
            flex-shrink: 0;
            display: flex;
            align-items: stretch;
        }

        .indent-unit {
            width: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .indent-unit .vline {
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 1px;
            background: #cbd5e1;
        }

        .indent-unit .hline {
            position: absolute;
            left: 9px;
            top: 50%;
            width: 11px;
            height: 1px;
            background: #cbd5e1;
        }

        .outline-bullet {
            flex-shrink: 0;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #94a3b8;
            margin-top: 5px;
            margin-right: 8px;
        }

        .depth-0 .outline-bullet { background: #1e40af; width: 8px; height: 8px; }
        .depth-1 .outline-bullet { background: #0ea5e9; }
        .depth-2 .outline-bullet { background: #10b981; }
        .depth-3 .outline-bullet { background: #f59e0b; width: 5px; height: 5px; }

        .outline-content {
            flex: 1;
            min-width: 0;
        }

        .outline-name {
            font-weight: 700;
            font-size: 11.5px;
            color: #1e293b;
        }

        .depth-0 .outline-name { font-size: 13px; }
        .depth-1 .outline-name { font-size: 12px; }

        .outline-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 2px;
            font-size: 9.5px;
            color: #64748b;
        }

        .outline-meta span strong { color: #334155; }

        .badge {
            display: inline-block;
            padding: 1px 5px;
            font-size: 8.5px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-active { background-color: #dcfce7; color: #15803d; }
        .badge-maintenance { background-color: #fef9c3; color: #a16207; }
        .badge-broken { background-color: #fee2e2; color: #b91c1c; }
        .badge-stored { background-color: #f1f5f9; color: #475569; }

        .depth-level-label {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-right: 4px;
        }

        @media print {
            body { padding: 0; margin: 1cm; }
            .no-print { display: none; }
            .outline-row { page-break-inside: avoid; }
        }
        @page { size: A4 portrait; margin: 1cm; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-area">
            <h2>MALBALI GALERIA</h2>
            <p>Asset &amp; Devices Inventory — Garis Bertingkat (Outline)</p>
        </div>
        <div class="meta-area">
            <p>Date Generated: <strong>{{ date('d F Y H:i') }}</strong></p>
            <p>Format: <strong>Indented Outline Tree</strong></p>
        </div>
    </div>

    <div class="filter-badge-row">
        <div class="filter-badge">
            Category: <strong>{{ $category ? $category->name : 'All Categories' }}</strong>
        </div>
        <div class="filter-badge">
            Status: <strong>{{ $status ? ucfirst($status) : 'All Statuses' }}</strong>
        </div>
        <div class="filter-badge">
            Location: <strong>{{ $location ? $location : 'All Locations' }}</strong>
        </div>
        <div class="filter-badge">
            Root Elements: <strong>{{ $roots->count() }}</strong>
        </div>
    </div>

    <div class="outline-root">
        @foreach($roots as $root)
            @include('backend.admin.inventory.print.outline_node', ['node' => $root, 'depth' => 0, 'isLast' => $loop->last])
        @endforeach
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() { window.print(); }, 500);
        }
    </script>
</body>
</html>
