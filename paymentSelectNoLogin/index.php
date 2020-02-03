<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";

// 遷移元画面判定
// 新規会員申込みの場合
if ($wk_tranScreen == 'confirmMember') {

    // 支払者氏名の設定
    $wk_name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
    $wk_name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";

    // 支払名目
    $wk_pay_name = '新規会員会費';

    // 支払金額
    $wk_payment = (isset($_SESSION['kaihi'])) ? $_SESSION['kaihi'] : "0";

    // 英文オプションの判定
    $wk_wk_sel_option = (isset($_SESSION['wk_sel_option'])) ? $_SESSION['wk_sel_option'] : "";
    if ($wk_wk_sel_option == '1') {
        $wk_kaihi_eibun_option = (isset($_SESSION['kaihi_eibun_option'])) ? $_SESSION['kaihi_eibun_option'] : "0";
        $wk_payment = number_format($wk_payment + $wk_kaihi_eibun_option);
    } else {
        $wk_payment = number_format($wk_payment);
    }
}

include_once $includeView;
