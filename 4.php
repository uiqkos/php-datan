<?php


require '2.php';
require 'framework/DBConfig.php';
require 'framework/Repository.php';

$config = new DBConfig(
    'localhost',
    'root',
    '1234',
    'mydb'
);

$c = new Repository(
    $config,
    Lecturer::class
);

$c->create(
    new Lecturer(
        'Vasya',
        12,
        new DateTime(),
        2,
        '23',
        '23',
        '23'
    )
);