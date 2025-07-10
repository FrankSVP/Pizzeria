<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = 'producto';

    protected $fillable = [
        'nombreproducto',
        'descripcionproducto',
        'precioproducto',
        'stock',
        'fktipoproducto',
        'activo',
    ];

    /**
     * Relación: un producto pertenece a un tipo de producto.
     */
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'fktipoproducto');
    }
}
