<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the visitor has been counted for this session
        if (!Session::has('visitor_tracked')) {
            // Get the visitor's IP address and User-Agent
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();

            // Check if the visitor has already been recorded today
            $existingVisitor = Visitor::where('ip_address', $ipAddress)
                ->where('user_agent', $userAgent)
                ->whereDate('created_at', Carbon::today()) // Check for same day
                ->first();

            // If the visitor is new for today, save it to the database
            if (!$existingVisitor) {
                Visitor::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                ]);
            }

            // Mark this session as tracked to avoid counting multiple times
            Session::put('visitor_tracked', true);
        }


        return $next($request);
    }
}
