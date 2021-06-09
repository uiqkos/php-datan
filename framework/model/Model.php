<?php

interface Model {
    public static function getFields(): Fields;
    public static function getIdName(): string;
    public static function fromFields(array $fields): Model;
}