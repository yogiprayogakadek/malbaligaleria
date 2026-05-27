<?php

namespace App\Http\View\Composers;

use App\Models\FrontendMenu;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class FrontendMenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        $menus = FrontendMenu::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->filter(function ($menu) use ($user) {
                // If roles are defined for this menu item
                if (!empty($menu->roles)) {
                    // If user is guest, they cannot view this restricted menu
                    if (!$user) {
                        return false;
                    }
                    // Check if the authenticated user has any of the allowed roles
                    return $user->hasAnyRole($menu->roles);
                }

                // Accessible to all (guests and authenticated users)
                return true;
            });

        $view->with('frontendMenus', $menus);

        // Fetch active announcement from DB
        $activeAnnouncement = \App\Models\Announcement::where('is_active', true)
            ->where(function($q) {
                $now = now('Asia/Makassar');
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function($q) {
                $now = now('Asia/Makassar');
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->latest()
            ->first();

        $announcement = $activeAnnouncement
            ? [
                'id' => $activeAnnouncement->id,
                'active' => true,
                'text' => $activeAnnouncement->title,
                'title' => $activeAnnouncement->title,
                'message' => $activeAnnouncement->message,
                'image' => $activeAnnouncement->image,
                'type' => $activeAnnouncement->type,
                'link' => $activeAnnouncement->link,
            ]
            : [
                'id' => null,
                'active' => false,
                'text' => '',
                'title' => '',
                'message' => '',
                'image' => null,
                'type' => 'info',
                'link' => null,
            ];

        $view->with('globalAnnouncement', $announcement);
    }
}
