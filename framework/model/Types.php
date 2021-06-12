<?php

include 'Field.php';

class IntegerField extends Field {
    public function __construct($constrains = array()) {
        parent::__construct('int', $constrains);
    }

    public function toString($value): string {
        return strval($value);
    }

    public function parse(string $value): int {
        return intval($value);
    }
}

class StringField extends Field {
    public function __construct($max_length=20, $constrains = array()) {
        parent::__construct(sprintf('varchar(%d)', $max_length), $constrains);
    }

    public function toString($value): string {
        return $value;
    }

    public function toMySql($value): string {
        return "'$value'";
    }

    public function parse(string $value): string {
        return $value;
    }
}

class DateField extends Field {
    public function __construct($constrains = array()) {
        parent::__construct('date', $constrains);
    }

    public function toString($value): string {
        return $value->format('Y-m-d');
    }

    public function toMySql($value): string {
        return sprintf("'%s'", $this->toString($value));
    }

    public function parse(string $value): DateTime|bool {
        return DateTime::createFromFormat('Y-m-d', $value);
    }
}

class Id extends IntegerField {
    public function __construct() {
        parent::__construct(['primary key', 'auto_increment']);
    }

    public function toString($value): string {
        if (is_null($value))
            return 'null';
        return parent::toString($value);
    }
}