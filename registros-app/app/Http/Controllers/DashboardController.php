<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->paginate(10);
        
        return view('dashboard.index', compact('registrations'));
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Registro eliminado exitosamente');
    }
}
