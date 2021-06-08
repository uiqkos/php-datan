<?php

class IntegerField extends Field {
    public function __construct($max_length=20) {
        parent::__construct('int', sprintf('int(%i)', $max_length));
    }
}

class StringField extends Field {
    public function __construct($max_length=20) {
        parent::__construct('string', sprintf('varchar(%i)', $max_length));
    }
}

class DateField extends Field {
    public function __construct() {
        parent::__construct('date', 'date');
    }
}