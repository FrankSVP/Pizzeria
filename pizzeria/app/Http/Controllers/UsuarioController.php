<?php
namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\TipoUsuario;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
   /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::with('tipoUsuario')->get();
        $tipos = TipoUsuario::all();
        return view('admin.usuario.index', compact('usuarios', 'tipos'));
    }

    /**
     * Guarda un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:50',
            'contrasena' => 'required|string|max:50',
            'fktipousuario' => 'required|exists:tipousuario,id',
            'activo' => 'nullable|boolean',
        ]);

        Usuario::create([
            'usuario' => $request->usuario,
            'contrasena' => $request->contrasena, // Puedes usar bcrypt() si deseas encriptarla
            'fktipousuario' => $request->fktipousuario,
            'activo' => $request->activo ?? false,
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Actualiza un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required|string|max:50',
            'contrasena' => 'required|string|max:50',
            'fktipousuario' => 'required|exists:tipousuario,id',
            'activo' => 'nullable|boolean',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'usuario' => $request->usuario,
            'contrasena' => $request->contrasena,
            'fktipousuario' => $request->fktipousuario,
            'activo' => $request->activo ?? false,
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
