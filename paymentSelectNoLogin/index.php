<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";

// �J�ڌ���ʔ���
// �V�K����\���݂̏ꍇ
if ($wk_tranScreen == 'confirmMember') {

    // �x���Ҏ����̐ݒ�
    $wk_name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
    $wk_name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";

    // �x������
    $wk_pay_name = '�V�K������';

    // �x�����z
    $wk_payment = (isset($_SESSION['kaihi'])) ? $_SESSION['kaihi'] : "0";

    // �p���I�v�V�����̔���
    $wk_wk_sel_option = (isset($_SESSION['wk_sel_option'])) ? $_SESSION['wk_sel_option'] : "";
    if ($wk_wk_sel_option == '1') {
        $wk_kaihi_eibun_option = (isset($_SESSION['kaihi_eibun_option'])) ? $_SESSION['kaihi_eibun_option'] : "0";
        $wk_payment = number_format($wk_payment + $wk_kaihi_eibun_option);
    } else {
        $wk_payment = number_format($wk_payment);
    }
}

include_once $includeView;
