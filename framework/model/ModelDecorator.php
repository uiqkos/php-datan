<?php


class ModelDecorator {
    private $model;
    private array $fields;
    private array $translated_field_names = array();
    private array $to_string_field_names = array();
    private array $foreign_keys = array();
    private ReflectionClass $r;

    /**
     * @throws ReflectionException
     */
    public function __construct($model) {
        $this->model = $model;

        $this->r = new ReflectionClass($model);

        $this->fields = array();
        foreach ($this->r->getProperties() as $property) {
            $annotations = self::parseAnnotations($property->getDocComment());
            $this->fields[$property->getName()] =
                match ($type = strval($property->getType())) {
                    '?int' => new Id(),
                    'int' => new IntegerField(),
                    'string' => new StringField($annotations['maxLength']),
                    'DateTime' => new DateField(),
                    default => throw new Exception("Cannot convert field: $type")
                };
            if (isset($annotations['ref'])) {
                $this->foreign_keys[$property->getName()] = $annotations['ref'];
            }
            if (isset($annotations['toString'])) {
                array_push($this->to_string_field_names, $property->getName());
            }
            if (isset($annotations['translated'])) {
                $this->translated_field_names[$property->getName()] = $annotations['translated'];
            } else {
                $this->translated_field_names[$property->getName()] = $property->getName();
            }
        }
    }

    public static function parseAnnotations(string $docComment): array {
        $annotations = [
            'maxLength' => 200,
            'onDelete' => 'cascade'
        ];
        $docs = explode(' ', $docComment);
        for ($i = 0; $i < sizeof($docs); $i++)  {
            if (str_starts_with($docs[$i], '@')) {
                match (substr($docs[$i], 1)) {
                    'ref' => $annotations['ref'] = ['key' => $docs[$i + 1]],
                    'applyToString' => $annotations['toString'] = true,
                    'onDelete' => $annotations['ref']['onDelete'] = $docs[$i + 1],
                    'translated' => $annotations['translated'] = $docs[$i + 1],
                    default => ''
                };
            }
        }
        return $annotations;
    }

    public function getFields(): array {
        return $this->fields;
    }

    public function getFieldsAsString(): array {
        return array_map('strval', $this->fields);
    }


    public function toStringArray(Model $object, $field_names = null): array {
        if (is_null($field_names))
            $field_names = $this->getFieldNames();
        return array_map(
            function ($field_name) use ($object) {
                if ($this->fields[$field_name] instanceof Id)
                    return $this->fields[$field_name]->toString($object->getId());
                return $this->fields[$field_name]->toString($object->$field_name);
            },
            $field_names
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
        )));

        if (isset($fields['id']))
            $o->setId($fields['id']);

        $o->toString = function () use ($o) {
            return $this->asString($o);
        };

        $o->getValues = function () use ($o) {
            return $this->toStringArray($o);
        };

        $o->getFieldNames = function () {
            return $this->getFieldNames();
        };

        $o->getTranslatedFieldNames = function () {
            return $this->getTranslatedFieldNames();
        };

        return $o;
    }

    public function toArray(Model $object): array {
        $arr = array();
        foreach ($this->getFieldNames() as $field_name) {
            $arr[$field_name] = $object->$field_name;
        }
        return $arr;
    }

    public function asString(Model $object): string {
        return join(', ', $this->toStringArray($object, $this->to_string_field_names));
    }

    /**
     * @return mixed
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @return array
     */
    public function getForeignKeys(): array {
        return $this->foreign_keys;
    }

    public function getTranslatedFieldNames() {
        return $this->translated_field_names;
    }
}