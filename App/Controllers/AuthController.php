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

    public function showRegister(){
        $this->view('auth/register', ['title'=> 'Registro']);
    }

    public function register(){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        
        var_dump($email);
        var_dump($password);
        var_dump($name);
        var_dump($lastname);
        
        $userRegister = new User();

        $user = $userRegister->register($email, $name, $lastname, $password);

        var_dump($user);

        if (isset($user)) {

            header('Location: /frameworkMVC/public/register');
            $this->view('auth/register', [
                'title' => 'Iniciar Sesión',
                'error' => 'Credenciales incorrectas',
                'email' => $email
            ]);
            exit;
        } else {
            $this->view('auth/register', [
                'title' => 'Registro exitoso',
                'error' => 'Sin errores',
                'email' => $email
            ]);
        }

    }
}
