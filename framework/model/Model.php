<?php


interface Model extends Initialized {
    public static function getFields(): array;
    public static function getFieldNames(): array;
    public static function fromFields(array $fields): Model;
}

abstract class DBModel implements Model {
    private static mysqli $connection;
    private static DBConfig $config;

    /**
     * @param DBConfig $config
     */
    public static function setConfig(DBConfig $config): void {
        self::$config = $config;
    }

    public static function init() {
        self::$connection = new mysqli(
            self::$config->hostname,
            self::$config->username,
            self::$config->password,
            self::$config->database
        );
    }

    public static function all() {
        $query = self::$connection->query("select * from ".self::getTableName());
    }
    public static function details(int $id) {

    }
    public static function update(Model $object) {

    }
    public static function create(Model $object) {

    }
    public static function delete(int $id) {

    }
    public abstract function getTableName(): string;

}