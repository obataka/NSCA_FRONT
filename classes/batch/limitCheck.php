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
$cursor = (new Tb_kaiin_joho())->cursor_limitCheck($db);
//error_log(print_r($cursor, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//会員情報の配列をループさせながらテーブルを更新する
if ($cursor) {

    //成功フラグ
    $flg = false;

    for ($i = 0; $i < count($cursor); $i++) {
        //更新用パラメータ設定
        $param = [
            'kaiin_no'                  => $cursor[$i]['kaiin_no'],
            'yuko_hizuke'               => $cursor[$i]['yuko_hizuke'],
            'taikai_renraku_juribi'     => $cursor[$i]['taikai_renraku_juribi'],
            'koshin_user_id'            => 'shibata',
        ];

        //退会予約をしているか?
        if ($param['taikai_renraku_juribi']) {
            //会員状況更新
            $result = (new Tb_kaiin_joho())->updateKaiinJokyo_limitCheck($db, $param, 5);
            if ($result == false) {
                //更新失敗の場合
                $db->rollBack();
                $flg = false;
                break;
            } else {
                //TB会員ジャーナル更新
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
            }
        } else {
            //即時退会
            //会員状況更新
            $result = (new Tb_kaiin_joho())->updateKaiinJokyo_limitCheck($db, $param, 4);
            if ($result == false) {
                //更新失敗の場合
                $db->rollBack();
                $flg = false;
                break;
            } else {
                //退会日更新
                $result = (new Tb_kaiin_jotai())->updateKaiinJotai_limitCheck($db, $param);
                if ($result == false) {
                    //更新失敗の場合
                    $db->rollBack();
                    $flg = false;
                    break;
                } else {
                    //TB会員ジャーナル更新
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
