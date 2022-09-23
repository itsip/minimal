<?php
include 'Route.php';

class Router {
    private $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    /**
     * Runs the router and directs user to correct functionality
     * based on the request.
     *
     */
    public function run() {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $path = ltrim($path, '/\\');
        $path = rtrim($path, '/\\');
        $method  = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = $_POST['_method'];
        }

        if ($path === '/') {
            $this->routes[$method][$path]->call();
        } else {
            $segments = explode('/', $path);

            if (array_key_exists($segments[0], $this->routes[$method])) {
                $route = $this->routes[$method][$segments[0]]->getRoute($path);
                $route->execute($path);
            }
        }
    }

    /**
     * Adds a route for a get request.
     *
     * @param mixed $path
     * @param mixed $function
     */
    public function get($path, $function) {
        $this->addRoute($path, 'GET', $function);
    }

    /**
     * Adds a route for a post request.
     *
     * @param mixed $path
     * @param mixed $function
     */
    public function post($path, $function) {
        $this->addRoute($path, 'POST', $function);
    }

    /**
     * Adds a route for a put request.
     *
     * @param mixed $path
     * @param mixed $function
     */
    public function put($path, $function) {
        $this->addRoute($path, 'PUT', $function);
    }

    /**
     * Adds a route for a delete request.
     *
     * @param mixed $path
     * @param mixed $function
     */
    public function delete($path, $function) {
        $this->addRoute($path, 'DELETE', $function);
    }

    /**
     * Parses a path and adds a route to a route group. Adds that
     * route group to a collection categorized by request type.
     *
     * @param mixed $path
     * @param mixed $method
     * @param mixed $function
     */
    private function addRoute($path, $method, $function) {
        $path = ltrim($path, '/\\');
        $path = rtrim($path, '/\\');

        if ($path === '/') {
            $this->routes[$method][$path[0]] = new Route($path, $function);
        }

        $segments = explode('/', $path);

        if (array_key_exists($segments[0], $this->routes[$method])) {
            $this->routes[$method][$segments[0]]->addRoute($path, $function);
        } else {
            $this->routes[$method][$segments[0]] = new RouteGroup($segments[0], $method);
            $this->routes[$method][$segments[0]]->addRoute($path, $function);
        }
    }
}

?>
