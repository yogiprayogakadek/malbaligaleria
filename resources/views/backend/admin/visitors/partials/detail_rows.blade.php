<div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
    <table class="table table-striped table-bordered align-middle mb-0">
        <thead class="table-light sticky-top" style="z-index: 1;">
            <tr>
                <th>Date</th>
                <th class="text-end" style="width: 150px;">Visits</th>
            </tr>
        </thead>
        <tbody>
            @forelse($days as $day)
            <tr class="{{ isset($day->is_today) && $day->is_today ? 'table-warning text-dark' : '' }}">
                <td>
                    @if(isset($day->is_today) && $day->is_today)
                        <span class="badge bg-danger py-1 px-2 me-2 text-white" style="font-size: 10px;">LIVE</span>
                    @endif
                    {{ $day->date }}
                </td>
                <td class="text-end font-monospace fw-bold">{{ number_format($day->count) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center py-3 text-muted">No daily records for this month.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
