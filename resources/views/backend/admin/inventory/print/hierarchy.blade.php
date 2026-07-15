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

        /* Hierarchy top-down visual styling */
        .tree-container {
            margin-top: 10px;
            width: 100%;
            overflow-x: auto;
            text-align: center;
            padding-bottom: 30px;
        }

        .tree-container * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .tree-container ul {
            padding-top: 20px;
            position: relative;
            display: inline-flex;
            justify-content: center;
        }

        .tree-container li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 8px 0 8px;
        }

        /* We use ::before and ::after to draw the connector lines */
        .tree-container li::before, .tree-container li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #cbd5e1;
            width: 50%;
            height: 20px;
        }

        .tree-container li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #cbd5e1;
        }

        /* Remove left-right connectors from single child nodes */
        .tree-container li:only-child::after, .tree-container li:only-child::before {
            display: none;
        }

        .tree-container li:only-child {
            padding-top: 0;
        }

        /* Remove left connector from first child and right connector from last child */
        .tree-container li:first-child::before, .tree-container li:last-child::after {
            border: 0 none;
        }

        /* Add back vertical connector for boundary sibling nodes */
        .tree-container li:last-child::before {
            border-right: 2px solid #cbd5e1;
            border-radius: 0 6px 0 0;
        }

        .tree-container li:first-child::after {
            border-radius: 6px 0 0 0;
        }

        /* Downward connectors from parents */
        .tree-container ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #cbd5e1;
            width: 0;
            height: 20px;
        }

        /* The node card */
        .tree-node-item {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px;
            width: 170px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.03), 0 1px 3px rgba(0,0,0,0.02);
            position: relative;
            text-align: left;
            vertical-align: top;
        }

        .icon-box {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-bottom: 6px;
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
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            margin-bottom: 6px;
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
            width: 100%;
            margin-top: 4px;
            font-size: 8.5px;
            color: #64748b;
            background-color: #f8fafc;
            padding: 4px 6px;
            border-radius: 4px;
            border: 1px solid #f1f5f9;
        }

        .specs-grid div {
            margin-bottom: 2px;
        }

        .specs-grid div:last-child {
            margin-bottom: 0;
        }

        .node-main-info {
            width: 100%;
        }

        .node-title-row {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .node-name {
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
            word-break: break-word;
        }

        .node-meta {
            font-size: 9px;
            color: #64748b;
            margin-top: 4px;
            border-top: 1px solid #f1f5f9;
            padding-top: 4px;
        }
        
        .node-meta div {
            margin-bottom: 2px;
        }
        
        .node-meta div:last-child {
            margin-bottom: 0;
        }
        
        @media print {
            body {
                padding: 0;
                margin: 0.5cm;
            }
            .no-print {
                display: none;
            }
            .tree-container {
                overflow: visible;
            }
            .tree-container ul {
                page-break-inside: avoid;
            }
            li {
                page-break-inside: avoid;
            }
        }
        @page {
            size: A4 landscape;
            margin: 0.5cm;
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
        <ul>
            @foreach($roots as $root)
                @include('backend.admin.inventory.print.hierarchy_node', ['node' => $root])
            @endforeach
        </ul>
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
