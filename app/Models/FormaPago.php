<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    protected $table = 'forma_pago';
    protected $primaryKey = 'idFormaPago';

    protected $fillable = [
        'nombreBanco',
        'nombreTitular',
        'numeroCuenta'
    ];
}
