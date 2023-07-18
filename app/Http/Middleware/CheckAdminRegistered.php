<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckAdminRegistered
{
    public function handle(Request $request, Closure $next)
    {
        $adminExists = User::where('owner', true)->exists();

        if ($adminExists) {
            return redirect()->route('website.index');
        }

        return $next($request);
    }
}
