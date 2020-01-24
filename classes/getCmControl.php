<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Cm_control.php';

// データ取得処理
$result = (new Cm_control())->findByCmControl();
error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_CMCONTROL_log.txt');
// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
