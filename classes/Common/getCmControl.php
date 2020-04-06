<?php
namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Cm_control.php';

$ret = '';

// データ取得処理
$result = (new Cm_control())->findById(1);

// 該当データなしの場合
if (empty($result)) {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
