<?php


class Model
{
    var $field_names = array();
    /**
     * @var ReflectionClass
     */
    private $reflection;
    public $fields = array();

    function __construct() {
        $this->reflection = new ReflectionClass($this);
        foreach ($this->reflection->getProperties() as $property) {
            if ($property->getValue() instanceof Field) {
                $this->fields[$property->getName()] = $property->getValue();
            }
        }
    }
}