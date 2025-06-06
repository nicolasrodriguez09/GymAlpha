<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function home()
    {
        return view('admin.home');
    }



    //-------creacion funciones membresia y derivados-------



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



    ////-------creacion funciones suplementos y derivados-------



    public function suplementos()
    {
        return view('admin.suplementos.index');
    }

    public function agregarSuplemento()
    {
        return view('admin.suplementos.agregar');
    }

    public function eliminarSuplemento()
    {
        return view('admin.suplementos.eliminar');
    }

    public function modificarSuplemento()
    {
        return view('admin.suplementos.modificar');
    }

    public function consultarSuplemento()
    {
        return view('admin.suplementos.consultar');
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

