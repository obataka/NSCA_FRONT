<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Vceu_shutoku_shosai.php';

//セッションから会員番号を取得
$wk_kaiin_no = '';
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

// データ取得処理
$result_ceuJoho = (new Vceu_shutoku_shosai())->findByCeuJoho($param);

// 該当データなしの場合
if ($result_ceuJoho == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result_ceuJoho);
}

die();
