<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_konyusha_joho.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Ms_meishoKbn.php';


//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 819121119;
/**********************
 * 会員番号セット
 ***********************/

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

$db = Db::getInstance();
$db->beginTransaction();

$zeiritsu = getShohizei($db);

$result = (new Tb_hambai_konyusha_joho())->findBySalesCartList($db, $param, $zeiritsu);
// error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

for ($i = 0; $i < count($result); $i++) {
    //販売設定名称、資格名称取得
    $hambai_settei_meisho = (new Ms_meishoKbn())->findByHambaiMeisho($db, 222,  $result[$i]['hambai_settei_kbn']);
    $result[$i]['hambai_settei_meisho'] = $hambai_settei_meisho[0]['meisho'];

    $shikaku_meisho = (new Ms_meishoKbn())->findByHambaiMeisho($db, 229, $result[$i]['shikaku_kbn']);
    $result[$i]['shikaku_meisho'] = $shikaku_meisho[0]['meisho'];


    //販売サイズ名称、販売カラー名称取得
    $hambai_size_meisho = (new Ms_meishoKbn())->findByHambaiMeisho($db, 223, $result[$i]['size_kbn']);
    $result[$i]['size_meisho'] = $hambai_size_meisho[0]['meisho'];


    $hambai_color_meisho = (new Ms_meishoKbn())->findByHambaiMeisho($db, 224, $result[$i]['color_kbn']);
    $result[$i]['color_meisho'] = $hambai_color_meisho[0]['meisho'];
}

// 該当データなしの場合
if ($result == '') {
    echo 0;
    // 該当データありの場合
} else {
    echo json_encode($result);
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

die();
