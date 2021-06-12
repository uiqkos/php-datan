<?php

include "framework/MainController.php";

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
$a = new A(1, '2');
$a->toString = function () use ($a) {
    return "$a->a";
};

print $a->toString();