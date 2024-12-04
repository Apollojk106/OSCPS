<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado e se o papel não é 'admin'
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // Se não for admin, redireciona para o dashboard do estudante
            return redirect()->route('student.dashboard');
        }

        // Caso contrário, prossegue com a requisição
        return $next($request);
    }
}
