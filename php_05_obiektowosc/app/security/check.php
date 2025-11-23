<?php
require_once dirname(__DIR__, 2).'/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['role'])) {
    header("Location: ".$conf->app_url."/app/security/login.php");
    exit();
}

if (isset($requireAdmin) && $requireAdmin === true && ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: ".$conf->app_url."/app/security/ForbiddenView.php");
    exit();
}
