<?php
require_once dirname(__DIR__, 2) . '/config.php';
use core\Utils;
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Brak dostępu</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css">
    <style>
        /* tiny inline to make the page usable; remove if you prefer a shared header */
        body {
            background: #222;
            color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            color: #111;
            padding: 2rem;
            border-radius: 8px;
            width: 420px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        }

        .actions {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>403 — Brak dostępu</h2>
        <p>Nie masz uprawnień do przeglądania tej strony. Tylko użytkownik z rolą <strong>admin</strong> może uzyskać
            dostęp.</p>
        <div class="actions">
            <a href="<?php echo htmlspecialchars(Utils::relURL('calc')); ?>" class="pure-button">Wróć do kalkulatora</a>
            <a href="<?php echo htmlspecialchars(Utils::relURL('logout')); ?>" class="pure-button pure-button-active">Wyloguj</a>
        </div>
    </div>
</body>

</html>