<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/ceuReportConfirm/ceuReportConfirm_tpl.php';

$chkCSCS = (!empty($_POST['chkCSCS'])) ? htmlentities($_POST['chkCSCS'], ENT_QUOTES, "UTF-8") : "";
$chkCPT = (!empty($_POST['chkCPT'])) ? htmlentities($_POST['chkCPT'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
