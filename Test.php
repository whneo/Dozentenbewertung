<?php
include './config.php';
include './class/DbConnect.php';
include './class/Kurs.php';
include './class/Einsatzort.php';
include './class/Dozent.php';
include './class/Bewertung.php';
include './class/Teilnehmer.php';

//$teilnehmer = new Teilnehmer('test1');
//$kurs = new Kurs('newTest2');
//$insert = Kurs::insert($kurs);
//$einsatzort = new Einsatzort('newTest1');
//$insert2 = Einsatzort::insert($einsatzort);
//$dozent = new Dozent('newTest', 'newTest1');
//$insert3 = Dozent::insert($dozent);
//echo '<pre>';
////print_r($insert);
////print_r($insert2);
//print_r($insert3);
//echo '</pre>';

$teilnehmer = new Teilnehmer('teilnehmer1');
$kurs = new Kurs('kurs3');
$einsatzort = new Einsatzort('einsatzort5');
$dozent = new Dozent('vorname5', 'vorname5');
$bewertung = new Bewertung($teilnehmer, $dozent, $kurs, $einsatzort, '5', '2005');
Bewertung::insert($bewertung);

//echo '<pre>';
//print_r($bewertung);
//echo '</pre>';

//Bewertungseingabe::getAll();