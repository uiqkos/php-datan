<?php

interface Model {
    public static function getFields(): Fields;
    public static function fromFields(array $fields): Model;
    public function getValues();
}