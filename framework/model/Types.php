<?php

include 'Field.php';

class IntegerField extends Field {
    public function __construct($max_length=20) {
        parent::__construct('int', sprintf('int(%d)', $max_length));
    }
}

class StringField extends Field {
    public function __construct($max_length=20) {
        parent::__construct('string', sprintf('varchar(%d)', $max_length));
    }
}

class DateField extends Field {
    public function __construct() {
        parent::__construct('date', 'date');
    }
}