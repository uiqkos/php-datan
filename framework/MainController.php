<?php


class Testable {
    private int $id;
    private string $name;

    public function __toString(): string {
        return "$this->id with name: $this->name";
    }
}

require 'framework/model/Types.php';

class MainController {
    private array $models = array();

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function register($model) {

    }
}


