<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Página principal.
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas para visitantes.
Route::middleware('guest')->group(function () {

    // Inicio de sesión.
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    // Registro de empleados.
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');

    // Verificación del administrador.
    Route::get('/verify-code', [AuthController::class, 'showVerifyCode'])
        ->name('verify-code');

    Route::post('/verify-code', [AuthController::class, 'verifyCode'])
        ->name('verify-code.post');
});

// Cerrar sesión.
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rutas protegidas del CRUD.
Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class)
        ->except(['destroy']);

    // Solo administradores pueden eliminar usuarios.
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('can:admin');

    // Consultar usuarios eliminados.
    Route::get('/users-trashed', [UserController::class, 'trashed'])
        ->name('users.trashed')
        ->middleware('can:admin');

    // Restaurar usuarios.
    Route::patch('/users/{id}/restore', [UserController::class, 'restore'])
        ->name('users.restore')
        ->middleware('can:admin');

    // Eliminar permanentemente.
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDeleteUser'])
        ->name('users.forceDelete')
        ->middleware('can:admin');
});
