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

        // Crear el suplemento mapeando cada campo
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

    public function eliminar (Request $request)
    {
        $request->validate ([
            'id' => 'required|numeric'
        ]);

        $suplemento = Suplemento::find($request->id);

        if($suplemento){
            $suplemento->delete();

            return back()->with('success','suplemento eliminado correctamente');
        }else{
            return back()->with('error','no se encontro suplemento con ese id');
        }
    }




    public function modificar(Request $request)
    {
        
        $request->validate([
            'id' => 'required|numeric',
            'categoria'=> 'required|integer|exists:categoria_suplemento,idCategoria',
            'proveedor'=> 'required|integer|exists:proveedor,idProveedor',
            'marca' => 'required|string|max:100',
            'nombre'  => 'required|string|max:100',
            'descripcion' => 'required|string|max:250',
            'precio'=> 'required|numeric|min:0',
            'imagen'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $suplemento = Suplemento::find($request->id);
        if (! $suplemento) {
            return back()->with('error', 'No se encontró suplemento con ese id');
        }

        
        
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('suplementos', 'public');
        } else {
            $ruta = $suplemento->imagenSuplemento;
        }

        
        $suplemento->update([
            'nombreSuplemento'=> $request->nombre,
            'descripcionSuplemento'=> $request->descripcion,
            'marcaSuplemento'  => $request->marca,
            'precioSuplemento'=> $request->precio,
            'idCategoria' => $request->categoria,
            'idProveedor' => $request->proveedor,
            'imagenSuplemento'=> $ruta,
        ]);

        return back()->with('success', 'Suplemento modificado correctamente');
    }

}
