<?php

include "framework/model/Types.php";

class MyModel extends Model {
    public static $Name;
    public static $Age;
    public static $BirthDate;

    public $name;
    public $age;
    public $birth_date;

    static function init() {
        self::$Name = new StringField();
        self::$Age = new IntegerField();
        self::$BirthDate = new DateField();
    }

    /**
     * MyModel constructor.
     * @param $name string
     * @param $age int
     * @param $birth_date DateTime
     */
    public function __construct($name, $age, $birth_date) {
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
    }
}