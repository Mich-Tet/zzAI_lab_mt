<?php
require_once '../init.php';
use core\App;

$requestUri = $_SERVER['REQUEST_URI'];
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

if ($requestUri === $scriptPath . '/' || $requestUri === $scriptPath) {
    header("Location: " . App::getConf()->app_url . "/calc");
    exit();
}

include App::getConf()->root_path . App::getConf()->action_script;