<?php
declare(strict_types=1);
namespace Lib;

class Route
{
    private static $routes = [];

    public static function get($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];

        // 1. Detectar si estamos en una subcarpeta (ej: /frameworkMVC/public/)
        // Esto limpia la base para que el ruteo sea relativo a la raíz del proyecto
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        if (strpos($uri, $scriptPath) === 0) {
            $uri = substr($uri, strlen($scriptPath));
        }

        // 2. Si .htaccess está enviando 'url'
        if (isset($_GET['url'])) {
            $uri = $_GET['url'];
        }

        $uri = trim($uri, '/');
        if ($uri === '')
            $uri = '/'; // Representar raíz como /

        // 3. Limpiar query strings (?id=1)
        if (strpos($uri, '?') !== false) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset(self::$routes[$method])) {
            http_response_code(404);
            echo "404 - Método no permitido";
            return;
        }

        foreach (self::$routes[$method] as $route => $callback) {
            $route = trim($route, '/');
            if ($route === '')
                $route = '/';

            // 4. Convertir la ruta en expresión regular para soportar {id}, {slug}, etc.
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Quitar la coincidencia completa

                // Ejecutar Closure
                if (is_callable($callback)) {
                    call_user_func_array($callback, $matches);
                    return;
                }

                // Ejecutar Controlador [ControllerName::class, 'method']
                if (is_array($callback)) {
                    $controllerName = $callback[0];
                    $action = $callback[1];

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        if (method_exists($controller, $action)) {
                            call_user_func_array([$controller, $action], $matches);
                            return;
                        } else {
                            die("Método $action no encontrado en $controllerName");
                        }
                    } else {
                        die("Controlador $controllerName no encontrado");
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 - Página no encontrada";
    }
}