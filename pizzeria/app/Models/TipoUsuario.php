<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
   
    // Tabla asociada (opcional si se llama igual que el modelo en plural snake_case)
    protected $table = 'tipousuario';

    // Campos que se pueden asignar masivamente
    protected $fillable = ['tipousuario', 'activo'];
}
