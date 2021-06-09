<?php


class Field
{
    public string $type;
    public string $mysql_type;
    public array $constrains;

    function __construct(string $type, string $mysql_name, array $constrains = array()) {
        $this->mysql_type = $mysql_name;
        $this->type = $type;
        $this->constrains = $constrains;
    }

    public function __toString() {
        return "[$this->type]";
    }
}