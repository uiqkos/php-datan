<?php

/**
 * Class Model
 * @method toString()
 * @method getValues()
 */
abstract class Model {
    public ?int $id = null;

    public function __call($method, $args) {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
        throw new Exception('Function not exists');
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId($id): Model {
        $this->id = $id;
        return $this;
    }

    public function __toString(): string {
        return $this->toString();
    }
}