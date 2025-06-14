<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    
    protected $table = 'tipo_documento';

    
    protected $primaryKey = 'idTipoDoc';

    
    protected $fillable = [
        'nombreTipoDoc',
        'descripcionTipoDoc',
    ];
}
