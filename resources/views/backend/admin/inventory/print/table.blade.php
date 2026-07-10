<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Inventory List - {{ date('Y-m-d') }}</title>
    <!-- Core fonts -->
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
            margin-bottom: 25px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .logo-area h2 {
            margin: 0 0 5px 0;
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
        
        .meta-area strong {
            color: #2a3547;
        }

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
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-active { background-color: #dcfce7; color: #15803d; }
        .badge-maintenance { background-color: #fef9c3; color: #a16207; }
        .badge-broken { background-color: #fee2e2; color: #b91c1c; }
        .badge-stored { background-color: #f1f5f9; color: #475569; }
        
        .thumbnail {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
        }

        .specs-list {
            margin: 0;
            padding-left: 12px;
            color: #475569;
            font-size: 10px;
        }

        .text-muted {
            color: #94a3b8;
        }
        
        @media print {
            body {
                padding: 0;
                margin: 1.5cm;
            }
            .no-print {
                display: none;
            }
            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-area">
            <h2>MALBALI GALERIA</h2>
            <p>Asset & Devices Inventory Document</p>
        </div>
        <div class="meta-area">
            <p>Date Generated: <strong>{{ date('d F Y H:i') }}</strong></p>
            <p>Format: <strong>Tabular Table List</strong></p>
        </div>
    </div>

    <!-- Active Filters -->
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
            Total Assets: <strong>{{ $items->count() }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 8%;">Image</th>
                <th style="width: 20%;">Asset Name</th>
                <th style="width: 12%;">Category</th>
                <th style="width: 12%;">Parent</th>
                <th style="width: 15%;">Brand & Model</th>
                <th style="width: 10%;">Serial Number</th>
                <th style="width: 10%;">Location</th>
                <th style="width: 8%;">Status (Qty)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" class="thumbnail" alt="Asset img">
                        @else
                            <span class="text-muted" style="font-size: 9px;">No Image</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $item->name }}</div>
                        @if(!empty($item->specs) && is_array($item->specs))
                            <ul class="specs-list" style="margin-top: 4px;">
                                @foreach($item->specs as $k => $v)
                                    <li><strong>{{ $k }}:</strong> {{ $v }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                    <td>
                        @if($item->parent)
                            <span style="font-size: 10px;">{{ $item->parent->name }}</span>
                        @else
                            <span class="text-muted" style="font-size: 9px;">None (Parent)</span>
                        @endif
                    </td>
                    <td>{{ $item->brand ?? '-' }} {{ $item->model ? '/ ' . $item->model : '' }}</td>
                    <td><code>{{ $item->serial_number ?? '-' }}</code></td>
                    <td>{{ $item->location ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $item->status }}">
                            {{ $item->status }}
                        </span>
                        <div style="font-size: 10px; margin-top: 4px; color: #475569;">Qty: <strong>{{ $item->quantity }}</strong></div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; color: #94a3b8; padding: 20px;">No assets found matching filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
