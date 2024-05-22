<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GEquipeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->statut === 'gequipe') {
            return $next($request);
        }

        abort(403, 'Accès non autorisé.');
    }
}