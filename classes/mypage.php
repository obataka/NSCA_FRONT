<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Tb_kaiin_ceu.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "819122001";





/************************************************************
*会員情報取得 
*************************************************************/

// 会員情報
$result_kaiin = (new Tb_kaiin_joho())->findByKaiinNo($kaiin_no);

// 該当データなしの場合
if ($result_kaiin == "") {
    $ret = 0;
// 該当データありの場合
} else {
	$result = $result_kaiin;
}



/************************************************************
*CSCS情報取得 
*************************************************************/

// 会員情報
$result_cscs = (new Tb_nintei_meisai())->findCscsByKaiinNo($kaiin_no);

// 該当データありの場合
if ($result_cscs != "") {
	$result += $result_cscs;

	/************************************************************
	*CEU CSCS情報取得 
	*************************************************************/

	// 会員情報
	$result_ceu_cscs = (new Tb_kaiin_ceu())->findCscsByKaiinNo($kaiin_no);

	// 該当データありの場合
	if ($result_ceu_cscs != "") {
		$result += $result_ceu_cscs;
	}

}


/************************************************************
*NSCA-CAP情報取得 
*************************************************************/

// 会員情報
$result_nsca = (new Tb_nintei_meisai())->findNscaByKaiinNo($kaiin_no);

// 該当データありの場合
if ($result_nsca != "") {
	$result += $result_nsca;

	/************************************************************
	*CEU NSCA-CAP情報取得 
	*************************************************************/

	// 会員情報
	$result_ceu_nsca = (new Tb_kaiin_ceu())->findNscaByKaiinNo($kaiin_no);

	// 該当データありの場合
	if ($result_ceu_nsca != "") {
		$result += $result_ceu_nsca;
	}

}



   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');


    $ret = json_encode($result);


echo $ret;

die();
