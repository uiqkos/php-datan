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

print $repo->create(new MyModel('Misha', 13, new DateTime('now')));
//print $repo->findById(2);
print join(' ', $repo->findAll());
print $repo->delete(1);
print join(' ', $repo->findAll());
