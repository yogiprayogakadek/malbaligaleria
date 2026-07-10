<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Hierarchy Document - {{ date('Y-m-d') }}</title>
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
            margin-bottom: 25px;
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

        /* Hierarchy visual styling */
        .tree-container {
            margin-top: 10px;
        }

        .tree-children {
            margin-left: 28px;
            padding-left: 20px;
            border-left: 2px dashed #cbd5e1;
            position: relative;
        }

        .tree-node-wrapper {
            margin-bottom: 15px;
            position: relative;
        }

        .tree-node-item {
            display: flex;
            align-items: flex-start;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 12px;
            gap: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            position: relative;
        }

        /* Connector horizontal line */
        .tree-children > .tree-node-wrapper::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 22px;
            width: 20px;
            height: 2px;
            border-top: 2px dashed #cbd5e1;
        }

        .icon-box {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-cctv {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .icon-dvr {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .icon-generic {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .thumbnail {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            flex-shrink: 0;
        }

        .badge {
            display: inline-block;
            padding: 1px 4px;
            font-size: 8px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-active { background-color: #dcfce7; color: #15803d; }
        .badge-maintenance { background-color: #fef9c3; color: #a16207; }
        .badge-broken { background-color: #fee2e2; color: #b91c1c; }
        .badge-stored { background-color: #f1f5f9; color: #475569; }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 4px 10px;
            margin-top: 6px;
            font-size: 9px;
            color: #64748b;
            background-color: #f8fafc;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .specs-grid span strong {
            color: #475569;
        }

        .node-main-info {
            flex-grow: 1;
        }

        .node-title-row {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .node-name {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
        }

        .node-meta {
            font-size: 9.5px;
            color: #64748b;
            margin-top: 2px;
        }
        
        @media print {
            body {
                padding: 0;
                margin: 1.5cm;
            }
            .no-print {
                display: none;
            }
            .tree-node-wrapper {
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
            <p>Format: <strong>Hierarchical Tree Layout</strong></p>
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
            Root Elements: <strong>{{ $roots->count() }}</strong>
        </div>
    </div>

    <div class="tree-container">
        @foreach($roots as $root)
            @include('backend.admin.inventory.print.hierarchy_node', ['node' => $root])
        @endforeach
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
