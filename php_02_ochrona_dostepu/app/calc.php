<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

include _ROOT_PATH . '/app/security/check.php';

// 1. pobranie parametrów


function getParams(&$amount, &$years, &$rate)
{
	$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
	$years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
	$rate = isset($_REQUEST['rate']) ? $_REQUEST['rate'] : null;
}
// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku


function validate(&$amount, &$years, &$rate, &$messages)
{
	// sprawdzenie, czy parametry zostały przekazane
	if (!(isset($amount) && isset($years) && isset($rate))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ($amount == "") {
		$messages[] = 'Nie podano kwoty';
	}
	if ($years == "") {
		$messages[] = 'Nie podano liczby lat';
	}
	if ($rate == "") {
		$messages[] = 'Nie podano oprocentowania';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (!empty($messages)) {
		return false;
	}
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (!is_numeric($amount)) {
		$messages[] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}

	if (!is_numeric($years)) {
		$messages[] = 'Druga wartość nie jest liczbą całkowitą';
	}

	if (!is_numeric($rate)) {
		$messages[] = 'Druga wartość nie jest liczbą całkowitą';
	}

	return true;
}
// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$amount, &$years, &$rate, &$messages, &$result)
{
	if (empty($messages)) {

		//konwersja parametrów na int
		$amount = intval($amount);
		$years = intval($years);
		$ratePercentage = floatval($rate) * 0.01;

		$monthlyRate = floatval($ratePercentage) / 12;

		$numberOfInstallments = $years * 12;

		$calculated = $amount * ($monthlyRate * pow(1 + $monthlyRate, $numberOfInstallments) / (pow(1 + $monthlyRate, $numberOfInstallments) - 1));

		$monthly = round($calculated, 2);

		$result = $monthly;
	}

}

$amount = null;
$years = null;
$rate = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($amount, $years, $rate);
if (validate($amount, $years, $rate, $messages)) { // gdy brak błędów
	process($amount, $years, $rate, $messages, $result);
}


include 'calc_view.php';