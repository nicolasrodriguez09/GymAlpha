<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = 'membresia';

    protected $fillable = [
        'nombreMembresia',
        'descripcionMembresia',
        'precioMembresia',
    ];
}
