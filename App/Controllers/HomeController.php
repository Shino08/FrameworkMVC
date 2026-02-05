<?php
declare(strict_types=1);

namespace App\Controllers;

use Lib\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está logueado
        $isLoggedIn = isset($_SESSION['user_id']);
        $userName = $_SESSION['user_name'] ?? 'Visitante';

        $data = [
            'title' => 'Bienvenido a FrameworkMVC',
            'message' => $isLoggedIn
                ? "¡Hola, $userName! Has iniciado sesión correctamente."
                : 'Este es un ejemplo de plantilla usando MVC. Inicia sesión para probar.',
            'logged_in' => $isLoggedIn
        ];

        $this->view('home', $data);
    }
}
