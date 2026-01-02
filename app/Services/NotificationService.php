<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a new notification for a user.
     *
     * @param User|int $user
     * @param string $type
     * @param string $title
     * @param string $message
     * @param array|null $data
     * @param string|null $link
     * @return Notification
     */
    public function create($user, string $type, string $title, string $message, ?array $data = null, ?string $link = null): Notification
    {
        $userId = $user instanceof User ? $user->id : $user;

        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'link' => $link,
        ]);
    }

    /**
     * Create notification for multiple users.
     *
     * @param mixed $users
     * @param string $type
     * @param string $title
     * @param string $message
     * @param array|null $data
     * @param string|null $link
     * @return void
     */
    public function createMany($users, string $type, string $title, string $message, ?array $data = null, ?string $link = null): void
    {
        foreach ($users as $user) {
            $this->create($user, $type, $title, $message, $data, $link);
        }
    }

    /**
     * Mark a notification as read.
     *
     * @param Notification $notification
     * @return bool
     */
    public function markAsRead(Notification $notification): bool
    {
        return $notification->update(['read_at' => now()]);
    }

    /**
     * Mark all notifications as read for a user.
     *
     * @param User|int $user
     * @return int
     */
    public function markAllAsRead($user): int
    {
        $userId = $user instanceof User ? $user->id : $user;

        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
    
    /**
     * Delete a notification.
     * 
     * @param Notification $notification
     * @return bool|null
     */
    public function delete(Notification $notification)
    {
        return $notification->delete();
    }
}
