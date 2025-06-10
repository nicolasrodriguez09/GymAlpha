<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spinning extends Model
{
    protected $table = 'clase_spinning';
    protected $primaryKey = 'idClaseSpinning';

    protected $fillable =[
        'diaClase',
        'horaClase',
        'cantidadCuposClase'
    ]; 
}

