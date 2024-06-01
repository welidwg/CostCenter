<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Vérifier si l'utilisateur est un administrateur
            if (Auth::user()->role == 1) {
                return $next($request);
            }
        }

        // Rediriger vers la page d'accueil avec un message d'erreur si l'utilisateur n'est pas un administrateur
        return redirect('/error');
    }
}
