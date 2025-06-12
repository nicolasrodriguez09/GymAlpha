<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PermisosController extends Controller
{
    
    public function darPermiso (Request $request)
    {
        $data = $request -> validate ([
            'email' => 'required|email|exists:user,emailUsu'
        ], [
            'email.exists' => 'No existe usuario con ese correo'
        ]);

        $user = User::where('emailUsu', $data['email'])->first();
        $adminRol = 2;

        if($user->idRol == $adminRol){
            return redirect()->back()->with('success', 'el usuario ya es admin');
        }else{
            $user->idRol = $adminRol;
            $user->save();

            return redirect()->back()->with('success', 'se otorgo permiso de admin correctamente');
        }
    }
}
