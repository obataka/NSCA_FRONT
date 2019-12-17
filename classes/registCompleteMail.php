<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php'; 
//require './DBAccess/ワンタイムURL.php';

//メールアドレス取得
$email_1 = (!empty($_POST['email_1'])) ? htmlentities($_POST['email_1'], ENT_QUOTES, "UTF-8") : "";
$email_2 = (!empty($_POST['email_2'])) ? htmlentities($_POST['email_2'], ENT_QUOTES, "UTF-8") : "";

$message="会員登録いただきまして誠にありがとうございます。"."\n";
$message.="お客様の登録が完了いたしましたのでご連絡申し上げます。"."\n";
$message.="ご不明な点やご質問などございましたら、お気軽にお問い合せください。"."\n";
$message.="https://www.nsca-japan.or.jp/06_qanda/top.html#contact";
my_send_mail($email_1,'入会案内',$message);
my_send_mail($email_2,'入会案内',$message);

 
function my_send_mail($mailto, $subject, $message)
{
     
    $message = mb_convert_encoding($message, "JIS", "UTF-8");
    $subject = mb_convert_encoding($subject, "JIS", "UTF-8");
     
    $header ="From: NSCAジャパン <info@example.com>\n";
     
    mb_send_mail($mailto, $subject, $message, $header);
}
 
echo $result;
die();


