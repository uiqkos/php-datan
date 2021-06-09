<?php

include 'Field.php';

class IntegerField extends Field {
    public function __construct($max_length=20, $constrains = array()) {
        parent::__construct('int', sprintf('int(%d)', $max_length), $constrains);
    }
}

class StringField extends Field {
    public function __construct($max_length=20, $constrains = array()) {
        parent::__construct('string', sprintf('varchar(%d)', $max_length), $constrains);
    }
}

class DateField extends Field {
    public function __construct($constrains = array()) {
        parent::__construct('date', 'date', $constrains);
    }
}

class Id extends IntegerField {
    public function __construct($max_length=20) {
        parent::__construct($max_length, ['primary key', 'autoincrement']);
    }
}