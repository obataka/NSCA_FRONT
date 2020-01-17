<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/confirmRiyo/confirmRiyo_tpl.php';

$name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$sei_kana_name = (!empty($_POST['sei_kana_name'])) ? htmlentities($_POST['sei_kana_name'], ENT_QUOTES, "UTF-8") : "";
$sei_mei_name = (!empty($_POST['sei_mei_name'])) ? htmlentities($_POST['sei_mei_name'], ENT_QUOTES, "UTF-8") : "";
$seireki_name = (!empty($_POST['seireki_name'])) ? htmlentities($_POST['seireki_name'], ENT_QUOTES, "UTF-8") : "";
$month = (!empty($_POST['month'])) ? htmlentities($_POST['month'], ENT_QUOTES, "UTF-8") : "";
$day = (!empty($_POST['day'])) ? htmlentities($_POST['day'], ENT_QUOTES, "UTF-8") : "";
$gender = (!empty($_POST['sel_gender'])) ? htmlentities($_POST['sel_gender'], ENT_QUOTES, "UTF-8") : "";
$address_yubin_nb_1 = (!empty($_POST['address_yubin_nb_1'])) ? htmlentities($_POST['address_yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$yubin_nb_2 = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$sel_math = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
$kenmei = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_gender = (!empty($_POST['wk_sel_gender'])) ? htmlentities($_POST['wk_sel_gender'], ENT_QUOTES, "UTF-8") : "";
$address_shiku = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
$address_tatemono = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
$address_yomi_shiku = (!empty($_POST['address_yomi_shiku'])) ? htmlentities($_POST['address_yomi_shiku'], ENT_QUOTES, "UTF-8") : "";
$address_yomi_tatemono = (!empty($_POST['address_yomi_tatemono'])) ? htmlentities($_POST['address_yomi_tatemono'], ENT_QUOTES, "UTF-8") : "";
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$keitai_tel = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
$mail_address_1 = (!empty($_POST['mail_address_1'])) ? htmlentities($_POST['mail_address_1'], ENT_QUOTES, "UTF-8") : "";
$mail_address_2 = (!empty($_POST['mail_address_2'])) ? htmlentities($_POST['mail_address_2'], ENT_QUOTES, "UTF-8") : "";
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
$sel_mail = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
$merumaga = (!empty($_POST['merumaga'])) ? htmlentities($_POST['merumaga'], ENT_QUOTES, "UTF-8") : "";
$sel_merumaga = (!empty($_POST['sel_merumaga'])) ? htmlentities($_POST['sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
$pass_1 = (!empty($_POST['pass_1'])) ? htmlentities($_POST['pass_1'], ENT_QUOTES, "UTF-8") : "";
$hoho = (!empty($_POST['hoho'])) ? htmlentities($_POST['hoho'], ENT_QUOTES, "UTF-8") : "";
$sel_hoho = (!empty($_POST['sel_hoho'])) ? htmlentities($_POST['sel_hoho'], ENT_QUOTES, "UTF-8") : "";
$sel_nagareyama = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$sel_chiiki = (!empty($_POST['sel_chiiki'])) ? htmlentities($_POST['sel_chiiki'], ENT_QUOTES, "UTF-8") : "";
$pass = (!empty($_POST['pass'])) ? htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8") : "";
include_once $includeView;