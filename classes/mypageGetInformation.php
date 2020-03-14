<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_oshirase.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_jotai.php';
require './DBAccess/Tb_kaiin_pick_up.php';



$ret = 0;


/************************************************************
*セッションから会員番号,有効期限フラグを取得
*************************************************************/
$kaiin_no = '';
$yukokigenFlg = FALSE;

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}

//セッションから有効期限フラグを取得
if (isset($_SESSION['yukokigenFlg'])) {
    $yukokigenFlg = $_SESSION['yukokigenFlg'];
}


/************************************************************
*POSTからページ番号取得
*************************************************************/

// 画面初期表示時
$page_no = 1;


$result_array = [];

// ①会員情報取得

$result_kaiin =  (new Tb_kaiin_joho())->findByKaiinNo($kaiin_no);

	error_log(print_r('****お知らせ情報取得処理', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

//　③郵便物の不着(TB会員ジャーナル.発送停止日に日付あり)
if(!is_null($result_kaiin['hasso_teishibi'])){
	$yubin_array = array (
	  'naiyo' => '郵送物が戻ってきています。ご住所の確認をお願いいたします。',
	  'url' => '../changeMember/',
	  'button_text' => '登録情報'
	);
	array_push($result_array,$yubin_array);

}

//　④退会予約の連絡あり(TB会員状態.退会書類受理日に日付あり)
if(!empty($result_kaiin['taikai_shorui_juribi'])){ // 退会予約済み

	$naiyo = "有効期限日".$result_kaiin['taikai_shorui_juribi']."付にての退会を承りました。";
	$taikai_array = array (
	  'naiyo' => $naiyo,
	  'url' => '',
	  'button_text' => ''
	);
	array_push($result_array,$taikai_array);


}elseif(!$yukokigenFlg){ // 有効期限切れ

	$naiyo = "会員有効期限が過ぎていますので、<span style='color: #ff0000; background-color: transparent'>継続手続き</span>をお願いいたします。";
	$kigen_array = array (
	  'naiyo' => $naiyo,
	  'url' => '../continueMemberRequest/',
	  'button_text' => '継続手続'
	);
	array_push($result_array,$kigen_array);

}else{ // 有効期限切れ前


	$yuko_hizuke = $result_kaiin['yuko_hizuke'];
	$kijyunbi =  date("Y/m/d",strtotime("+2 month"));
	error_log(print_r($yuko_hizuke, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');
	error_log(print_r($kijyunbi, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

    //有効期限まで２ヵ月を切っている場合、お知らせ表示
	if(!is_null($yuko_hizuke) && $yuko_hizuke < $kijyunbi){
		error_log(print_r('****有効期限２ヵ月切る', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

		// ピックアップ6 is not null && 一桁目="q"　→　自動課金者
		$result_pic_up =  (new Tb_kaiin_pick_up())->findByKaiinNo($kaiin_no);
		$pick_up_6 = "";
		if(!empty($result_pic_up)){$pick_up_6 = $result_pic_up['yuko_hizuke'];}
		if(!empty($pick_up_6) && substr($result_pic_up,0,1) == "q"){ 				// 自動課金者
			error_log(print_r('****自動課金者', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

			// 継続処理完了チェック
			$keizoku_kanryo = chkKeizokuStatus($kaiin_no);
			if($keizoku_kanryo == 0 || $keizoku_kanryo == 3){ 							// 継続完了前
		        // 自動課金は、予約会員種別を決済前に登録することがある
		        // 予約会員種別の登録済みで、自動課金が未決済の場合、完了として返却される
				error_log(print_r('****継続完了前', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

				// 決済エラーなし
				if(is_null($result_kaiin['kaihi_kessai_error_code'])
						|| ($result_kaiin['kaihi_kessai_error_code'] != 1 && $result_kaiin['kaihi_kessai_error_code'] != 3)){		// 決済エラーなし

						$yuko_month = date('n', strtotime($result_kaiin['yuko_hizuke']));

		                // 英文オプションの有無によってメッセージを変える
						$naiyo2 = $yuko_month."月20日(土日祝日の場合は翌営業日)に自動支払い処理をいたします。";
						if(!is_null($result_kaiin['eibun_option']) &&  $result_kaiin['eibun_option'] == 1
								&& (is_null($result_kaiin['eibun_option_kikan_to'])) 
								|| $result_kaiin['eibun_option_kikan_to'] > $result_kaiin['yuko_hizuke']){

				             $naiyo = "年会費及び英文購読オプション会費はご登録のクレジットカードより".$naiyo2;
						}else{
			                 $naiyo =  "年会費はご登録のクレジットカードより".$naiyo2;
						}
						$kigen_array = array (
						  'naiyo' => $naiyo,
						  'url' => '',
						  'button_text' => ''
						);
						array_push($result_array,$kigen_array);
				}else{                                                                      		// 決済エラーあり

						$kigen_array = array (
						  'naiyo' => 'ご登録のクレジットカードによる自動支払処理ができませんでした。別のクレジットカードまたはコンビニ払いにて継続手続きをお願いいたします。',
						  'url' => '../continueMemberRequest/',
						  'button_text' => '継続手続'
						);
						array_push($result_array,$kigen_array);

				}
			}
		}else{													// 自動課金者以外

	error_log(print_r('****自動課金者以外', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

			// 継続処理完了チェック
			$keizoku_kanryo = chkKeizokuStatus($kaiin_no);
			if($keizoku_kanryo == 0){ 							// 継続完了前

						$kigen_array = array (
						  'naiyo' => '会員有効期限が近づいていますので継続手続をお願いいたします。',
						  'url' => '../continueMemberRequest/',
						  'button_text' => '継続手続'
						);
						array_push($result_array,$kigen_array);

			}
		}
	}
}





// ②お知らせテーブル情報取得
	// 申込ボタン（会員有効期限が過ぎた場合は、申込ボタンは出力しない）
error_log(print_r('お知らせテーブル情報取得', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

$result_information =  (new Tb_oshirase())->findInformationData($kaiin_no);
error_log(print_r($result_information, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

if(!empty($result_information)){
	foreach ($result_information as $value) {
		$naiyo = $value['naiyo'];
		$url = $value['url'];
		if(!$yukokigenFlg){ // 有効期限切れ
			$button_text = "";
		}else{
			$button_text = $value['button_text'];
		}
		$info_array = array (
		  'naiyo' => $naiyo,
		  'url' => $url,
		  'button_text' => $button_text
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
	error_log(print_r('決済データを取得', true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');

	$status = 0;

	if(empty($result_kaiin_jotai)){	// 決済データなし　→　未手続
		$status = 0;
        return $status;
	}

	if(is_null($result_kaiin_jotai['yoyaku_kaiin_sbt'])){
	// if "予約会員種別" is nulll -> 未手続
		$status = 0;
	}else{
		if(is_null($result_kaiin_jotai['nonyubi'])){
			if(is_null($result_kaiin_jotai['id'])){
	 		// if ID is null  -> 未手続(決済を途中でやめたかGMOor手入力のデータ→再度決済開始)
				$status = 0;
			}else{
			// else  -> 再支払   ID、SETTLENO(伝票番号、発行番号)を保管
//                            .hidID.Value = row.Item("ID")
 //                           .hidSETTLENO.Value = row.Item("SETTLENO")
				$status = 1;
			}
		}else{
			if($result_kaiin_jotai['yoyaku_kaiin_sbt'] == 2){ // 学生
				if($result_kaiin_jotai['gakuseisho_kakunin_kbn'] == 0){ // 学生証未確認
					$status = 2;
				}else{
                    // 入金および学生証の確認が終了しているので有効日付が
                    // 伸びているためこのケースで更新2ヵ月前、グレー期間はありえない
					$status = 3; // 手続き完了
				}
			}else{
                    // 入金完了で有効期限が伸びるためこのケースで更新2ヵ月前、グレー期間はありえない
					$status = 3; // 手続き完了
			}
		}
	}
	error_log(print_r($status, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka3_log.txt');
    return $status;

}


// 表示データなし
if(empty($result_array)){
	return 0;
}

$ret = json_encode($result_array);


echo $ret;



die();
