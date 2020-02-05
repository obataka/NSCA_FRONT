<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/seminarEntryVis/seminarEntryVis_tpl.php';

if (isset($_SESSION['kaiinNo'])) {
    // ƒƒOƒCƒ“‚µ‚Ä‚¢‚é
    $wk_kaiin_no = $_SESSION['kaiinNo'];
 
 } else {
 
     $wk_kaiin_no = "";
 }
 
$name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$name_sei_kana = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$name_mei_kana = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$bei_kaiin_no = (!empty($_POST['bei_kaiin_no'])) ? htmlentities($_POST['bei_kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$yubin_nb_1 = (!empty($_POST['yubin_nb_1'])) ? htmlentities($_POST['yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$yubin_nb_2 = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$sel_math = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
$kenmei = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
$sel_shikaku = (!empty($_POST['sel_shikaku'])) ? htmlentities($_POST['sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
$shikakumei = (!empty($_POST['shikakumei'])) ? htmlentities($_POST['shikakumei'], ENT_QUOTES, "UTF-8") : "";
$address_shiku = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
$address_tatemono = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
$tel_1 = (!empty($_POST['tel_1'])) ? htmlentities($_POST['tel_1'], ENT_QUOTES, "UTF-8") : "";
$tel_2 = (!empty($_POST['tel_2'])) ? htmlentities($_POST['tel_2'], ENT_QUOTES, "UTF-8") : "";
$tel_3 = (!empty($_POST['tel_3'])) ? htmlentities($_POST['tel_3'], ENT_QUOTES, "UTF-8") : "";
$nagareyama = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_nagareyama = (!empty($_POST['wk_sel_nagareyama'])) ? htmlentities($_POST['wk_sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
$bei_kaiin = (!empty($_POST['sel_bei_kaiin'])) ? htmlentities($_POST['sel_bei_kaiin'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_bei_kaiin = (!empty($_POST['wk_sel_bei_kaiin'])) ? htmlentities($_POST['wk_sel_bei_kaiin'], ENT_QUOTES, "UTF-8") : "";

$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
$tb_name = (!empty($_POST['tb_name'])) ? htmlentities($_POST['tb_name'], ENT_QUOTES, "UTF-8") : "";
include_once $includeView;
