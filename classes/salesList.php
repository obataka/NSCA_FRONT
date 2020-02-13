<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_joho.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "819122001";


/************************************************************
*販売情報取得 
*************************************************************/

// 販売情報
$result_hambai = (new Tb_hambai_joho())->findSalesListByKaiinNo($kaiin_no);
// 該当データなしの場合
if ($result_hambai == "") {
    $ret = 0;
// 該当データありの場合
} else {
	$ret = json_encode($result_hambai);
}


   error_log(print_r("販売情報取得", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');
   error_log(print_r($result_hambai, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

//    $ret = json_encode($result_hambai);


echo $ret;

die();
