<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/unpaidConfirm/unpaidConfirm_tpl.php';

$item_title = (!empty($_POST['item_title'])) ? htmlentities($_POST['item_title'], ENT_QUOTES, "UTF-8") : "";
$pay = (!empty($_POST['pay'])) ? htmlentities($_POST['pay'], ENT_QUOTES, "UTF-8") : "";
$name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$name_sei_kana = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$name_mei_kana = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$keitai_tel = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
