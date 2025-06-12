<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplemento;
use App\Models\Categoria;
use App\Models\Proveedor;

class SuplementoController extends Controller
{
    
    public function guardar(Request $request)
    {
        
        $request->validate([
            'categoria' => 'required|integer|exists:categoria_suplemento,idCategoria',
            'proveedor' => 'required|integer|exists:proveedor,idProveedor',
            'marca' => 'required|string|max:100',
            'nombre'=> 'required|string|max:100',
            'descripcion'=> 'required|string|max:250',
            'precio' => 'required|numeric|min:0',
            'imagen'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $ruta = $request->file('imagen')->store('suplementos', 'public');

        // 3) Crear el suplemento mapeando cada campo
        Suplemento::create([
            'nombreSuplemento'=> $request->nombre,
            'descripcionSuplemento'=> $request->descripcion,
            'marcaSuplemento' => $request->marca,
            'precioSuplemento' => $request->precio,
            'idCategoria'=> $request->categoria,
            'idProveedor'=> $request->proveedor,
            'imagenSuplemento'=> $ruta,            
        ]);

        return back()->with('success', 'Suplemento guardado correctamente.');
    }

}
