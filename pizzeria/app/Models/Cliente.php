<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'cliente';

    protected $fillable = [
        'nombres',
        'appaterno',
        'apmaterno',
        'direccion',
        'celular1',
        'celular2',
        'fksexo',
        'activo',
    ];

    public $timestamps = true;

    /**
     * Relación con el modelo Sexo
     */
    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'fksexo');
    }
}
