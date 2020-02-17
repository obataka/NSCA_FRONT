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

//$kaiin_no = "";
$kaiin_no = "819122001";

//$result_array = array('kaiin_no'=>$kaiin_no);
/************************************************************
*販売情報取得 
*************************************************************/

// 販売情報
$result_hambai = (new Tb_hambai_joho())->findSalesListByKaiinNo($kaiin_no);
// 該当データなしの場合
if ($result_hambai == "") {
//    $ret = 0;
// 該当データありの場合
} else {
//	$result_array = $result_hambai;

	foreach ($result_hambai as $value) {
		$hambai_array = array (
		  'kaiin_no' => $kaiin_no,
		  'hambai_id' => $value['hambai_id'],
		  'hambai_kbn' => $value['hambai_kbn'],
		  'hambai_title' => $value['hambai_title'],
		  'gaiyo' => $value['gaiyo'],
		  'gazo_url' => $value['gazo_url'],
		  'kakaku_zeikomi' => $value['kaiin_kakaku_zeikomi'],
		  'kakaku_title' => $value['kakaku_title'],
		  'kaiin_kakaku_zeikomi' => $value['kaiin_kakaku_zeikomi'],
		  'kaiin_kakaku_title' => $value['kakaku_title']
		);
		array_push($result_array,$hambai_array);
	}

}





/************************************************************
*動画情報取得 
*************************************************************/

// ログインしている場合のみ動画情報を表示する

if($kaiin_no != ""){

	// 動画情報
	$result_doga = (new Tb_doga_joho())->findOnSaleDogaJoho();
	// 該当データなしの場合
	if ($result_doga == "") {
	//    $ret = 0;
	// 該当データありの場合
	} else {
	//	$result_array = $result_hambai;

		foreach ($result_doga as $value) {
			if(!$yukokigenFlg){ // 有効期限切れ
				$button_text = "";
			}else{
				$button_text = $value['button_text'];
			}
			$doga_array = array (
			  'kaiin_no' => $kaiin_no,
			  'hambai_id' => $value['doga_id'],
			  'hambai_kbn' => 99,
			  'hambai_title' => $value['doga_title'],
			  'gazo_url' => $value['sample_doga_url'],
			  'kakaku_zeikomi' => $value['kakaku_zeikomi'],
			  'kakaku_title' => '会員',
			  'kaiin_kakaku_zeikomi' => 0,
			  'kaiin_kakaku_title' => 0
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
