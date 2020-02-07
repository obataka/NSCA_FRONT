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
$_SESSION['yubin_nb_1'] = (!empty($_POST['yubin_nb_1'])) ? htmlentities($_POST['yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['yubin_nb_2'] = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['ken_no'] = (!empty($_POST['ken_no'])) ? htmlentities($_POST['ken_no'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kemmei'] = (!empty($_POST['kemmei'])) ? htmlentities($_POST['kemmei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_shiku'] = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['address_tatemono'] = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tel'] = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['beikoku_kaiin_no'] = (!empty($_POST['beikoku_kaiin_no'])) ? htmlentities($_POST['beikoku_kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['beikoku_kaiin_shikaku_kbn'] = (!empty($_POST['beikoku_kaiin_shikaku_kbn'])) ? htmlentities($_POST['beikoku_kaiin_shikaku_kbn'], ENT_QUOTES, "UTF-8") : "";

$_SESSION['event_sbt'] = (!empty($_POST['event_sbt'])) ? htmlentities($_POST['event_sbt'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_name'] = (!empty($_POST['event_name'])) ? htmlentities($_POST['event_name'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_day'] = (!empty($_POST['event_day'])) ? htmlentities($_POST['event_day'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_hiyo_ippan'] = (!empty($_POST['event_hiyo_ippan'])) ? htmlentities($_POST['event_hiyo_ippan'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_hiyo_ryojitsu'] = (!empty($_POST['event_hiyo_ryojitsu'])) ? htmlentities($_POST['event_hiyo_ryojitsu'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_hiyo_1'] = (!empty($_POST['event_hiyo_1'])) ? htmlentities($_POST['event_hiyo_1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_hiyo_2'] = (!empty($_POST['event_hiyo_2'])) ? htmlentities($_POST['event_hiyo_2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['event_hiyo_konshin'] = (!empty($_POST['event_hiyo_konshin'])) ? htmlentities($_POST['event_hiyo_konshin'], ENT_QUOTES, "UTF-8") : "";

$_SESSION['tranScreen'] = (!empty($_POST['tranScreen'])) ? htmlentities($_POST['tranScreen'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
