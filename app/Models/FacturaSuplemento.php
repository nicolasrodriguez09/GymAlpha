<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaSuplemento extends Model
{
    protected $table      = 'factura_suplemento';    
    protected $primaryKey = 'idFacturaSuplemento';     
    public $timestamps    = true;

    protected $fillable = [
        'fechaCompra',
        'idUsuario',
        'idInventario',
        'idFormaPago',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    public function inventario()
    {
        // Suponiendo que tu modelo de suplementos se llama Inventario
        return $this->belongsTo(Inventario::class, 'idInventario', 'idInventario');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'idFormaPago', 'idFormaPago');
    }
}
