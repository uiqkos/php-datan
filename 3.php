<?php

require 'framework/model/ModelDecorator.php';


/**
 * @ref Lecturer
 * @toString
 */
function f() {

}

$r = new ReflectionFunction('f');
print $r->getDocComment();
$s = ModelDecorator::parseAnnotations($r->getDocComment());
var_dump($s);