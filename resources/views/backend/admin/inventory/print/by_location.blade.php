<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset by Location - {{ date('Y-m-d') }}</title>
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

        .logo-area h2 { margin: 0 0 4px 0; font-size: 20px; font-weight: 700; color: #000; letter-spacing: -0.5px; }
        .logo-area p { margin: 0; color: #64748b; font-size: 12px; }
        .meta-area { text-align: right; }
        .meta-area p { margin: 0 0 4px 0; font-size: 11px; color: #64748b; }
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

        /* Location sections */
        .loc-section {
            margin-bottom: 28px;
            page-break-inside: avoid;
        }

        .loc-header {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #065f46 0%, #059669 100%);
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px 8px 0 0;
        }

        .loc-header h3 { margin: 0; font-size: 13px; font-weight: 700; }
        .loc-header .loc-count {
            font-size: 10px;
            background: rgba(255,255,255,0.2);
            padding: 2px 8px;
            border-radius: 10px;
        }

        .loc-unlisted .loc-header {
            background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-top: none;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        tr:nth-child(even) td { background-color: #fafbfc; }

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

        .thumbnail {
            width: 40px; height: 40px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #cbd5e1;
        }

        .text-muted { color: #94a3b8; }

        .summary-bar {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 22px;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .sum-item { display: flex; flex-direction: column; }
        .sum-item .sum-val { font-size: 20px; font-weight: 700; color: #059669; }
        .sum-item .sum-lbl { font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .sum-divider { width: 1px; background: #e2e8f0; }

        @media print {
            body { padding: 0; margin: 1cm; }
            .no-print { display: none; }
            .loc-section { page-break-inside: avoid; }
        }
        @page { size: A4 portrait; margin: 1cm; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-area">
            <h2>MALBALI GALERIA</h2>
            <p>Asset &amp; Devices Inventory — Kelompok Per Lokasi</p>
        </div>
        <div class="meta-area">
            <p>Date Generated: <strong>{{ date('d F Y H:i') }}</strong></p>
            <p>Format: <strong>Grouped by Location</strong></p>
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
            Total Assets: <strong>{{ $items->count() }}</strong>
        </div>
        <div class="filter-badge">
            Total Lokasi: <strong>{{ $grouped->count() }}</strong>
        </div>
    </div>

    <div class="summary-bar">
        <div class="sum-item">
            <span class="sum-val">{{ $items->count() }}</span>
            <span class="sum-lbl">Total Aset</span>
        </div>
        <div class="sum-divider"></div>
        <div class="sum-item">
            <span class="sum-val">{{ $grouped->count() }}</span>
            <span class="sum-lbl">Lokasi</span>
        </div>
        <div class="sum-divider"></div>
        <div class="sum-item">
            <span class="sum-val">{{ $items->where('status','active')->count() }}</span>
            <span class="sum-lbl">Active</span>
        </div>
        <div class="sum-divider"></div>
        <div class="sum-item">
            <span class="sum-val">{{ $items->where('status','maintenance')->count() }}</span>
            <span class="sum-lbl">Maintenance</span>
        </div>
        <div class="sum-divider"></div>
        <div class="sum-item">
            <span class="sum-val">{{ $items->where('status','broken')->count() }}</span>
            <span class="sum-lbl">Broken</span>
        </div>
    </div>

    @foreach($grouped as $locationName => $locItems)
        <div class="loc-section {{ $locationName === 'Tanpa Lokasi' ? 'loc-unlisted' : '' }}">
            <div class="loc-header">
                <h3>📍 {{ $locationName }}</h3>
                <span class="loc-count">{{ $locItems->count() }} aset</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width:4%">No</th>
                        <th style="width:7%">Gambar</th>
                        <th style="width:22%">Nama Aset</th>
                        <th style="width:13%">Kategori</th>
                        <th style="width:12%">Induk (Parent)</th>
                        <th style="width:14%">Brand / Model</th>
                        <th style="width:12%">Serial Number</th>
                        <th style="width:16%">Status (Qty)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locItems as $index => $item)
                        <tr>
                            <td style="text-align:center">{{ $index + 1 }}</td>
                            <td>
                                @if($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" class="thumbnail" alt="">
                                @else
                                    <span class="text-muted" style="font-size:9px">No Image</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:600">{{ $item->name }}</div>
                                @if(!empty($item->specs) && is_array($item->specs))
                                    <div style="font-size:9px;color:#64748b;margin-top:2px">
                                        @foreach(array_slice($item->specs, 0, 2) as $k => $v)
                                            {{ $k }}: {{ $v }}{{ !$loop->last ? ' · ' : '' }}
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->category ? $item->category->name : '-' }}</td>
                            <td>{{ $item->parent ? $item->parent->name : '-' }}</td>
                            <td>{{ $item->brand ?? '-' }}{{ $item->model ? ' / ' . $item->model : '' }}</td>
                            <td><code>{{ $item->serial_number ?? '-' }}</code></td>
                            <td>
                                <span class="badge badge-{{ $item->status }}">{{ $item->status }}</span>
                                <div style="font-size:9px;margin-top:3px;color:#475569">Qty: <strong>{{ $item->quantity }}</strong></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <script>
        window.onload = function() {
            setTimeout(function() { window.print(); }, 500);
        }
    </script>
</body>
</html>
