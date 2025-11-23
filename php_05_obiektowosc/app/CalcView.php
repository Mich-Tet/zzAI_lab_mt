<?php
require_once dirname(__DIR__).'/config.php';
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Kalkulator</title>
  <link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css">
</head>
<body style="background:#222;color:#ddd;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;min-height:100vh; padding-top:2rem;">

  <div style="background:#fff;color:#111;padding:2rem;border-radius:8px;width:360px;">
    <span>Zalogowany jako: <strong><?php echo htmlspecialchars($role); ?></strong></span>
    <div style="padding-block:1rem">
      <a href="<?php print ($conf->app_root); ?>/app/SecuredPageView.php" class="pure-button">Inna strona</a>
      <a href="<?php print ($conf->app_root); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
    </div>
    <form method="post" class="pure-form pure-form-stacked">
      <label>Kwota</label>
      <input name="amount" value="<?php echo htmlspecialchars($form->amount ?? ''); ?>">
      <label>Ilość lat</label>
      <input name="years" value="<?php echo htmlspecialchars($form->years ?? ''); ?>">
      <label>Oprocentowanie (%)</label>
      <input name="rate" value="<?php echo htmlspecialchars($form->rate ?? ''); ?>">
      <button class="pure-button pure-button-primary" type="submit" style="width:100%;margin-top:1rem;">Oblicz</button>
    </form>

    <?php if (!empty($messages)): ?>
      <ul style="color:#b00;margin-top:1rem;">
        <?php foreach ($messages as $m): ?><li><?php echo htmlspecialchars($m); ?></li><?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($result->monthlyPayment)): ?>
      <div style="margin-top:1rem;padding:10px;background:#eef;color:#111;border-radius:6px;">
        Miesięczna rata: <?php echo number_format($result->monthlyPayment, 2); ?> PLN
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
