<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoProducto;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra el listado de productos.
     */
    public function index()
    {
        $productos = Producto::with('tipoProducto')->get();
        $tipos = TipoProducto::all();
        return view('admin.producto.index', compact('productos', 'tipos'));
    }

    /**
     * Guarda un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreproducto' => 'required|string|max:100',
            'descripcionproducto' => 'required|string|max:150',
            'precioproducto' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'fktipoproducto' => 'required|exists:tipoproducto,id',
            'activo' => 'nullable|boolean',
        ]);

        Producto::create([
            'nombreproducto' => $request->nombreproducto,
            'descripcionproducto' => $request->descripcionproducto,
            'precioproducto' => $request->precioproducto,
            'stock' => $request->stock,
            'fktipoproducto' => $request->fktipoproducto,
            'activo' => $request->activo ?? false,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Actualiza un producto existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreproducto' => 'required|string|max:100',
            'descripcionproducto' => 'required|string|max:150',
            'precioproducto' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'fktipoproducto' => 'required|exists:tipoproducto,id',
            'activo' => 'nullable|boolean',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombreproducto' => $request->nombreproducto,
            'descripcionproducto' => $request->descripcionproducto,
            'precioproducto' => $request->precioproducto,
            'stock' => $request->stock,
            'fktipoproducto' => $request->fktipoproducto,
            'activo' => $request->activo ?? false,
        ]);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}
