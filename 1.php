<?php

include 'framework/Repository.php';
include 'framework/DBConfig.php';
include 'framework/Controller.php';
include '2.php';

MyModel::init();

$repo = new Repository(
    (new DBConfig())
        ->setHostname('localhost')
        ->setUsername('root')
        ->setPassword('1234')
        ->setDatabase('mydb'),
    MyModel::class
);

$controller = new MyModelController(
    $repo
);

print $repo->save(new MyModel('Faker', 15, new DateTime('now')));
