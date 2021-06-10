<?php

include "framework/MainController.php";

MainController::register(Testable::class);
print Testable::fromArray([
    'id' => 221, 'name' => 'mishka'
]);