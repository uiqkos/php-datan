<?php

//include "framework/MainController.php";

//MainController::register(Testable::class);
//print Testable::fromArray([
//    'id' => 221, 'name' => 'mishka'
//]);

//require '4.php';
//
//$r = new ReflectionClass(A::class);
//
//foreach ($r->getProperties() as $property) {
//    print strval($property->getType());
//}
require '4.php';

$a = new A(2);

$method = function () {
    return "sdfdfsdf";
};

function bind($obj, $method) {
    $obj->toString = $method;
    return $obj;
}
bind($a, $method);

$method = function () {
    return "keka";
};
bind($a, $method);
print $a;
