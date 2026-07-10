<?php

namespace App\Http\Middleware;

use App\Models\SubdomainUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ensures the authenticated user has been explicitly granted access
 * to the current subdomain by a superuser.
 *
 * - Superusers always bypass this check (they granted access to others).
 * - All other users must have an active, non-expired SubdomainUser record.
 */
class CheckInventoryAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Not logged in → auth middleware handles redirect
        if (!$user) {
            return redirect()->route('inventory.login');
        }

        // Superusers always have access
        if ($user->hasRole('superuser')) {
            return $next($request);
        }

        // Check if user has an active record for 'inventory' subdomain
        $hasAccess = SubdomainUser::where('user_id', $user->id)
            ->where('subdomain', 'inventory')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->exists();

        if (!$hasAccess) {
            // Log them out of the subdomain session and redirect to access denied
            return redirect()->route('inventory.access-denied');
        }

        return $next($request);
    }
}
