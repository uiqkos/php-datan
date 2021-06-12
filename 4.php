<?php

class A {
    public string $a;
    public int $b;

    /**
     * A constructor.
     * @param string $a
     * @param int $b
     */
    public function __construct(string $a, int $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function __call($method, $args)
    {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
    }

    public function __set(string $name, $value): void {

    }

    public function toString(): string {
        throw new Exception('Not implemented');
    }

}

//(new ReflectionClass(A))->newInstance()