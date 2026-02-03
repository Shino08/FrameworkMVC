<?php
declare(strict_types=1);

namespace Lib;

class Controller
{
    public function view(string $view, array $data = [])
    {
        extract($data);
        $viewPath = '../App/Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("Error: The view '$view' was not found in 'App/Views/'.");
        }
    }

    public function json($data, int $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
