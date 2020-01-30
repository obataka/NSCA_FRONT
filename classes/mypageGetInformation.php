<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_oshirase.php';
require './DBAccess/Tb_kaiin_joho.php';



$ret = 0;


/************************************************************
*セッションから会員番号取得
*************************************************************/

$kaiin_no = "819122001";


/************************************************************
*POSTからページ番号取得
*************************************************************/

// 画面初期表示時
$page_no = 1;


// ①会員情報取得

$result_kaiin =  (new Tb_kaiin_joho())->findByKaiinNo($kaiin_no);

error_log(print_r('会員情報取得', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');
error_log(print_r($result_kaiin, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');


	// 有効期限チェック
$yukokigenFlg = TRUE;

// ②お知らせテーブル情報取得
	// 申込ボタン（会員有効期限が過ぎた場合は、申込ボタンは出力しない）

$result_information =  (new Tb_oshirase())->findInformationData($kaiin_no);



//　③郵便物の不着(TB会員ジャーナル.発送停止日に日付あり)
if(!is_null($result_kaiin['hasso_teishibi'])){

//                dtRow("内容") = "郵送物が戻ってきています。ご住所の確認をお願いいたします。"
//                dtRow("URL") = "~/02_regist/EditMemberInfo.aspx"
//                dtRow("ボタンタイトル") = "登録情報"
//                dtRow("メニュー番号") = clsCommon.geumMenu.Menu_Member
//                dtRow("処理番号") = clsCommon.geumMemberProcess.Process_Edit
//                dtRow("ボタン種別") = InfoButtonType.Button_Command
//                dtRow("別画面") = InfoLinKTarget.Target_Non
}

//　④退会予約の連絡あり(TB会員状態.退会書類受理日に日付あり)
if(!empty($result_kaiin['taikai_shorui_juribi'])){ // 退会予約済み

//                dtRow("内容") = "有効期限日" & dtmMemLimit.ToString("yyyy年MM月dd日") & "付にての退会を承りました。"
//                dtRow("URL") = String.Empty
//                dtRow("ボタンタイトル") = String.Empty
//                dtRow("メニュー番号") = 0
//                dtRow("処理番号") = 0
//                dtRow("ボタン種別") = InfoButtonType.Button_Non
//                dtRow("別画面") = InfoLinKTarget.Target_Non

}elseif(!$yukokigenFlg){ // 有効期限切れ

	//   ' 継続手続きの有無を確認しメッセージを表示する
	//  If Me.SetContenuForGrya(row, dtinfo) = False Then Return False
	// 継続手続きをしていない場合
//                    dtRow("内容") = "会員有効期限が過ぎていますので、<span style='color: #ff0000; background-color: transparent'>継続手続き</span>をお願いいたします。"
//                    dtRow("URL") = "~/02_regist/EditMemberInfo.aspx"
//                    dtRow("ボタンタイトル") = "継続手続"
//                    dtRow("メニュー番号") = clsCommon.geumMenu.Menu_Member
//                    dtRow("処理番号") = clsCommon.geumMemberProcess.Process_Continue
//                    dtRow("ボタン種別") = InfoButtonType.Button_Command ' ボタン
//                    dtRow("別画面") = InfoLinKTarget.Target_Non



}else{ // 有効期限切れ前

	// 継続処理完了チェック
	$keizoku_kanryo = FALSE;
	if(!$keizoku_kanryo){ // 継続完了前

		// 有効期限までの期間を確認する
        //有効期限まで２ヵ月を切っている→自動課金者とそれ以外でメッセージが異なる

		// 自動課金者
		// 決済エラーなし
		if(is_null($result_kaiin['kaihi_kessai_error_code'])
				|| ($result_kaiin['kaihi_kessai_error_code'] != 1 && $result_kaiin['kaihi_kessai_error_code'] != 3)){		// 決済エラーなし

                // 英文オプションの有無によってメッセージを変える
				if(!is_null($result_kaiin['eibun_option']) &&  $result_kaiin['eibun_option'] == 1
						&& (is_null($result_kaiin['eibun_option_kikan_to'])) || $result_kaiin['eibun_option_kikan_to'] > $result_kaiin['yuko_hizuke']){

//              dtRow("内容") = "年会費及び英文購読オプション会費はご登録のクレジットカードより" & dtmLimit.Month & "月20日(土日祝日の場合は翌営業日)に自動支払い処理をいたします。"
				}else{

//                 dtRow("内容") = "年会費はご登録のクレジットカードより" & dtmLimit.Month & "月20日(土日祝日の場合は翌営業日)に自動支払い処理をいたします。"

				}


//                        dtRow("URL") = String.Empty
//                        dtRow("ボタンタイトル") = String.Empty
//                        dtRow("メニュー番号") = 0
//                        dtRow("処理番号") = 0
//                        dtRow("ボタン種別") = InfoButtonType.Button_Non ' ボタン
//                        dtRow("別画面") = InfoLinKTarget.Target_Non

		}else{                                                                      		// 決済エラーあり

//                        dtRow("内容") = "ご登録のクレジットカードによる自動支払処理ができませんでした。別のクレジットカードまたはコンビニ払いにて継続手続きをお願いいたします。"
//                        dtRow("URL") = "~/02_regist/EditMemberInfo.aspx"
//                        dtRow("ボタンタイトル") = "継続手続"
//                        dtRow("メニュー番号") = clsCommon.geumMenu.Menu_Member
//                        dtRow("処理番号") = clsCommon.geumMemberProcess.Process_Continue
//                        dtRow("ボタン種別") = InfoButtonType.Button_Command ' ボタン
//                        dtRow("別画面") = InfoLinKTarget.Target_Non

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

	}
}







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













echo $ret;

die();
