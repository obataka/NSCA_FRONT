<?php
namespace Was;

session_start();

require './Config/FregiConfig.php';
require './Common/Util.php';

// 承認番号
$authCode = $_POST['authCode'];

// 取引番号
$seqNo = $_POST['seqNo'];

//売上処理
$url = FregiConfig::SALES_API_URL;
$param = array(
    'SHOPID' => FregiConfig::SHOP_ID,
    'AUTHCODE' => $authCode,
    'SEQNO' => $seqNo
);

error_log(print_r("売上処理パラメータ", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

$response = Util::payment_post_request($url, $param);

$response = mb_convert_encoding($response, "utf-8", "euc-jp");

error_log(print_r("売上処理結果", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($response, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r(json_encode($response), true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

echo json_encode($response);

die();
