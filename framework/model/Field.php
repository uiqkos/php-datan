<?php


class Field
{
    public string $type;
    public string $mysql_type;

    function __construct(string $type, string $mysql_name) {
        $this->mysql_type = $mysql_name;
        $this->type = $type;
    }

    public function __toString() {
        return "[$this->type]";
    }
}