<?php

include "framework/Repository.php";
include "framework/DBConfig.php";
include "framework/Router.php";
include "framework/Controller.php";
include "framework/view/home.php";

require "datan/models.php";
require "datan/DatasetController.php";

/**
 * @Config
 */

$config = new DBConfig(
    'localhost',
    'root',
    '1234',
    'datan'
);

/*
 * @Controllers
 */


$user_controller = new Controller(
    new Repository(
        $config, User::class
    )
);

$dataset_repository = new Repository(
    $config, Dataset::class
);


$comment_controller = new Controller(
    new Repository(
        $config, Comment::class
    )
);

$like_controller = new Controller(
    new Repository(
        $config, Like::class
    )
);

$dataset_controller = new DatasetController(
    $dataset_repository, $comment_controller, $like_controller
);

$controllers = [
    $user_controller,
    $dataset_controller,
    $comment_controller,
    $like_controller
];

SuperRouter::getInstance()->bind(
    '',
    function () use ($controllers) {
        HomeView($controllers);
    },
    'get'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
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
