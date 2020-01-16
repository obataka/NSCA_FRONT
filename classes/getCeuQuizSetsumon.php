<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_ceu_quiz_setsumon.php';
//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}
$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
/**********************
* 会員番号セット
***********************/

$param = [
    'kaiin_no'  => $wk_kaiin_no,
    'ceu_id'  => $ceu_id,
];
// データ取得処理
$result = (new Tb_ceu_quiz_setsumon())->findByQuizSetsumon($param);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
