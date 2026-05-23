<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionId = session()->getId();
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $today = now()->startOfDay();

        // Check if this session has already been recorded today
        $visitor = VisitorLog::where('session_id', $sessionId)
            ->where('created_at', '>=', $today)
            ->first();

        if (!$visitor) {
            $country = null;
            $city = null;

            if ($ipAddress !== '127.0.0.1' && $ipAddress !== '::1') {
                try {
                    $response = \Illuminate\Support\Facades\Http::timeout(2)->get("http://ip-api.com/json/{$ipAddress}");
                    if ($response->successful()) {
                        $data = $response->json();
                        if (($data['status'] ?? '') === 'success') {
                            $country = $data['country'] ?? null;
                            $city = $data['city'] ?? null;
                        }
                    }
                } catch (\Exception $e) {
                    // Fail silently to not impact user experience
                }
            }

            if (!$country) {
                $country = ($ipAddress === '127.0.0.1' || $ipAddress === '::1') ? 'Localhost' : 'Unknown';
            }
            if (!$city) {
                $city = ($ipAddress === '127.0.0.1' || $ipAddress === '::1') ? 'Localhost' : 'Unknown';
            }

            VisitorLog::create([
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'user_agent' => $userAgent,
                'country'    => $country,
                'city'       => $city,
            ]);
        } else {
            // Update updated_at to track "Online" status without Redis
            $visitor->touch();
        }

        return $next($request);
    }
}
