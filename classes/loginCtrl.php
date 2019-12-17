<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

$ret = '';

// POSTデータを取得
$loginId = htmlentities($_POST['loginId'], ENT_QUOTES, "UTF-8");
$loginPswd = htmlentities($_POST['loginPswd'], ENT_QUOTES, "UTF-8");

// データ取得処理
$result = (new Tb_kaiin_joho())->findByEmailAndPassword($loginId, $loginPswd);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
