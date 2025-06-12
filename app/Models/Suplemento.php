<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplemento extends Model
{
    protected $table = 'suplemento';
    protected $primaryKey = 'idSuplemento';

    protected $fillable = [
        'nombreSuplemento',
        'descripcionSuplemento',
        'marcaSuplemento',
        'precioSuplemento',
        'idCategoria',
        'idProveedor',
        'imagenSuplemento',    
    ];
}
