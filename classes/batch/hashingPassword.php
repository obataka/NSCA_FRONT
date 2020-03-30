<?php

namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Tb_kaiin_joho.php';

/******************
前処理
 ******************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//実行時間の制限をなくす
set_time_limit(0);

//有効な会員情報を取得する
$cursor = (new Tb_kaiin_joho())->cursor_hashingPassword($db);
//error_log(print_r($cursor, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//会員情報の配列をループさせながらテーブルを更新する
if ($cursor) {
    //成功フラグ
    $flg = false;

    for ($i = 0; $i < count($cursor); $i++) {

        // ハッシュを作る
        $my_page_password = password_hash($cursor[$i]['my_page_password'], PASSWORD_BCRYPT);

        //会員番号
        $kaiin_no = $cursor[$i]['kaiin_no'];

        //パスワード更新
        $result = (new Tb_kaiin_joho())->hashingPassword($db, $my_page_password, $kaiin_no);
        if ($result == false) {
            //更新失敗の場合
            $db->rollBack();
            $flg = false;
            break;
        } else {
            //更新成功の場合
            $flg = true;

            //1000件ごとにコミットしてトランザクション開始しなおす
            if ($i % 1000 == 0) {
                $db->commit();
                $db->beginTransaction();
            }
        }
    }

    //すべての処理が正常に終了した場合commitする
    if ($flg == true) {
        $db->commit();
    }
}


die();
