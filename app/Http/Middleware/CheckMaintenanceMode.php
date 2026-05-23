<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass maintenance check for administrative, authentication, and core assets
        if ($request->is('admin*') || 
            $request->is('login*') || 
            $request->is('logout*') || 
            $request->is('check-status-user*') || 
            $request->is('_debugbar*') ||
            $request->is('assets*')) {
            return $next($request);
        }

        try {
            $othersSetting = \App\Models\Setting::where('pages', 'others')->where('is_active', true)->first();
            if ($othersSetting && isset($othersSetting->payload['maintenance_mode']) && $othersSetting->payload['maintenance_mode'] == '1') {
                
                // Allow logged in admins/superusers to view the website normally for testing
                if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'superuser'])) {
                    return $next($request);
                }

                $message = $othersSetting->payload['maintenance_message'] ?? 'We are currently performing scheduled maintenance. Please check back soon!';
                abort(503, $message);
            }
        } catch (\Exception $e) {
            // Silence exceptions if database connections fail
        }

        return $next($request);
    }
}
