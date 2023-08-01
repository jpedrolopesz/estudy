<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoUserRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Emails que você deseja restringir
        $restrictedEmails = ['owner@demo.com', 'user@demo.com'];

        // Verificar se o usuário está logado e se é um dos emails restritos
        if (auth()->check() && in_array(auth()->user()->email,$restrictedEmails)) {
            // Verificar o tipo de requisição (se é um update, delete ou store)
            if (in_array($request->method(), ['PUT', 'PATCH', 'DELETE', 'POST'])) {
                // Se for uma operação restrita, retorne uma resposta de erro ou redirecione para uma página de erro
                return back()->with('alert', 'Attention: Modification Actions Are Not Allowed in Demo Mode.');
            }
        }

        return $next($request);
    }

}
