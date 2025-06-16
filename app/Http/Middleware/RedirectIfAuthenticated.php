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
            $rol = Auth::user()->rol->nombreRol;

            if ($rol === 'administrador'){
                return redirect()->route('admin.home');
            }

            if ($roll === 'cliente'){
                return redirect()->route('cliente.home');
            }
        }

        return $next($request);
    }
}
