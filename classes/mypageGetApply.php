<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Vmoshikomi_jokyo.php';

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
*イベント情報取得 
*************************************************************/

// 会員情報
$result_apply = (new Vmoshikomi_jokyo())->findByKaiinNo($kaiin_no);

// 該当データありの場合
if (!empty($result_apply)) {
   error_log(print_r('申込データあり', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	$result = $result_apply;

}else{
	$result = 0;
   error_log(print_r('申込データなし', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
}



   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');


    $ret = json_encode($result);


echo $ret;

die();
