<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    // Tabla asociada (opcional si se llama igual que el modelo en plural snake_case)
    protected $table = 'cliente';

    // Campos que se pueden asignar masivamente
    protected $fillable = ['nombres', 'appaterno', 'apmaterno', 'direccion', 'celular1', 'celular2', 'fksexo', 'estadocliente'];
}
