<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php'; 
//require './DBAccess/ワンタイムURL.php';

//メールアドレス取得
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
//トークンを作成し、アドレスとトークンと有効期限をDBに登録する。
    $limit = (time()+3600);    //有効期限
     
    $token= rand(0,100).uniqid();//トークン

    //touch($tokendir.$token.".log");//トークンファイル作成
    //$url = $_SERVER["HTTP_REFERER"]."?key=".$token;
    //file_put_contents($tokendir.$token.".log", $limit, LOCK_EX);//期限保存 
    //delete_old_token($tokendir);//古いトークン削除
     
    $message ="メールアドレスの変更が完了しました。\n";
    $message.="https://www.demo-nls02.work/reissueMailComplete/".$token;
    $subject ="メールアドレス変更のお知らせ";
    my_send_mail($mail,$subject,$message);

// 	function delete_old_token($token = NULL)
// {
//     global $tokendir,$email;
     
//     if (is_dir($tokendir)) {
//         if ($dh = opendir($tokendir)) {
//             while (($file = readdir($dh)) !== false) {
//                 if(is_file($tokendir.$file) && is_null($token)){
                     
//                     $log = file_get_contents($tokendir.$file);
//                     list($data,$mail) = split("<>",$log);
//                     $email = $mail;
//                     if(time() > $data) @unlink($tokendir.$file);
                     
//                 }else if(basename($file,".log")==$token && !is_null($token)){
                     
//                     if(time() < (filemtime($tokendir.$token.".log")+180) ){
                     
//                         $log = file_get_contents($tokendir.$token.".log");
//                         list($data,$mail) = split("<>",$log);
//                         $email = $mail;
                     
//                         @unlink($tokendir.$token.".log");
//                         return true;
//                     }else{
//                         @unlink($tokendir.$token.".log");
//                         return false;
//                     }
//                 }
//             }
//             closedir($dh);
//         }
//     }
// }
function my_send_mail($mailto, $subject, $message)
{
     
    $message = mb_convert_encoding($message, "JIS", "UTF-8");
    $subject = mb_convert_encoding($subject, "JIS", "UTF-8");
     
    $header ="From: NSCAジャパン <info@example.com>\n";
     
    mb_send_mail($mailto, $subject, $message, $header);
}
 

// // 登録用パラメーター設定
// $param = [
//     'mail'                  => $mail,
//     'token'                 => $token,
//     'limit'                 => $limit,
// ];
// error_log(print_r($param, true). PHP_EOL, '3', 'tanihara_log.txt');     //動作確認

// // 登録処理
// $result = (new "ここにワンタイムURL.phpを設置"())->insertRec($param);
// error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log.txt');

// // 登録失敗の場合
// if ($result == false) {
//     NULL;
//     error_log(print_r("登録失敗", true). PHP_EOL, '3', 'tanihara_log.txt');
// // 登録成功の場合
// } else {
//     NULL;
//     error_log(print_r("登録成功", true). PHP_EOL, '3', 'tanihara_log.txt');
// }
echo $result;
die();


