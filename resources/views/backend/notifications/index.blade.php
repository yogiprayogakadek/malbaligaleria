@extends('templates.backend.master')

@section('page-title')
    Notifications
@endsection

@section('page-link')
    {{ route('notifications.index') }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="card-title fw-semibold">All Notifications</h4>
            @if(Auth::user()->notifications()->unread()->exists())
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-read-line-duotone" class="fs-5"></iconify-icon>
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table align-middle text-nowrap mb-0">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Notification</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Action</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                        <tr class="{{ is_null($notification->read_at) ? 'bg-light' : '' }}">
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="flex-shrink-0 rounded-circle round d-flex align-items-center justify-content-center fs-6 
                                        {{ $notification->type == 'promo_expiring' ? 'bg-warning-subtle text-warning' : ($notification->type == 'event_upcoming' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary') }}">
                                        <iconify-icon icon="{{ $notification->type == 'promo_expiring' ? 'solar:calendar-date-line-duotone' : ($notification->type == 'event_upcoming' ? 'solar:calendar-line-duotone' : 'solar:bell-bing-line-duotone') }}"></iconify-icon>
                                    </span>
                                    <div>
                                        <h6 class="fw-semibold mb-0">{{ $notification->title }}</h6>
                                        <span class="fw-normal text-muted">{{ $notification->message }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <span class="fw-normal">{{ $notification->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="border-bottom-0">
                                @if(is_null($notification->read_at))
                                    <span class="badge bg-danger-subtle text-danger">Unread</span>
                                @else
                                    <span class="badge bg-success-subtle text-success">Read</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="{{ is_null($notification->read_at) ? 'Mark as Read' : 'View Details' }}">
                                        <iconify-icon icon="{{ is_null($notification->read_at) ? 'solar:check-read-line-duotone' : 'solar:eye-line-duotone' }}" class="fs-5"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <iconify-icon icon="solar:bell-off-line-duotone" class="fs-8 text-muted mb-2"></iconify-icon>
                                    <h6 class="fw-semibold text-muted">No notifications found</h6>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection
