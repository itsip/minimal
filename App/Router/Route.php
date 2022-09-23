<?php

class Route {
    private $path;
    private $action;

    /**
     * Constructor
     *
     * @param mixed $path
     * @param mixed $action
     */
    public function __construct($path, $action) {
        $this->path = $path;
        $this->action = $action;
    }

    /**
     * Executes a route by path.
     *
     * @param mixed $path
     */
    public function execute($path) {
        $segments = explode('/', $path);
        $params = array_values(array_intersect_key($segments, $this->getParams()));
        call_user_func_array($this->action, $params);
    }

    /**
     * Parses the path associated with the route to determine the
     * route paramaters associated with this route.
     *
     */
    private function getParams() {
        $segments = explode('/', $this->path);

        $params = [];
        foreach($segments as $key => $segment) {
            if (substr($segment, 0, 1) === '{' && substr($segment, -1) === '}') {
                $params[$key] = $segment;
            }
        }

        return $params;
    }
}

?>
