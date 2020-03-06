<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/shoppingBasket/shoppingBasket_tpl.php';

$wk_kaiin_no = "";

if (isset($_SESSION['kaiinNo'])) {

    // ƒƒOƒCƒ“‚µ‚Ä‚¢‚éŽž
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$gokei_kingaku = (!empty($_POST['gokei_kingaku'])) ? htmlentities($_POST['gokei_kingaku'], ENT_QUOTES, "UTF-8") : "";
$wk_hambai_id = (!empty($_POST['wk_hambai_id'])) ? htmlentities($_POST['wk_hambai_id'], ENT_QUOTES, "UTF-8") : "";
$hambai_id = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$hambai_title = (!empty($_POST['hambai_title'])) ? htmlentities($_POST['hambai_title'], ENT_QUOTES, "UTF-8") : "";
$hambai_title_chuigaki = (!empty($_POST['hambai_title_chuigaki'])) ? htmlentities($_POST['hambai_title_chuigaki'], ENT_QUOTES, "UTF-8") : "";
$gazo_url = (!empty($_POST['gazo_url'])) ? htmlentities($_POST['gazo_url'], ENT_QUOTES, "UTF-8") : "";
$kaiin_kakaku = (!empty($_POST['kaiin_kakaku'])) ? htmlentities($_POST['kaiin_kakaku'], ENT_QUOTES, "UTF-8") : "";
$kaiin_zeikomi_kakaku = (!empty($_POST['kaiin_zeikomi_kakaku'])) ? htmlentities($_POST['kaiin_zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$ippan_kakaku = (!empty($_POST['ippan_kakaku'])) ? htmlentities($_POST['ippan_kakaku'], ENT_QUOTES, "UTF-8") : "";
$ippan_zeikomi_kakaku = (!empty($_POST['ippan_zeikomi_kakaku'])) ? htmlentities($_POST['ippan_zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$gaiyo = (!empty($_POST['wk_gaiyo'])) ? htmlentities($_POST['wk_gaiyo'], ENT_QUOTES, "UTF-8") : "";
$hambai_kbn = (!empty($_POST['hambai_kbn'])) ? htmlentities($_POST['hambai_kbn'], ENT_QUOTES, "UTF-8") : "";
$hambai_settei_kbn = (!empty($_POST['hambai_settei_kbn'])) ? htmlentities($_POST['hambai_settei_kbn'], ENT_QUOTES, "UTF-8") : "";
$hambai_settei_meisho = (!empty($_POST['hambai_settei_meisho'])) ? htmlentities($_POST['hambai_settei_meisho'], ENT_QUOTES, "UTF-8") : "";
$setsumei = (!empty($_POST['setsumei'])) ? htmlentities($_POST['setsumei'], ENT_QUOTES, "UTF-8") : "";
$kakaku = (!empty($_POST['kakaku'])) ? htmlentities($_POST['kakaku'], ENT_QUOTES, "UTF-8") : "";
$konyusu = (!empty($_POST['konyusu'])) ? htmlentities($_POST['konyusu'], ENT_QUOTES, "UTF-8") : "";
$zeikomi_kakaku = (!empty($_POST['zeikomi_kakaku'])) ? htmlentities($_POST['zeikomi_kakaku'], ENT_QUOTES, "UTF-8") : "";
$color_kbn = (!empty($_POST['color_kbn'])) ? htmlentities($_POST['color_kbn'], ENT_QUOTES, "UTF-8") : "";
$size_kbn = (!empty($_POST['size_kbn'])) ? htmlentities($_POST['size_kbns'], ENT_QUOTES, "UTF-8") : "";
$color_meisho = (!empty($_POST['color_meisho'])) ? htmlentities($_POST['color_meisho'], ENT_QUOTES, "UTF-8") : "";
$size_meisho = (!empty($_POST['size_meisho'])) ? htmlentities($_POST['size_meisho'], ENT_QUOTES, "UTF-8") : "";
$shikaku_kbn = (!empty($_POST['shikaku_kbn'])) ? htmlentities($_POST['shikaku_kbn'], ENT_QUOTES, "UTF-8") : "";


include_once $includeView;
