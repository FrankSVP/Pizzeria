<?php

namespace App\Http\Controllers;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    
    public function index()
    {
        $tipos = TipoProducto::all();
        return view('admin.tipoproducto.index', compact('tipos'));
    }

 public function store(Request $request)
    {
        $request->validate([
            'tipoproducto' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ]);

        TipoProducto::create([
            'tipoproducto' => $request->tipoproducto,
            'activo' => $request->activo,
        ]);

        return redirect()->route('tipoproducto.index')->with('success', 'Tipo de Producto agregado correctamente.');
    }

public function update(Request $request, $id)
    {
        $request->validate([
            'tipoproducto' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ]);

        $tipo = TipoProducto::findOrFail($id);
        $tipo->update([
            'tipoproducto' => $request->tipoproducto,
            'activo' => $request->activo,
        ]);

        return redirect()->route('tipoproducto.index')->with('success', 'Tipo de Producto actualizado correctamente.');
    }

public function destroy($id)
    {
        $tipo = TipoProducto::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipoproducto.index')->with('success', 'Tipo de Producto eliminado correctamente.');
    }
}
