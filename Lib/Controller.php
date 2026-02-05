<?php
declare(strict_types=1);

namespace Lib;

class Controller
{
    public function view(string $view, array $data = [])
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $baseUrl = str_replace('/index.php', '', $scriptName);

        $baseUrl = rtrim($baseUrl, '/');

        $data['base_url'] = $baseUrl;

        extract($data);
        
        $viewPath = '../App/Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("Error: Esta vista '$view' no se encuentra en 'App/Views/'.");
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
