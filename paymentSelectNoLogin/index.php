<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";

// �J�ڌ���ʔ���
// �V�K����\���݂̏ꍇ
if ($wk_tranScreen == 'confirmMember') {
    $wk_name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
    $wk_name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";
    $wk_pay_name = '�V�K������';
    $wk_payment = (isset($_SESSION['kaihi'])) ? $_SESSION['kaihi'] : "";
}

include_once $includeView;
