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
// error_log(print_r($param, true). PHP_EOL, '3', 'tanihara_log1.txt');
// SELECT処理
$result = (new Tb_kaiin_joho2())->searchAddress2($param);
error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log1.txt');
if ($result[0] == 0) {
    $result = 0;
} else {
    $result = 1;
}
echo $result;
die();


