<?php

namespace Was;

session_start();

require './DBAccess/Db.php';
require './Config/Config.php';
require './Common/Util.php';
require './DBAccess/Tb_shiken_meisai.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}
$wk_kaiin_no = 10251033;

$param = [
    'kaiin_no'                          => $wk_kaiin_no,
];

$ret = "";

//受験状態データ取得する
$result = (new Tb_shiken_meisai())->findByJukenJotaiKbn($param);

//受験状態区分が9(キャンセル処理中)または10(キャンセル完了)の場合は終了
//それ以外の場合は受験状態区分を9(キャンセル処理中)に更新してメール送信する
if ($result['juken_jotai_kbn'] == 9 || $result['juken_jotai_kbn'] == 10) {
    $ret = 10;
} else {
    // 更新処理
    $result = (new Tb_shiken_meisai())->updateJukenJotai_entryCancel($param);
    // 更新失敗の場合
    if ($result == false) {
        // 戻り値に0設定
        $ret = 0;

    } else {
        $uketsuke_address = "f-rezi-test@nls.co.jp";

        //POSTからデータ取得
        $message = (!empty($_POST['message'])) ? htmlentities($_POST['message'], ENT_QUOTES, "UTF-8") : "";
        $my_address = (!empty($_POST['mail_address'])) ? htmlentities($_POST['mail_address'], ENT_QUOTES, "UTF-8") : "";

        $subject = "認定試験出願取消";

        $mail_send_ret = (new Util())->my_send_mail($uketsuke_address, $subject, $message);

        if (!$mail_send_ret) {
            // 戻り値に0設定
            $ret = 0;
        } else {
            $mail_send_ret = (new Util())->my_send_mail($my_address, $subject, $message);

            if (!$mail_send_ret) {
                // 戻り値に0設定
                $ret = 0;
            } else {
                // 戻り値に1設定
                $ret = 1;
            }
        }
    }
}


echo $ret;
die();
