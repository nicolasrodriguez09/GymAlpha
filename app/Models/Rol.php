<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    // 1) Indicamos la tabla exacta:
    protected $table = 'rol';

    // 2) Clave primaria:
    protected $primaryKey = 'idRol';

    // 3) Si no quieres timestamp en esta tabla, agrega:
    public $timestamps = false;

    // 4) Campos asignables en masa (solo nombre y descripción):
    protected $fillable = [
        'nombreRol',
        'descripcionRol',
    ];
}
