<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role != $role) {
            abort(403, 'Accès interdit'); // interdiction si ce n'est pas le rôle
        }
        return $next($request);
    }
}
