<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_token_front.php';


// POSTデータを取得
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");
//error_log(print_r($token, true). PHP_EOL, '3', 'tanaka_log.txt');

// データ取得処理
$result = (new Tb_kaiin_token_front())->findBytoken($token);
$kaiin_no = 0;
// 登録用会員番号生成用の連番を設定
if ($result['kaiin_no'] != '') {
    $kaiin_no = $result['kaiin_no'];
}

echo $kaiin_no;

die();
