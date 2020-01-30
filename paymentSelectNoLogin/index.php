<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";

// ‘JˆÚŒ³‰æ–Ê”»’è
// V‹K‰ïˆõ\ž‚Ý‚Ìê‡
if ($wk_tranScreen == 'confirmMember') {
    $wk_name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
    $wk_name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";
    $wk_pay_name = 'V‹K‰ïˆõ‰ï”ï';
    $wk_payment = (isset($_SESSION['kaihi'])) ? $_SESSION['kaihi'] : "";
}

include_once $includeView;
