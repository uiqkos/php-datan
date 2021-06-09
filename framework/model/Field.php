<?php


class Field
{
    public string $type;
    public string $mysql_type;
    public array $constrains;

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getMysqlType(): string {
        return $this->mysql_type;
    }

    /**
     * @param string $mysql_type
     */
    public function setMysqlType(string $mysql_type): void {
        $this->mysql_type = $mysql_type;
    }

    /**
     * @return array
     */
    public function getConstrains(): array {
        return $this->constrains;
    }

    /**
     * @param array $constrains
     */
    public function setConstrains(array $constrains): void {
        $this->constrains = $constrains;
    }

    function __construct(string $type, string $mysql_name, array $constrains = array()) {
        $this->mysql_type = $mysql_name;
        $this->type = $type;
        $this->constrains = $constrains;
    }

    public function __toString() {
        return "[$this->type]";
    }
}