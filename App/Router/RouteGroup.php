<?php

class RouteGroup
{
    private $uri;
    private $method;
    private $routes;

    /**
     * Constructor
     *
     * @param mixed $uri
     * @param mixed $method
     */
    public function __construct($uri, $method)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->routes = [];
    }

    /**
     * Adds a route to the collection. Categorizes it by number of
     * path segments and whether it's static or dynamic (contains parameters).
     *
     * @param mixed $path
     * @param mixed $action
     */
    public function addRoute($path, $action): void
    {
        preg_match_all('/{(.*?)}/', $path, $matches);
        $numOfSegments = count(explode('/', $path));

        if (!isset($this->routes[$numOfSegments])) {
            $this->routes[$numOfSegments] = [];
        }

        $key = count($matches[1]) ? 'dynamic' : 'static';
        $pathKey = count($matches[1]) ? 0 : $path;

        if (!isset($this->routes[$numOfSegments][$key])) {
            $this->routes[$numOfSegments][$key] = [];
        }

        $this->routes[$numOfSegments][$key][$pathKey] = new Route($path, $action);
    }

    /**
     * Returns a route by path
     *
     * @param mixed $path
     */
    public function getRoute($path): Route
    {
        $segments = explode('/', $path);
        $numOfSegments = count($segments);

        if (!isset($this->routes[$numOfSegments])) {
            echo '404 Not Found';
        }

        if (isset($this->routes[$numOfSegments]['static'][$path])) {
            return $this->routes[$numOfSegments]['static'][$path];
        }

        return $this->routes[$numOfSegments]['dynamic'][0];
    }
}
