<?php


class SuperRouter {
    private Route $getRoute;
    private Route $postRoute;
    private static ?SuperRouter $instance = null;

    private function __construct() {
        $this->getRoute = new Route();
        $this->postRoute = new Route();
    }

    public static function getInstance(): SuperRouter {
        if (is_null(self::$instance))
            self::$instance = new SuperRouter();
        return self::$instance;
    }

    private static function parseUrl(string $url) {
        $parsed = parse_url($url);
        $segments = explode(
            '/', $parsed['path']
        );

        if (end($segments) == '')
            $segments = array_slice($segments, 0, -1);

        return $segments;
    }

    public function get(string $path, array $GET = array()) {
        $segments = self::parseUrl($path);
        return $this->getRoute->route(array_slice($segments, 1), $GET);
    }

    public function post(string $path, array $POST = array(), string $redirect_url = null) {
        $segments = self::parseUrl($path);

        $r = $this->postRoute->route(array_slice($segments, 1), $POST);

        if (!is_null($redirect_url)) {
            header("Location: $redirect_url");
        }
        return $r;
    }

    public function bind(string $path, array | callable $func, string $method): static {
        $segments = self::parseUrl($path);
        match ($method) {
            'POST' | 'post' => $this->postRoute->bind(array_splice($segments, 1), $func),
            'GET' | 'get' => $this->getRoute->bind(array_splice($segments, 1), $func),
            default => throw new Exception("Unknown method $method")
        };

        return $this;
    }
}

class Router {
    private Controller $controller;
    private string $listRoute;
    private string $detailsRoute;
    private string $deleteRoute;
    private string $updateRoute;
    private string $createRoute;
    private string $prefix;

    /**
     * Router constructor.
     * @param Controller $controller
     * @param string $prefix
     */
    public function __construct(Controller $controller, string $prefix) {
        $this->controller = $controller;
        $this->prefix = $prefix;

        $this->listRoute = '/'.$this->prefix.'/list';
        $this->deleteRoute = '/'.$this->prefix.'/delete';
        $this->updateRoute = '/'.$this->prefix.'/update';
        $this->createRoute = '/'.$this->prefix.'/create';
        $this->detailsRoute = '/'.$this->prefix.'/details';

        SuperRouter::getInstance()->bind($this->listRoute, [$controller, 'all'], 'get');
        SuperRouter::getInstance()->bind($this->deleteRoute, [$controller, 'delete'], 'get');
        SuperRouter::getInstance()->bind($this->updateRoute, [$controller, 'update'], 'get');
        SuperRouter::getInstance()->bind($this->createRoute, [$controller, 'create'], 'get');
        SuperRouter::getInstance()->bind($this->detailsRoute, [$controller, 'details'], 'get');

        SuperRouter::getInstance()->bind($this->deleteRoute, [$controller->getRepository(), 'delete'], 'post');

        $create_post = function (...$arr) use ($controller) {
            return $controller
                ->getRepository()
                ->create($controller
                    ->getRepository()
                    ->getModelDecorator()
                    ->fromArray($arr)
            );
        };

        $update_post = function (...$arr) use ($controller) {
            $controller
                ->getRepository()
                ->update($controller
                    ->getRepository()
                    ->getModelDecorator()
                    ->fromArray($arr)
                );
        };

        SuperRouter::getInstance()->bind($this->updateRoute, $update_post, 'post');
        SuperRouter::getInstance()->bind($this->createRoute, $create_post, 'post');

    }

    /**
     * @return Controller
     */
    public function getController(): Controller {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getListRoute(): string {
        return $this->listRoute;
    }

    /**
     * @return string
     */
    public function getDetailsRoute(): string {
        return $this->detailsRoute;
    }

    /**
     * @return string
     */
    public function getDeleteRoute(): string {
        return $this->deleteRoute;
    }

    /**
     * @return string
     */
    public function getUpdateRoute(): string {
        return $this->updateRoute;
    }

    /**
     * @return string
     */
    public function getCreateRoute(): string {
        return $this->createRoute;
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
    public function route(array $path, array $params = array()) {
        if (empty($path)) {
            return call_user_func_array($this->func, $params);
        } else if ($path[0] == '' and sizeof($path) == 1) {
            return $this->route([]);
        }
        return $this->segments[$path[0]]->route(array_slice($path, 1), $params);
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

