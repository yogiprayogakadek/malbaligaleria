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

        // Fetch active announcements (latest first)
        $announcements = \App\Models\Announcement::where('is_active', true)
            ->latest()
            ->get();

        $activeAnnouncements = [];
        $currentRouteName = request()->route() ? request()->route()->getName() : '';

        foreach ($announcements as $ann) {
            // Check if active on the current date
            $now = now('Asia/Makassar');
            $today = $now->toDateString();
            
            $dateMatches = false;
            
            if (!empty($ann->active_dates) && is_array($ann->active_dates)) {
                foreach ($ann->active_dates as $range) {
                    if (is_array($range) && isset($range['start']) && isset($range['end'])) {
                        if ($today >= $range['start'] && $today <= $range['end']) {
                            $dateMatches = true;
                            break;
                        }
                    } elseif (is_string($range)) {
                        if ($today === $range) {
                            $dateMatches = true;
                            break;
                        }
                    }
                }
            } else {
                $startOk = is_null($ann->start_date) || $ann->start_date <= $now;
                $endOk = is_null($ann->end_date) || $ann->end_date >= $now;
                if ($startOk && $endOk) {
                    $dateMatches = true;
                }
            }
            
            if (!$dateMatches) {
                continue;
            }

            // Check if active within daily display hours
            if (!is_null($ann->start_time) && !is_null($ann->end_time)) {
                $currentTime = $now->format('H:i:s');
                if ($currentTime < $ann->start_time || $currentTime > $ann->end_time) {
                    continue;
                }
            }

            $targets = is_array($ann->target_page) ? $ann->target_page : [$ann->target_page];
            $matches = false;
            
            if (in_array('all', $targets)) {
                $matches = true;
            } else {
                foreach ($targets as $target) {
                    if ($target === 'homepage' && $currentRouteName === 'frontend.landing') {
                        $matches = true;
                    } elseif ($target === 'career' && str_starts_with($currentRouteName, 'frontend.career.')) {
                        $matches = true;
                    } elseif ($target === 'promo' && str_starts_with($currentRouteName, 'frontend.promotion.')) {
                        $matches = true;
                    } elseif ($target === 'event' && str_starts_with($currentRouteName, 'frontend.event.')) {
                        $matches = true;
                    } elseif ($target === 'directory' && str_starts_with($currentRouteName, 'frontend.directory.')) {
                        $matches = true;
                    } elseif ($target === 'new_store' && str_starts_with($currentRouteName, 'frontend.new-store.')) {
                        $matches = true;
                    } elseif ($target === 'gallery' && str_starts_with($currentRouteName, 'frontend.gallery.')) {
                        $matches = true;
                    }
                    if ($matches) {
                        break;
                    }
                }
            }

            if ($matches) {
                $activeAnnouncements[] = [
                    'id' => $ann->id,
                    'text' => $ann->title,
                    'title' => $ann->title,
                    'message' => $ann->message,
                    'image' => $ann->image,
                    'type' => $ann->type,
                    'link' => $ann->link,
                    'frequency' => $ann->frequency ?? 'always',
                ];
            }
        }

        $activeAnnouncement = count($activeAnnouncements) > 0 ? $activeAnnouncements[0] : null;

        $announcement = $activeAnnouncement
            ? [
                'id' => $activeAnnouncement['id'],
                'active' => true,
                'text' => $activeAnnouncement['title'],
                'title' => $activeAnnouncement['title'],
                'message' => $activeAnnouncement['message'],
                'image' => $activeAnnouncement['image'],
                'type' => $activeAnnouncement['type'],
                'link' => $activeAnnouncement['link'],
                'frequency' => $activeAnnouncement['frequency'] ?? 'always',
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
                'frequency' => 'always',
            ];

        $view->with('globalAnnouncement', $announcement);
        $view->with('globalAnnouncements', $activeAnnouncements);
    }
}
