<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_jotai.php';
require './DBAccess/Tb_kaiin_sonota.php';
require './DBAccess/Tb_kaiin_joho.php';   
$ret = '';
$wk_no = 0;
$wk_kaiin_no = '';

// POSTデータを取得
// unsubscrideConfirm.jsでセットしたPOSTデータを取得する
$taikai_riyu_kbn = (!empty($_POST['taikai_riyu_kbn'])) ? htmlentities($_POST['taikai_riyu_kbn'], ENT_QUOTES, "UTF-8") : "";
$taikai_riyu_biko = (!empty($_POST['taikai_riyu_biko'])) ? htmlentities($_POST['taikai_riyu_biko'], ENT_QUOTES, "UTF-8") : "";
$taikaigono_oshirase_kbn = (!empty($_POST['taikaigono_oshirase_kbn'])) ? htmlentities($_POST['taikaigono_oshirase_kbn'], ENT_QUOTES, "UTF-8") : "";
$yuko_hizuke = (!empty($_POST['yuko_hizuke'])) ? htmlentities($_POST['yuko_hizuke'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($yuko_hizuke, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_yuko_hizuke_log.txt');
error_log(print_r($taikai_riyu_kbn, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_taikaigono_oshirase_kbn_log.txt');
error_log(print_r($taikai_riyu_kbn, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_taikai_riyu_kbn_log.txt');
error_log(print_r($taikai_riyu_biko, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_taikai_riyu_biko_log.txt');
/**********************
* 更新用パラメーター設定
***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//更新用パラメーターセット
$param = [
    'taikai_shorui_juribi'  => date("Y/m/d H:i:s"),
    'taikai_riyu_kbn'       => $taikai_riyu_kbn,
    'taikai_riyu_biko'      => $taikai_riyu_biko,
    'koshin_user_id'        => "Web",
];

// 更新処理
$result_jotai = (new Tb_kaiin_jotai())->updateKaiinJotai($db, $param);
error_log(print_r($result_jotai, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_jotai_log.txt');

// 更新成功の場合
if ($result_jotai == TRUE) {
    error_log(print_r("状態更新成功その他更新処理通過", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/taniharamemo_log.txt');
    //TB会員その他更新用パラメーターセット
    $param1 = [
        'taikaigono_oshirase_kbn'   => $taikaigono_oshirase_kbn,
        'koshin_user_id'            => "Web",
    ];
    // 更新処理
    $result_sonota = (new Tb_kaiin_sonota())->LeaveUpdateSonota($db, $param1);
    error_log(print_r($result_sonota, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_sonota_log.txt');
    
    // 登録成功の場合
    if ($result_sonota == TRUE) {
        error_log(print_r("その他通過", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_sonotaTsuka_log.txt');
        //有効期限が切れている場合は登録状況区分を4にして即時退会にする
        $today = strtotime(date("Y/m/d H:i:s"));
        $yuko_hizuke = strtotime($yuko_hizuke);
        error_log(print_r($today, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_yuko_today_log.txt');
        error_log(print_r($yuko_hizuke, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_kigen_log.txt');
        if ($today > $yuko_hizuke) {
             
            $param2 = [
                'toroku_jokyo_kbn'          => "4",
                'koshin_user_id'            => "Web",
            ];
            // 更新処理
            $result_joho = (new Tb_kaiin_joho())->torokuJohoKbn($db, $param2);

            if ($result_joho == TRUE) {
                $param3 = [
                    'taikai_hizuke'   => date("Y/m/d H:i:s"),
                    'koshin_user_id'            => "Web",
                ];
                // 更新処理
                $result_jotai2 = (new Tb_kaiin_jotai())->Taikaihizuke($db, $param3);
                if ($result_jotai2 == TRUE) {
                    // commit
                    $db->commit();

                    // 戻り値に1設定
                    $result = 1;
                } else  {
                    // ロールバック
                    $db->rollBack();
    
                    // 戻り値に0設定
                    $result = 0;
                }
            } else {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
            }
        } else {
            error_log(print_r("期限内の場合通過", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_kigenTsuka_log.txt');
            $param4 = [
                'taikai_shorui_juribi'   => date("Y/m/d H:i:s"),
                'koshin_user_id'            => "Web",
            ];
            // 更新処理
            $result_jotai3 = (new Tb_kaiin_jotai())->TaikaiYoyaku($db, $param4);
            if ($result_jotai3 == TRUE) {
                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;
            } else {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
            }
        }
    //登録失敗の場合
    } else {
        // ロールバック
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
    }
//登録失敗の場合
} else {
    // ロールバック
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
}


echo $result;
die();
