<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho2.php';

$ret = '';
$wk_no = 0;
$wk_kaiin_no = '';

//POSTデータを取得
//reissueMail.jsでセットしたPOSTデータを取得する
//メールアドレス 
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
// SELECT用パラメーター設定
$param = [
    'mail'  => $mail,
];
// SELECT処理
$result = (new Tb_kaiin_joho2())->reissueMailAddress1($param);
// 更新失敗の場合
if ($result == false) {
    NULL;
// 更新成功の場合
} else {
    NULL; 
}
echo $result;
die();


