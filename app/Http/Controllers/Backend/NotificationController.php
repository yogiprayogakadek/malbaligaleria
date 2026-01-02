<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(20);
        return view('backend.notifications.index', compact('notifications'));
    }

    public function getLatest()
    {
        $notifications = Auth::user()->notifications()->unread()->orderBy('created_at', 'desc')->take(5)->get();
        $unreadCount = Auth::user()->notifications()->unread()->count();
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $this->notificationService->markAsRead($notification);
        
        if ($notification->link) {
            return redirect($notification->link);
        }
        
        return back();
    }

    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(Auth::user());
        return back()->with('success', 'All notifications marked as read');
    }
}
