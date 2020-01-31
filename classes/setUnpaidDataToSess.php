<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';

$return_value = -1;

// POSTデータを取得
// unpaidConfirm.jsでセットしたPOSTデータからSESSIONにセット
// 入力された会員情報
$_SESSION['item_title'] = (!empty($_POST['item_title'])) ? htmlentities($_POST['item_title'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['pay'] = (!empty($_POST['pay'])) ? htmlentities($_POST['pay'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_sei'] = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei'] = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_sei_kana'] = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei_kana'] = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tel'] = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['keitai_tel'] = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tranScreen'] = (!empty($_POST['tranScreen'])) ? htmlentities($_POST['tranScreen'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
