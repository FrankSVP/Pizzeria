<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sexo;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
     /**
     * Muestra la lista de clientes.
     */
    public function index()
    {
        $clientes = Cliente::with('sexo')->get();
        $sexos = Sexo::where('activo', true)->get();

        return view('admin.cliente.index', compact('clientes', 'sexos'));
    }

    /**
     * Guarda un nuevo cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres'     => 'required|string|max:100',
            'appaterno'   => 'required|string|max:100',
            'apmaterno'   => 'required|string|max:100',
            'direccion'   => 'required|string|max:300',
            'celular1'    => 'required|string|max:15',
            'celular2'    => 'nullable|string|max:15',
            'fksexo'      => 'required|exists:sexo,id',
            'activo'      => 'boolean',
        ]);

        Cliente::create($request->all());

        return redirect()->back()->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Actualiza un cliente existente.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombres'     => 'required|string|max:100',
            'appaterno'   => 'required|string|max:100',
            'apmaterno'   => 'required|string|max:100',
            'direccion'   => 'required|string|max:300',
            'celular1'    => 'required|string|max:15',
            'celular2'    => 'nullable|string|max:15',
            'fksexo'      => 'required|exists:sexo,id',
            'activo'      => 'boolean',
        ]);

        $cliente->update($request->all());

        return redirect()->back()->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()->back()->with('success', 'Cliente eliminado correctamente.');
    }
}
