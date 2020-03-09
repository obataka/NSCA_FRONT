<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';

$return_value = -1;

// POSTデータを取得
// 商品情報をPOSTデータからSESSIONにセット

$_SESSION['konyu_id'] = (!empty($_POST['gokei_kingaku'])) ? htmlentities($_POST['gokei_kingaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['wk_hambai_id'] = (!empty($_POST['wk_hambai_id'])) ? htmlentities($_POST['wk_hambai_id'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_id'] = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_title'] = (!empty($_POST['hambai_title'])) ? htmlentities($_POST['hambai_title'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_title_chuigaki'] = (!empty($_POST['hambai_title_chuigaki'])) ? htmlentities($_POST['hambai_title_chuigaki'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['gazo_url'] = (!empty($_POST['gazo_url'])) ? htmlentities($_POST['gazo_url'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kaiin_kakaku'] = (!empty($_POST['kaiin_kakaku'])) ? htmlentities($_POST['kaiin_kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kaiin_zeikomi_kakaku'] = (!empty($_POST['kaiin_zeikomi_kakaku'])) ? htmlentities($_POST['kaiin_zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['ippan_kakaku'] = (!empty($_POST['ippan_kakaku'])) ? htmlentities($_POST['ippan_kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['ippan_zeikomi_kakaku'] = (!empty($_POST['ippan_zeikomi_kakaku'])) ? htmlentities($_POST['ippan_zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['gaiyo'] = (!empty($_POST['gaiyo'])) ? htmlentities($_POST['gaiyo'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_kbn'] = (!empty($_POST['hambai_kbn'])) ? htmlentities($_POST['hambai_kbn'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_settei_kbn'] = (!empty($_POST['hambai_settei_kbn'])) ? htmlentities($_POST['hambai_settei_kbn'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['hambai_settei_meisho'] = (!empty($_POST['hambai_settei_meisho'])) ? htmlentities($_POST['hambai_settei_meisho'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['setsumei'] = (!empty($_POST['setsumei'])) ? htmlentities($_POST['setsumei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['kakaku'] = (!empty($_POST['kakaku'])) ? htmlentities($_POST['kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['konyusu'] = (!empty($_POST['konyusu'])) ? htmlentities($_POST['konyusu'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['zeikomi_kakaku'] = (!empty($_POST['zeikomi_kakaku'])) ? htmlentities($_POST['zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['size_meisho'] = (!empty($_POST['size_meisho'])) ? htmlentities($_POST['size_meisho'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['color_kbn'] = (!empty($_POST['color_kbn'])) ? htmlentities($_POST['color_kbn'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['color_meisho'] = (!empty($_POST['color_meisho'])) ? htmlentities($_POST['color_meisho'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shikaku_kbn'] = (!empty($_POST['shikaku_kbn'])) ? htmlentities($_POST['shikaku_kbn'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['gokei_kingaku'] = (!empty($_POST['gokei_kingaku'])) ? htmlentities($_POST['gokei_kingaku'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['buppan_soyo'] = (!empty($_POST['buppan_soyo'])) ? htmlentities($_POST['buppan_soyo'], ENT_QUOTES, "UTF-8") : "";

echo $return_value;
die();
