<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/changeRiyo/changeRiyo_tpl.php';

// Session�ɐݒ肳��Ă������ԍ�����ɁA��������擾����
$wk_kaiin_no = "";
$wk_kaiin_no = 12345;   // �������͎b��I�Ɏ����̃e�X�g�p�̉���̉���ԍ���ݒ肷��ӏ��ł��B���O�C���������o������폜���܂��B
// ���ȉ��̓��O�C���������܂��ł��ĂȂ��̂ŁA��U�R�����g�A�E�g���Ă����܂��B
//if (isset($_SESSION['kaiinNo'])) {
//    
//    // ���O�C�����Ă���
//    $wk_kaiin_no = $_SESSION['kaiinNo'];
//
//} else {
//
//    // Session�ɉ���ԍ����Ȃ��̂ŁA�����O�C���Ƃ݂Ȃ��āA���O�C����ʂɑJ�ڂ�����
//    header('Location: https://www.demo-nls02.work/login/');
//    exit();
//}


// �����ɁA��������擾���鏈�������A�擾������������A��ʕ\���p�̕ϐ���
// �ݒ肷��悤�ɂ��Ă��������B
// POST����l��ݒ肷�鏈���͌����_�ł͕s�v�ɂȂ�܂��B





$name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($name_sei, true). PHP_EOL, '3', 'tanihara_log1.txt');
$name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($name_mei, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sei_kana_name = (!empty($_POST['sei_kana_name'])) ? htmlentities($_POST['sei_kana_name'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sei_kana_name, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sei_mei_name = (!empty($_POST['sei_mei_name'])) ? htmlentities($_POST['sei_mei_name'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sei_mei_name, true). PHP_EOL, '3', 'tanihara_log1.txt');
$seireki_name = (!empty($_POST['seireki_name'])) ? htmlentities($_POST['seireki_name'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($seireki_name, true). PHP_EOL, '3', 'tanihara_log1.txt');
$month = (!empty($_POST['month'])) ? htmlentities($_POST['month'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($month, true). PHP_EOL, '3', 'tanihara_log1.txt');
$day = (!empty($_POST['day'])) ? htmlentities($_POST['day'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($day, true). PHP_EOL, '3', 'tanihara_log1.txt');
$gender = (!empty($_POST['sel_gender'])) ? htmlentities($_POST['sel_gender'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($gender, true). PHP_EOL, '3', 'tanihara_log1.txt');
$wk_sel_gender = (!empty($_POST['wk_sel_gender'])) ? htmlentities($_POST['wk_sel_gender'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($wk_sel_gender, true). PHP_EOL, '3', 'tanihara_log1.txt');
$address_yubin_nb_1 = (!empty($_POST['address_yubin_nb_1'])) ? htmlentities($_POST['address_yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($address_yubin_nb_1, true). PHP_EOL, '3', 'tanihara_log1.txt');
$yubin_nb_2 = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($yubin_nb_2, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_math = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_math, true). PHP_EOL, '3', 'tanihara_log1.txt');
$kenmei = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($kenmei, true). PHP_EOL, '3', 'tanihara_log1.txt');
$address_shiku = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($address_shiku, true). PHP_EOL, '3', 'tanihara_log1.txt');
$address_tatemono = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($address_tatemono, true). PHP_EOL, '3', 'tanihara_log1.txt');
$address_yomi_shiku = (!empty($_POST['address_yomi_shiku'])) ? htmlentities($_POST['address_yomi_shiku'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($address_yomi_shiku, true). PHP_EOL, '3', 'tanihara_log1.txt');
$address_yomi_tatemono = (!empty($_POST['address_yomi_tatemono'])) ? htmlentities($_POST['address_yomi_tatemono'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($address_yomi_tatemono, true). PHP_EOL, '3', 'tanihara_log1.txt');
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($tel, true). PHP_EOL, '3', 'tanihara_log1.txt');
$keitai_tel = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($keitai_tel, true). PHP_EOL, '3', 'tanihara_log1.txt');
$mail_address_1 = (!empty($_POST['mail_address_1'])) ? htmlentities($_POST['mail_address_1'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($mail_address_1, true). PHP_EOL, '3', 'tanihara_log1.txt');
$mail_address_2 = (!empty($_POST['mail_address_2'])) ? htmlentities($_POST['mail_address_2'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($mail_address_2, true). PHP_EOL, '3', 'tanihara_log1.txt');
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($mail, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_mail = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_mail, true). PHP_EOL, '3', 'tanihara_log1.txt');
$merumaga = (!empty($_POST['merumaga'])) ? htmlentities($_POST['merumaga'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($merumaga, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_merumaga = (!empty($_POST['sel_merumaga'])) ? htmlentities($_POST['sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_merumaga, true). PHP_EOL, '3', 'tanihara_log1.txt');
$hoho = (!empty($_POST['hoho'])) ? htmlentities($_POST['hoho'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($hoho, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_hoho = (!empty($_POST['sel_hoho'])) ? htmlentities($_POST['sel_hoho'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_hoho, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_nagareyama = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_nagareyama, true). PHP_EOL, '3', 'tanihara_log1.txt');
$sel_chiiki = (!empty($_POST['sel_chiiki'])) ? htmlentities($_POST['sel_chiiki'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_chiiki, true). PHP_EOL, '3', 'tanihara_log1.txt');
include_once $includeView;