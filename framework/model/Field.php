<?php


abstract class Field
{
    public string $mysql_type;
    public array $constrains;

    public abstract function toString($value): string;
    public abstract function parse(string $value);

    public function toMySql($value): string {
        return $this->toString($value);
    }

    public function getMysqlType(): string {
        return $this->mysql_type;
    }

    public function setMysqlType(string $mysql_type): Field {
        $this->mysql_type = $mysql_type;
        return $this;
    }

    public function getConstrains(): array {
        return $this->constrains;
    }

    public function setConstrains(array $constrains): Field {
        $this->constrains = $constrains;
        return $this;
    }

    function __construct(string $mysql_name, array $constrains = array()) {
        $this->mysql_type = $mysql_name;
        $this->constrains = $constrains;
    }

    public function __toString() {
        $constrains = join(' ', $this->constrains);
        return "$this->mysql_type $constrains";
    }
}