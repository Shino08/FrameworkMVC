<?php
declare(strict_types=1);

namespace App\Controllers;

use Lib\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bienvenido a FrameworkMVC',
            'message' => 'Este es un ejemplo de plantilla usando MVC'
        ];

        $this->view('home', $data);
    }
}
