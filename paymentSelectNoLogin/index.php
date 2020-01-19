<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";
$wk_name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
$wk_name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";

include_once $includeView;
