<?php
namespace Was;

session_start();

require './Config/FregiConfig.php';
require './Common/Util.php';

// 支払い金額
$pay = $_POST['pay'];

// 伝票番号
$slipNo = $_POST['slipNo'];

// お客様名
$customerName = $_POST['customerName'];

// 電話番号
$phoneNo = $_POST['phoneNo'];

// コンビニ
$conveni = $_POST['conveni'];

//コンビニ決済処理
$url = FregiConfig::CONVENI_API_URL;
$param = array(
    'SHOPID' => FregiConfig::SHOP_ID,
    'PAY' => $pay,
    'ID' => $slipNo,
    'CUSTOMERNAME1' => $customerName,
    'CHARCODE' => 'utf8',
    'CUSTOMERTEL' => $phoneNo,
    'CONVENI' => $conveni,
    'REQUIREURL' => 1
);

error_log(print_r("コンビニ決済処理パラメータ", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

$response = Util::payment_post_request($url, $param);

$response = mb_convert_encoding($response, "utf-8", "euc-jp");

// レスポンスにコンビニを追加
$response[4] = $conveni;

error_log(print_r("コンビニ決済処理結果", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($response, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r(json_encode($response), true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

echo json_encode($response);

die();
