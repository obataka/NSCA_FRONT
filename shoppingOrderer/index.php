<?php


$includeView = '../views/shoppingOrderer/shoppingOrderer_tpl.php';

$shimeiSei = (isset($_SESSION['shimeiSei'])) ? $_SESSION['shimeiSei'] : "";
$shimeiMei = (isset($_SESSION['shimeiMei'])) ? $_SESSION['shimeiMei'] : "";

include_once $includeView;
