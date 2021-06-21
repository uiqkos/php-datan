<?php


require "LoginView.php";

class UserController extends Controller {
    public function __construct(Repository $repository, string $prefix = null) {
        parent::__construct($repository, $prefix);
        SuperRouter::getInstance()->bind('/login', [$this, 'login'], 'post');
        SuperRouter::getInstance()->bind('/login', [$this, 'loginView'], 'get');
    }

    public static function getCurrentUserId(): int {
        if (isset($_COOKIE['user_id'])) {
            return intval($_COOKIE['user_id']);
        }
        throw new Exception("Пользователь не войден");
    }

    public function login(int $id, string $password) {
        if ($password == parent::getRepository()->findById($id)->password)
            setcookie('user_id', $id, time() + 3600);
        else throw new Exception("Неверный пароль или id пользователя");
    }

    public function loginView() {
        head("Login");
        blockBegin();
        LoginView();
        blockEnd();
    }
}