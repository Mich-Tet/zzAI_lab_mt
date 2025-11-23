<?php
require_once dirname(__FILE__) . '/../config.php';
//ochrona widoku
$requireAdmin = true;
include $conf->root_path.'/app/security/check.php';
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Chroniona strona</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css">
</head>

<body
	style="background-color:#222; color:#ddd; display:flex; flex-direction:column; align-items:center; justify-content:center; height:100vh;">
	<div
		style="background-color:#fff; color:#111; padding:2em; border-radius:10px; text-align:center; width:400px; box-shadow:0 0 10px rgba(0,0,0,0.3);">
		<img src="<?php print ($conf->app_root); ?>/app/Under_construction.jpg" alt="Under_construction"
			style="max-width:100%; border-radius:8px; margin-bottom:1em;">
		<div style="width:90%; margin: 2em auto;">
			<p>To jest inna chroniona strona aplikacji internetowej</p>
		</div>
		<div style="margin-top:1em;">
			<a href="<?php print ($conf->app_root); ?>/app/calc.php" class="pure-button">Powrót do kalkulatora</a>
			<a href="<?php print ($conf->app_root); ?>/app/security/logout.php"
				class="pure-button pure-button-active">Wyloguj</a>
		</div>
	</div>

</body>

</html>