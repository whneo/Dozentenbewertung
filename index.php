<?php

include './config.php';
spl_autoload_register(function($class) {
    include './class/' . $class . '.php';
});
include './view/begin.php';

$navigation = isset($_GET['navi']) ? $_GET['navi'] : '0';
$view = 'home';
switch ($navigation) {
    case "0":
        echo "<h2>Willkommen bei Evaluate A Doz</h2>";
        break;
    case "1":
        echo "<h2>Bewertungen</h2>";
        $view = 'bewertungenAnzeigen';
        break;
    case "2":
        echo "<h2>Bewertung eintragen</h2>";
        $view = 'bewertungEintragen';
        break;
    case "3":
        echo "<h2>Kontakt</h2>";
        $view = 'kontakt';
        break;
    default:
        break;
}
$sentDozent = isset($_POST['sentDozent']) ? $_POST['sentDozent'] : '';
$suchstringDozent = isset($_POST['suchstringDozent']) ? $_POST['suchstringDozent'] : '';
if ($sentDozent && $suchstringDozent) {
    echo "<h2>Dozentensuche</h2>";
    $view = 'suchenDozent';
}
$sentOrt = isset($_POST['sentOrt']) ? $_POST['sentOrt'] : '';
$suchstringOrt = isset($_POST['suchstringOrt']) ? $_POST['suchstringOrt'] : '';
if ($sentOrt && $suchstringOrt) {
    echo "<h2>Ortssuche</h2>";
    $view = 'suchenOrt';
}
$sentKurs = isset($_POST['sentKurs']) ? $_POST['sentKurs'] : '';
$suchstringKurs = isset($_POST['suchstringKurs']) ? $_POST['suchstringKurs'] : '';
if ($sentKurs && $suchstringKurs) {
    echo "<h2>Kurssuche</h2>";
    $view = 'suchenKurs';
}
// Eingabeformular auswerten
$insertsent = isset($_POST['insertsent']) ? $_POST['insertsent'] : '';
$teilnehmerPseudonym = isset($_POST['teilnehmerPseudonym']) ? $_POST['teilnehmerPseudonym'] : '';
$dozentVorname = isset($_POST['dozentVorname']) ? $_POST['dozentVorname'] : '';
$dozentNachname = isset($_POST['dozentNachname']) ? $_POST['dozentNachname'] : '';
$kursThema = isset($_POST['kursThema']) ? $_POST['kursThema'] : '';
$einsatzortStadt = isset($_POST['einsatzortStadt']) ? $_POST['einsatzortStadt'] : '';
$note = isset($_POST['note']) ? $_POST['note'] : '';
$jahr = isset($_POST['jahr']) ? $_POST['jahr'] : '';

if ($insertsent && $teilnehmerPseudonym && $dozentVorname && $dozentNachname && $kursThema && $einsatzortStadt && $jahr) {
    echo '<h2>Bewertung eintragen</h2>';
    Bewertung::insert(new Bewertung(new Teilnehmer($teilnehmerPseudonym), new Dozent($dozentVorname, $dozentNachname), new Kurs($kursThema), new Einsatzort($einsatzortStadt), $note, $jahr));
    $view = 'bewertungenAnzeigen';
}
include './view/' . $view . '.php';
include './view/end.php';
?>