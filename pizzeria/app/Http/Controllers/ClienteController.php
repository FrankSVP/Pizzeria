<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('estadocliente', 1)->get();
        return view('admin.cliente.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'appaterno' => 'required|string|max:100',
            'apmaterno' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:300',
            'celular1' => 'nullable|string|max:15',
            'celular2' => 'nullable|string|max:15'
        ]);

        Cliente::create([
            'nombres' => $request->input('nombres'),
            'appaterno' => $request->input('appaterno'),
            'apmaterno' => $request->input('apmaterno'),
            'direccion' => $request->input('direccion'),
            'celular1' => $request->input('celular1'),
            'celular2' => $request->input('celular2'),
            'fksexo' => 1,
            'estadocliente' => 1,
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'appaterno' => 'required|string|max:100',
            'apmaterno' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:300',
            'celular1' => 'nullable|string|max:15',
            'celular2' => 'nullable|string|max:15'
        ]);

        $tipo = Cliente::findOrFail($id);
        $tipo->update([
            'nombres' => $request->input('nombres'),
            'appaterno' => $request->input('appaterno'),
            'apmaterno' => $request->input('apmaterno'),
            'direccion' => $request->input('direccion'),
            'celular1' => $request->input('celular1'),
            'celular2' => $request->input('celular2'),
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $tipo = Cliente::findOrFail($id);
        $tipo->update([
            'estadocliente' => 0
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
