<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function guardar (Request $request){
        $request->validate([
            'nombre'=> 'required|string|max:100|unique:categoria_suplemento,nombreCategoria',
            'descripcion' => 'required|string|max:250'

        ], [
            'nombre.unique' => 'esa categoria ya existe'
        ]);
        $categoria = Categoria::create([
            'nombreCategoria' => $request->nombre,
            'descripcionCategoria' => $request->descripcion
        ]);

        return redirect()->back()->with('success', 'se ha creado una nueva categoria');



    }

    public function eliminar (Request $request)
    {
        $request -> validate ([
            'id' => 'required|numeric'
        ]);
        
        $categoria = Categoria::find($request->id);
        if ($categoria){
            $categoria->delete();

            return redirect()->back()->with('success', 'se elimino correctamente la categoria');
        }else{
            return redirect()->back()->with('error', 'ese id no pertenece a ninguna categoria');
        }
        
    }

    public function modificar (Request $request){
        $request -> validate ([
            'id' => 'required|numeric',
            'nombre'=> 'required|string|max:100|unique:categoria_suplemento,nombreCategoria',
            'descripcion' => 'required|string|max:250'
        ], [
            'nombre.unique' => 'esa categoria ya existe'
        ]);

        $categoria = Categoria::find($request->id);

        if ($categoria){
            $categoria -> update([
                'nombreCategoria' => $request->nombre,
                'descripcionCategoria' => $request->descripcion
            ]);
            return redirect()->back()->with('success', 'categoria modificada correctamente');
        
        }else{
            return redirect()->back()->with('error', 'no se encontro el id de esa categoria');
        }
    }
}
