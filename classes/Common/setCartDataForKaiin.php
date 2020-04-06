<?php

namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Cm_control.php';
require '../DBAccess/Tb_hambai_konyusha_joho_meisai.php';
require '../DBAccess/Tb_hambai_konyusha_joho.php';
require '../DBAccess/Tb_hambai_joho.php';


/************************************************************
*初期化 
*************************************************************/
$konyusha_kbn = 1 ; // 購入者区分：会員
$user_id = "products";
$gokei_kingaku = 0;
$soryo = 0;

$tb_hambai_konyusha_joho = new Tb_hambai_konyusha_joho();
$tb_hambai_konyusha_joho_meisai = new Tb_hambai_konyusha_joho_meisai();
$tb_hambai_joho = new Tb_hambai_joho();

/************************************************************
*セッションから会員番号,購入ID取得 
*************************************************************/
$kaiin_no = "";
$konyu_id = "";

if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}else{
	echo 0;
}

if (isset($_SESSION['konyu_id'])) {
    $konyu_id = $_SESSION['konyu_id'];
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}else{
    $cart = [];
}

/************************************************************
*POSTから購入情報取得 
*************************************************************/

$hambai_id = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$hambai_kbn = (!empty($_POST['hambai_kbn'])) ? htmlentities($_POST['hambai_kbn'], ENT_QUOTES, "UTF-8") : "";
$size_kbn = (!empty($_POST['size_kbn'])) ? htmlentities($_POST['size_kbn'], ENT_QUOTES, "UTF-8") : "";
$color_kbn = (!empty($_POST['color_kbn'])) ? htmlentities($_POST['color_kbn'], ENT_QUOTES, "UTF-8") : "";
$hambai_sentakushi_kbn = (!empty($_POST['hambai_sentakushi_kbn'])) ? htmlentities($_POST['hambai_sentakushi_kbn'], ENT_QUOTES, "UTF-8") : "";
$kakaku = (!empty($_POST['kakaku'])) ? htmlentities($_POST['kakaku'], ENT_QUOTES, "UTF-8") : "";
$suryo = (!empty($_POST['suryo'])) ? htmlentities($_POST['suryo'], ENT_QUOTES, "UTF-8") : "";


/************************************************************
*cm_controlから送料取得 
*************************************************************/

$CmControl = (new Cm_control())->findById(1);
// 該当データなしの場合
if (empty($CmControl)) {
	// エラー
	return false;
}else{
	$cm_soryo = $CmControl['buppan_soyo'];
}


// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

/************************************************************
* カートがない場合は、新規に販売購入者情報、販売購入者情報明細を作成する
*************************************************************/
if(empty($cart)){

	$soryo = $cm_soryo;
	$gokei_kingaku = $kakaku * $suryo + $soryo;

	//購入者情報登録
	$param = [
	    'kaiin_no'              => $kaiin_no,
	    'konyusha_kbn'          => $konyusha_kbn,
	    'gokei_kingaku'         => $gokei_kingaku,
	    'soryo'                 => $soryo,
	    'user_id'               => $user_id
	];
	$result = $tb_hambai_konyusha_joho->insert($db, $param);
	$konyu_id = $tb_hambai_konyusha_joho->getLastKonyuId($db);

	if(!$result || !$konyu_id){
		error_log(print_r("購入者情報登録エラー", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
         $db->rollBack();
		 return false;
	}

	//購入者情報明細登録

	$param_meisai = [
	    'konyu_id'                => $konyu_id,
	    'hambai_id'               => $hambai_id,
	    'hambai_size_kbn'         => $hambai_size_kbn,
	    'hambai_color_kbn'        => $hambai_color_kbn,
	    'hambai_sentakushi_kbn'   => $hambai_sentakushi_kbn,
	    'kakaku'                  => $kakaku,
	    'suryo'                   => $suryo,
	    'user_id'                 => $user_id
	];

    $result = $tb_hambai_konyusha_joho_meisai->insert($db, $param_meisai);

	if(!$result){
		error_log(print_r("購入者情報明細登録エラー", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
         $db->rollBack();
		 return false;
	}

	//セッションにカート情報セット
    $_SESSION['konyu_id'] = $konyu_id;
    $_SESSION['gokei_kingaku'] = $gokei_kingaku;
    $_SESSION['soryo'] = $soryo;

$add_cart = [
	'hambai_id'               => $hambai_id, 
	'hambai_size_kbn'         => $hambai_size_kbn, 
	'hambai_color_kbn'        => $hambai_color_kbn, 
	'hambai_sentakushi_kbn'   => $hambai_sentakushi_kbn,
    'kakaku'                  => $kakaku,
    'suryo'                   => $suryo
];
//	$_SESSION['cart'] = array();
    $_SESSION['cart'] = $add_cart;

	error_log(print_r("***************　 カート　登録　***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
	error_log(print_r($konyu_id, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
	error_log(print_r($add_cart, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');


/************************************************************
* カートがあって購入IDがない場合（一般→会員）カートの内容をDBに登録する
* （価格は会員価格で取得しなおす）
*************************************************************/
}elseif($konyu_id == ""){
	error_log(print_r("***************　 カート　登録（一般→会員）　***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');



/************************************************************
* カート、購入IDがある場合（会員→会員）DB更新する
* （価格は会員価格で取得しなおす）
*************************************************************/
}else{
	error_log(print_r("***************　 カート　更新（会員→会員）　***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');



}


        $db->commit();





// 更新失敗の場合
//if ($result == false) {
//    $db->rollBack();

//    // 戻り値に0設定
    $result = 0;
//} else {

    //明細新規登録
//    $result = (new Tb_hambai_konyusha_joho_meisai())->insertKonyushaJohoMeisai($db, $param);
//    error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
    // 更新失敗の場合
//    if ($result == false) {
//        $db->rollBack();

        // 戻り値に0設定
//        $result = 0;
//    } else {
        // 更新成功の場合
        // commit
//        $db->commit();

        // 戻り値に1設定
//        $result = 1;
//    }
//}



echo $result;

die();
