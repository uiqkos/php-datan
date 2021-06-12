<?php

/**
 * Class A
 * @method toString
 */

class A {
    public $a;
    public function __construct($a) {
        $this->a = $a;
    }

    public function __call($method, $args) {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
        return null;
    }

    public function __toString(): string {
        return $this->toString();
    }
}
