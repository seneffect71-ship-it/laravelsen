<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = session('user');

        if (! $user) {
            return redirect('/login')->with('message', 'Silakan login terlebih dahulu');
        }

        $allowedRoles = explode(',', $roles);

        if (! in_array($user['role'] ?? '', $allowedRoles, true)) {
            return redirect('/dashboard')->with('message', 'Akses tidak diizinkan untuk role Anda.');
        }

        return $next($request);
    }
}
