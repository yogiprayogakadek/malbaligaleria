<div class="outline-item depth-{{ $depth }}">
    <div class="outline-row">
        {{-- Indent spacer with connector lines --}}
        @if($depth > 0)
            <div class="outline-indent">
                @for($i = 0; $i < $depth; $i++)
                    <div class="indent-unit">
                        <div class="vline"></div>
                        @if($i === $depth - 1)
                            <div class="hline"></div>
                        @endif
                    </div>
                @endfor
            </div>
        @endif

        <div class="outline-bullet"></div>

        <div class="outline-content">
            <div class="outline-name">
                @if($depth === 0)
                    <span class="depth-level-label">L{{ $depth }}</span>
                @endif
                {{ $node->name }}
            </div>
            <div class="outline-meta">
                <span><strong>Status:</strong> <span class="badge badge-{{ $node->status }}">{{ $node->status }}</span></span>
                @if($node->category)
                    <span><strong>Kategori:</strong> {{ $node->category->name }}</span>
                @endif
                @if($node->brand || $node->model)
                    <span><strong>Brand:</strong> {{ $node->brand ?? '-' }}{{ $node->model ? ' / ' . $node->model : '' }}</span>
                @endif
                @if($node->serial_number)
                    <span><strong>S/N:</strong> {{ $node->serial_number }}</span>
                @endif
                @if($node->location)
                    <span><strong>Lokasi:</strong> {{ $node->location }}</span>
                @endif
                <span><strong>Qty:</strong> {{ $node->quantity }}</span>
            </div>
        </div>
    </div>

    {{-- Render children recursively --}}
    @if($node->children->count() > 0)
        @foreach($node->children as $child)
            @include('backend.admin.inventory.print.outline_node', [
                'node'   => $child,
                'depth'  => $depth + 1,
                'isLast' => $loop->last,
            ])
        @endforeach
    @endif
</div>
