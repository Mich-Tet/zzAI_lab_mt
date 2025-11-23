<?php
require_once dirname(__DIR__, 2).'/config.php';
require_once __DIR__.'/LoginForm.class.php';
require_once __DIR__.'/../lib/Messages.class.php';

session_start();

$form = LoginForm::fromRequest();
$messages = new Messages();

// jeśli metoda POST -> próbujemy zalogować
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // prosta walidacja
    if (empty($form->login)) $messages->add('Nie podano loginu');
    if (empty($form->pass)) $messages->add('Nie podano hasła');

    if ($messages->isEmpty()) {
        if ($form->login === 'admin1' && $form->pass === 'admin1') {
            $_SESSION['role'] = 'admin';
            header("Location: ".$conf->app_url."/app/calc.php");
            exit();
        } elseif ($form->login === 'user1' && $form->pass === 'user1') {
            $_SESSION['role'] = 'user';
            header("Location: ".$conf->app_url."/app/calc.php");
            exit();
        } else {
            $messages->add('Niepoprawny login lub hasło');
        }
    }
}

include __DIR__.'/LoginView.php';
