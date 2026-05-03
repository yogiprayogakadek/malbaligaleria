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
            VisitorLog::create([
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
                'user_agent' => $userAgent,
            ]);
        } else {
            // Update updated_at to track "Online" status without Redis
            $visitor->touch();
        }

        return $next($request);
    }
}
