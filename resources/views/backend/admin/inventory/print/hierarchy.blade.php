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
        @php
            if (!function_exists('renderTreeNode')) {
                function renderTreeNode($node) {
                    $nameLower = strtolower($node->name);
                    $categoryLower = $node->category ? strtolower($node->category->name) : '';
                    
                    $isCctv = false;
                    $isDvr = false;
                    
                    if (str_contains($nameLower, 'cctv') || str_contains($categoryLower, 'cctv')) {
                        $isCctv = true;
                    } elseif (
                        str_contains($nameLower, 'dvr') || str_contains($categoryLower, 'dvr') ||
                        str_contains($nameLower, 'nvr') || str_contains($categoryLower, 'nvr')
                    ) {
                        $isDvr = true;
                    }
                    @endphp
                    
                    <div class="tree-node-wrapper">
                        <div class="tree-node-item">
                            <!-- Icon block based on category/name -->
                            @if($isCctv)
                                <div class="icon-box icon-cctv" title="CCTV Device">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                                        <path d="M12 3v2"/>
                                        <path d="M12 13v8"/>
                                        <path d="M5 21h14"/>
                                        <path d="m19 13-3-3"/>
                                        <path d="m5 13 3-3"/>
                                    </svg>
                                </div>
                            @elseif($isDvr)
                                <div class="icon-box icon-dvr" title="DVR/NVR Device">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="8" x="2" y="3" rx="2"/>
                                        <rect width="20" height="8" x="2" y="13" rx="2"/>
                                        <line x1="6" x2="6.01" y1="7" y2="7"/>
                                        <line x1="6" x2="6.01" y1="17" y2="17"/>
                                        <line x1="10" x2="10.01" y1="7" y2="7"/>
                                        <line x1="10" x2="10.01" y1="17" y2="17"/>
                                    </svg>
                                </div>
                            @else
                                <div class="icon-box icon-generic" title="Asset Device">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Thumbnail Image -->
                            @if($node->image_path)
                                <img src="{{ asset('storage/' . $node->image_path) }}" class="thumbnail" alt="Thumb">
                            @endif

                            <div class="node-main-info">
                                <div class="node-title-row">
                                    <span class="node-name">{{ $node->name }}</span>
                                    <span class="badge badge-{{ $node->status }}">{{ $node->status }}</span>
                                    @if($node->category)
                                        <span style="font-size: 9px; color: #3b82f6; background-color: #eff6ff; padding: 1px 4px; border-radius: 4px; border: 1px solid #dbeafe;">{{ $node->category->name }}</span>
                                    @endif
                                </div>

                                <div class="node-meta">
                                    @if($node->brand || $node->model)
                                        Brand/Model: <strong>{{ $node->brand ?? '-' }} {{ $node->model ? '/ ' . $node->model : '' }}</strong> &nbsp;|&nbsp;
                                    @endif
                                    Serial Number: <strong><code>{{ $node->serial_number ?? '-' }}</code></strong> &nbsp;|&nbsp;
                                    Location: <strong>{{ $node->location ?? '-' }}</strong> &nbsp;|&nbsp;
                                    Qty: <strong>{{ $node->quantity }}</strong>
                                </div>

                                <!-- Technical specifications grid -->
                                @if(!empty($node->specs) && is_array($node->specs))
                                    <div class="specs-grid">
                                        @foreach($node->specs as $k => $v)
                                            <span><strong>{{ $k }}:</strong> {{ $v }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Render Children recursively -->
                        @if($node->children->count() > 0)
                            <div class="tree-children">
                                @foreach($node->children as $child)
                                    @php renderTreeNode($child); @endphp
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @php
                }
            }

            foreach($roots as $root) {
                renderTreeNode($root);
            }
        @endphp
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
