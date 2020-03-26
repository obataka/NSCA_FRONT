<?php

namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Tb_kaiin_joho.php';
require '../DBAccess/Tb_kaiin_jotai.php';
require '../DBAccess/Tb_kaiin_journal.php';

/******************
前処理
 ******************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();


//有効な会員情報を取得する
$cursor = (new Tb_kaiin_joho())->cursor_sbtChange($db);
//error_log(print_r($cursor, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//会員情報の配列をループさせながらテーブルを更新する
if ($cursor) {
    //成功フラグ
    $flg = false;

    for ($i = 0; $i < count($cursor); $i++) {
        //更新用パラメータ設定
        $param = [
            'kaiin_no'          => $cursor[$i]['kaiin_no'],
            'kaiin_sbt'         => $cursor[$i]['kaiin_sbt'],
            'yoyaku_kaiin_sbt'  => $cursor[$i]['yoyaku_kaiin_sbt'],
            'koshin_user_id'    => 'system',
        ];

        //TB会員情報更新
        $result = (new Tb_kaiin_joho())->updateKaiinSbt_sbtChange($db, $param);
        if ($result == false) {
            //更新失敗の場合
            $db->rollBack();
            $flg = false;
            break;
        } else {
            //TB会員状態更新
            $result = (new Tb_kaiin_jotai())->updateKaiinJotai_sbtChange($db, $param);
            if ($result == false) {
                //更新失敗の場合
                $db->rollBack();
                $flg = false;
                break;
            } else {
                if ($param['kaiin_sbt'] == 3 && ($param['yoyaku_kaiin_sbt'] == 1 || $param['yoyaku_kaiin_sbt'] == 2)) {
                    //TB会員ジャーナル更新
                    //会員種別が英文 → 正会員、学生会員のとき「1」
                    $result = (new Tb_kaiin_journal())->updateKaiinJournal_eibun_sbtChange($db, $param);
                    if ($result == false) {
                        //更新失敗の場合
                        $db->rollBack();
                        $flg = false;
                        break;
                    } else {
                        //更新成功の場合
                        $flg = true;
                    }
                } else if (($param['kaiin_sbt'] == 1 || $param['kaiin_sbt'] == 2) && $param['yoyaku_kaiin_sbt'] == 3) {
                    //会員種別が正会員、学生会員 → 英文 のとき「0」
                    $result = (new Tb_kaiin_journal())->updateKaiinJournal_batch($db, $param);
                    if ($result == false) {
                        //更新失敗の場合
                        $db->rollBack();
                        $flg = false;
                        break;
                    } else {
                        //更新成功の場合
                        $flg = true;
                    }
                } else {
                    //更新成功の場合
                    $flg = true;
                }
            }
        }
    }

    //すべての処理が正常に終了した場合commitする
    if ($flg == true) {
        $db->commit();
    }
}


die();
