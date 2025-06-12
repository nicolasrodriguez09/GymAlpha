<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PermisosController extends Controller
{
    
    public function darPermiso(Request $request)
    {
        // 
        $request->validate([
            'email' => 'required|email',
        ]);

        
        $user = \App\Models\User::where('emailUsu', $request->email)->first();

        
        if (! $user) {
            return back()->with('error', 'No existe ningún usuario con ese correo.');
                
        }

        
        $adminRol = 2;
        if ($user->idRol == $adminRol) {
            return back()->with('success', 'El usuario ya es admin');
        }
        $user->idRol = $adminRol;
        $user->save();

        return back()->with('success', 'Se otorgó permiso de admin correctamente');
    }

    public function quitarPermiso(Request $request)
    {
        // 
        $request->validate([
            'email' => 'required|email',
        ]);

        
        $user = \App\Models\User::where('emailUsu', $request->email)->first();

        
        if (! $user) {
            return back()->with('error', 'No existe ningún usuario con ese correo.');
        }

        //protegidos
        $protegidos =[
            'admin@gym.com',
            'nicolas.rodriguez.quintero@correounivalle.edu.co',
            'Maria.granda@correounivalle.edu.co'
        ];

        if (in_array($user->emailUsu, $protegidos, true)){
            return back()->with('error', 'No se puede cambiar el rol de este usuario.');
        }

        

        
        $userRol = 1;
        if ($user->idRol == $userRol) {
            return back()->with('success', 'El usuario no tiene permisos');
        }
        $user->idRol = $userRol;
        $user->save();

        return back()->with('success', 'Se quito permiso de admin correctamente');
    }

}
