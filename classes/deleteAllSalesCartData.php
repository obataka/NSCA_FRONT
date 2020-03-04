<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/tb_hambai_konyusha_joho_meisai.php';
require './DBAccess/tb_hambai_konyusha_joho.php';

//shoppingBasket.jsでセットしたPOSTデータを取得する
$konyu_id = (!empty($_POST['konyu_id'])) ? htmlentities($_POST['konyu_id'], ENT_QUOTES, "UTF-8") : "";
$user_id = (!empty($_POST['user_id'])) ? htmlentities($_POST['user_id'], ENT_QUOTES, "UTF-8") : "";


//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 819121119;
/**********************
 * 会員番号セット
 ***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

$param = [
    'kaiin_no'              => $wk_kaiin_no,
    'konyu_id'              => $konyu_id,
    'koshin_user_id'        => $user_id,
];
error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
//商品(カラー、サイズ)を削除
$result = (new Tb_hambai_konyusha_joho_meisai())->deleteAllSalesCartData($db, $param);
error_log(print_r('deleteAllSalesCartData', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
// 更新失敗の場合
if ($result == false) {
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
    // 更新成功の場合
} else {
    $result = (new Tb_hambai_konyusha_joho())->deleteAllKonyushaJoho($db, $param);
    error_log(print_r('deleteAllKonyushaJoho', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
    error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
    // 更新失敗の場合
    if ($result == false) {
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
    } else {
        // 更新成功の場合
        // commit
        $db->commit();

        // 戻り値に1設定
        $result = 1;
    }
}

echo $result;
die();
