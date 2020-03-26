<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/changeMemberConfirm/changeMemberConfirm_tpl.php';

$wk_kaiinType = "";
$wk_kaiinSbt = (!empty($_POST['kaiinSbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";

if ($wk_kaiinSbt == 1) {
    $wk_kaiinType = "NSCA正会員";
} elseif ($wk_kaiinSbt == 2) {
    $wk_kaiinType = "学生会員";
} else {
    $wk_kaiinType = "";
}

$option = (!empty($_POST['sel_option'])) ? htmlentities($_POST['sel_option'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_option = (!empty($_POST['wk_sel_option'])) ? htmlentities($_POST['wk_sel_option'], ENT_QUOTES, "UTF-8") : "";
$name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$name_sei_kana = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$name_mei_kana = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$name_last = (!empty($_POST['name_last'])) ? htmlentities($_POST['name_last'], ENT_QUOTES, "UTF-8") : "";
$name_first = (!empty($_POST['name_first'])) ? htmlentities($_POST['name_first'], ENT_QUOTES, "UTF-8") : "";
$year = (!empty($_POST['year'])) ? htmlentities($_POST['year'], ENT_QUOTES, "UTF-8") : "";
$month = (!empty($_POST['month'])) ? htmlentities($_POST['month'], ENT_QUOTES, "UTF-8") : "";
$day = (!empty($_POST['day'])) ? htmlentities($_POST['day'], ENT_QUOTES, "UTF-8") : "";
$gender = (!empty($_POST['sel_gender'])) ? htmlentities($_POST['sel_gender'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_gender = (!empty($_POST['wk_sel_gender'])) ? htmlentities($_POST['wk_sel_gender'], ENT_QUOTES, "UTF-8") : "";
$yubin_nb_1 = (!empty($_POST['yubin_nb_1'])) ? htmlentities($_POST['yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$yubin_nb_2 = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$sel_math = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
$kenmei = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
$address_shiku = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
$address_tatemono = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
$address_yomi_shiku = (!empty($_POST['address_yomi_shiku'])) ? htmlentities($_POST['address_yomi_shiku'], ENT_QUOTES, "UTF-8") : "";
$address_yomi_tatemono = (!empty($_POST['address_yomi_tatemono'])) ? htmlentities($_POST['address_yomi_tatemono'], ENT_QUOTES, "UTF-8") : "";
$nagareyama = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_nagareyama = (!empty($_POST['wk_sel_nagareyama'])) ? htmlentities($_POST['wk_sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$keitai_tel = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
$fax = (!empty($_POST['fax'])) ? htmlentities($_POST['fax'], ENT_QUOTES, "UTF-8") : "";
$mail_address_1 = (!empty($_POST['mail_address_1'])) ? htmlentities($_POST['mail_address_1'], ENT_QUOTES, "UTF-8") : "";
$mail_address_2 = (!empty($_POST['mail_address_2'])) ? htmlentities($_POST['mail_address_2'], ENT_QUOTES, "UTF-8") : "";
$mail = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_mail = (!empty($_POST['wk_sel_mail'])) ? htmlentities($_POST['wk_sel_mail'], ENT_QUOTES, "UTF-8") : "";
$merumaga = (!empty($_POST['sel_merumaga'])) ? htmlentities($_POST['sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_merumaga = (!empty($_POST['wk_sel_merumaga'])) ? htmlentities($_POST['wk_sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
$pass_1 = (!empty($_POST['pass_1'])) ? htmlentities($_POST['pass_1'], ENT_QUOTES, "UTF-8") : "";
$url = (!empty($_POST['url'])) ? htmlentities($_POST['url'], ENT_QUOTES, "UTF-8") : "";
$shoku_1 = (!empty($_POST['shoku_1'])) ? htmlentities($_POST['shoku_1'], ENT_QUOTES, "UTF-8") : "";
$shoku_2 = (!empty($_POST['shoku_2'])) ? htmlentities($_POST['shoku_2'], ENT_QUOTES, "UTF-8") : "";
$shoku_3 = (!empty($_POST['shoku_3'])) ? htmlentities($_POST['shoku_3'], ENT_QUOTES, "UTF-8") : "";
$sel_shoku_1 = (!empty($_POST['sel_shoku_1'])) ? htmlentities($_POST['sel_shoku_1'], ENT_QUOTES, "UTF-8") : "";
$sel_shoku_2 = (!empty($_POST['sel_shoku_2'])) ? htmlentities($_POST['sel_shoku_2'], ENT_QUOTES, "UTF-8") : "";
$sel_shoku_3 = (!empty($_POST['sel_shoku_3'])) ? htmlentities($_POST['sel_shoku_3'], ENT_QUOTES, "UTF-8") : "";
$office_yubin_nb_1 = (!empty($_POST['office_yubin_nb_1'])) ? htmlentities($_POST['office_yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$office_yubin_nb_2 = (!empty($_POST['office_yubin_nb_2'])) ? htmlentities($_POST['office_yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$sel_office_math = (!empty($_POST['sel_office_math'])) ? htmlentities($_POST['sel_office_math'], ENT_QUOTES, "UTF-8") : "";
$office_kenmei = (!empty($_POST['office_kenmei'])) ? htmlentities($_POST['office_kenmei'], ENT_QUOTES, "UTF-8") : "";
$office_name = (!empty($_POST['office_name'])) ? htmlentities($_POST['office_name'], ENT_QUOTES, "UTF-8") : "";
$office_shiku = (!empty($_POST['office_shiku'])) ? htmlentities($_POST['office_shiku'], ENT_QUOTES, "UTF-8") : "";
$office_tatemono = (!empty($_POST['office_tatemono'])) ? htmlentities($_POST['office_tatemono'], ENT_QUOTES, "UTF-8") : "";
$office_fax = (!empty($_POST['office_fax'])) ? htmlentities($_POST['office_fax'], ENT_QUOTES, "UTF-8") : "";
$office_tel = (!empty($_POST['office_tel'])) ? htmlentities($_POST['office_tel'], ENT_QUOTES, "UTF-8") : "";
$shikaku = (!empty($_POST['sel_shikaku'])) ? htmlentities($_POST['sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_shikaku = (!empty($_POST['wk_sel_shikaku'])) ? htmlentities($_POST['wk_sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
$shikaku_sonota = (!empty($_POST['sel_shikaku_sonota'])) ? htmlentities($_POST['sel_shikaku_sonota'], ENT_QUOTES, "UTF-8") : "";
$k_chiiki = (!empty($_POST['sel_k_chiiki'])) ? htmlentities($_POST['sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_k_chiiki = (!empty($_POST['wk_sel_k_chiiki'])) ? htmlentities($_POST['wk_sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
$bunya = (!empty($_POST['sel_bunya'])) ? htmlentities($_POST['sel_bunya'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_bunya = (!empty($_POST['wk_sel_bunya'])) ? htmlentities($_POST['wk_sel_bunya'], ENT_QUOTES, "UTF-8") : "";
$bunya_sonota = (!empty($_POST['sel_bunya_sonota'])) ? htmlentities($_POST['sel_bunya_sonota'], ENT_QUOTES, "UTF-8") : "";
$hoho = (!empty($_POST['sel_hoho'])) ? htmlentities($_POST['sel_hoho'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_hoho = (!empty($_POST['wk_sel_hoho'])) ? htmlentities($_POST['wk_sel_hoho'], ENT_QUOTES, "UTF-8") : "";
$yubin = (!empty($_POST['sel_yubin'])) ? htmlentities($_POST['sel_yubin'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_yubin = (!empty($_POST['wk_sel_yubin'])) ? htmlentities($_POST['wk_sel_yubin'], ENT_QUOTES, "UTF-8") : "";
$web = (!empty($_POST['sel_web'])) ? htmlentities($_POST['sel_web'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_web = (!empty($_POST['wk_sel_web'])) ? htmlentities($_POST['wk_sel_web'], ENT_QUOTES, "UTF-8") : "";
$qa = (!empty($_POST['sel_qa'])) ? htmlentities($_POST['sel_qa'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_qa = (!empty($_POST['wk_sel_qa'])) ? htmlentities($_POST['wk_sel_qa'], ENT_QUOTES, "UTF-8") : "";
$login = (!empty($_POST['sel_login'])) ? htmlentities($_POST['sel_login'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_login = (!empty($_POST['wk_sel_login'])) ? htmlentities($_POST['wk_sel_login'], ENT_QUOTES, "UTF-8") : "";
$auth = (!empty($_POST['sel_auth'])) ? htmlentities($_POST['sel_auth'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_auth = (!empty($_POST['wk_sel_auth'])) ? htmlentities($_POST['wk_sel_auth'], ENT_QUOTES, "UTF-8") : "";
$sel_chiiki = (!empty($_POST['sel_chiiki'])) ? htmlentities($_POST['sel_chiiki'], ENT_QUOTES, "UTF-8") : "";
$sel_office_chiiki = (!empty($_POST['sel_office_chiiki'])) ? htmlentities($_POST['sel_office_chiiki'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;