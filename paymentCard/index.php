<?php
include_once '../ctrl/parts/inputHeader.php';
require '../classes/Config/FregiConfig.php';

$includeView = '../views/paymentCard/paymentCard_tpl.php';

// 支払い金額
$pay = $_POST['pay'];

// 店舗ID
$shop_id = Was\FregiConfig::SHOP_ID;

// トークン発行キー
$token_key = Was\FregiConfig::TOKEY_KEY;

include_once $includeView;
