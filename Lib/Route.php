<?php
declare(strict_types= 1);
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

        if (isset($_GET['url'])) {
            $uri = $_GET['url'];
        }

        $uri = trim($uri, '/');

        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes[$method] as $route => $callback) {
            if (trim($route, '/') == $uri) {
                $callback();
                return;
            }
        }

        echo "404 Not Found";
    }
}