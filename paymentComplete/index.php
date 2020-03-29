<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/paymentComplete/paymentComplete_tpl.php';
$include3dView = '../views/paymentComplete/3dsecure_tpl.php';

// 支払い金額
$pay = $_POST['pay'];

// TOKEN
$token = $_POST['token'];

// 顧客情報を使用する
$usagePaymentInfo = $_POST['usagePaymentInfo'];

// カード番号
$card_num = $_POST['card_nb'];

// 氏名
$name = $_POST['neme'];

// カード有効期限（月）
$limit_month = $_POST['card_1'];

// カード有効期限（年）
$limit_year = $_POST['card_2'];

// セキュリティコード
$code = $_POST['code'];

// 決済情報登録
$registPaymentInfo = $_POST['registPaymentInfo'];

// 3Dセキュアhtml
$secureHtml = $_SESSION['secureHtml'];

// 承認番号
$authCode = $_POST['authCode']? $_POST['authCode'] : $_GET['AUTHCODE'];

// 取引番号
$seqNo = $_POST['seqNo']? $_POST['seqNo'] : $_GET['SEQNO'];

if (empty($secureHtml) || $_GET['STATUS'] == 'OK') {
    include_once $includeView;
}
else {
    include_once $include3dView;
}
