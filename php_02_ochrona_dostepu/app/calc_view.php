<?php ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
	<meta charset="utf-8" />
	<title>Kalkulator kredytów</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css">
</head>

<body>

	<body
		style="background-color:#222; color:#ddd; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh;">
		<div
			style="background-color:#fff; color:#111; padding:2em; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3); width:400px;">
			<div style="text-align:center; margin-bottom:1em;">
				<a href="<?php print (_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona
					strona</a>
				<a href="<?php print (_APP_ROOT); ?>/app/security/logout.php"
					class="pure-button pure-button-active">Wyloguj</a>
			</div>

			<form action="<?php print (_APP_URL); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
				<legend style="text-align:center; margin-bottom:1em;" for="id_amount">Kalkulator: </legend>
				<label for="id_amount">Kwota: </label>
				<input id="id_amount" type="text" name="amount" value="<?php if (isset($amount))
					print ($amount); ?>" /><br />

				<label for="id_years">Ilość lat: </label>
				<input id="id_years" type="text" name="years" value="<?php if (isset($years))
					print ($years); ?>" /><br />

				<label for="id_rate">Oprocentowanie: </label>
				<div class="pure-g">
					<div class="pure-u-3-4">
						<input id="id_rate" type="text" name="rate" value="<?php if (isset($rate))
							print ($rate); ?>">
					</div>
					<div class="pure-u-1-4" style="text-align:center; line-height:2.2em;">%</div>
				</div>
				<button type="submit" class="pure-button pure-button-primary"
					style="width:100%; margin-top:1em;">Oblicz</button>
			</form>
			<?php if (isset($messages) && count($messages) > 0): ?>
				<ul class="pure-form-message" style="margin-top:1em; color:#b00;">
					<?php foreach ($messages as $msg): ?>
						<li><?php echo $msg; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if (isset($result)) { ?>
				<div style="margin-top:1em; padding:10px; border-radius:5px; background-color:#eef; color:#111;">
					<?php
					echo 'Miesięczna rata: ' . number_format($result, 2) . ' PLN<br>';
					?>
				</div>
			<?php } ?>
		</div>
	</body>

</html>