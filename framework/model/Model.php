<?php

abstract class Model {
    public function toString(): string {
        throw new Exception('Not implemented');
    }

    public function __toString(): string {
        return $this->toString();
    }

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

}