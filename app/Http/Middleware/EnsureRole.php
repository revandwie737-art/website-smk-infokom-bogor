<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Usage: middleware(["auth", "role:admin"]) or role:admin,teacher
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $allowed = explode(",", $roles);

        if (! $request->user() || ! in_array($request->user()->role, $allowed, true)) {
            abort(403, "Anda tidak memiliki akses ke halaman ini.");
        }

        return $next($request);
    }
}
