<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        // 1) Validamos usando 'emailUsu' en lugar de 'email'
        $request->validate([
            'emailUsu' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 2) Intentamos autenticar con 'emailUsu' y 'password'
        $credentials = [
            'emailUsu' => $request->emailUsu,
            'password' => $request->password,
        ];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'emailUsu' => __('auth.failed'),
            ]);
        }

        // 3) Si la autenticación pasa:
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->rol->nombreRol === 'administrador') {
            return redirect()->route('admin.home');
        }

        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
