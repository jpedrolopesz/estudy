<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\LoginAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogoutAttemptMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user->owner == '1') {
            return $next($request);
        }

        if ($user->owner == '0') {
            $ip = $request->ip();

            $maxUsers = DB::table('subscriptions')
                ->where('user_id', $user->id)
                ->value('max_users');

            $maxIPs = $maxUsers;

            $sessionId = $request->cookie('session_id');
            $sessionExists = LoginAttempt::where('user_id', $user->id)->where('session_id', $sessionId)->exists();

            if (!$sessionExists) {
                $sessionCount = LoginAttempt::where('user_id', $user->id)->distinct('session_id')->count();

                if ($sessionCount >= $maxIPs) {
                    return redirect()->route('website.index')->with('alert','You exceeded max users. Logout or upgrade.');
                }

                $sessionId = Str::uuid();
                LoginAttempt::create(['user_id' => Auth::id(), 'session_id' => $sessionId, 'ip_address' => $ip]);


                $minutes = 1440;
                $cookie = cookie('session_id', $sessionId, $minutes);

                return $next($request)->withCookie($cookie);


            }
        }

        return $next($request);
    }



}

