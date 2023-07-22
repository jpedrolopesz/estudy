<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginAttempt;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->owner == '1') {
            return redirect('/admin/dashboard')->with('success', 'Your login was successful');
        } elseif (Auth::user()->owner == '0') {
            $allowedIps = Auth::user()->allowed_ips;
            $userIpAddress = $request->ip();

            if (is_array($allowedIps) && !in_array($userIpAddress, $allowedIps)) {
                return redirect('/')->with('alert', 'Your IP does not have permission to log into this account.');
            }

            $maxUsers = DB::table('subscriptions')
                ->where('user_id', $request->user()->id)
                ->value('max_users');

            $maxAttemptsPerIP = $maxUsers;

            $ipAttempts = LoginAttempt::where('user_id', Auth::id())
                ->where('ip_address', $userIpAddress)
                ->where('created_at', '>=', now()->subDay())
                ->count();

            if ($ipAttempts >= $maxAttemptsPerIP) {
                return redirect('/')->with('alert', 'Login limit exceeded for this IP');
            }

            return redirect(RouteServiceProvider::HOME)->with('success', 'Your login was successful');
        } else {
            return redirect('/');
        }
    }



    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $userIpAddress = $request->ip();

            LoginAttempt::where('user_id', Auth::id())
                ->where('ip_address', $userIpAddress)
                ->delete();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return back();
    }

    public function logoutAllIPs(Request $request)
    {
        $user = Auth::user();

        LoginAttempt::where('user_id', $user->id)
            ->delete();

        return redirect()->route('website.index')->with('success', 'Successfully logged out of all sessions on other IPs.');
    }


}
