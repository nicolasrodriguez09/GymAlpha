<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'idProveedor';

    protected $fillable = [
        'nomProveedor',
        'correoProveedor',
        'telefonoProveedor',
        'NITProveedor',
    
    ];
}
