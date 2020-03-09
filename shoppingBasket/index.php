<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/shoppingBasket/shoppingBasket_tpl.php';

$wk_kaiin_no = "";

if (isset($_SESSION['kaiinNo'])) {

    // ƒƒOƒCƒ“‚µ‚Ä‚¢‚éŽž
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$gokei_kingaku = (isset($_SESSION['gokei_kingaku'])) ? $_SESSION['gokei_kingaku'] : "";
$wk_hambai_id = (isset($_SESSION['wk_hambai_id'])) ? $_SESSION['wk_hambai_id'] : "";
$hambai_id = (isset($_SESSION['hambai_id'])) ? $_SESSION['hambai_id'] : "";
$hambai_title = (isset($_SESSION['hambai_title'])) ? $_SESSION['hambai_title'] : "";
$hambai_title_chuigaki = (isset($_SESSION['hambai_title_chuigaki'])) ? $_SESSION['hambai_title_chuigaki'] : "";
$gazo_url = (isset($_SESSION['gazo_url'])) ? $_SESSION['gazo_url'] : "";
$kaiin_kakaku = (isset($_SESSION['kaiin_kakaku'])) ? $_SESSION['kaiin_kakaku'] : "";
$kaiin_zeikomi_kakaku = (isset($_SESSION['kaiin_zeikomi_kakaku'])) ? $_SESSION['kaiin_zeikomi_kakaku'] : "";
$ippan_kakaku = (isset($_SESSION['ippan_kakaku'])) ? $_SESSION['ippan_kakaku'] : "";
$ippan_zeikomi_kakaku = (isset($_SESSION['ippan_zeikomi_kakaku'])) ? $_SESSION['ippan_zeikomi_kakaku'] : "";
$gaiyo = (isset($_SESSION['gaiyo'])) ? $_SESSION['gaiyo'] : "";
$hambai_kbn = (isset($_SESSION['hambai_kbn'])) ? $_SESSION['hambai_kbn'] : "";
$hambai_settei_kbn = (isset($_SESSION['hambai_settei_kbn'])) ? $_SESSION['hambai_settei_kbn'] : "";
$hambai_settei_meisho = (isset($_SESSION['hambai_settei_meisho'])) ? $_SESSION['hambai_settei_meisho'] : "";
$setsumei = (isset($_SESSION['setsumei'])) ? $_SESSION['setsumei'] : "";
$kakaku = (isset($_SESSION['kakaku'])) ? $_SESSION['kakaku'] : "";
$konyusu = (isset($_SESSION['konyusu'])) ? $_SESSION['konyusu'] : "";
$zeikomi_kakaku = (isset($_SESSION['zeikomi_kakaku'])) ? $_SESSION['zeikomi_kakaku'] : "";
$color_kbn = (isset($_SESSION['color_kbn'])) ? $_SESSION['color_kbn'] : "";
$size_kbn = (isset($_SESSION['size_kbn'])) ? $_SESSION['size_kbn'] : "";
$color_meisho = (isset($_SESSION['color_meisho'])) ? $_SESSION['color_meisho'] : "";
$size_meisho = (isset($_SESSION['size_meisho'])) ? $_SESSION['size_meisho'] : "";
$shikaku_kbn = (isset($_SESSION['shikaku_kbn'])) ? $_SESSION['shikaku_kbn'] : "";


include_once $includeView;
