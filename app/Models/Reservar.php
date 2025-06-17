<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservar extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'idReserva';

    protected $fillable = [
        'idUsuario',
        'idClaseSpinning',
        'fechaReserva',
    
    ];
}
