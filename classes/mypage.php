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
*決済データチェック処理 (決済途中の取引ステータスを取得して削除する)
*************************************************************/

//*******************未実装******************
//CmFregiInqueryStatus

/************************************************************
*会員情報取得 
*************************************************************/
	error_log(print_r('****会員情報取得処理', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_log.txt');

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




/************************************************************
*有効期限切れ対策 
*************************************************************/

 //有効期限が切れた→継続処理以外は行わせない

//        ' ①　CEU取得状況
//        .lbtnCeuReport.Visible = False  ' CEU報告
//        .lbtnCeuState.Visible = False   ' CEU詳細画面へのリンク(詳しくはこちら)
//        .lblExamEntry.Visible = False   ' 認定資格無の場合の試験申込ボタンキャプション
//        .lbtnExamEntry.Visible = False  ' 認定資格無の場合の試験申込ボタン
//        .pnlCeuQuiz.Visible = False     ' クイズ一覧画面へのリンク
//        .pnlPersonal.Visible = False    ' パーソナルデベロップメント申告へのリンク
//        ' ②　会員限定コンテンツ
//        .lbtnContents.Visible = False   ' 限定コンテンツへのリンクボタン(パネル毎消すと空白が空きすぎる)
//        '.pnlPremiere.Visible = False
//
//        ' ③　セミナー一覧
//        .pnlSeminar.Visible = False
//        ' ④　求人一覧
//        .pnlKyujin.Visible = False








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
