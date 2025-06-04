<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    // 1) Indicamos la tabla exacta:
    protected $table = 'tipo_documento';

    // 2) Clave primaria:
    protected $primaryKey = 'idTipoDoc';

    // 3) Si no tienes created_at/updated_at en esta tabla:
    public $timestamps = false;

    // 4) Campos asignables:
    protected $fillable = [
        'nombreTipoDoc',
        'descripcionTipoDoc',
    ];
}
