<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';


// POSTデータを取得
//$kaiin_no = htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8");
//$pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");

//error_log(print_r($token, true). PHP_EOL, '3', 'tanaka_log.txt');


//$my_page_password = password_hash($_REQUEST[$my_page_password], PASSWORD_BCRYPT);


// データ更新処理
//$result = (new Tb_kaiin_joho())->updatePassword($pass);

echo $result;

die();