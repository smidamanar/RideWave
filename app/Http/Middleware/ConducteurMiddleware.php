<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConducteurMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isConducteur()) {
            abort(403, 'Accès refusé. Seuls les conducteurs peuvent effectuer cette action.');
        }

        return $next($request);
    }
}
