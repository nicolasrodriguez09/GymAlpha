<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplemento;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
  // 1) Botonera principal
  public function index()
  {
    return view('admin.configuracion.inventario.index');
  }

  // 2) Formulario “Ingresar cantidad”
  public function ingresarCantidad()
  {
    $suplementos = Suplemento::all();
    return view('admin.configuracion.inventario.ingresar', compact('suplementos'));
  }

  
  public function store(Request $request)
  {
      
      $data = $request->validate([
          'suplemento_id' => 'required|exists:suplemento,idSuplemento',
          'tipo'          => 'required|in:in,out',
          'cantidad'      => 'required|integer|min:1',
      ]);

      
      $supl = Suplemento::findOrFail($data['suplemento_id']);

      
      if ($data['tipo'] === 'out' && $data['cantidad'] > $supl->stock) {
          return back()->with('error', "No puedes sacar {$data['cantidad']} unidades; el stock actual es {$supl->stock}.");

      }

      
      $entrada = $data['tipo'] === 'in'  ? $data['cantidad'] : 0;
      $salida  = $data['tipo'] === 'out' ? $data['cantidad'] : 0;

      
      Inventario::create([
          'cantEntrada'  => $entrada,
          'cantSalida'   => $salida,
          'idSuplemento' => $data['suplemento_id'],
          'idUsuario'    => auth()->user()->idUsuario,
      ]);


      $nuevoStock = Inventario::where('idSuplemento', $supl->idSuplemento)->sum('cantEntrada')
                  - Inventario::where('idSuplemento', $supl->idSuplemento)->sum('cantSalida');

      $supl->update(['stock' => $nuevoStock]);

      
      return back()->with('success', 'Movimiento registrado correctamente.');
  }


  
  public function registroVentas(Request $request)
  {
    $query = Inventario::with('suplemento','usuario')
              ->where('cantSalida','>',0);

    if($request->filled('suplemento_id')){
      $query->where('idSuplemento',$request->suplemento_id);
    }

    $ventas = $query->latest()->paginate(25);

    // Para tu dropdown
    $suplementos = Suplemento::all();

    // calcular valor = cantSalida * precioSuplemento
    $ventas->getCollection()->transform(function($mov){
      $mov->valor = $mov->cantSalida * $mov->suplemento->precioSuplemento;
      return $mov;
    });

    return view('admin.configuracion.inventario.ventas', compact('ventas','suplementos'));
  }

  
  public function consultarStock(Request $request)
  {
    $q = $request->input('q');
    $tipo = $request->input('tipo','todos');

    $stocks = Suplemento::query();
    if($tipo==='id' && $q){
      $stocks->where('idSuplemento',$q);
    }
    $stocks = $stocks->get(['idSuplemento','nombreSuplemento','descripcionSuplemento','stock','precioSuplemento']);

    return view('admin.configuracion.inventario.stock', compact('stocks','tipo','q'));
  }
}
