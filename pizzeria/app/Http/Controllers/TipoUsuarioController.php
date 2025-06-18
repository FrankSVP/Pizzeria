<?php

namespace App\Http\Controllers;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        $tipos = TipoUsuario::all();
        return view('admin.tipousuario.index', compact('tipos'));
    }

 public function store(Request $request)
    {
        $request->validate([
            'tipousuario' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ]);

        TipoUsuario::create([
            'tipousuario' => $request->tipousuario,
            'activo' => $request->activo,
        ]);

        return redirect()->route('tipousuario.index')->with('success', 'Tipo de usuario agregado correctamente.');
    }

public function update(Request $request, $id)
    {
        $request->validate([
            'tipousuario' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ]);

        $tipo = TipoUsuario::findOrFail($id);
        $tipo->update([
            'tipousuario' => $request->tipousuario,
            'activo' => $request->activo,
        ]);

        return redirect()->route('tipousuario.index')->with('success', 'Tipo de usuario actualizado correctamente.');
    }

public function destroy($id)
    {
        $tipo = TipoUsuario::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipousuario.index')->with('success', 'Tipo de usuario eliminado correctamente.');
    }

}
