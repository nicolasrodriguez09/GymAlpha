<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaMembresia extends Model
{
    protected $table = 'factura_membresia';
    protected $primaryKey = 'idFacturaMembresia';
    public $timestamps = true;

    
    protected $fillable = [
        'fechaCompra',
        'idUsuario',
        'idMembresia',
        'idFormaPago',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'idMembresia', 'idMembresia');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'idFormaPago', 'idFormaPago');
    }
}
