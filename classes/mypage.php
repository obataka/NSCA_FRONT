<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "819122001";





/************************************************************
*会員情報取得 
*************************************************************/

// 会員情報　パスワード更新処理
$result = (new Tb_kaiin_joho())->findByKaiinNo($kaiin_no);

// 該当データなしの場合
if ($result == "") {
    $ret = 0;

// 該当データありの場合
} else {
//$result['my_page_password'] 
    $ret = json_encode($result);

}

 //           error_log(print_r($ret, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');


echo $ret;

die();
