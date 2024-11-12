<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }   

        // Se o usuário não for admin, redireciona
        return redirect('/');
    }
}

