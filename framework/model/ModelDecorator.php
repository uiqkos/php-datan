<?php


class ModelDecorator {
    private $model;
    private array $fields;
    private ReflectionClass $r;

    /**
     * @throws ReflectionException
     */
    public function __construct($model) {
        $this->model = $model;

        $this->r = new ReflectionClass($model);

        $this->fields = array();

        foreach ($this->r->getProperties() as $property) {
            $this->fields[$property->getName()] =
                match ($strtype = strval($property->getType())) {
                    '?int' => new Id(),
                    'int' => new IntegerField(),
                    'string' => new StringField(200),
                    'DateTime' => new DateField(),
                    default => throw new \Exception("Cannot convert field: $strtype")
                };
        }
    }

    public function getFields(): array {
        return $this->fields;
    }

    public function getFieldsAsString(): array {
        return array_map('strval', $this->fields);
    }

    public function getFieldNamesWithout($constrain): array {
        return array_keys(array_filter(
            $this->fields,
            function (Field $field) use ($constrain) {
                return !in_array(
                    $constrain,
                    $field->getConstrains()
                );
            }
        ));
    }

    public function parseValues(Model $object): array {
        return array_map(
            function (Field $field, $field_name) use ($object) {
                if ($field instanceof Id)
                    return $field->toString($object->getId());
                return $field->toString($object->$field_name);
            },
            $this->getFields(),
            $this->getFieldNames()
        );
    }

    public function parseValuesToMySql(Model $object): array {
        return array_map(
            function (Field $field, $field_name) use ($object) {
                if ($field instanceof Id)
                    return $field->toMySql($object->getId());
                return $field->toMySql($object->$field_name);
            },
            $this->getFields(),
            $this->getFieldNames()
        );
    }

    public function getFieldNames(): array {
        return array_keys($this->fields);
    }

    public function fromArray(array $fields) {
        $o = (new $this->model(...array_map(
            function ($field_name) use ($fields) {
                return $this->fields[$field_name]->parse($fields[$field_name]);
            },
            array_filter(
                $this->getFieldNames(),
                function ($s) {
                    return $s != 'id';
                }
            )
        )))->setId($fields['id']);
        $o->toString = function () use ($o) {
            return $this->asString($o);
        };
        return $o;
    }

    public function asString(Model $object): string {
        return join(', ', $this->parseValues($object));
    }
}