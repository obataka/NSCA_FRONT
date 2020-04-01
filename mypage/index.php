<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/mypage/mypage_tpl.php';

$shimeiSei = (isset($_SESSION['shimeiSei'])) ? $_SESSION['shimeiSei'] : "";
$shimeiMei = (isset($_SESSION['shimeiMei'])) ? $_SESSION['shimeiMei'] : "";

include_once $includeView;
