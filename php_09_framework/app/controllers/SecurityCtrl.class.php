<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\Message;
use core\Messages;
use core\RoleUtils;
use app\model\LoginForm;

class SecurityCtrl {
    private $form;
    private $messages;

    public function __construct() {
        $this->messages = new Messages();
        $this->form = LoginForm::fromRequest();
    }

    public function action_login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($this->form->login)) {
                $this->messages->addMessage(new Message('Nie podano loginu', Message::ERROR));
            }
            if (empty($this->form->pass)) {
                $this->messages->addMessage(new Message('Nie podano hasła', Message::ERROR));
            }

           if ($this->messages->isEmpty()) {
                if ($this->form->login === 'admin1' && $this->form->pass === 'admin1') {
                    $this->loginUser('admin');
                    App::getRouter()->redirectTo('calc');
                    return;
                } elseif ($this->form->login === 'user1' && $this->form->pass === 'user1') {
                    $this->loginUser('user');
                    App::getRouter()->redirectTo('calc');
                    return;
                } else {
                    $this->messages->addMessage(new Message('Niepoprawny login lub hasło', Message::ERROR));
                }
            }
        }

        $this->generateLoginView();
    }

    private function loginUser($role) {
        $_SESSION['role'] = $role;
        $_SESSION['_amelia_roles'] = serialize([$role => true]);
        App::getConf()->roles = [$role => true];
    }

    private function generateLoginView() {
        $form = $this->form;
        $messages = $this->messages; 
        $conf = App::getConf();
    
        require_once App::getConf()->root_path . '/app/views/LoginView.php';
    }

    public function action_logout() {
        session_destroy();
        App::getConf()->roles = [];
        App::getRouter()->redirectTo('login');
    }

    public function action_secured() {
        if (!RoleUtils::inRole('admin')) {
            require_once App::getConf()->root_path . '/app/views/ForbiddenView.php';
            return;
        }
        
        require_once App::getConf()->root_path . '/app/views/SecuredPageView.php';
    }
}