<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './Common/Util.php';

$return_val = -1;
$mail_send_ret = TRUE;

//メールアドレス取得
$email = (!empty($_POST['email'])) ? htmlentities($_POST['email'], ENT_QUOTES, "UTF-8") : "";

// 本文
$message="会員登録いただきまして誠にありがとうございます。"."\n\n";
$message.="お客様の登録が完了いたしましたのでご連絡申し上げます。"."\n";
$message.="ご不明な点やご質問などございましたら、お気軽にお問い合せください。"."\n\n";
$message.="https://www.nsca-japan.or.jp/06_qanda/top.html#contact";

// 件名
$subject = "会員登録ありがとうございます。";

$mail_send_ret = (new Util())->my_send_mail($email, $subject, $message);

if (!$mail_send_ret) {
    $return_val =  0;
}

echo $return_val;
die();
