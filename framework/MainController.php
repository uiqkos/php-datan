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
        $r = new ReflectionClass($model);
        $properties = $r->getProperties();
        $fields = array_map(
            function (ReflectionProperty $property) {
                if ($property->getType() == 'int' and $property->getName() == 'id')
                    return new Id();
                if ($property->getType() == 'int')
                    return new IntegerField();
                if ($property->getType() == 'string')
                    return new StringField(200);
                if ($property->getType() == 'DateTime')
                    return new DateField();
                throw new Exception("Cannot convert field");
            },
            $properties
        );
        $model::$fields = $fields;
        $model::$fromArray = function (array $values) use ($model, $properties) {
            new $model(array_map(
                function ($property) use ($values) {
                    return $values[$property->getName()];
                },
                $properties
            ));
        };
    }
}


