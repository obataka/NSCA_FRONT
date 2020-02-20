<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';

$return_value = -1;

// POSTデータを取得
// seminarConfirm.jsでセットしたPOSTデータからSESSIONにセット

$_SESSION['name_sei'] = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei'] = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_sei_kana'] = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['name_mei_kana'] = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tel'] = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";

$_SESSION['koushinryo'] = (!empty($_POST['koushinryo'])) ? htmlentities($_POST['koushinryo'], ENT_QUOTES, "UTF-8") : "";

$_SESSION['tranScreen'] = (!empty($_POST['tranScreen'])) ? htmlentities($_POST['tranScreen'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
