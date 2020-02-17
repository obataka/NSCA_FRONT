<?php

namespace Was;

session_start();

require './Config/Config.php';
require './Common/Util.php';

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


echo $ret;
die();
