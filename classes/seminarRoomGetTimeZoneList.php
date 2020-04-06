<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Dtb_timezone_place_detail.php';

// POSTデータを取得
$targetDay = (!empty($_POST['targetDay'])) ? htmlentities($_POST['targetDay'], ENT_QUOTES, "UTF-8") : "";

// データ取得処理
$result = (new Dtb_timezone_place_detail())->findTimeZone($targetDay);

if ($result == '') {
    echo 0;
} else {
    echo json_encode($result);
}

die();
