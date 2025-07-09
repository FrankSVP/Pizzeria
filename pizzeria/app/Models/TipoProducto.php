<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
   
    // Tabla asociada (opcional si se llama igual que el modelo en plural snake_case)
    protected $table = 'tipoproducto';

    // Campos que se pueden asignar masivamente
    protected $fillable = ['tipoproducto', 'activo'];
}
