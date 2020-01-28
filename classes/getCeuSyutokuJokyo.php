<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
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

// データ取得処理
$result_cscs = (new Tb_nintei_meisai())->findBycscsNinteibi($param);

// 該当データなしの場合
if ($result_cscs == TRUE) {

    // データ取得処理
    $result_cpt = (new Tb_nintei_meisai())->findBycptNinteibi($param);

    // 該当データなしの場合
    if ($result_cpt == TRUE) {

        

    // 該当データありの場合
    } else {

        // commit
        $db->commit();

        // 戻り値に0設定
        $result = 0;
    }

// 該当データありの場合
} else {

    // commit
    $db->commit();

    // 戻り値に0設定
    $result = 0;
}



echo $result;
die();
