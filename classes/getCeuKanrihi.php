<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Cm_hitsuyo_ceu.php';
require './DBAccess/Ms_meishoKbn.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

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

$result = "";

// cscs取得状況取得処理
$cnt_cscs = (new Tb_nintei_meisai())->countcscsShutokujokyo($db, $param);

// cpt取得状況取得処理
$cnt_cpt = (new Tb_nintei_meisai())->countcptShutokujokyo($db, $param);

// 両認定の場合
if ($cnt_cpt[0]['COUNT(*)'] != 0 && $cnt_cscs[0]['COUNT(*)'] != 0) {

    //認定明細のレコード取得
    $nintei_meisai = (new Tb_nintei_meisai())->findByNinteiMeisaiRyo($db, $param);
    $result = [];

    for ($i = 0; $i < count($nintei_meisai); $i++) {
        if ($nintei_meisai[$i][2] == 1) {
            //年度ID取得
            $nendo_id = (new Cm_control())->findByNendoId($db);

            //試験種別区分取得
            $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $nintei_meisai[$i][2]);

            if ($nintei_meisai[$i][3] >= $nintei_meisai[1][3]) {
                //管理費取得
                $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[$i][3], $nendo_id['nendo_id']);

                //税率取得
                $zeiritsu = getShohizei($db);

                $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] / 2 * $zeiritsu;
            } else {
                //管理費取得
                $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[$i][3], $nendo_id['nendo_id']);

                //税率取得
                $zeiritsu = getShohizei($db);

                $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] * $zeiritsu;
            }

            $result[] = (new Tb_nintei_meisai())->getceuKanrihiRyo($db, $param, $shiken_sbt_kbn[0]['meisho'], $wk_ceu_kanrihi);

        } else if ($nintei_meisai[$i][2] == 2) {
            //年度ID取得
            $nendo_id = (new Cm_control())->findByNendoId($db);

            //試験種別区分取得
            $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $nintei_meisai[$i][2]);

            if ($nintei_meisai[$i][3] >= $nintei_meisai[0][3]) {

                //管理費取得
                $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[$i][3], $nendo_id['nendo_id']);

                //税率取得
                $zeiritsu = getShohizei($db);

                $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] / 2 * $zeiritsu;

            } else {
                //管理費取得
                $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[$i][3], $nendo_id['nendo_id']);

                //税率取得
                $zeiritsu = getShohizei($db);

                $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] * $zeiritsu;
            }

            $result[] = (new Tb_nintei_meisai())->getceuKanrihiRyo($db, $param, $shiken_sbt_kbn[0]['meisho'], $wk_ceu_kanrihi);
        }
    }

    // 該当データなしの場合
    if ($result == '') {
        echo 0;
        // 該当データありの場合
    } else {
        echo json_encode($result);
    }
    
} else {

    $result = [];
    if ($cnt_cscs[0]['COUNT(*)'] != 0) {
        $wk_shiken_sbt_kbn = 1;
        //認定明細のカラム取得
        $nintei_meisai = (new Tb_nintei_meisai())->findByNinteiMeisai($db, $param, $wk_shiken_sbt_kbn);

        //年度ID取得
        $nendo_id = (new Cm_control())->findByNendoId($db);

        //試験種別区分取得
        $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $nintei_meisai[0]['shiken_sbt_kbn']);

        //管理費取得
        $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[0]['ninteibi'], $nendo_id['nendo_id']);

        $zeiritsu = getShohizei($db);

        $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] * $zeiritsu;

        $result = (new Tb_nintei_meisai())->getceuKanrihi($db, $param, $shiken_sbt_kbn[0]['meisho'], $wk_ceu_kanrihi);

        if (count($result) >= 2) {
            array_pop($result);
        }

    } else if ($cnt_cpt[0]['COUNT(*)'] != 0) {
        $wk_shiken_sbt_kbn = 2;
        //認定明細のカラム取得
        $nintei_meisai = (new Tb_nintei_meisai())->findByNinteiMeisai($db, $param, $wk_shiken_sbt_kbn);

        //年度ID取得
        $nendo_id = (new Cm_control())->findByNendoId($db);

        //試験種別区分取得
        $shiken_sbt_kbn = (new Ms_meishoKbn())->findByShikenSbtKbn($db, $nintei_meisai[0]['shiken_sbt_kbn']);

        //管理費取得
        $ceu_kanrihi = (new Cm_hitsuyo_ceu())->findByceuKanrihi($db, $nintei_meisai[0]['ninteibi'], $nendo_id['nendo_id']);

        $zeiritsu = getShohizei($db);

        $wk_ceu_kanrihi = $ceu_kanrihi[0]['ceu_kanrihi'] * $zeiritsu;

        $result = (new Tb_nintei_meisai())->getceuKanrihi($db, $param, $shiken_sbt_kbn[0]['meisho'], $wk_ceu_kanrihi);

        if (count($result) >= 2) {
            array_pop($result);
        }
    }

    // 該当データなしの場合
    if ($result == '') {
        echo 0;
        // 該当データありの場合
    } else {
        echo json_encode($result);
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

die();
