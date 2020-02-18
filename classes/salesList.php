<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_joho.php';

$result_array = [];


/************************************************************
*セッションから会員番号取得 
*************************************************************/

//$kaiin_no = "";
$kaiin_no = "819122001";

/************************************************************
*販売情報取得 
*************************************************************/

// 販売情報
$result_hambai = (new Tb_hambai_joho())->findSalesListByKaiinNo($kaiin_no);

// 該当データなしの場合
if ($result_hambai == "") {
		array_push($result_array,array('kaiin_no'=>$kaiin_no,'hambai_id'=>''));
// 該当データありの場合
} else {

	foreach ($result_hambai as $value) {
		$hambai_array = array (
		  'kaiin_no' => $kaiin_no,
		  'hambai_id' => $value['hambai_id'],
		  'shurui' => $value['shurui'],
		  'hambai_kbn' => $value['hambai_kbn'],
		  'hambai_title' => $value['hambai_title'],
		  'gaiyo' => $value['gaiyo'],
		  'gazo_url' => $value['gazo_url'],
		  'kakaku_zeikomi' => $value['kakaku_zeikomi'],
		  'kakaku_title' => $value['kakaku_title'],
		  'kaiin_kakaku_zeikomi' => $value['kaiin_kakaku_zeikomi'],
		  'kaiin_kakaku_title' => $value['kaiin_kakaku_title']
		);
		array_push($result_array,$hambai_array);
	}

}


	$ret = json_encode($result_array);

   error_log(print_r("販売情報取得", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');
   error_log(print_r($result_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

echo $ret;

die();
