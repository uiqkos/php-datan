<?php

include 'Field.php';

class IntegerField extends Field {
    public function __construct($constrains = array()) {
        parent::__construct('int', $constrains);
    }
}

class StringField extends Field {
    public function __construct($max_length=20, $constrains = array()) {
        parent::__construct(sprintf('varchar(%d)', $max_length), $constrains);
    }
}

class DateField extends Field {
    public function __construct($constrains = array()) {
        parent::__construct('date', $constrains);
    }
}

class Id extends IntegerField {
    public function __construct() {
        parent::__construct(['primary key', 'auto_increment']);
    }
}