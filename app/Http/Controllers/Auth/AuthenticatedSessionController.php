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
            // Verificar o limite de logins por IP
            $allowedIps = Auth::user()->allowed_ips;
            $userIpAddress = $request->ip();

            if (is_array($allowedIps) && !in_array($userIpAddress, $allowedIps)) {
                // O IP do usuário não está permitido
                return redirect('/')->withErrors(['login' => 'Seu IP não tem permissão para fazer login nesta conta.']);
            }


            $maxUsers = DB::table('subscriptions')
                ->where('user_id', $request->user()->id)
                ->value('max_users');

            // Verificar o número de tentativas de login por IP
            $maxAttemptsPerIP = $maxUsers; // Defina o limite máximo de logins por IP aqui

            $ipAttempts = LoginAttempt::where('user_id', Auth::id())
                ->where('ip_address', $userIpAddress)
                ->where('created_at', '>=', now()->subDay()) // Limitar a um período de 24 horas
                ->count();

            if ($ipAttempts >= $maxAttemptsPerIP) {
                // Excedeu o limite de logins por IP
                return redirect('/')->withErrors(['login' => 'Limite de logins excedido para este IP.']);
            }

            // Registrar a tentativa de login
            LoginAttempt::create([
                'user_id' => Auth::id(),
                'ip_address' => $userIpAddress,
            ]);

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


}
