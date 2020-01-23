<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_shiken_meisai.php';

// データ取得処理
$result = (new Tb_shiken_meisai())->findByShutokuGakuiMeisho();

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
