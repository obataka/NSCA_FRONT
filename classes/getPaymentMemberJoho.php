<?php
namespace Was;

session_start();

require './Config/Config.php';
require './Config/FregiConfig.php';
require './Common/Util.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];

    // 顧客情報取得処理
    $url = FregiConfig::GET_CUSTOMER_INFO_API_URL;
    $param = array(
        'SHOPID' => FregiConfig::SHOP_ID,
        'CUSTOMERID' => $wk_kaiin_no,
        'GETEXPIRE' => 1
    );

    error_log(print_r("顧客情報取得処理パラメータ", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
    error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

    $response = Util::payment_post_request($url, $param);

    // 会員番号から会員情報を取得し、名称をレスポンスに追加する
    $result = (new Tb_kaiin_joho())->findByKaiinNo($wk_kaiin_no);

    $response = mb_convert_encoding($response, "utf-8", "euc-jp");

    error_log(print_r("顧客情報取得処理結果", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
    error_log(print_r($response, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
    error_log(print_r(json_encode($response), true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

    echo json_encode($response);
}
else {

    $response[0] = "NG";
    $response[1] = "ログインされていません";

    error_log(print_r("顧客情報取得処理結果", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');
    error_log(print_r($response, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/obara_log.txt');

    echo json_encode($response);
}

die();
