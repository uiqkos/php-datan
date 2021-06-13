<?php


class Router {
    private static Route $root;

    private static Route $GET;
    private static Route $POST;
    private static Route $PATCH;
    private static Route $DELETE;

    private function __construct() {
        self::$DELETE = new Route();
        self::$POST = new Route();
        self::$GET = new Route();
        self::$PATCH = new Route();
    }

    public static function route(string $path, $method) {

        return self::$root->route($segments);
    }

    public static function bind(string $path, callable $func, string $method) {
        $segments = str_split('/', $path);
        // self::$method
        match ($method) {
            'GET' => self::$GET->bind($segments, $func),
            'POST' => self::$POST->bind($segments, $func),
            'DELETE' => self::$DELETE->bind($segments, $func),
            'PATCH' => self::$PATCH->bind($segments, $func),
        };
    }

    public function get(string $path, callable $function) {
        self::$GET[$path] = $function;
    }

    public function post(string $path, callable $function) {
        self::$POST[$path] = $function;
    }

    public function delete(string $path, callable $function) {
        self::$DELETE[$path] = $function;
    }

    public function patch(string $path, callable $function) {
        self::$PATCH[$path] = $function;
    }


}

class Route {
    /**
     * @var array<Route>
     */
    private array $segments = array();
    private $func;

    /**
     * Route constructor.
     * @param array<string> $path
     */
    public function route(array $path) {
        if (empty($path)) {
            return call_user_func($this->func);
        }
        return $this->segments[$path[0]]->route(array_slice($path, 1));
    }

    /**
     * Route constructor.
     * @param $func
     */
    public function __construct($func = null) {
        if (is_null($func))
            $this->func = function () {};
        else
            $this->func = $func;
    }

    public function bind(array $path, callable $func): static {
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

/**
 *
 * Router::get('human/details?id=2', HumanController::details)
 * Router::get('human/details?id=2')
 *
 * Router::bindGet('human/details?id=2', HumanController::details)
 *
 * Router::get('human/details?id=2')
 * Router::bind('human/details?id=2', HumanController::details, method = 'get')
 *
 *
 * Router::bind('human/details?id=2', HumanController::details)
 *
 */