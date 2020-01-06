<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';


// POSTデータを取得
$kaiin_no = htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8");
$mail_address = htmlentities($_POST['mail_address'], ENT_QUOTES, "UTF-8");

// データ取得処理
$result = (new Tb_kaiin_joho())->findByKaiinNoAndEmail($kaiin_no, $mail_address);

echo $result;

die();
