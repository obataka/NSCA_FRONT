<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_hambai_joho.php';
require './DBAccess/Tb_doga_joho.php';

/************************************************************
*POSTから販売ID,動画ID 
*************************************************************/

// POSTデータを取得
$hambaiId = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$dogaId = (!empty($_POST['doga_id'])) ? htmlentities($_POST['doga_id'], ENT_QUOTES, "UTF-8") : "";

	   error_log(print_r("****動画 parameter****", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($hambaiId, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($dogaId, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

/************************************************************
*セッションから会員番号取得 
*************************************************************/

$kaiin_no = "819122001";


if($hambaiId !=""){
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
			  'doga_id' => "",
			  'hambai_title' => $result_hambai['hambai_title'],
			  'hambai_title_chuigaki' => $result_hambai['hambai_title_chuigaki'],
			  'hambai_title_tsuiki' => $result_hambai['hambai_title_tsuiki'],
			  'gaiyo' => $result_hambai['gaiyo'],
			  'umekomi_tag' => $result_doga['umekomi_tag'],
			  'setsumei' => $result_hambai['setsumei'],
			  'gazo_url' => $result_hambai['gazo_url'],
			  'setsumei_gazo_url_1' => $result_hambai['setsumei_gazo_url_1'],
			  'setsumei_gazo_url_2' => $result_hambai['setsumei_gazo_url_2'],
			  'setsumei_gazo_url_3' => $result_hambai['setsumei_gazo_url_3'],
			  'setsumei_gazo_url_4' => $result_hambai['setsumei_gazo_url_4'],
			  'sample_doga_url' => $result_doga['sample_url'],
			  'kakaku_zeikomi' => $result_hambai['kakaku_zeikomi']
			);

	   error_log(print_r("****動画販売詳細情報取得****", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($hambai_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

	    echo json_encode($hambai_array);
	}
}else{

	/************************************************************
	*動画情報取得 
	*************************************************************/
	// 動画情報
	$result_doga = (new Tb_doga_joho())->findProductByDogaId($dogaId,$kaiin_no);

	// 該当データなしの場合
	if ($result_doga == "") {
		// エラー
		echo 0;
	//		array_push($result_array,array('kaiin_no'=>$kaiin_no,'hambai_id'=>''));
	// 該当データありの場合
	} else {

			$doga_array = array (
			  'kaiin_no' => $kaiin_no,
			  'hambai_id' => "",
			  'doga_id' => $result_doga['doga_id'],
			  'hambai_title' => $result_doga['doga_title'],
			  'hambai_title_chuigaki' => "",
			  'hambai_title_tsuiki' => "",
			  'gaiyo' => $result_doga['gaiyo'],
			  'umekomi_tag' => $result_doga['umekomi_tag'],
			  'setsumei' => "",
			  'gazo_url' => $result_doga['hyoji_gazo_url'],
			  'setsumei_gazo_url_1' => "",
			  'setsumei_gazo_url_2' => "",
			  'setsumei_gazo_url_3' => "",
			  'setsumei_gazo_url_4' => "",
			  'sample_doga_url' => $result_doga['sample_doga_url'],
			  'kakaku_zeikomi' => $result_doga['kakaku']
			);

	   error_log(print_r("****動画販売詳細情報取得****", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($doga_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

	    echo json_encode($doga_array);



	}
}

//	$ret = json_encode($result_array);



die();
