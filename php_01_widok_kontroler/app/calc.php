<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__) . '/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
$years = isset($_REQUEST['years']) ? $_REQUEST['years'] : '';
$rate = isset($_REQUEST['rate']) ? $_REQUEST['rate'] : '';

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if (!(isset($amount) && isset($years) && isset($rate))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
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
if (empty($messages)) {

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
}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty($messages)) { // gdy brak błędów

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

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';