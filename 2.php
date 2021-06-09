<?php

include "framework/model/Types.php";
include "framework/model/Model.php";

class MyModel extends Model {
    public string $name;
    public int $age;
    public DateTime $birth_date;

    private static array $fields = array();
    private static array $field_names = ['name', 'age', 'birth_date'];

    static function init() {
        self::$fields['name']       = new StringField();
        self::$fields['age']        = new IntegerField();
        self::$fields['birth_date'] = new DateField();
    }

    public function __construct(string $name, int $age, DateTime $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }
    public static function getFields(): array {
        return self::$fields;
    }
    public static function getFieldNames(): array {
        return self::$field_names;
    }

    public static function getTableName(): string {
        return 'my_table';
    }
}