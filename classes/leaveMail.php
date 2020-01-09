<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php'; 
//require './DBAccess/ワンタイムURL.php';

//メールアドレス取得
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
 //トークン作成
$token= rand(0,100).uniqid();
//本文
$message ="退会が完了しました。\n";
//件名
$subject ="NSCAジャパン退会のお知らせ";
//送信先メールアドレス、件名、本文をセット
my_send_mail($mail,$subject,$message);

//メール送信処理
function my_send_mail($mailto, $subject, $message)
{
    $charset = "iso-2022-JP";
    mb_language("ja");
    mb_internal_encoding("utf-8");
    
    $headers = "Mime-Version: 1.0\n";
    $headers .= "Content-Transfer-Encoding: 7bit\n";
    $headers .= "Content-Type: text/plain;charset={$charset}\n";
    $header ="From: NSCAジャパン <info@example.com>\n";
     
    mb_send_mail($mailto, $subject, $message, $header);
}
echo $result;
die();


