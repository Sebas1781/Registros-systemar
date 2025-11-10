<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Redirigir la ruta raíz según el rol del usuario
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('registration.form');
        }
    }
    return redirect()->route('login');
});

// Rutas protegidas - Solo para usuarios regulares
Route::middleware(['auth', 'verified', 'user'])->group(function () {
    // Formulario de registro (solo usuarios regulares)
    Route::get('/formulario', [RegistrationController::class, 'index'])->name('registration.form');
    Route::post('/registro', [RegistrationController::class, 'store'])->name('registration.store');
});

// Rutas protegidas - Solo para administradores
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Dashboard del administrador
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

    // Gestión de usuarios
    Route::get('/usuarios', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/usuarios/crear', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('/usuarios', [UserManagementController::class, 'store'])->name('users.store');
    Route::delete('/usuarios/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
});

// Perfil del usuario (accesible para todos los usuarios autenticados)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
