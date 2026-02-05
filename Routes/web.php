<?php
declare(strict_types=1);

use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// 1. Ruta principal con Controlador
Route::get('/', [HomeController::class, 'index']);

Route::get('/hola/{nombre}', function ($nombre) {
    echo "Hola " . ucfirst($nombre);
});

Route::get('/contacto', function () {
    echo "Página de contacto";
});

Route::dispatch();