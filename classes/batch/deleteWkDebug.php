<?php

namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Wk_debug.php';

// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//wk_debugテーブルを全件削除する
$result = (new Wk_debug())->deleteAllRec_deleteWkDebug($db);

if ($result == false) {
    //更新失敗の場合
    $db->rollBack();
} else {
    //更新成功の場合
    $db->commit();
}

die();
