<?php
namespace Was;

session_start();

require './Config/Config.php';
require './Config/FregiConfig.php';
require './paymentSelect_constants.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kessai_hakko.php';

$tb_kessai_hakko = new Tb_kessai_hakko();
$result = null;
$checkMode = null;

/*************************************************************************************************************************************
* SESSIONデータを取得
*************************************************************************************************************************************/
$tranScreen = isset($_SESSION['tranScreen']) ? $_SESSION['tranScreen'] : '';
$kessaiHakkoId = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$settleNo = isset($_SESSION['settle_no']) ? $_SESSION['settle_no'] : '';
$extpayment = isset($_SESSION['extpayment']) ? $_SESSION['extpayment'] : '';

/*************************************************************************************************************************************
* 
* title ：Fregi決済状況チェック処理
*
* return：1 初回支払い / 2 再支払い（一度コンビニで決済後成功） / 3 再支払い（一度コンビニで決済後キャンセルか失敗） / 4 延長手続き決済
* 		  9 ２重出願中 / 20 管理システム申込
*
**************************************************************************************************************************************/

// 画面ごとにチェックフラグを立てる
switch($tranScreen) {
    case paymentSelect_constants::MENU_CONFIRM_MEMBER : // 新規会員申込み
        $checkMode = 1;
        break;
    /****************************************************************************************
    * 上記以外のメニューの場合の処理も実装すること
    *****************************************************************************************/
}

/****************************************************************************************
* 試験メニューから遷移時のチェック処理を実装すること
*****************************************************************************************/

// 初回支払いか再支払い（一度コンビニで決済）か延長手続き決済かをチェック
if(!empty($kessaiHakkoId) && !empty($settleNo) && empty($extpayment)) {

    $fregiData = $tb_kessai_hakko->findByIdAndSettleno($kessaiHakkoId, $settleNo);
    if(empty($fregiData)) {
        $result = 1;
    } else {
        if($fregiData[0]['kessai_kekka'] == FregiConfig::STATUS_OK) {
            $result = 2;
        } else {
            $result = 3;
        }
    }
    
} else {
    if(!empty($extpayment)) {
        $result = 4;
    } else {
        $result = 1;
    }
}

echo $result;
die();