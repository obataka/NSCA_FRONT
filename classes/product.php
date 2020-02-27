<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_joho.php';

/************************************************************
*POSTから販売ID 
*************************************************************/

// POSTデータを取得
$hambaiId = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";


/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "";
//$kaiin_no = "819122001";

/************************************************************
*販売情報取得 
*************************************************************/

// 販売情報
$result_hambai = (new Tb_hambai_joho())->findProductByHambaiId($hambaiId,$kaiin_no);

// 該当データなしの場合
if ($result_hambai == "") {

// エラー
echo 0;

//		array_push($result_array,array('kaiin_no'=>$kaiin_no,'hambai_id'=>''));
// 該当データありの場合
} else {


		$hambai_array = array (
		  'kaiin_no' => $kaiin_no,
		  'hambai_id' => $result_hambai['hambai_id'],
		  'shurui' => $result_hambai['shurui'],
		  'hambai_kbn' => $result_hambai['hambai_kbn'],
		  'hambai_title' => $result_hambai['hambai_title'],
		  'hambai_title_chuigaki' => $result_hambai['hambai_title_chuigaki'],
		  'hambai_title_tsuiki' => $result_hambai['hambai_title_tsuiki'],
		  'gaiyo' => $result_hambai['gaiyo'],
		  'setsumei' => $result_hambai['setsumei'],
		  'gazo_url' => $result_hambai['gazo_url'],
		  'setsumei_gazo_url_1' => $result_hambai['setsumei_gazo_url_1'],
		  'setsumei_gazo_url_2' => $result_hambai['setsumei_gazo_url_2'],
		  'setsumei_gazo_url_3' => $result_hambai['setsumei_gazo_url_3'],
		  'setsumei_gazo_url_4' => $result_hambai['setsumei_gazo_url_4'],
		  'kakaku_zeikomi' => $result_hambai['kakaku_zeikomi'],
		  'kakaku_title' => $result_hambai['kakaku_title'],
		  'ippan_kakaku_zeikomi' => $result_hambai['ippan_kakaku_zeikomi'],
		  'kaiin_kakaku_zeikomi' => $result_hambai['kaiin_kakaku_zeikomi'],
		  'kaiin_kakaku_title' => $result_hambai['kaiin_kakaku_title']
		);


   error_log(print_r("****販売詳細情報取得****", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');
   error_log(print_r($hambai_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

    echo json_encode($hambai_array);

}


//	$ret = json_encode($result_array);



die();
