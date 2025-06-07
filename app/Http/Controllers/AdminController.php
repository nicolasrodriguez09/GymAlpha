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



    ////-------creacion funciones spinning y derivados-------



    public function spinning()
    {
        return view('admin.spinning.index');
    }

    public function agregarClase()
    {
        return view('admin.spinning.agregar');
    }

    public function eliminarClase()
    {
        return view('admin.spinning.eliminar');
    }

    public function modificarClase()
    {
        return view('admin.spinning.modificar');
    }

    public function consultarClase()
    {
        return view('admin.spinning.consultar');
    }








    //creacion funcion configuracion
    public function configuracion()
    {
        return view('admin.configuracion.index');
    }

    //---------- sub configuracion --------------

    //------------permisos y derivados ----------------
    public function permisos()
    {
        return view('admin.configuracion.permisos.index');
    }
    public function darPermiso()
    {
        return view('admin.configuracion.permisos.darPermiso');
    }
    public function quitarPermiso()
    {
        return view('admin.configuracion.permisos.quitarPermiso');
    }
    public function consultarPermiso()
    {
        return view('admin.configuracion.permisos.consultarPermiso');
    }



    //------------categoria de productos y derivados ----------------
    public function categoriaProducto ()
    {
        return view('admin.configuracion.categoriaProducto.index');
    }
    public function agregarCategoria ()
    {
        return view('admin.configuracion.categoriaProducto.agregarCategoria');
    }
    public function eliminarCategoria ()
    {
        return view ('admin.configuracion.categoriaProducto.eliminarCategoria');
    }
    public function modificarCategoria ()
    {
        return view ('admin.configuracion.categoriaProducto.modificarCategoria');
    }
    public function consultarCategoria ()
    {
        return view ('admin.configuracion.categoriaProducto.consultarCategoria');
    }


    //------------forma de pago  y derivados ----------------
    public function formaPago ()
    {
        return view('admin.configuracion.formaPago.index');
    }
    public function agregarformaPago ()
    {
        return view('admin.configuracion.formaPago.agregarFormaPago');
    }
    public function eliminarformaPago ()
    {
        return view('admin.configuracion.formaPago.eliminarFormaPago');
    }
    public function modificarformaPago ()
    {
        return view('admin.configuracion.formaPago.modificarFormaPago');
    }
    public function consultarformaPago ()
    {
        return view('admin.configuracion.formaPago.consultarFormaPago');
    }

    


    //------------inventario y derivados ----------------
    public function inventario ()
    {
        return view('admin.configuracion.inventario.index');
    }
    public function ingresarCantidad ()
    {
        return view('admin.configuracion.inventario.ingresarCantidad');
    }
    public function registroVentas ()
    {
        return view('admin.configuracion.inventario.registroVentas');
    }
    public function consultarStock ()
    {
        return view('admin.configuracion.inventario.consultarStock');
    }


    //------------tipo de documento y derivados ----------------
    public function tipoDocumento ()
    {
        return view('admin.configuracion.tipoDocumento.index');
    }


    //------------proveedor y derivados ----------------
    public function proveedor()
    {
        return view('admin.configuracion.proveedor.index');
    }





}

