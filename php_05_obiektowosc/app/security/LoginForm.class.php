<?php
class LoginForm {
    public $login;
    public $pass;

    public function __construct($login = null, $pass = null) {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function fromRequest() {
        return new LoginForm(
            isset($_POST['login']) ? trim($_POST['login']) : null,
            isset($_POST['pass']) ? trim($_POST['pass']) : null
        );
    }
}
