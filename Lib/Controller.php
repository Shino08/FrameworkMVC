<?php
declare(strict_types=1);

namespace Lib;

class Controller
{
    /**
     * Render a view with data
     * @param string $view Name of the view file (without extension)
     * @param array $data Associative array of data to make available in the view
     */
    public function view(string $view, array $data = [])
    {
        // Extract data to make variables available in view
        extract($data);

        // Define the path to the view
        $viewPath = '../App/Views/' . $view . '.php';

        // Check if view exists using absolute path check relative from public/index.php
        // but simpler here:
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Provide a useful error message
            die("Error: The view '$view' was not found in 'App/Views/'.");
        }
    }
}
