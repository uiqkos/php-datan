<?php


class Fields {
    private array $fields = array();

    public function add(string $name, Field $field) {
        $this->fields[$name] = $field;
        return $this;
    }

    public function getFieldNames() {
        return array_keys($this->fields);
    }

    public function getFieldNamesWithoutAutoInc() {
        return array_keys(
            array_filter(
                $this->fields,
                function (Field $field) {
                    return !in_array(
                        'auto_increment',
                        $field->getConstrains()
                    );
                }
            )
        );
    }

    public function getMySqlTypes() {
        return array_map(
            function ($field) {
                return $field->getMySqlType();
            },
            $this->fields
        );
    }

    public function getFieldValues() {
        return array_values($this->fields);
    }

    public static function fromFields(...$fields) {
        $new = new Fields();
        $new->fields = $fields;
        return $new;
    }
}