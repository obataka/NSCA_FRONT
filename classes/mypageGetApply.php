<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Vmoshikomi_jokyo.php';
require './DBAccess/Tb_keiri_joho.php';
require './DBAccess/Tb_kessai_hakko.php';
require './DBAccess/Tb_hambai_konyusha_joho.php';
require './DBAccess/Tb_hambai_konyusha_joho_meisai.php';

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





// 申込内容取得
$result_apply = getMousikomiData($kaiin_no);
	   error_log(print_r($result_apply, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
if (!empty($result_apply)) {
	// 申込状況をチェック
	   error_log(print_r('申込状況をチェック--', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
	chkMousikomiData($result_apply);
}

// 申込内容取得
$result_apply2 = getMousikomiData($kaiin_no);
if (!empty($result_apply2)) {
	// 画面表示データ作成
	$result_array = createMousikomiData($result_apply2);
}



// 名刺データ取得??


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

/**********************************************
 * 申込状況をチェック
 * @params Array $result 
 **********************************************/
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

	foreach ($result as $value) {

	   error_log(print_r('画面表示データ作成', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
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
					// クレジットで決済までいかないので販売購入者情報を更新確認
					// 納入方法クリアしたレコードは表示対象外
					continue;
				}

			}elseif($yokuseiFlg == 1){ //  ■抑制中(抑制中仕様)
				// チェックなし
			}

		}else{
		   error_log(print_r('支払いタイプ：その他', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka2_log.txt');
		}

		array_push($result_array,$value);
		
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
