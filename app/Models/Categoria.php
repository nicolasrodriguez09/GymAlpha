<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria_suplemento';
    protected $primaryKey = 'idCategoria';

    protected $fillable = [
        'nombreCategoria',
        'descripcionCategoria'
    ];
}
