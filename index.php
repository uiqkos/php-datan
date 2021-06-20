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

$lecturer_controller = new Controller(
    new Repository(
        $config, Lecturer::class
    )
);

$car_controller = new Controller(
    new Repository(
        $config, Car::class
    )
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['redirect'])) {
        $redirect = $_POST['redirect'];
        $_POST = array_diff_key($_POST, ['redirect' => 0]);
        SuperRouter::getInstance()->post($_SERVER['REQUEST_URI'], array_merge($_GET, $_POST), $redirect);
    } else {
        SuperRouter::getInstance()->post($_SERVER['REQUEST_URI'], array_merge($_GET, $_POST));
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    SuperRouter::getInstance()->get($_SERVER['REQUEST_URI'], $_GET);
}
