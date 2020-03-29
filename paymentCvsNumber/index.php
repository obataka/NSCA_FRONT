<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/paymentCvsNumber/paymentCvsNumber_tpl.php';

// コンビニ
$conveni = $_POST['conveni'];

// 支払番号・払込票番号
$payNo = $_POST['payNo'];

// 取引番号
$transNo = $_POST['transNo'];

include_once $includeView;
