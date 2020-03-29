<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/paymentCvs/paymentCvs_tpl.php';

// 店舗名
$shopName = $_POST['shopName'];

// お客様名
$customerName = $_POST['customerName'];

// 電話番号
$phoneNo = $_POST['phoneNo'];

// 伝票番号
$slipNo = $_POST['slipNo'];

// 商品名
$itemName = $_POST['itemName'];

// 金額
$price = $_POST['price'];

include_once $includeView;
