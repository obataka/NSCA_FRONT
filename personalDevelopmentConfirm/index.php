<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/personalDevelopmentConfirm/personalDevelopmentConfirm_tpl.php';

$chkCSCS = (!empty($_POST['chkCSCS'])) ? htmlentities($_POST['chkCSCS'], ENT_QUOTES, "UTF-8") : "";
$chkCPT = (!empty($_POST['chkCPT'])) ? htmlentities($_POST['chkCPT'], ENT_QUOTES, "UTF-8") : "";
$year = (!empty($_POST['sel_year'])) ? htmlentities($_POST['sel_year'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_year = (!empty($_POST['wk_sel_year'])) ? htmlentities($_POST['wk_sel_year'], ENT_QUOTES, "UTF-8") : "";
$katsudo = (!empty($_POST['sel_katsudo'])) ? htmlentities($_POST['sel_katsudo'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_katsudo = (!empty($_POST['wk_sel_katsudo'])) ? htmlentities($_POST['wk_sel_katsudo'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
