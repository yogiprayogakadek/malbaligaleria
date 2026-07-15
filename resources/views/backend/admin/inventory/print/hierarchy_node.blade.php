@php
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

<li>
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
                <div>
                    <span class="badge badge-{{ $node->status }}">{{ $node->status }}</span>
                    @if($node->category)
                        <span style="font-size: 8px; color: #3b82f6; background-color: #eff6ff; padding: 1px 4px; border-radius: 4px; border: 1px solid #dbeafe; display: inline-block; margin-top: 2px;">{{ $node->category->name }}</span>
                    @endif
                </div>
            </div>

            <div class="node-meta">
                @if($node->brand || $node->model)
                    <div>Brand/Model: <strong>{{ $node->brand ?? '-' }}{{ $node->model ? ' / ' . $node->model : '' }}</strong></div>
                @endif
                <div>S/N: <strong><code>{{ $node->serial_number ?? '-' }}</code></strong></div>
                <div>Loc: <strong>{{ $node->location ?? '-' }}</strong></div>
                <div>Qty: <strong>{{ $node->quantity }}</strong></div>
            </div>

            <!-- Technical specifications grid -->
            @if(!empty($node->specs) && is_array($node->specs))
                <div class="specs-grid">
                    @foreach($node->specs as $k => $v)
                        <div><strong>{{ $k }}:</strong> {{ $v }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Render Children recursively -->
    @if($node->children->count() > 0)
        <ul>
            @foreach($node->children as $child)
                @include('backend.admin.inventory.print.hierarchy_node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
