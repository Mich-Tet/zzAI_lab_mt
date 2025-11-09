<?php
require_once dirname(__FILE__) . '/../../config.php';
//inicjacja mechanizmu sesji
session_start();

//pobranie roli
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

//jeśli brak parametru (niezalogowanie) to idź na stronę logowania
if (empty($role)) {
	include _ROOT_PATH . '/app/security/login.php';
	//zatrzymaj dalsze przetwarzanie skryptów
	exit();
}

// if this page requires admin and user is not admin -> 403
if (isset($requireAdmin) && $requireAdmin === true && $role !== 'admin') {
	http_response_code(403);
	include _ROOT_PATH . '/app/security/forbidden.php';
	exit();
}