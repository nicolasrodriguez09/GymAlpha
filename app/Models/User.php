<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $table = 'user';

    
    protected $primaryKey = 'idUsuario';

    
    protected $fillable = [
        'nombreUsu',
        'apellidoUsu',
        'emailUsu',
        'telefonoUsu',
        'idTipoDoc',
        'numero_identificacion',
        'idRol',
        'password',
    ];

    // 4) Ocultar estos campos al serializar:
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 5) Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 6) Indica a Laravel que el "username" para Auth es 'emailUsu'
     */
    public function getAuthIdentifierName()
    {
        return 'emailUsu';
    }

    /**
     * 7) Relación con Rol:
     */
    public function rol()
    {
        return $this->belongsTo(\App\Models\Rol::class, 'idRol');
    }

    /**
     * 8) Relación con TipoDocumento:
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idTipoDoc', 'idTipoDoc');
    }
}
