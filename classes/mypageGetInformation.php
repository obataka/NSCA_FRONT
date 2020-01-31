<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_oshirase.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_jotai.php';



$ret = 0;


/************************************************************
*セッションから会員番号,有効期限フラグを取得
*************************************************************/

$kaiin_no = "819122001";
$yukokigenFlg = TRUE;


/************************************************************
*POSTからページ番号取得
*************************************************************/

// 画面初期表示時
$page_no = 1;


$result_array = [];

// ①会員情報取得

$result_kaiin =  (new Tb_kaiin_joho())->findByKaiinNo($kaiin_no);

//　③郵便物の不着(TB会員ジャーナル.発送停止日に日付あり)
if(!is_null($result_kaiin['hasso_teishibi'])){
	$yubin_array = array (
	  'naiyo' => '郵送物が戻ってきています。ご住所の確認をお願いいたします。',
	  'url' => '~/kaiin_joho/',
	  'button_title' => '登録情報',
	  'menu_no' => 'clsCommon.geumMenu.Menu_Member',
	  'syori__no' => 'clsCommon.geumMemberProcess.Process_Edit',
	  'button_sbt' => 'InfoButtonType.Button_Command',
	  'betsugamen' => 'no'
	);
	array_push($result_array,$yubin_array);

}

//　④退会予約の連絡あり(TB会員状態.退会書類受理日に日付あり)
if(!empty($result_kaiin['taikai_shorui_juribi'])){ // 退会予約済み

	$naiyo = "有効期限日".$result_kaiin['taikai_shorui_juribi']."付にての退会を承りました。";
	$taikai_array = array (
	  'naiyo' => $naiyo,
	  'url' => '',
	  'button_title' => '',
	  'menu_no' => '0',
	  'syori__no' => '0',
	  'button_sbt' => '',
	  'betsugamen' => 'no'
	);
	array_push($result_array,$taikai_array);


}elseif(!$yukokigenFlg){ // 有効期限切れ
error_log(print_r('有効期限切れ', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

	$naiyo = "会員有効期限が過ぎていますので、<span style='color: #ff0000; background-color: transparent'>継続手続き</span>をお願いいたします。";
	$kigen_array = array (
	  'naiyo' => $naiyo,
	  'url' => '~/kaiin_joho/',
	  'button_title' => '継続手続',
	  'menu_no' => 'clsCommon.geumMenu.Menu_Member',
	  'syori__no' => 'clsCommon.geumMemberProcess.Process_Continue',
	  'button_sbt' => 'InfoButtonType.Button_Command',
	  'betsugamen' => 'no'
	);
	array_push($result_array,$kigen_array);

}else{ // 有効期限切れ前
error_log(print_r('有効期限切れ前', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

	// 継続処理完了チェック
	$keizoku_kanryo = chkKeizokuStatus($kaiin_no);
	if(!$keizoku_kanryo){ 							// 継続完了前
error_log(print_r('有効期限切れ前----', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

		// 有効期限までの期間を確認する
        //有効期限まで２ヵ月を切っている→自動課金者とそれ以外でメッセージが異なる

		// 自動課金者
		// ピックアップ6 is not null && 一桁目="q"　→　自動課金者


		// 決済エラーなし
		if(is_null($result_kaiin['kaihi_kessai_error_code'])
				|| ($result_kaiin['kaihi_kessai_error_code'] != 1 && $result_kaiin['kaihi_kessai_error_code'] != 3)){		// 決済エラーなし

error_log(print_r('有効期限切れ前aa', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

				$yuko_month = date('n', strtotime($result_kaiin['yuko_hizuke']));

                // 英文オプションの有無によってメッセージを変える
				if(!is_null($result_kaiin['eibun_option']) &&  $result_kaiin['eibun_option'] == 1
						&& (is_null($result_kaiin['eibun_option_kikan_to'])) || $result_kaiin['eibun_option_kikan_to'] > $result_kaiin['yuko_hizuke']){

		             $naiyo = "年会費及び英文購読オプション会費はご登録のクレジットカードより".$yuko_month."月20日(土日祝日の場合は翌営業日)に自動支払い処理をいたします。";
				}else{

	                 $naiyo =  "年会費はご登録のクレジットカードより".$yuko_month."月20日(土日祝日の場合は翌営業日)に自動支払い処理をいたします。";

				}
				$kigen_array = array (
				  'naiyo' => $naiyo,
				  'url' => '',
				  'button_title' => '',
				  'menu_no' => '0',
				  'syori__no' => '0',
				  'button_sbt' => '',
				  'betsugamen' => 'no'
				);
				array_push($result_array,$kigen_array);

		}else{                                                                      		// 決済エラーあり
error_log(print_r('有効期限切れ前bb', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

				$kigen_array = array (
				  'naiyo' => 'ご登録のクレジットカードによる自動支払処理ができませんでした。別のクレジットカードまたはコンビニ払いにて継続手続きをお願いいたします。',
				  'url' => '~/kaiin_joho/',
				  'button_title' => '継続手続',
				  'menu_no' => 'clsCommon.geumMenu.Menu_Member',
				  'syori__no' => 'clsCommon.geumMemberProcess.Process_Continue',
				  'button_sbt' => 'InfoButtonType.Button_Command',
				  'betsugamen' => 'no'
				);
				array_push($result_array,$kigen_array);

		}

		// 自動課金者以外

//            If Me.継続会費の支払状況を確認する(ViewState("MemberID").ToString, intState) = False Then Return False

//            ' 支払状況
//            Select Case intState
//                Case clsCommon.geumContinuState.Cont_Non              ' 手続きしていない
//                    dtRow = rdtInfo.NewRow
//                    dtRow("内容") = "会員有効期限が近づいていますので継続手続をお願いいたします。"
//                    dtRow("URL") = "~/02_regist/EditMemberInfo.aspx"
//                    dtRow("ボタンタイトル") = "継続手続"
//                    dtRow("メニュー番号") = clsCommon.geumMenu.Menu_Member
//                    dtRow("処理番号") = clsCommon.geumMemberProcess.Process_Continue
//                    dtRow("ボタン種別") = InfoButtonType.Button_Command ' ボタン
//                    dtRow("別画面") = InfoLinKTarget.Target_Non



	}
}


		// 自動課金以外

		// 継続手続きの状況を確認
		// 手続きしていない場合

//                    dtRow("内容") = "会員有効期限が近づいていますので継続手続をお願いいたします。"
//                    dtRow("URL") = "~/02_regist/EditMemberInfo.aspx"
//                    dtRow("ボタンタイトル") = "継続手続"
//                    dtRow("メニュー番号") = clsCommon.geumMenu.Menu_Member
//                    dtRow("処理番号") = clsCommon.geumMemberProcess.Process_Continue
//                    dtRow("ボタン種別") = InfoButtonType.Button_Command ' ボタン
//                    dtRow("別画面") = InfoLinKTarget.Target_Non





// ②お知らせテーブル情報取得
	// 申込ボタン（会員有効期限が過ぎた場合は、申込ボタンは出力しない）
error_log(print_r('お知らせテーブル情報取得', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

$result_information =  (new Tb_oshirase())->findInformationData($kaiin_no);
error_log(print_r($result_information, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

if(!empty($result_information)){
	foreach ($result_information as $value) {
		$naiyo = $value['mongon'];
		$info_array = array (
		  'naiyo' => $naiyo,
		  'url' => '~/kaiin_joho/',
		  'button_title' => 'お申込',
		  'menu_no' => 'clsCommon.geumMenu.Menu_Member',
		  'syori__no' => 'clsCommon.geumMemberProcess.Process_Continue',
		  'button_sbt' => 'InfoButtonType.Button_Command',
		  'betsugamen' => 'no'
		);
		array_push($result_array,$info_array);
	}


}
error_log(print_r('*************************', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

error_log(print_r($result_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');







//①郵送物が戻ってきています。ご住所の確認をお願いいたします。
//　登録情報ボタン（会員情報修正に飛ぶ）
//（表示条件）
//　　→TB会員ジャーナル.発送停止日に日付あり（管理システムで入れる）

//　②有効期限切れ
//　　　継続手続ボタン（会員情報修正に飛ぶ）
//　　　　※登録画面修正と同じ画面だが、セッションに画面遷移元が入っており、
//　　　　　継続手続きモードになる。

//　③有効期限まで二か月切っている
//　　　自動課金の場合
//　　　　\\192.168.1.102\Earth\800.プロジェクト\NSCAジャパン\002.現状分析\030.IFファイル\エフレジ\年会費自動課金手順.xlsx
//　　　　に運用方法が記載されています。

//　　　自動課金でない場合
//　　　　メッセージ：会員有効期限が近づいていますので継続手続をお願いいたします。
//　　　　※登録画面修正と同じ画面だが、セッションに画面遷移元が入っており、
//　　　　　継続手続きモードになる。



//メッセージ：各種割引利用・イベント紹介・賛同事業紹介
	//各種割引利用ボタン　イベント賛同事業紹介ボタン


/***********************************************
 * 継続会費の支払状況を確認する
 * @params $yuko_hizuke
 ***********************************************/
function chkKeizokuStatus($kaiin_no) {
	error_log(print_r('継続会費の支払状況チェック', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

	// 決済データを取得する
	$result_kaiin_jotai =  (new Tb_kaiin_jotai())->findKeizokuKaihiByKaiinNo($kaiin_no);


	if(empty($result_kaiin_jotai)){	// 決済データなし　→　未手続
		return 0;
	}
//****************************************************************************************
//************************************************************************************
}



echo $ret;

die();
