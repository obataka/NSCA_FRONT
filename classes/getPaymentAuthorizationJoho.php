<?php
namespace Was;

session_start();

require './Config/FregiConfig.php';
require './Common/Util.php';

$token = $_POST['token'];
$pay = $_POST['pay'];
$usagePaymentInfo = $_POST['usagePaymentInfo'];
$registPaymentInfo = $_POST['registPaymentInfo'];

error_log(print_r("チェックボックス", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($usagePaymentInfo, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($registPaymentInfo, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

unset($_SESSION['secureHtml']);

// 承認処理
$url = FregiConfig::AUTHORIZATION_API_URL;
$param = array(
    'SHOPID' => FregiConfig::SHOP_ID,
    'TOKEN' => $token,
    'PAY' => $pay,
    'CUSTOMERID' => $usagePaymentInfo == 'true'? $_SESSION['kaiinNo'] : '',
    'CHARCODE' => 'utf8',
    'MONTHLY' => $registPaymentInfo == 'true'? '1' : '0'
);

error_log(print_r("承認処理パラメータ", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

$response = Util::payment_post_request($url, $param);

$response = mb_convert_encoding($response, "utf-8", "euc-jp");

error_log(print_r("承認処理結果", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r($response, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
error_log(print_r(json_encode($response), true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

// 3Dセキュア用のhtmlの内容はセッションに保存する
if ($response[0] == 'OUTPUT') {
    $_SESSION['secureHtml'] = $response[1];
}

echo json_encode($response);

die();
