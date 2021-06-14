<?php

include "2.php";
include "framework/Repository.php";
include "framework/DBConfig.php";
include "framework/Router.php";

/**
 * @Config
 */

$config = new DBConfig(
    'localhost',
    'root',
    '1234',
    'mydb'
);

/**
 * @Controller
 */

//$mycontroller = new MyModelController($config, MyModel::class);
$lecturercont = new LecturerController($config, Lecturer::class);

/**
 * @Routes
 */

//Router::getInstance()->bind(
//    '/mymodel/list', array($mycontroller, 'all'), 'get');
Router::getInstance()->bind(
    '/lecturer/peka/list', array($lecturercont, 'all'), 'get');

Router::getInstance()->bind(
    '/lecturer/peka/add', function () use ($lecturercont) {
        $lecturercont->getRepository()->create(
            new Lecturer(
                'Vasya Puppkien',
                14,
                new DateTime('now'),
                10,
                'Chemistry',
                'a300bc',
                'Ulitsa pushkina dom kalatushkina 10'
            ));
}, 'get');

Router::getInstance()->get($_SERVER['REQUEST_URI']);

//Router::getInstance()->prefix()
