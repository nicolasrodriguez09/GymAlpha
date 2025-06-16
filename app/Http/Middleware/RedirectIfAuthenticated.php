<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // Si es admin, al panel de admin
            if (Auth::user()->rol->nombreRol === 'administrador') {
                return redirect()->route('admin.home');
            }
            // Si no, al dashboard “cliente”
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
