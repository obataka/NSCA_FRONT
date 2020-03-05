<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Tb_hambai_konyusha_joho_meisai.php';
require './DBAccess/Tb_hambai_konyusha_joho.php';

//shoppingBasket.jsでセットしたPOSTデータを取得する
$konyu_id = (!empty($_POST['konyu_id'])) ? htmlentities($_POST['konyu_id'], ENT_QUOTES, "UTF-8") : "";
$hambai_id = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$size_kbn = (!empty($_POST['size_kbn'])) ? htmlentities($_POST['size_kbn'], ENT_QUOTES, "UTF-8") : "";
$color_kbn = (!empty($_POST['color_kbn'])) ? htmlentities($_POST['color_kbn'], ENT_QUOTES, "UTF-8") : "";
$kaiin_no = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$kakaku = (!empty($_POST['kakaku'])) ? htmlentities($_POST['kakaku'], ENT_QUOTES, "UTF-8") : "";
$suryo = (!empty($_POST['suryo'])) ? htmlentities($_POST['suryo'], ENT_QUOTES, "UTF-8") : "";
$user_id = (!empty($_POST['user_id'])) ? htmlentities($_POST['user_id'], ENT_QUOTES, "UTF-8") : "";

// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//送料取得
$wk = (new Cm_control())->findByCmControlNoTran($db);
$soryo = $wk['buppan_soyo'];

$param = [
    'kaiin_no'              => $kaiin_no,
    'konyu_id'              => $konyu_id,
    'hambai_id'             => $hambai_id,
    'size_kbn'              => $size_kbn,
    'color_kbn'             => $color_kbn,
    'kakaku'                => $kakaku,
    'suryo'                 => $suryo,
    'buppan_soyo'           => $buppan_soyo,
    'koshin_user_id'        => $user_id,
    'torokubi'              => date("Y/m/d"),
];

error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

$zeiritsu = getShohizei($db);
$gokei = 0;
$soryo_gokei = 0;

//送料を再計算
$soryo_gokei = $soryo_gokei + $param['buppan_soyo'];

//合計金額を再計算
$gokei = $gokei + $param['kakaku'] * $zeiritsu * $param['suryo'];

//新規登録
$result = (new Tb_hambai_konyusha_joho())->insertKonyushaJoho($db, $param, $gokei);
error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
// 更新失敗の場合
if ($result == false) {
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
} else {

    //明細新規登録
    $result = (new Tb_hambai_konyusha_joho_meisai())->insertKonyushaJohoMeisai($db, $param);
    error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
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


//消費税を取得する関数
function getShohizei($db)
{
    $shohizei = (new Cm_control())->findByShohizei($db);

    $zeiritsu = "";
    //切替日1がnullなら税1
    if ($shohizei['kirikae_nengappi_1'] == "") {
        $zeiritsu = $shohizei['zei_1'];

        //切替日1より過去なら税1    
    } else if ($shohizei['kirikae_nengappi_1'] > date("Y/m/d")) {
        $zeiritsu = $shohizei['zei_1'];

        //切替日1より未来かつ、切替日2より過去なら税2
    } else if (($shohizei['kirikae_nengappi_1'] <= date("Y/m/d")) && ($shohizei['kirikae_nengappi_2'] > date("Y/m/d")) || $shohizei['kirikae_nengappi_2'] == "") {
        $zeiritsu = $shohizei['zei_2'];

        //切替日2より未来なら税3
    } else if ($shohizei['kirikae_nengappi_2'] < date("Y/m/d")) {
        $zeiritsu = $shohizei['zei_3'];
    }

    $zeiritsu = $zeiritsu + 1;

    return $zeiritsu;
}

echo $result;

die();
