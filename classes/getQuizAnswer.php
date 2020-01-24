<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_ceu_quiz_joho.php';
//POSTデータを取得
//confirmAnswer.jsでセットしたPOSTデータを取得する
// 会員情報
$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";

/**********************
* 会員番号セット
***********************/

$param = [
    'ceu_id'  => $ceu_id,
];
// データ取得処理
$result = (new Tb_ceu_quiz_joho())->GetByQuizAnswer($param);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
