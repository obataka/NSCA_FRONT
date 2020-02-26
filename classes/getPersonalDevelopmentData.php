<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Tb_ceu_joho.php';
require './DBAccess/Cm_control.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 10251033;


//personalDevelopmentConfirmでセットしたPOSTデータを取得する
$kaiin_sbt = (!empty($_POST['kaiin_sbt'])) ? htmlentities($_POST['kaiin_sbt'], ENT_QUOTES, "UTF-8") : "";
$kaiin_column = "";
switch ($kaiin_sbt) {
    case '0':
        $kaiin_column = "riyo_toroku_sankaryo";
        break;
    case '1':
        $kaiin_column = "seikaiin_sankaryo";
        break;
    case '2':
        $kaiin_column = "gakuseikaiin_sankaryo";
        break;
}

/**********************
 * 会員番号セット
 ***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//年度ID取得
$nendo_id = (new Cm_control())->findByNendoId($db);

//パラメータ設定
$param = [
    'kaiin_no'  => $wk_kaiin_no,
    'nendo_id'  => $nendo_id['nendo_id'],
];

//認定日取得
$ninteibi = "";

// cscs認定日取得処理
$result_cscs = (new Tb_nintei_meisai())->findBycscsNinteibi($db, $param);

// cpt認定日取得処理
$result_cpt = (new Tb_nintei_meisai())->findBycptNinteibi($db, $param);

// error_log(print_r($result_cpt, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//両認定日から最小の認定日を設定
if ($result_cscs == TRUE && $result_cpt == TRUE) {
    if ($result_cscs < $result_cpt) {
        $ninteibi = $result_cscs[0]['ninteibi'];
    } else {
        $ninteibi = $result_cpt[0]['ninteibi'];
    }
} else if ($result_cscs == TRUE || $result_cpt == TRUE) {
    if ($result_cscs == TRUE) {
        $ninteibi = $result_cscs[0]['ninteibi'];
    }

    if ($result_cpt == TRUE) {
        $ninteibi = $result_cpt[0]['ninteibi'];
    }
}

//パーソナルディベロップメント情報取得
$result = (new Tb_ceu_joho())->findByPersonalDevelopment($db, $param, $ninteibi, $kaiin_column);

// error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

// 該当データなしの場合
if ($result == '') {
    echo 0;
    // 該当データありの場合
} else {
    echo json_encode($result);
}

die();
