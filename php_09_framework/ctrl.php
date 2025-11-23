<?php
use core\App;

require_once 'init.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// INICJALIZACJA RÓL - DODAJ TEN FRAGMENT
if (empty($_SESSION['_amelia_roles'])) {
    $_SESSION['role'] = 'guest'; // dla kompatybilności wstecznej
    $_SESSION['_amelia_roles'] = serialize(['guest' => true]);
    \core\App::getConf()->roles = ['guest' => true];
}

// Witamy we frameworku Amelia !
// Framework zamyka ostatecznie wszystko to, co było wprowadzone do tej pory, dodatkowo wprowadzając ułatwienia i rozszerzenia.

// 1. Uporządkowano globalne funkcje likwidując je i umieszczając ich odpowiedniki (te same nazwy) w specjalnych, dedykowanych klasach jako
//    metody statyczne. Znika zatem skrypt functions.php oraz definicje funkcji w skrypcie init.php.
//    W zamian funkcje dostępowe do głównych obiektów (Config, Messages, Router, ClassLoader, Smarty, DB) umieszczono w nowej klasie App.
//    Klasa ta reprezentuje aplikację/system. Inicjalizacja systemu odbywa się też za pomocą odpowiedniej metody tejże klasy. Wszstko nadal inicjuje
//	  skrypt init.php. A więc idea wprowadzona wcześniej się nie zmienia.
//	  Zatem aby uzyskać instancję obiektu Messages należy wywołać App::getMessages(), a router za pomocą App::getRouter() itd. (getConf,getSmarty
//    getDB ...)
//
//    Dodatkowe klasy pomocnicze:
//    - RoleUtils: zawiera metody addRole, inRole ...
//    - ParamUtils: zawiera metody pobierające parametry z żądania i sesji, takie jak getFromRequest, getFromGET, getFromPOST ...
//    - SessionUtils: metody ułatwiające zapis i pobieranie danych z sesji (również zapis Messages i dowolnych obiektów)
//    - Utils: zawiera metody upraszaczjące dodawanie komunikatów (Messages) i ścieżek do routera, również generowanie linków
//
//    Pogrupowanie tych funkcji w klasy optymalizuje ładowanie przez autoloader tylko potrzebnych, używanych w danym momencie funkcjonalności
//    (skrypt functions.php był ładowany zawsze). Poza tym środowisko programistyczne precyzyjniej podpowiada składnię.
//    Naturalnie wszystkie nowe klasy umieszczono jak inne klasy frameworka w przestrzeni nazw '\core'.
//
// 2. Podejście wprowadza nowy podfolder 'public', w którym umieszcza się wszystkie zasoby publiczne (jak pliki css, grafiki, js - JavaScript)
//    Tak profesjonalne rozwiązania pozwalają "podpiąć" domenę bezposrednio do takiego folderu. Wtedy reszta zasobów systemu jest niedostępna
//    z poziomu przeglądarki (przeglądarka "widzi" jedynie zawartość 'public').
//    Plik index.php umieszczony w tym podfolderze kieruje żądanie na kontroler główny, zatem dotychczasowa idea przetwarzania żądań się nie zmienia.
//
// 3. Ostatnią ważną zmianą jest zaimplementowanie "przyjaznych linków" (ang. "pretty urls", "clean urls", "friendly urls"), co nie jest niczym
//    innym jak ukrywaniem "brzydkich" parametrów w URLu w ramach przyjętej konwencji.
//    
//    Przykład:  zamiast http://www.domena.pl/index.php?action=main&name=ala&age=15
//    można stworzyć rozwiązanie przyjmujące tę samą liczbę parametrów przekazanych w ten sposób:
//                       http://www.domena.pl/main/ala/15
//
//    We frameworku Amelia problem rozwiązuje się poprzez przekierowanie każdego żądania na kontroler główny, a inicjacja systemu sama pobiera
//    te parametry z URLa do specjalnej tablicy. Parametry są dostępne za pomocą metod: ParamUtils::getFromCleanURL(...) lub przez obiekt walidatora.
//    Przekierowanie każdego żądania (poza odwołaniami do istniejących plików, jak .css i inne dla przeglądarki) osiągnięto poprzez konfigurację
//    serwera Apache dla aplikacji w pliku '.htaccess'
//
//    Przesyłanie dodatkowych parametrów metodą GET jest dalej możliwe, np: http://www.domena.pl/main/ala/15?param1=xxx&param2=yyy
//    Dla domyślnie skonfigurowanych 'clean urls' we frameworku pierwsza pozycja jest akcją (pozycja o nr 0), a następne mają kolejne numery 1,2,3...
//
// 4. Dodatkowo dodano narzędzie walidatora (klasa Validator) znacznie ułątwiające proces pobrania i walidacji parametrów. Użycie zostanie
//    zaprezentowane w kolejnych projektach
//
// 5. Ostatnią drobną funkcjonalność stanowią dwa skrypty 'onload_db.php' oraz 'onload_smarty.php', umieszczone w folderze 'app'. Jak nazwy tych
//    skryptów wskazują, są one uruchamiane jednorazowo w momencie ładowania silnika Smarty oraz odpowiednio bazy danych (Medoo) - czyli pierwszego
//    wywołania metody 'App::getSmarty()' lub odpowiednio 'App::getDB()'.
//    Daje to możliowość dodania swojego kodu, który powienien być zawsze wykonany po załadowaniu tychże obiektów. Przykładowo, 'onload_smarty.php'
//    pozwala dodać użytkownikowi do silnika Smarty dane, które zawsze będą mu potrzebne po stronie widoku, jak np. obiekt 'user'. Natomiast skrypt
//    'onload_db.php' pozwala wykonać jakieś działania bezpośrednio po poprawnym połączeniu z bazą danych.

// Niniejsza aplikacja posiada tylko jedną akcję. To projekt typu "Hello world".


//konfiguracja routingu przeniesiona do dedykowanego skryptu
require_once 'routing.php';

//metoda ładująca obiekt Messages z sesji (jeśli został tam zachowany) - pozwala to komunikatom "przetrwać" redirect.
\core\SessionUtils::loadMessages();

//uruchomienie routera
\core\App::getRouter()->go();