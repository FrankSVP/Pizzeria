<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';

    protected $fillable = [
        'sexo',
        'activo',
    ];

    // Si deseas forzar timestamps aunque estén definidos por default:
    public $timestamps = true;
}
