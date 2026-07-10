<?php

namespace App\Http\Middleware;

use App\Models\IpWhitelist;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * If the ip_whitelists table has active entries for the 'inventory' subdomain,
 * only those IPs are permitted. An empty list = open access for all IPs.
 */
class CheckInventoryIpWhitelist
{
    public function handle(Request $request, Closure $next): Response
    {
        // Feature flag from config
        if (!config('inventory.ip_whitelist_enabled', true)) {
            return $next($request);
        }

        $clientIp = $request->ip();

        if (!IpWhitelist::isAllowed('inventory', $clientIp)) {
            // Store blocked IP in session so the view can show it
            session(['blocked_ip' => $clientIp]);

            return redirect()->route('inventory.ip-blocked');
        }

        return $next($request);
    }
}
