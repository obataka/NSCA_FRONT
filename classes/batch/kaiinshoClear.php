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

//TB会員状態更新
$result = (new Tb_kaiin_jotai())->updateKaiinJotai_kaiinshoClear($db, $kisanbi);
if ($result == false) {
    //更新失敗の場合
    $db->rollBack();
} else {
    //更新成功の場合
    $db->commit();
}


die();
