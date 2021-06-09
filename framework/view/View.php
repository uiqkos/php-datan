<?php


class View {
    private $func;
    private array $params;

    public function __construct(callable $func, array $params) {
        $this->func = $func;
        $this->params = $params;
    }

    public function call() {
        $func = $this->func;
        $func(...$this->params);
    }
}