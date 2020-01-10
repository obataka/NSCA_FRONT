<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_jotai.php';
$wk_kaiin_no = '';
//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}
//検索用パラメーターセット
$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

// データ取得処理
$result = (new Tb_kaiin_jotai())->findByYukohizuke($param);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
