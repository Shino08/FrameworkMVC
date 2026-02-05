<?php
declare(strict_types=1);

namespace App\Controllers;

use Lib\Controller;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        // Si ya está logueado, redirigir al inicio
        if (isset($_SESSION['user_id'])) {
            header('Location: /frameworkMVC/public/');
            exit;
        }

        $this->view('auth/login', ['title' => 'Iniciar Sesión']);
    }

    // Procesar datos del login
    public function processLogin()
    {
        // Obtener datos del post
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Instanciar el MODELO
        $userModel = new User();

        // Pedirle los datos al modelo
        $user = $userModel->findByEmail($email);

        // Validar credenciales
        if ($user && $password === $user['password']) {
            // Login exitoso
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header('Location: /frameworkMVC/public/');
            exit;
        } else {
            // Login fallido
            $this->view('auth/login', [
                'title' => 'Iniciar Sesión',
                'error' => 'Credenciales incorrectas',
                'email' => $email
            ]);
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /frameworkMVC/public/');
        exit;
    }

    public function showRegister()
    {
        $this->view('auth/register', ['title' => 'Registro']);
    }

    public function register()
    {
        // 1. Obtener datos del formulario
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['name'] ?? '';
        $lastname = $_POST['lastname'] ?? '';

        // 2. Instanciar el modelo
        $userModel = new User();

        // 3. Intentar registrar
        $user = $userModel->register($email, $name, $lastname, $password);

        if ($user) {
            // Éxito: El usuario fue registrado (simulado)
            // Redirigimos al login para que inicie sesión
            header('Location: /frameworkMVC/public/login');
            exit;
        } else {
            // Fallo: El usuario ya existe o hubo error
            $this->view('auth/register', [
                'title' => 'Registro',
                'error' => 'El correo electrónico ya está registrado',
                'email' => $email
            ]);
        }
    }
}
