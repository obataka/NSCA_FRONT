<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

// データ取得処理
$result = (new Tb_kaiin_joho())->findBykaiinjoho();
error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log.txt');

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
