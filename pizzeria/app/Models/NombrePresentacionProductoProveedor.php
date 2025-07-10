<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NombrePresentacionProductoProveedor extends Model
{
     protected $table = 'presentacionproductoproveedor';

    protected $fillable = [
        'nombrepresentacionproductoproveedor',
        'activo',
    ];

    public $timestamps = true;
}
