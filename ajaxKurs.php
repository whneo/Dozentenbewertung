<?php
include './config.php';
spl_autoload_register(function($class){
    include './class/' . $class . '.php';
});

$term = isset($_GET['term']) ? trim($_GET['term']) : '';
if (!empty($term)) {
    $themen = Kurs::getThemenByLikeness($term);
}
echo json_encode($themen);