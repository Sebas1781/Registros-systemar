<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Mostrar lista de usuarios
     */
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Mostrar formulario para crear usuario
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar nuevo usuario
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:users,curp',
            'fotografia' => 'nullable|image|max:5120', // 5MB máximo
            'password' => 'required|string|min:8|confirmed',
            'calle' => 'required|string|max:255',
            'manzana' => 'required|string|max:10',
            'lote' => 'required|string|max:10',
            'numero' => 'required|string|max:10',
            'codigo_postal' => 'required|string|size:5',
            'municipio' => 'required|string|max:255',
            'seccion_electoral' => 'required|numeric',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
        ], [
            'curp.unique' => 'Este CURP ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Manejo de la fotografía
        $fotografiaPath = null;
        if ($request->hasFile('fotografia')) {
            $fotografiaPath = $request->file('fotografia')->store('usuarios', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'curp' => $validated['curp'],
            'fotografia' => $fotografiaPath,
            'calle' => $validated['calle'],
            'manzana' => $validated['manzana'],
            'lote' => $validated['lote'],
            'numero' => $validated['numero'],
            'codigo_postal' => $validated['codigo_postal'],
            'municipio' => $validated['municipio'],
            'seccion_electoral' => $validated['seccion_electoral'],
            'telefono' => $validated['telefono'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // No permitir eliminar administradores
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'No se puede eliminar un administrador.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}

