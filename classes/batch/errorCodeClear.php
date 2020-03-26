<?php

namespace Was;

use DateInterval;
use DateTime;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Tb_kaiin_jotai.php';

/******************
前処理
 ******************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//起算日を取得する 本日から8か月前の1日を算出
$date = new DateTime();
$date->sub(new DateInterval('P0Y8M0D'));
$kisanbi = $date->format('Y/m/01');

//error_log(print_r($kisanbi, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//TB会員状態更新
$result = (new Tb_kaiin_jotai())->updateKaiinJotai_errorCodeClear($db, $kisanbi);
if ($result == false) {
    //更新失敗の場合
    $db->rollBack();
} else {
    //更新成功の場合
    $db->commit();
}


die();
