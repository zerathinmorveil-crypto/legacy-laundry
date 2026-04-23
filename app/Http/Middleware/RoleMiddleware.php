<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Customer diarahkan ke halaman khusus mereka
        if (Auth::check() && Auth::user()->role === 'customer') {
            return redirect()->route('customer.home')
                             ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return redirect('/dashboard')
                    ->with('error', 'Anda tidak memiliki hak akses ke halaman tersebut.');
    }
}