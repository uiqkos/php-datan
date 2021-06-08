<?php


class Field
{
    var $type;
//    var $name;
    var $mysql_name;

    /**
     * Field constructor.
     * @param $type string
     */
    function __construct($type, $mysql_name) {
//        $this->name = $name;
        $this->mysql_name = $mysql_name;
        $this->type = $type;
    }
}