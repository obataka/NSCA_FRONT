<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Vceu_shutoku_shosai.php';
require './DBAccess/Tb_kaiin_ceu.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 10251033;

/**********************
 * 会員番号セット
 ***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

$wk_kaiin_no = 10251033;

// cscs取得状況取得処理
$cnt_cscs = (new Tb_nintei_meisai())->countcscsShutokujokyo($db, $param);

// cpt取得状況取得処理
$cnt_cpt = (new Tb_nintei_meisai())->countcptShutokujokyo($db, $param);

// 両認定の場合
if ($cnt_cscs['COUNT(*)'] != 0 || $cnt_cpt['COUNT(*)'] != 0) {
    $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $param);

    $ceu_kanrihi = "";
    $result = (new Tb_nintei_meisai())->getceuKanrihi($db, $param);

} else {
    $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $param);
    $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $param);
    $shohizei = (new Cm_control())->findByShohizei($db);

    $zeiritsu = "";
    if($shohizei['kirikae_nengappi_1'] == "") {

    }


    $result = (new Tb_nintei_meisai())->getceuKanrihi($db, $param);

}

echo $result;
die();
