<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Logowanie</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>

<body
	style="background-color:#222; color:#ddd; display:flex; justify-content:center; align-items:center; height:100vh;">


	<form action="<?php print (_APP_ROOT); ?>/app/security/login.php" method="post" class="pure-form pure-form-stacked"
		style="background-color:#fff; color:#111; padding:2em; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3); width:300px;">
		<legend>Logowanie</legend>
		<fieldset>
			<label for="id_login">login: </label>
			<input class="pure-input-1" id="id_login" type="text" name="login" value="<?php out($form['login']); ?>" />
			<label for="id_pass">pass: </label>
			<input class="pure-input-1" id="id_pass" type="password" name="pass" />

			<button type="submit" class="pure-button pure-button-primary">Zaloguj</button>
		</fieldset>


		<?php if (isset($messages) && count($messages) > 0): ?>
			<ul class="pure-form-message" style="margin-top:1em; color:#b00;">
				<?php foreach ($messages as $msg): ?>
					<li><?php echo $msg; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</form>
</body>

</html>