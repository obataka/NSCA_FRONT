<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_sentaku.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}


// データ取得処理
$result = (new Tb_kaiin_sentaku())->findBySentaku($wk_kaiin_no);

// 該当データなしの場合
if (empty($result)) {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
