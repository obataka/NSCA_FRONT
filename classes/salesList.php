<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_joho.php';
require './DBAccess/Tb_doga_joho.php';

$result_array = [];


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "";
//$kaiin_no = "819122001";

/************************************************************
*販売情報取得 
*************************************************************/

// 販売情報（動画以外）
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
		  'chuigaki' => $value['hambai_title_chuigaki'],
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

// 会員の場合は動画情報取得
if($kaiin_no != ""){

	// 販売情報（動画）
	$result_hambai_doga = (new Tb_hambai_joho())->findSalesListDogaByKaiinNo($kaiin_no);
	// 該当データなしの場合
	if ($result_hambai_doga == "") {

	// 該当データありの場合
	} else {

		foreach ($result_hambai_doga as $value) {
			$hambai_doga_array = array (
			  'kaiin_no' => $kaiin_no,
			  'hambai_id' => $value['hambai_id'],
			  'shurui' => $value['shurui'],
			  'hambai_kbn' => $value['hambai_kbn'],
			  'hambai_title' => $value['hambai_title'],
			  'chuigaki' => $value['hambai_title_chuigaki'],
			  'gaiyo' => $value['gaiyo'],
			  'gazo_url' => $value['gazo_url'],
			  'kakaku_zeikomi' => $value['kakaku_zeikomi'],
			  'kakaku_title' => $value['kakaku_title'],
			  'kaiin_kakaku_zeikomi' => $value['kaiin_kakaku_zeikomi'],
			  'kaiin_kakaku_title' => $value['kaiin_kakaku_title'],
			  'sample_url' => $value['sample_url']
			);
			array_push($result_array,$hambai_doga_array);
		}
	}

	// 動画情報
	$result_doga = (new Tb_doga_joho())->findSalesList($kaiin_no);
	// 該当データなしの場合
	if ($result_doga == "") {
	// 該当データありの場合
	} else {

		foreach ($result_doga as $value) {

			$hambai_kikan = "";
			$hambai_kaishi = (is_null($value['hambai_kaishi'])) ? "" : $value['hambai_kaishi'];
			$hambai_shuryo = (is_null($value['hambai_shuryo'])) ? "" : $value['hambai_shuryo'];

			if($value['hambai_shuryo_settei_kbn'] == 2){
				$hambai_kikan = $hambai_kaishi."～".$hambai_shuryo;
			}else{
				$hambai_kikan = $hambai_kaishi."～現在配信中";
			}

			$doga_array = array (
			  'kaiin_no' => $kaiin_no,
			  'hambai_id' => $value['doga_id'],
			  'shurui' => 2,
			  'hambai_kbn' => 0,
			  'hambai_title' => $value['doga_title'],
			  'chuigaki' => $hambai_kikan,
			  'gaiyo' => $value['gaiyo'],
			  'gazo_url' => $value['hyoji_gazo_url'],
			  'kakaku_zeikomi' => $value['kakaku'],
			  'kakaku_title' => "会員",
			  'kaiin_kakaku_zeikomi' => $value['kakaku'],
			  'kaiin_kakaku_title' => "会員",
			  'sample_url' => $value['sample_doga_url']
			);
			array_push($result_array,$doga_array);

		}
	}

}


	$ret = json_encode($result_array);

   error_log(print_r("販売情報取得", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');
   error_log(print_r($result_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

echo $ret;

die();
