<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginAttempt;
use Illuminate\Support\Facades\DB;

class LogoutAttemptMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userIpAddress = $request->ip();

            // Obtenha o número máximo de IPs permitidos para o usuário
            $maxUsers = DB::table('subscriptions')
                ->where('user_id', $request->user()->id)
                ->value('max_users');

            $allowedIPsCount = $user->allowed_ips ? count($user->allowed_ips) : 0;

            // Obtenha o número atual de IPs acessados pelo usuário
            $accessedIPsCount = LoginAttempt::where('user_id', $user->id)
                ->distinct('ip_address')
                ->count('ip_address');

            // Verifique se o número de IPs acessados excede o número máximo permitido
            if ($accessedIPsCount > $allowedIPsCount) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/')->withErrors(['login' => 'Limite de acesso excedido.']);
            }

            // Verifique se o número de tentativas de login excede o limite máximo
            $loginAttemptsCount = LoginAttempt::where('user_id', $user->id)
                ->where('created_at', '>=', now()->subDay()) // Limite de um período de 24 horas
                ->count();

            $maxLoginAttempts = 2; // Define o limite máximo de tentativas de login

            if ($loginAttemptsCount >= $maxLoginAttempts) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/')->withErrors(['login' => 'Limite de tentativas de login excedido.']);
            }


    }

        return $next($request);
    }
}
