<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';

$return_value = -1;

// POSTデータを取得
// confirmMember.jsでセットしたPOSTデータからSESSIONにセット
// 入力された会員情報
$_SESSION['kaiinType'] = (!empty($_POST['kaiinType'])) ? htmlentities($_POST['kaiinType'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kaiinSbt'] = (!empty($_POST['kaiinSbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_option'] = (!empty($_POST['sel_option'])) ? htmlentities($_POST['sel_option'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_option'] = (!empty($_POST['wk_sel_option'])) ? htmlentities($_POST['wk_sel_option'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_riyu'] = (!empty($_POST['sel_riyu'])) ? htmlentities($_POST['sel_riyu'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_riyu'] = (!empty($_POST['wk_sel_riyu'])) ? htmlentities($_POST['wk_sel_riyu'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_riyu_sonota'] = (!empty($_POST['sel_riyu_sonota'])) ? htmlentities($_POST['sel_riyu_sonota'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_hoji'] = (!empty($_POST['sel_hoji'])) ? htmlentities($_POST['sel_hoji'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_hoji'] = (!empty($_POST['wk_sel_hoji'])) ? htmlentities($_POST['wk_sel_hoji'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['file_front'] = (!empty($_POST['file_front'])) ? htmlentities($_POST['file_front'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['file_back'] = (!empty($_POST['file_back'])) ? htmlentities($_POST['file_back'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_sei'] = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei'] = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_sei_kana'] = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei_kana'] = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_last'] = (!empty($_POST['name_last'])) ? htmlentities($_POST['name_last'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_first'] = (!empty($_POST['name_first'])) ? htmlentities($_POST['name_first'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['year'] = (!empty($_POST['year'])) ? htmlentities($_POST['year'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['month'] = (!empty($_POST['month'])) ? htmlentities($_POST['month'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['day'] = (!empty($_POST['day'])) ? htmlentities($_POST['day'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_gender'] = (!empty($_POST['sel_gender'])) ? htmlentities($_POST['sel_gender'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_gender'] = (!empty($_POST['wk_sel_gender'])) ? htmlentities($_POST['wk_sel_gender'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['yubin_nb_1'] = (!empty($_POST['yubin_nb_1'])) ? htmlentities($_POST['yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['yubin_nb_2'] = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_math'] = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kenmei'] = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_shiku'] = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_tatemono'] = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_yomi_shiku'] = (!empty($_POST['address_yomi_shiku'])) ? htmlentities($_POST['address_yomi_shiku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_yomi_tatemono'] = (!empty($_POST['address_yomi_tatemono'])) ? htmlentities($_POST['address_yomi_tatemono'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_nagareyama'] = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_nagareyama'] = (!empty($_POST['wk_sel_nagareyama'])) ? htmlentities($_POST['wk_sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tel'] = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['keitai_tel'] = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['fax'] = (!empty($_POST['fax'])) ? htmlentities($_POST['fax'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['mail_address_1'] = (!empty($_POST['mail_address_1'])) ? htmlentities($_POST['mail_address_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['mail_address_2'] = (!empty($_POST['mail_address_2'])) ? htmlentities($_POST['mail_address_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_mail'] = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_mail'] = (!empty($_POST['wk_sel_mail'])) ? htmlentities($_POST['wk_sel_mail'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_merumaga'] = (!empty($_POST['sel_merumaga'])) ? htmlentities($_POST['sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_merumaga'] = (!empty($_POST['wk_sel_merumaga'])) ? htmlentities($_POST['wk_sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['pass_1'] = (!empty($_POST['pass_1'])) ? htmlentities($_POST['pass_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['url'] = (!empty($_POST['url'])) ? htmlentities($_POST['url'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shoku_1'] = (!empty($_POST['shoku_1'])) ? htmlentities($_POST['shoku_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shoku_2'] = (!empty($_POST['shoku_2'])) ? htmlentities($_POST['shoku_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shoku_3'] = (!empty($_POST['shoku_3'])) ? htmlentities($_POST['shoku_3'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_shoku_1'] = (!empty($_POST['sel_shoku_1'])) ? htmlentities($_POST['sel_shoku_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_shoku_2'] = (!empty($_POST['sel_shoku_2'])) ? htmlentities($_POST['sel_shoku_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_shoku_3'] = (!empty($_POST['sel_shoku_3'])) ? htmlentities($_POST['sel_shoku_3'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_yubin_nb_1'] = (!empty($_POST['office_yubin_nb_1'])) ? htmlentities($_POST['office_yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_yubin_nb_2'] = (!empty($_POST['office_yubin_nb_2'])) ? htmlentities($_POST['office_yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_office_math'] = (!empty($_POST['sel_office_math'])) ? htmlentities($_POST['sel_office_math'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_kenmei'] = (!empty($_POST['office_kenmei'])) ? htmlentities($_POST['office_kenmei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_name'] = (!empty($_POST['office_name'])) ? htmlentities($_POST['office_name'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_shiku'] = (!empty($_POST['office_shiku'])) ? htmlentities($_POST['office_shiku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_tatemono'] = (!empty($_POST['office_tatemono'])) ? htmlentities($_POST['office_tatemono'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_fax'] = (!empty($_POST['office_fax'])) ? htmlentities($_POST['office_fax'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['office_tel'] = (!empty($_POST['office_tel'])) ? htmlentities($_POST['office_tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_shikaku'] = (!empty($_POST['sel_shikaku'])) ? htmlentities($_POST['sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_shikaku'] = (!empty($_POST['wk_sel_shikaku'])) ? htmlentities($_POST['wk_sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_shikaku_sonota'] = (!empty($_POST['sel_shikaku_sonota'])) ? htmlentities($_POST['sel_shikaku_sonota'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_k_chiiki'] = (!empty($_POST['sel_k_chiiki'])) ? htmlentities($_POST['sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_k_chiiki'] = (!empty($_POST['wk_sel_k_chiiki'])) ? htmlentities($_POST['wk_sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_bunya'] = (!empty($_POST['sel_bunya'])) ? htmlentities($_POST['sel_bunya'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_bunya'] = (!empty($_POST['wk_sel_bunya'])) ? htmlentities($_POST['wk_sel_bunya'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_bunya_sonota'] = (!empty($_POST['sel_bunya_sonota'])) ? htmlentities($_POST['sel_bunya_sonota'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_hoho'] = (!empty($_POST['sel_hoho'])) ? htmlentities($_POST['sel_hoho'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_hoho'] = (!empty($_POST['wk_sel_hoho'])) ? htmlentities($_POST['wk_sel_hoho'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_yubin'] = (!empty($_POST['sel_yubin'])) ? htmlentities($_POST['sel_yubin'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_yubin'] = (!empty($_POST['wk_sel_yubin'])) ? htmlentities($_POST['wk_sel_yubin'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_web'] = (!empty($_POST['sel_web'])) ? htmlentities($_POST['sel_web'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_web'] = (!empty($_POST['wk_sel_web'])) ? htmlentities($_POST['wk_sel_web'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_qa'] = (!empty($_POST['sel_qa'])) ? htmlentities($_POST['sel_qa'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_sel_qa'] = (!empty($_POST['wk_sel_qa'])) ? htmlentities($_POST['wk_sel_qa'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_chiiki'] = (!empty($_POST['sel_chiiki'])) ? htmlentities($_POST['sel_chiiki'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sel_office_chiiki'] = (!empty($_POST['sel_office_chiiki'])) ? htmlentities($_POST['sel_office_chiiki'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tranScreen'] = (!empty($_POST['tranScreen'])) ? htmlentities($_POST['tranScreen'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
