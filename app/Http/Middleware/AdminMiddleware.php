<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifique se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Verifique se o usuário é um administrador (você pode ajustar essa lógica de acordo com seus requisitos)
        if (auth()->user()->isfuncionario) {
            return redirect()->route('home')->with('error','Acesso não autorizado' );
        }

        return $next($request);
    }
}
