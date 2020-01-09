<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/changeSbtConfirm/changeSbtConfirm_tpl.php';

// POSTからパラメータを取得する
$wk_kaiinSbt = (!empty($_POST['kaiinSbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";
$wk_kaihi = (!empty($_POST['kaihi'])) ? htmlentities($_POST['kaihi'], ENT_QUOTES, "UTF-8") : "";
if ($wk_kaihi == 0) {
    $wk_kaihi = "無料";
} else {
    $wk_kaihi = $wk_kaihi."円";
}

$Wk_kaiinType = "";             //会員種別を格納する変数

if ($wk_kaiinSbt == 1) {
    $wk_kaiinType = "NSCA正会員";
} elseif ($wk_kaiinSbt == 2) {
    $wk_kaiinType = "学生会員";
} else {
    $wk_kaiinType = "利用会員(無料)";
}

include_once $includeView;
