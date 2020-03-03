<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_keiri_joho.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "";

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}


/************************************************************
*POSTからページ番号取得 
*************************************************************/

// 画面初期表示時
$page_no = 1;


/************************************************************
*イベント情報取得 
*************************************************************/

// 表示期間を設定

$standard_date = date("Y/05/01");

if(date("Y/m/d") > $standard_date ){
	// 基準日を超えた
	// 今年の1/1～現時点まで表示
	$start_date = date("Y/01/01");
	$end_date = date("Y/12/31");
}else{
	// 基準日前
	// 前年の1/1～現時点まで表示
	$start_date = date("Y/01/01", strtotime("-1 year"));
	$end_date = date("Y/12/31");
}

// 支払済情報
$result_keiri = (new Tb_keiri_joho())->findByKaiinNoShiharaizumi($kaiin_no, $start_date, $end_date);

// 該当データありの場合
if (!empty($result_keiri)) {
	$result = $result_keiri;
}else{
	$result = 0;
}

	error_log(print_r('****支払済情報', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

    $ret = json_encode($result);


echo $ret;

die();
