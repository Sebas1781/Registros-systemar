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
            'telefono' => ['required', 'string', 'max:10', 'regex:/^[0-9]+$/'],
            'email' => 'required|email|max:255',
            'fotografia' => 'nullable|image|max:5120', // 5MB máximo
            'curp' => ['required', 'string', 'size:18', 'regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9A-Z]{2}$/'],
            'calle' => 'required|string|max:255',
            'manzana' => 'nullable|string|max:50',
            'lote' => 'nullable|string|max:50',
            'numero' => 'nullable|string|max:50',
            'codigo_postal' => ['required', 'string', 'size:5', 'regex:/^[0-9]{5}$/'],
            'municipio' => 'required|string|max:255',
            'seccion_electoral' => 'required|string|max:50',
            'ocupacion_actual' => 'required|string|max:255',
            'experiencia' => 'required|in:Si,No',
            'detalle_experiencia' => 'nullable|string',
            'secciones_desarrollarse' => 'required|string',
            'por_que_propone' => 'required|string',
            'corriente_politica' => 'required|string',
        ], [
            'curp.regex' => 'El formato del CURP no es válido. Debe tener 18 caracteres: 4 letras, 6 dígitos, H o M, 5 letras y 2 caracteres finales.',
            'codigo_postal.regex' => 'El código postal debe contener exactamente 5 dígitos numéricos.',
            'codigo_postal.size' => 'El código postal debe tener exactamente 5 dígitos.',
            'telefono.regex' => 'El teléfono solo debe contener números.',
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
