<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function home()
    {
        return view('admin.home');
    }

    //creacion funciones membresia y derivados

    public function membresia()
    {
        return view('admin.membresia.index');
    }

    public function agregarMembresia()
    {
        return view('admin.membresia.agregar');
    }

    public function eliminarMembresia()
    {
        return view('admin.membresia.eliminar');
    }

    public function modificarMembresia()
    {
        return view('admin.membresia.modificar');
    }

    public function consultarMembresia()
    {
        return view('admin.membresia.consultar');
    }




    //creacion funcion suplementos
    public function suplementos()
    {
        return view('admin.suplementos.index');
    }
    //creacion funcion spinnning
    public function spinning()
    {
        return view('admin.spinning.index');
    }
    //creacion funcion configuracion
    public function configuracion()
    {
        return view('admin.configuracion.index');
    }
}

