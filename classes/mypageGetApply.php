<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Vmoshikomi_jokyo.php';
require './DBAccess/Tb_keiri_joho.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Tb_kessai_hakko.php';
require './DBAccess/Tb_hambai_konyusha_joho.php';
require './DBAccess/Tb_hambai_konyusha_joho_meisai.php';

$ret = 0;


/************************************************************
*セッションから会員番号取得
*************************************************************/
$kaiin_no = '';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}

/************************************************************
*POSTからページ番号取得
*************************************************************/

// 画面初期表示時
$page_no = 1;
$kessai_check_jikan = "";


	   error_log(print_r('申込状況**************************', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

// コントロールマスタ取得
$result_control = (new Cm_control())->findById(1);
if (!empty($result_control)) {
	$kessai_check_jikan = $result_control['kessai_check_jikan'];
}
	   error_log(print_r('決済チェック時間', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($kessai_check_jikan, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');


// 申込内容取得
$result_apply = getMousikomiData($kaiin_no);
if (!empty($result_apply)) {
	// 物販のチェック
	error_log(print_r('申込状況をチェック--', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	chkMousikomiData($result_apply);
}

// 申込内容取得
$result_apply2 = getMousikomiData($kaiin_no);
if (!empty($result_apply2)) {
	// 画面表示データ作成
	$result_array = createMousikomiData($result_apply2);
}


// 名刺データ取得
//	$result_meishi = (new Tb_hambai_konyusha_joho_meisai())->findMeishiJohoByKaiinNo($kaiin_no);
//if (!empty($result_meishi)) {
	// 画面表示データ作成
//	$result_array = createMousikomiMeishiData($result_meishi);
//}


	   error_log(print_r($result_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');


    $ret = json_encode($result_array);



/**********************************************
 * 申込内容を取得
 * @params $kaiin_no
 **********************************************/
function getMousikomiData($kaiin_no) {

	// 申込内容
	$result_apply = (new Vmoshikomi_jokyo())->findByKaiinNo($kaiin_no);

	// 該当データありの場合
	if (!empty($result_apply)) {
	   error_log(print_r('申込データあり', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	}else{
	   error_log(print_r('申込データなし', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	}

		return $result_apply;

}

/**************************************************************
 * 物販申込状況をチェック
 * クレジットで決済までいかない場合はボタン非表示（再購入可能）
 * @params Array $result
 **************************************************************/
function chkMousikomiData($result) {

	foreach ($result as $value) {

	   error_log(print_r('申込状況チェック', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		$yokuseiFlg = 0;
		$retKessaiHakko = 0;
		$pay_type_specify = $value['pay_type_specify'];

		if ($pay_type_specify == "20" || $pay_type_specify == "40"){ // コンビニorPayeasy

	 	  error_log(print_r('支払いタイプ：コンビニ', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

			// 決済時間チェック
			$yokuseiFlg = chkYokuseiKikan($value['koshin_nichiji'],$value['syutoku_nichiji']);

			if($yokuseiFlg == 0){ // ■ 開放(現行仕様)

		        // コンビ二、Payeasyなら決済開始までいかない場合はボタン表示（再決済可能）
				if($value['kessai_kekka'] == "OK" && $value['status'] == ""){

					// *********************************************************************************
					// *********************************************************************************
					// $value['id'],$value['settleno']からF-REGI決済情報照会
					// $retResult(OK/NG/CANCEL)
					// $retStatus(1:発行受付/2:発行取消/3:決済開始/4:決済完了/5:決済中断/6:決済完了後取消/7:有効期限切れ
					// *********************************************************************************
					// *********************************************************************************
					 $retResult = "OK";
					 $retStatus = "3";

					if($retResult == "OK"){
	                 // 取引ステータス区分のチェック
						if($retStatus == "3" || $retStatus == "4"){
							// *********************************************************************************
							// トランザクション開始
							// 決済開始はステータスを"OK"に更新　※一覧に表示
		   error_log(print_r('決済発行テーブルを更新：OK', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
							$retKessaiHakko = updateKessaiHakko($value['id'],$value['settleno'],"OK");
							if(!$retKessaiHakko){
								return false;
							}
							// トランザクション完了
						}

					}else{
							// ステータスを"NG"に更新
		   error_log(print_r('決済発行テーブルを更新：NG', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
							$retKessaiHakko = updateKessaiHakko($value['id'],$value['settleno'],"NG");
							if(!$retKessaiHakko){
								return false;
							}
					}
				}

			}elseif($yokuseiFlg == 1){ //  ■抑制中(抑制中仕様)
				// チェックなし
			}


		}elseif($pay_type_specify == "10"){ // カード
		    // 物販の場合、クレジットで決済までいかない場合はボタン非表示（再購入可能）
		   error_log(print_r('支払いタイプ：カード', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

			$yokuseiFlg = chkYokuseiKikan($value['koshin_nichiji'],$value['syutoku_nichiji']);

			if($yokuseiFlg == 0){ //  ■ 開放(現行仕様)
				// ステータス確認
				if($value['status'] == ""){
	                // 同一購入者ID(ETCID)を保持する後発のTB経理情報があるか確認する
				    $result_hakko = (new Tb_kessai_hakko())->findByEtcId($value['id'],$value['etc_id']);

					// 同一ETCIDを持つ後発データなし
					if (empty($result_hakko)) {

						// 購入販売情報の購入方法区分、購入日をクリア
						$ret_hakko = (new Tb_hambai_konyusha_joho())->updateKonyubi($value['kaiin_no'],$value['etc_id'],"mypage");

					// 同一ETCIDを持つ後発データあり
					}else{

		                // 経理情報を削除する(後発の伝票がある為)
						if(!is_null($value['id']) && !empty($value['id'])){
							$result_keiri = (new Tb_keiri_joho())->updateSakujoFlg($value['id'],"mypage");
						}

					}
				}


			}elseif($yokuseiFlg == 1){ //  ■抑制中(抑制中仕様)
				// チェックなし
			}

		}else{
		   error_log(print_r('支払いタイプ：その他', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		}

	}
}


/**********************************************
 * 画面表示データ作成
 * @params Array $result
 **********************************************/
function createMousikomiData($result) {
	$result_array = [];
	global $kessai_check_jikan;

	$array_event = array(40,41,42,60);		// イベント区分=40、41、42、60（会費・CEU報告・英文オプション・物販）
	   error_log(print_r('画面表示データ作成', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');


	foreach ($result as $value) {
		$yokusei_Flg = FALSE;
		$shiharai_button = "";
		$shiharai = "";
		$kakunin = "";
		$kakunin_class = "";
		$tetuzuki = "";
		$shosai = "";

		if (empty($value['id']) || $value['id'] ==""){	// ID=null,0の場合は管理システム作成のため
	   error_log(print_r('ID=null,0の場合は管理システム作成のため', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
			$yokusei_Flg = TRUE;
		}elseif($value['staff_kbn'] != 0){	// スタッフ区分<>0の場合（スタッフ）
	   error_log(print_r('スタッフ区分<>0の場合', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
			$yokusei_Flg = TRUE;
//		}elseif(in_array($value['event_kbn'] , $array_event)){	
		}elseif(in_array($value['event_kbn'] , array(40,41,42,60))){	
		}elseif(empty($value['nonyu_kingaku'])){	// 配列のイベント区分以外で参加料null(0円)
	   error_log(print_r('参加料null(0円)', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
			$yokusei_Flg = TRUE;
		}else{
			// 経過時間チェック
			// ■ 抑制時間(分)はcm_controlの決済チェック時間
			if(!empty($value['koshin_nichiji'])){

//$kessai_check_jikan
			}
//			        ' 更新日時から取得日時までの経過時間を取得する
//			        If String.IsNullOrEmpty(Server.HtmlDecode(e.Row.Cells(20).Text)) OrElse
//			           String.IsNullOrEmpty(Server.HtmlDecode(e.Row.Cells(21).Text)) Then
//			        Else
//			            Dim dtmUpdateData As DateTime = DateTime.Parse(Server.HtmlDecode(e.Row.Cells(20).Text))   ' ■ TB決済発行 更新日時
//			            Dim dtmGetData As DateTime = DateTime.Parse(Server.HtmlDecode(e.Row.Cells(21).Text))      ' ■ 申込状況 取得日時
//			            Dim interval As TimeSpan = dtmGetData.Subtract(dtmUpdateData)                             ' ■ 更新日時と取得日時の経過時間
//			            Dim int抑制時間 As Integer = Integer.Parse(ViewState("決済チェック時間"))                 ' ■ 抑制時間(分)
//			            ' ②トータル経過時間(分)確認
//			            If interval.TotalMinutes > int抑制時間 Then
//			                intCheckmate = clsCommon.geumSettlementChkKbn.Check_Open        ' ■ 開放　0
//			            Else
//			                ' ③入金確認
//			                If String.IsNullOrEmpty(Server.HtmlDecode(e.Row.Cells(4).Text).Trim) Then
//			                    ' 未入金
//			                    intCheckmate = clsCommon.geumSettlementChkKbn.Check_Close   ' ■ 抑制中　1
//			                Else
//			                    ' 入金済み
//			                    intCheckmate = clsCommon.geumSettlementChkKbn.Check_Open    ' ■ 開放
//			                End If
//			            End If
//			        End If

		}
	   error_log(print_r('*-*-*-*-*-*-*-*-*-*-* 抑制flg *-*-*-*-*-*-*-*-*-*-*', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	   error_log(print_r($yokusei_Flg, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');

		if($yokusei_Flg == 0){ // ■ 開放(現行表示仕様) ===========================================
			if(empty($value['nonyubi'])){
				$shiharai_button = "支払い";
				$kakunin = "支払方法を選択してご入金お願いします。";
				$kakunin_class = "text-danger";
//                        lbtnPayment.Visible = True
//                        lblNote.Text = "支払方法を選択してご入金お願いします。"
//                        lblNote.Visible = True
//                        lblNote.CssClass = "form-label text-danger"
//                        lblComp.Visible = False
			}else{
				$kakunin = "入金を確認致しました。";
//                        lblNote.Text = "入金を確認致しました。"
//                        lblNote.Visible = True
//                        lblNote.CssClass = String.Empty
//                        lblComp.Visible = True
			}
	//     ' 経理IDがない場合は管理システムから追加された参加者データとする
	//     ' 12/2現在対応が完了しているのはセミナーのみの為、セミナー以外は支払ボタンを非表示とする

			if(empty($value['id'])){ // ■ID(伝票番号)が取得できない場合

				switch ($value['event_kbn']) {
					case 4:			// Seminar
					case 5:			// Counterplan
					case 6:			// UnionScience
					case 7:			// SpecialNintei
					case 99:		// OtherEvent

							if($value['nonyu_hoho_kbn'] == 2){ // コンビニ
								if(empty($value['nonyubi'])){
										$kakunin = "コンビ二からのご入金お願いします。";
//                                        lblNote.Text = "コンビ二からのご入金お願いします。"
								}else{
										$kakunin = "コンビ二からの入金を確認致しました。";
//                                        lblNote.Text = "コンビ二からの入金を確認致しました。"
								}
//                                    lblNote.Visible = True
							}elseif($value['nonyu_hoho_kbn'] == 4){ // Payeasy
								if(empty($value['nonyubi'])){
										$kakunin = "金融機関(Pay-easy)からのご入金お願いします。";
//                                        lblNote.Text = "金融機関(Pay-easy)からのご入金お願いします。"
								}else{
										$kakunin = "金融機関(Pay-easy)からの入金を確認致しました。";
//                                        lblNote.Text = "金融機関(Pay-easy)からの入金を確認致しました。"
								}
//                                    lblNote.Visible = True

							}elseif($value['nonyu_hoho_kbn'] == 1){ // Card
								if(empty($value['nonyubi'])){
										$kakunin = "支払方法を選択してご入金お願いします。";
//                                        lblNote.Text = "支払方法を選択してご入金お願いします。"
								}else{
										$kakunin = "金融機関(クレジット)からの入金を確認致しました。";
//                                        lblNote.Text = "金融機関(クレジット)からの入金を確認致しました。"
								}
//                                    lblNote.Visible = True

							}
							break;

					default:		// ■セミナー以外の管理システム追加参加者

							if(empty($value['nonyubi'])){
										$kakunin = "支払方法が不明な場合はお問い合わせください。";
										$kakunin_class = "text-danger";
//                                    lblNote.Text = "支払方法が不明な場合はお問い合わせください。"
//                                    lblNote.Visible = True
//                                    lblNote.CssClass = "form-label text-danger"
//                                    lblComp.Visible = False
							}else{
										$kakunin = "入金を確認致しました。";
//                                    lblNote.Text = "入金を確認致しました。"
//                                    lblNote.Visible = True
//                                    lblNote.CssClass = String.Empty
										$shiharai = "済";
//                                    lblComp.Visible = True
							}
				}
			}else{ // ■ID(伝票番号)が取得できた場合

				if($value['nonyu_hoho_kbn'] == 2){ // コンビニ
					if(empty($value['nonyubi'])){
						$kakunin = "コンビ二からのご入金お願いします。";
//                                        lblNote.Text = "コンビ二からのご入金お願いします。"
					}else{
						$kakunin = "コンビ二からの入金を確認致しました。";
//                                        lblNote.Text = "コンビ二からの入金を確認致しました。"
					}
//                                    lblNote.Visible = True
				}elseif($value['nonyu_hoho_kbn'] == 4){ // Payeasy
					if(empty($value['nonyubi'])){
						$kakunin = "金融機関(Pay-easy)からのご入金お願いします。";
//                                        lblNote.Text = "金融機関(Pay-easy)からのご入金お願いします。"
					}else{
						$kakunin = "金融機関(Pay-easy)からの入金を確認致しました。";
//                                        lblNote.Text = "金融機関(Pay-easy)からの入金を確認致しました。"
					}
//                                    lblNote.Visible = True

				}elseif($value['nonyu_hoho_kbn'] == 1){ // Card
					if(empty($value['nonyubi'])){
						$kakunin = "支払方法を選択してご入金お願いします。";
//                                        lblNote.Text = "支払方法を選択してご入金お願いします。"
					}else{
						$kakunin = "金融機関(クレジット)からの入金を確認致しました。";
//                                        lblNote.Text = "金融機関(クレジット)からの入金を確認致しました。"
					}
//                                    lblNote.Visible = True
				}  
			}  

           // キャンセルボタンの表示切替制御
			if(empty($value['cancel_shimekiribi'])){ // キャンセル締切日が設定されていない
                 // イベント区分(継続・英文オプション・物販にキャンセルボタンを表示しない)
				if(in_array($value['event_kbn'] , array(40,42,60))){
//                            linkCancelBtn.Visible = False
				}else{
					$tetuzuki = "キャンセルはこちら";
//                            linkCancelBtn.Visible = True
				}
			}else{ // キャンセル締切日が設定されている
                        //キャンセル締切日を過ぎていればキャンセルボタンを非表示
				if($value['cancel_shimekiribi'] < date("Y/m/d")){
//                            linkCancelBtn.Visible = False
				}
			}

//      スタッフ(講師、アシスタント、ボランティア)での表示切替
		if($value['staff_kbn'] != 0){	// スタッフ区分<>0の場合（スタッフ）
			$kakunin = "";
			$kakunin_class = "";
			$tetuzuki = "";
			$shiharai_button = "";


//            lblNote.Text = ""
//            linkPayment.Visible = False
//            linkCancel.Visible = False
		}

//       イベント毎の表示切替
		switch ($value['event_kbn']) {
			case 40:			// 会費
			case 41:			// CEU報告
			case 42:			// 英文オプション
					// →　参加明細のない支払は、参加料を参照しないように修正
					break;
			case 60:			// 物販


// VIEWの支払ボタン区分が実装できず************
// etc_id を配列で持ち、配列の中に同じetc_idがあるかどうかチェックする
// 存在しない→支払ボタン表示　存在する→支払ボタン非表示
// 支払ボタンは物販（イベント区分=60）のみ


//                            ' ■支払欄
//                            If e.Row.Cells(19).Text <> "1" Then    支払ボタン区分
//                                Dim lbtnPayment As LinkButton = DirectCast(e.Row.FindControl("lbtnPayment"), LinkButton)
//                                lbtnPayment.Visible = False
//                            End If


//       ' ■手続き欄(名刺入力)
//      ' 名刺の申込ボタンは、1名刺で、未発送で、決済後なら表示
		if($value['buppan_kbn'] == 1){	// 物販区分=1（名刺）の場合
		//発送伝票番号=null、納入日!=null、購入ID


// 【名刺入力フォーム】リンク　名刺データの購入IDで購入者情報を検索　*************************
//　物販区分はTB経理情報.経理種目CD2=03→1　で判断しているので、TB販売情報.販売区分IN (7,8)で存在するか確認
			

		}
//                            If e.Row.Cells(18).Text = "1" And e.Row.Cells(16).Text = "&nbsp;" And e.Row.Cells(4).Text <> "&nbsp;" Then
//                                ' 購入IDがあるかチェック
//                                Dim dtSalesCard As DataTable = DirectCast(ViewState("EntrySalesCard"), DataTable)
//                                Dim drRows() As DataRow = dtSalesCard.Select("購入ID = " & e.Row.Cells(17).Text)
//                                If drRows.Count > 0 Then
//                                    Dim hlnkSalesCard As HyperLink = DirectCast(e.Row.FindControl("hlnkSalesCard"), System.Web.UI.WebControls.HyperLink)
//                                    hlnkSalesCard.NavigateUrl = hlnkSalesCard.NavigateUrl & "?MemberID=" & ViewState("MemberID") & "&SalesBuyID=" & e.Row.Cells(17).Text
//                                    hlnkSalesCard.Visible = True
//                                End If
//                            End If


			//      ' ■手続き欄(発送状況)
			//      ' 1名刺 2英語版認定証なら非表示
					if($value['buppan_kbn'] == 1 || $value['buppan_kbn'] == 2){
			//                                lblShipping.Visible = False
					}else{
			//                                lblShipping.Visible = True
						if(empty($value['hasso_dempyo_no'])){ // 発送前
							$tetuzuki = "受付中";
			//                                    lblShipping.Text = "受付中"
						}else{ // 発送済
							$tetuzuki = "発送済";
			//                                    lblShipping.Text = "発送済"
						}
					}

					break;
			default:
//                   ' 参加料のチェック
					if(empty($value['nonyu_kingaku'])){	// 参加料null(0円)の場合は、申込済みだけを表示
						$shiharai = "";
						$shiharai_button = "";
						$kakunin = "";
//                                    Dim lbtnPayment As LinkButton = DirectCast(e.Row.FindControl("lbtnPayment"), LinkButton) ' 支払いボタン
//                                    Dim lblNote As Label = DirectCast(e.Row.FindControl("lblNote"), Label)                   ' 支払い状況の表示
//                                    Dim lblComp As Label = DirectCast(e.Row.FindControl("lblComp"), Label)                   ' [済]表示
//                                    lbtnPayment.Visible = False
//                                    lblNote.Visible = False
//                                    lblComp.Visible = False
					}
		}

		if(!empty($value['moshikomi_go_annai_url'])){
			$shosai = $value['moshikomi_go_annai_url'];
		}else{
			//クイズの不合格かつ納入済みの場合、不合格表示に設定
			if($value['gohi_kbn'] == "2" && !empty($value['nonyubi'])){
				$shosai = "不合格";
			}
		}
//                    ' 案内URLの表示切替
//                    If e.Row.RowType = DataControlRowType.DataRow Then
//                        ' 申込後・発送後詳細リンク表示のセル内ないのコントロールをチェック
//                        For Each control As Control In e.Row.Cells(11).Controls
//                            ' ハイパーリンクコントロールがあるかチェック
//                            If TypeOf control Is System.Web.UI.WebControls.HyperLink Then
//                                Dim link As System.Web.UI.WebControls.HyperLink = DirectCast(control, System.Web.UI.WebControls.HyperLink)
//                                ' 申込後案内URLが取得されていなければ非表示
//                                If String.IsNullOrEmpty(link.NavigateUrl) Then
//                                    link.Visible = False
//                                    'クイズの不合格かつ納入済みの場合、HiperLinkを強引に不合格表示に設定
//                                    If e.Row.Cells(10).Text = "2" And e.Row.Cells(4).Text <> "&nbsp;" Then
//                                        link.BackColor = Drawing.Color.Gray
//                                        link.BorderColor = Drawing.Color.Gray
//                                        link.Text = "不合格"
//                                        link.Visible = True
//                                        link.Enabled = False
//                                        Exit For
//                                    End If
//                                End If

//$value['event_kbn'] = "60"
//            e.Row.Cells(4).Visible = False ' 納入日
//            e.Row.Cells(18).Visible = False ' 名刺区分

//                                ' 発送伝票番号があれば表示
//                                If e.Row.Cells(12).Text = "60" Then
//                                    ' 物品で未決済以外は詳細ボタンを表示する
//                                    If e.Row.Cells(18).Text = "0" And e.Row.Cells(4).Text = "&nbsp;" Then
//                                    Else
//                                        ' リンク先指定
//                                        link.NavigateUrl = "~/18_sales/SalesOrder.aspx " &
//                                                    "?Menu=" & clsCommon.geumMenu.Menu_Sales &
//                                                    "&Process=" & clsCommon.geumSalesProcess.Process_Member &
//                                                    "&MemberID=" & ViewState("MemberID") &
//                                                    "&SalesBuyID=" & e.Row.Cells(17).Text &
//                                                    "&SalesKn=" & e.Row.Cells(18).Text
//                                        link.Visible = True
//                                        ' 別タブで開かないように制御する
//                                        link.Target = String.Empty
//                                    End If
//                                    Exit For
//                                End If

//                            End If



// ■ 開放(現行表示仕様) ===========================================end
		} else{

 //■ 抑制中(抑制中の表示仕様)

			$shiharai = "";
			$shiharai_button = "";
			$kakunin = "申込状況の反映まで、しばらくお待ちください。";
			$kakunin_class = "text-danger";
			$tetuzuki = "";
			$shosai = "";

//                    ' 支払ボタン
//                    lbtnPayment.Visible = False

//                    ' 確認事項
//                    lblNote.Text = "申込状況の反映まで、しばらくお待ちください。"
//                    lblNote.Visible = True
//                    lblNote.CssClass = "form-label text-danger"
//                    ' 支払済み表示
//                    lblComp.Visible = False
//                    ' キャンセルボタン
//                    linkCancelBtn.Visible = False

//                    ' 申込後URL
//                    For Each control As Control In e.Row.Cells(11).Controls
//                        ' ハイパーリンクコントロールがあるかチェック
//                        If TypeOf control Is System.Web.UI.WebControls.HyperLink Then
//                            Dim link As System.Web.UI.WebControls.HyperLink = DirectCast(control, System.Web.UI.WebControls.HyperLink)
//                            link.Visible = False
//                        End If
//                    Next


		} 

		$apply_array = array (
		  'shutoku_naiyo' => $value['shutoku_naiyo'],
		  'shiharai' => $shiharai,
		  'shiharai_button' => $shiharai_button,
		  'kakunin' => $kakunin,
		  'kakunin_class' => $kakunin_class,
		  'tetuzuki' => $tetuzuki,
		  'shosai' => $shosai,
		  'id' => $value['id'],
		  'settleno' => $value['settleno'],
		  'ceu_id' => $value['ceu_id'],
		  'event_kbn' => $value['event_kbn'],
		);
		array_push($result_array,$apply_array);



//		array_push($result_array,$value);

	}

		   error_log(print_r('result_array', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		   error_log(print_r($result_array, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	return $result_array;
}



/*
 * 抑制期間判定
 * @params $updateData
 * @params $getData
 */
function chkYokuseiKikan($updateData, $getData) {

	//TB決済発行 更新日時と申込状況 取得日時の経過時間　＞　抑制時間(分)（15）→　0　■ 開放
	//TB決済発行 更新日時と申込状況 取得日時の経過時間　≦　抑制時間(分)（15）→　1　■ 抑制中


	// 抑制時間(15分)
	$yokuseiTime = 15 * 60;

	$interval = strtotime($getData) - strtotime($updateData);

	if($interval > $yokuseiTime){
	   error_log(print_r('解放', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		return 0 ;
	}else{
	   error_log(print_r('抑制', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		return 1 ;
	}

}


/*
 * 決済発行テーブルを更新
 * @params $updateData
 * @params $getData
 */
function updateKessaiHakko($id, $settleno,$status) {

	$error_code = "errtest";
	$error_message = "msgtest";
	$koshin_user_id = "mypage";

	   error_log(print_r('決済発行テーブル更新', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	// 申込内容
	$result = (new Tb_kessai_hakko())->updateStatus($id,$settleno,$status,$error_code,$error_message,$koshin_user_id);
	   error_log(print_r($result, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');	return $result;

}

echo $ret;

die();
