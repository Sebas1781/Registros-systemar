<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fotografia' => 'nullable|image|max:5120', // 5MB máximo
            'curp' => 'required|string|size:18',
            'calle' => 'required|string|max:255',
            'manzana' => 'nullable|string|max:50',
            'lote' => 'nullable|string|max:50',
            'numero' => 'nullable|string|max:50',
            'codigo_postal' => 'required|string|max:10',
            'municipio' => 'required|string|max:255',
            'seccion_electoral' => 'required|string|max:50',
            'ocupacion_actual' => 'required|string|max:255',
            'experiencia' => 'required|in:Si,No',
            'detalle_experiencia' => 'nullable|string',
            'secciones_desarrollarse' => 'required|string',
            'por_que_propone' => 'required|string',
            'corriente_politica' => 'required|string',
        ]);

        // Manejo de la fotografía
        if ($request->hasFile('fotografia')) {
            $validated['fotografia'] = $request->file('fotografia')->store('fotografias', 'public');
        }

        // Agregar el ID del usuario autenticado
        $validated['user_id'] = auth()->id();

        Registration::create($validated);

        return redirect()->route('registration.form')
            ->with('success', '¡Registro guardado exitosamente!');
    }
}
