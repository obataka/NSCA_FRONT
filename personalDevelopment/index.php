<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/personalDevelopment/personalDevelopment_tpl.php';

$chkCSCS = (!empty($_POST['chkCSCS'])) ? htmlentities($_POST['chkCSCS'], ENT_QUOTES, "UTF-8") : "";
$chkCPT = (!empty($_POST['chkCPT'])) ? htmlentities($_POST['chkCPT'], ENT_QUOTES, "UTF-8") : "";
$year = (!empty($_POST['year'])) ? htmlentities($_POST['year'], ENT_QUOTES, "UTF-8") : "";
$wk_year = (!empty($_POST['wk_year'])) ? htmlentities($_POST['wk_year'], ENT_QUOTES, "UTF-8") : "";
$katsudo = (!empty($_POST['katsudo'])) ? htmlentities($_POST['katsudo'], ENT_QUOTES, "UTF-8") : "";
$wk_katsudo = (!empty($_POST['wk_katsudo'])) ? htmlentities($_POST['wk_katsudo'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
