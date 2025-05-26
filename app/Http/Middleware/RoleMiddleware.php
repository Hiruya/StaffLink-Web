<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
        public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $userRole = auth()->user()->role?->name;

        if (!$userRole || !in_array($userRole, $roles)) {
            abort(403, 'Unauthorized: Access denied for role [' . ($userRole ?? 'unknown') . ']');
        }

        return $next($request);
    }
}
