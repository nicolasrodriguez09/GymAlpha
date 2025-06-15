<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'idInventario';
    public $timestamps = true;

    protected $fillable = [
        'cantEntrada',
        'cantSalida',
        'idSuplemento',
        'idUsuario',
    ];

    public function suplemento()
    {
        return $this->belongsTo(Suplemento::class, 'idSuplemento');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}