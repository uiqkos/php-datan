<?php
include '2.php';
include 'index.html.php';
//include 'framework/model/Field.php';
MyModel::init();
get_index(MyModel::$fields);

Annotator
