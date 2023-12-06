<?php

namespace PRGANYRN\PROJECT\TEST\App;

class Route
{
    private static $routes = [];
    public function add(string $method, string $url, string $controller, string $function, array $middleware): void
    {
        self::$routes[] = [
            "method" => $method,
            "url" => $url,
            "controller" => $controller,
            "function" => $function,
            "middleware" => $middleware
        ];
    }

    public function gas(): void
    {
        $url = "/";
        if(isset($_SERVER['PATH_INFO'])){
            $url = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route){

            $pola = "#^" . $route['url'] . "$#";
            if(preg_match($pola, $url, $variables) && $method == $route['method'])
            {
                // foreach($route['middleware'] as $middleware)
                // {
                //     $instance = new $middleware;
                //     $instance->cek();
                // }

                $function = $route['function'];
                $controller = new $route['controller'];

                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);
            }
        }

        http_response_code(404);
        View::redirect('errors/notfound');

    }
}
