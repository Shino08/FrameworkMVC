<?php
declare(strict_types=1);

use Lib\Route;
use App\Controllers\HomeController;

// --- PLANTILLA DE RUTAS ---

// 1. Ruta principal con Controlador
Route::get('/', [HomeController::class, 'index']);

// 2. Ruta con parámetros dinámicos (Ej: /hola/juan)
Route::get('/hola/{nombre}', function ($nombre) {
    echo "Hola " . ucfirst($nombre);
});

// 3. Ruta simple con función anónima
Route::get('/contacto', function () {
    echo "Página de contacto";
});

// --------------------------

Route::dispatch();