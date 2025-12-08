<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->getRoleNames()->first() === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user->getRoleNames()->first() === 'tenant') {
            return redirect()->intended(route('tenant.dashboard'));
        }

        // fallback
        return redirect()->intended('/dashboard');
    }
}
