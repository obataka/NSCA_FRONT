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

$kaiin_no = "819122001";

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

   error_log(print_r("****販売詳細情報取得****", true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');
   error_log(print_r($result_hambai, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

    echo json_encode($result_hambai);

}


//	$ret = json_encode($result_array);



die();
