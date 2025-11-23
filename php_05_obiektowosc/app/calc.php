<?php
require_once __DIR__ . '/../Config.class.php'; 
require_once __DIR__ . '/CalcCtrl.class.php';

require_once __DIR__.'/security/check.php';

$ctrl = new CalcCtrl();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->process();
}

$form = $ctrl->getForm();
$result = $ctrl->getResult();
$messages = $ctrl->getMessages()->getAll();

include __DIR__ . '/CalcView.php';
