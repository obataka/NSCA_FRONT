<?php
namespace Was;

session_start();

require '../classes/paymentSelect_constants.php';

/*************************************************************************************************************************************
* SESSIONデータを取得
*************************************************************************************************************************************/
$kaiinNo = isset($_SESSION['kaiinNo']) ? $_SESSION['kaiinNo'] : '';
// $tranScreen = isset($_SESSION['tran_screen']) ? $_SESSION['tran_screen'] : '';
$tranScreen = paymentSelect_constants::MENU_CONFIRM_MEMBER;

/*************************************************************************************************************************************
* 画面表示用変数
*************************************************************************************************************************************/
$payName = null;
$nameMai = null;
$nameSei = null;
$payment = null;
$selOption = null;
$kaihiEibunOption = null;

// ヘッダー・ビューを設定
$includeHeader = '../ctrl/parts/loginHeader.php';
$includeView = '../views/paymentSelect/paymentSelect_tpl.php';

// デフォルトで会員とする
$_SESSION['member_type'] = paymentSelect_constants::PROC_TYPE_MEMBER;
$memberType = paymentSelect_constants::PROC_TYPE_MEMBER;

// 遷移元画面判定
switch ($tranScreen){
    case paymentSelect_constants::MENU_CONFIRM_MEMBER : // 新規会員申込み

        // 未ログイン用ヘッダーを設定
        $includeHeader = '../ctrl/parts/beforeLoginHeader.php';

        // 会員種別を非会員に設定
        $_SESSION['member_type'] = paymentSelect_constants::PROC_TYPE_VISITOR;
        $memberType = paymentSelect_constants::PROC_TYPE_VISITOR;

        // 画面表示用にSESSIONデータを取得
        getSessionData();
        break;
}


// SESSIONデータ取得処理
function getSessionData() {

    // 支払情報の設定
    // $pay_name = '新規会員会費';
    $payName = isset($_SESSION['pay_name']) ? $_SESSION['pay_name'] : '';
    $shimeiSei = isset($_SESSION['name_sei']) ? $_SESSION['name_sei'] : '';
    $shimeiMei = isset($_SESSION['name_mei']) ? $_SESSION['name_mei'] : '';
    $payment = isset($_SESSION['kaihi']) ? $_SESSION['kaihi'] : '0';
    $selOption = isset($_SESSION['sel_option']) ? $_SESSION['sel_option'] : '';
    $kaihiEibunOption = isset($_SESSION['kaihi_eibun_option']) ? $_SESSION['kaihi_eibun_option'] : '0';

    // 英文オプションの判定
    if ($selOption == '1') {
        $payment = number_format($payment + $kaihiEibunOption);
    } else {
        $payment = number_format($payment);
    }
}


// ヘッダー・ビューを読込
include_once $includeHeader;
include_once $includeView;
