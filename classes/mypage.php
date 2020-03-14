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
$kaiin_no = "";

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}


/************************************************************
*決済データチェック処理 (決済途中の取引ステータスを取得して削除する)
*************************************************************/

//*******************未実装******************
//CmFregiInqueryStatus　　WebApplication\SharedClass\clsShFunction.vb
//　・cvw申込状況ALLから決済データを取得（wusp90100）
//　・F-REGI決済情報照会
//　・取引ステータス区分＝発行受付、発行取消（コンビニ、Pay-easyの支払いを途中でやめた）　→　決済途中のデータを削除
//　・取引ステータス区分＝決済開始、決済完了　→　ステータスを"OK"に更新

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
*会員有効期限チェック 
*************************************************************/

$yuko_hizuke = $result_kaiin['yuko_hizuke'];

$today = date('Y/m/d');
if(is_null($yuko_hizuke)){ 			// 有効日付なし　→　TRUE
	$yukokigenFlg =  TRUE;
}elseif($yuko_hizuke < $today){		// 有効日付<今日　→　FALSE
	$yukokigenFlg =  FALSE;
}else{								// 有効日付≧今日　→　TRUE
	$yukokigenFlg =  TRUE;
}

//SESSIONに値をセットする
$_SESSION['yukokigenFlg'] = $yukokigenFlg;

$result += array('yukokigenFlg' => $yukokigenFlg);



/************************************************************
*CSCS情報取得 
*************************************************************/

// CSCS情報
$result_cscs = (new Tb_nintei_meisai())->findCscsByKaiinNo($kaiin_no);

// 該当データありの場合
if ($result_cscs != "") {
	$result += $result_cscs;

	/************************************************************
	*CEU CSCS情報取得 
	*************************************************************/

	// CEU CSCS情報
	$result_ceu_cscs = (new Tb_kaiin_ceu())->findCscsByKaiinNo($kaiin_no);

	// 該当データありの場合
	if ($result_ceu_cscs != "") {
		$result += $result_ceu_cscs;
	}

}


/************************************************************
*NSCA-CAP情報取得 
*************************************************************/

// NSCA-CAP情報
$result_nsca = (new Tb_nintei_meisai())->findNscaByKaiinNo($kaiin_no);

// 該当データありの場合
if ($result_nsca != "") {
	$result += $result_nsca;

	/************************************************************
	*CEU NSCA-CAP情報取得 
	*************************************************************/

	// CEU NNSCA-CAP情報
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
