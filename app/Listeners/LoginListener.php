<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LoginListener
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static $logged = false;

    public function handle(Login $event)
    {
        if (self::$logged) {
            return;
        }
        self::$logged = true;

        $user = $event->user;

        $activity = activity()
            ->causedBy($user)
            ->withProperties([
                'ip' => $this->request->ip(),
                'user_agent' => $this->request->userAgent()
            ]);

        if ($user->tenant) {
            $activity->performedOn($user->tenant);
        }

        $activity->log('login');
    }
}
