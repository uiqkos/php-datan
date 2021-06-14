<?php


class Router {
    private static ?Router $instance = null;

    private Route $GET;
    private Route $POST;
    private Route $PATCH;
    private Route $DELETE;

    private function __construct() {
        $this->DELETE = new Route();
        $this->POST = new Route();
        $this->GET = new Route();
        $this->PATCH = new Route();
    }

    public static function getInstance(): Router {
        if (is_null(self::$instance))
            self::$instance = new Router();
        return self::$instance;
    }

    public function bind(string $path, callable | array $func, string $method) {
        $segments = explode('/', $path);
        match ($method) {
            'GET'    | 'get'    => $this->GET   ->bind(array_splice($segments, 1), $func),
            'POST'   | 'post'   => $this->POST  ->bind(array_splice($segments, 1), $func),
            'DELETE' | 'delete' => $this->DELETE->bind(array_splice($segments, 1), $func),
            'PATCH'  | 'patch'  => $this->PATCH ->bind(array_splice($segments, 1), $func),
        };
    }

    public function get(string $path) {
        $segments = explode('/', $path);
        $this->GET->route(array_slice($segments, 1));
    }

    public function post(string $path) {
        $segments = explode('/', $path);
        $this->POST->route(array_slice($segments, 1));
    }

}


class Route {
    /**
     * @var array<Route>
     */
    public array $segments = array(); //todo
    private mixed $func;

    /**
     * Route constructor.
     * @param array<string> $path
     */
    public function route(array $path) {
        if (empty($path)) {
            return call_user_func($this->func);
        } else if ($path[0] == '' and sizeof($path) == 1) {
            return $this->route([]);
        }
        return $this->segments[$path[0]]->route(array_slice($path, 1));
    }

    public function __construct($func = null) {
        if (is_null($func))
            $this->func = function () {};
        else
            $this->func = $func;
    }

    public function bind(array $path, callable | array $func): static {
        if (empty($path)) {
            $this->func = $func;
            return $this;
        }
        if (!isset($this->segments[$path[0]])) {
            $this->segments[$path[0]] = new Route();
        }
        $this->segments[$path[0]]->bind(array_slice($path, 1), $func);

        return $this;
    }

}
