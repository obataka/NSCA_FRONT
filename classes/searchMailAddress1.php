<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

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
$result = (new Tb_kaiin_joho())->searchAddress1($param);
if ($result[0] == 0) {
    $result = 0;
} else {
    $result = 1;
}
echo $result;
die();


