<?php

namespace App\Http\Controllers;
use App\Models\NombrePresentacionProductoProveedor;

use Illuminate\Http\Request;

class PresentacionProductoProveedorController extends Controller
{
     public function index()
    {
        $presentaciones = NombrePresentacionProductoProveedor::all();
        return view('admin.presentacionproductoproveedor.index', compact('presentaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombrepresentacionproductoproveedor' => 'required|string|max:50',
            'activo' => 'nullable|boolean',
        ]);

        NombrePresentacionProductoProveedor::create([
            'nombrepresentacionproductoproveedor' => $request->nombrepresentacionproductoproveedor,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->back()->with('success', 'Presentación agregada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombrepresentacionproductoproveedor' => 'required|string|max:50',
            'activo' => 'nullable|boolean',
        ]);

        $presentacion = NombrePresentacionProductoProveedor::findOrFail($id);
        $presentacion->update([
            'nombrepresentacionproductoproveedor' => $request->nombrepresentacionproductoproveedor,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->back()->with('success', 'Presentación actualizada correctamente.');
    }

    public function destroy($id)
    {
        $presentacion = NombrePresentacionProductoProveedor::findOrFail($id);
        $presentacion->delete();

        return redirect()->back()->with('success', 'Presentación eliminada correctamente.');
    }
}
