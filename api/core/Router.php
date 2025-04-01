<?php
class Router {
    private $routes = [];

    public function add($method, $uri, $handler) {
        $this->routes[$method][$uri] = $handler;
    }

    public function get($uri, $handler) {
        $this->add('GET', $uri, $handler);
    }

    public function post($uri, $handler) {
        $this->add('POST', $uri, $handler);
    }

    public function route($uri, $method) {
        $basePath = '/api/public';
        $uri = str_replace($basePath, '', $uri);
        
        // Verifica se a rota existe
        if (isset($this->routes[$method][$uri])) {
					$handler = $this->routes[$method][$uri];
            
            // Separa controller e método
            list($controllerName, $methodName) = explode('@', $handler);
            
            // Inclui o controller
            $controllerFile = dirname(__DIR__, 1) . '/controllers/' . $controllerName . '.php';
            
            if (file_exists($controllerFile)) {
                require $controllerFile;
                
                // Verifica se a classe e método existem
                if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
                
                    $controller = new $controllerName();
                    $controller->$methodName();
                    return;
                }
            }
        }

        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint não encontrado']);
    }
}