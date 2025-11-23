<?php
use core\App;
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Logowanie</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css">
</head>
<body style="background-color:#222; color:#ddd; display:flex; justify-content:center; align-items:center; height:100vh;">

<form action="<?php echo App::getConf()->app_url; ?>/login" method="post" class="pure-form pure-form-stacked"
    style="background-color:#fff; color:#111; padding:2em; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3); width:300px;">
    <legend>Logowanie</legend>
    <fieldset>
        <label for="id_login">Login:</label>
        <input class="pure-input-1" id="id_login" type="text" name="login" value="<?php echo htmlspecialchars($form->login ?? ''); ?>">
        <label for="id_pass">Hasło:</label>
        <input class="pure-input-1" id="id_pass" type="password" name="pass">
        <button type="submit" class="pure-button pure-button-primary">Zaloguj</button>
    </fieldset>

    <?php if (isset($messages) && !$messages->isEmpty()): ?>
        <ul class="pure-form-message" style="margin-top:1em; color:#b00;">
            <?php foreach ($messages->getMessages() as $msg): ?>
                <li><?php echo htmlspecialchars(is_object($msg) ? ($msg->text ?? (string)$msg) : $msg); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</form>
</body>
</html>