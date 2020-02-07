<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kyujin_joho.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "819122001";


/************************************************************
*POSTからページ番号取得 
*************************************************************/

// 画面初期表示時
$page_no = 1;


/************************************************************
*求人情報取得 
*************************************************************/


// 支払済情報
$result_kyujin_joho = (new Tb_kyujin_joho())->findShowData($page_no);

// 該当データありの場合
if (!empty($result_kyujin_joho)) {
	$result = $result_kyujin_joho;
}else{
	$result = 0;
}

	error_log(print_r('****求人情報取得', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka4_log.txt');
   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka4_log.txt');

    $ret = json_encode($result);


echo $ret;

die();
