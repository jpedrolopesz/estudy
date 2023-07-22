<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\LoginAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutAttemptMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $ip = $request->ip();

        $ipCount = LoginAttempt::where('user_id', $user->id)->distinct('ip_address')->count();

        $maxUsers = DB::table('subscriptions')
            ->where('user_id', $request->user()->id)
            ->value('max_users');

        $maxIPs = $maxUsers;

        if ($ipCount >= $maxIPs && !LoginAttempt::where('user_id', $user->id)->where('ip_address', $ip)->exists()) {
            return redirect()->route('website.index')->with('alert','You have exceeded the maximum number of simultaneous users. Log out from all devices or consider upgrading your plan.' );
        }

        LoginAttempt::create(['user_id' => Auth::id(), 'ip_address' => $ip]);

        return $next($request);
    }
}

