<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/shoppingBasket/shoppingBasket_tpl.php';

$konyu_id = (!empty($_POST['konyu_id'])) ? htmlentities($_POST['konyu_id'], ENT_QUOTES, "UTF-8") : "";
$gokei_kingaku = (!empty($_POST['gokei_kingaku'])) ? htmlentities($_POST['gokei_kingaku'], ENT_QUOTES, "UTF-8") : "";
$hambai_joho = (!empty($_POST['hambai_joho'])) ? htmlentities($_POST['hambai_joho'], ENT_QUOTES, "UTF-8") : "";
$hambai_settei_meisho = (!empty($_POST['hambai_settei_meisho'])) ? htmlentities($_POST['hambai_settei_meisho'], ENT_QUOTES, "UTF-8") : "";
$color_meisho = (!empty($_POST['color_meisho'])) ? htmlentities($_POST['color_meisho'], ENT_QUOTES, "UTF-8") : "";
$size_meisho = (!empty($_POST['size_meisho'])) ? htmlentities($_POST['size_meisho'], ENT_QUOTES, "UTF-8") : "";


include_once $includeView;
