<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use App\Models\TipoDocumento;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Pasamos los roles y tipos de documento para llenar los <select>
        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();

        return view('auth.register', compact('roles', 'tiposDocumento'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        // 1) VALIDACIÓN: usamos los nombres de campo de la tabla "user"
        $request->validate([
            'nombreUsu'             => ['required', 'string', 'max:255'],
            'apellidoUsu'           => ['required', 'string', 'max:255'],
            'emailUsu'              => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:user,emailUsu' // valida unicidad en tabla "user"
            ],
            'telefonoUsu'           => ['nullable', 'string', 'max:20'],
            'idTipoDoc'             => ['required', 'exists:tipo_documento,idTipoDoc'],
            'numero_identificacion' => [
                'required',
                'string',
                'max:50',
                'unique:user,numero_identificacion' // unicidad en "user"
            ],
            
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        

        // 2) CREAR EL USUARIO usando los campos exactos de la tabla "user"
        
        $user = User::create([
            'nombreUsu'             => $request->nombreUsu,
            'apellidoUsu'           => $request->apellidoUsu,
            'emailUsu'              => $request->emailUsu,
            'telefonoUsu'           => $request->telefonoUsu,
            'idTipoDoc'             => $request->idTipoDoc,
            'numero_identificacion' => $request->numero_identificacion,
            'idRol'                 => 1, // 1 = cliente (no se elige en el formulario)
            'password'              => Hash::make($request->password),
        ]);

        

        event(new Registered($user));

        Auth::login($user);

        // 3) REDIRECCIÓN CORRECTA
        // En lugar de usar `redirect(route('dashboard', false))`, 
        // usamos ->route('dashboard') directamente:
        return redirect()->route('dashboard');
    }
} 
