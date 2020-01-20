<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_ceu_joho.php';

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
$result_apply = (new Tb_ceu_joho())->findByKaiinNoMoushikomiZumi($kaiin_no);

// 該当データありの場合
if (!empty($result_apply)) {
	$result = $result_apply;

}else{
	$result = 0;
}



   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');


    $ret = json_encode($result);


echo $ret;

die();
