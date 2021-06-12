<?php


class View {
    private $func;
    private array $params;

    public function __construct(callable $func, array $params) {
        $this->func = $func;
        $this->params = $params;
    }

    public function call() {
        return call_user_func_array($this->func, $this->params);
    }
}