<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/continueMemberRequest/continueMemberRequest_tpl.php';

// POSTからパラメータを取得する
$wk_kaiinSbt = (!empty($_POST['kaiinSbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";
$wk_kaihi = (!empty($_POST['kaihi'])) ? htmlentities($_POST['kaihi'], ENT_QUOTES, "UTF-8") : "";
$wk_kaiinType = (!empty($_POST['kaiinType'])) ? htmlentities($_POST['kaiinType'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
