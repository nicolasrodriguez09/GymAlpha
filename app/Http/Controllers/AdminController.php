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
    //creacion funcion membresia
    public function membresia()
    {
        return view('admin.membresia.index');
    }
    //creacion funcion suplementos
    public function suplementos()
    {
        return view('admin.suplementos');
    }
    //creacion funcion spinnning
    public function spinning()
    {
        return view('admin.spinning');
    }
    //creacion funcion configuracion
    public function configuracion()
    {
        return view('admin.configuracion');
    }
}

