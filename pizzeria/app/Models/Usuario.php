<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
protected $table = 'usuario';

    protected $fillable = [
        'usuario',
        'contrasena',
        'activo',
        'fktipousuario',
    ];

    /**
     * Relación: un usuario pertenece a un tipo de usuario.
     */
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'fktipousuario');
    }
}
