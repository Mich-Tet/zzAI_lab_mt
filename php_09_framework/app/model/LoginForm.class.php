<?php
namespace app\model;
class LoginForm {
    public $login;
    public $pass;

    public function __construct($login = null, $pass = null) {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function fromRequest(){
        return new LoginForm($_POST['login'] ?? null, $_POST['pass'] ?? null);
    }
}
