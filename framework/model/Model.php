<?php


interface Model {
    public static function getFields(): array;
    public static function getValues(): array;
    public static function getFieldNames(): array;
    public static function getIdName(): string;
    public static function fromFields(array $fields): Model;
}