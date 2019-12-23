<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php'; 
require './DBAccess/Tb_kaiin_token_front.php';
//require './DBAccess/Tb_kaiin_joho.php';

//メールアドレス取得
$kaiin_no = htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8");
$mail_address = htmlentities($_POST['mail_address'], ENT_QUOTES, "UTF-8");

/************************************************************
*トークンと有効期限をDBに登録する 
*************************************************************/


//トークンを作成し、アドレスとトークンと有効期限をDBに登録する。
    $yukokigen_nichiji = (time()+3600);    //有効期限
     
    $one_time_token= rand(0,100).uniqid();//トークン



// 登録用パラメーター設定
 $param = [
     'kaiin_no'                  => $kaiin_no,
     'one_time_token'            => $one_time_token,
     'yukokigen_nichiji'         => $yukokigen_nichiji,
 ];


 error_log(print_r($param, true). PHP_EOL, '3', 'tanaka_log.txt');     //動作確認

 // 登録処理
 $result = new Tb_kaiin_token_front()->insertRec($param);
 error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log.txt');

// // 登録失敗の場合
// if ($result == false) {
//     NULL;
//     error_log(print_r("登録失敗", true). PHP_EOL, '3', 'tanaka_log.txt');
// // 登録成功の場合
// } else {
//     NULL;
//     error_log(print_r("登録成功", true). PHP_EOL, '3', 'tanaka_log.txt');
// }




/************************************************************
*メール送信する 
*************************************************************/

    $message = "以下のアドレスを開いて新しいパスワードを登録してください。\n60分以内にアクセスが無かった場合は無効となります。\n";
    $message .= "https://www.demo-nls02.work/registSbtSelect/".$token;
	$title = "NACAジャパン　パスワード再設定のご案内"

    my_send_mail($mail,$title,$message);

 
function my_send_mail($mailto, $subject, $message)
{
     
    $message = mb_convert_encoding($message, "JIS", "UTF-8");
    $subject = mb_convert_encoding($subject, "JIS", "UTF-8");
     
    $header ="From: NSCAジャパン <info@example.com>\n";
     
    mb_send_mail($mailto, $subject, $message, $header);
}
 

echo $result;
die();


