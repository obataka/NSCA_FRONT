<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_token_front.php';

$ret = 0;

// POSTデータを取得
$kaiin_no = htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8");
$pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");

$my_page_password = password_hash($pass, PASSWORD_BCRYPT);

// 登録用パラメーター設定
 $param = [
     'kaiin_no'         => $kaiin_no,
     'my_page_password' => $my_page_password
 ];

// 会員情報　パスワード更新処理
$result = (new Tb_kaiin_joho())->updatePassword($param);

if ($result) {

    // トークンデータ削除処理
    $result2 = (new Tb_kaiin_token_front())->deleteRec($kaiin_no);

    if ($result2) {
        $ret = 1;
    }
}

echo $ret;

die();
