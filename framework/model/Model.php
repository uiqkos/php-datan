<?php

/**
 * Class Model
 * @method toString()
 */
abstract class Model extends stdClass {
    public ?int $id = null;

    public function __call($method, $args) {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId($id): MyModel {
        $this->id = $id;
        return $this;
    }

    public function __toString(): string {
        return $this->toString();
    }
}