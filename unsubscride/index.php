<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/unsubscride/unsubscride_tpl.php';


$sel_riyu = (!empty($_POST['sel_riyu'])) ? htmlentities($_POST['sel_riyu'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($sel_riyu, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/taniharaUnsubscride_log.txt');
$sel_riyu_txt = (!empty($_POST['sel_riyu_txt'])) ? htmlentities($_POST['sel_riyu_txt'], ENT_QUOTES, "UTF-8") : "";
$sel_annai = (!empty($_POST['sel_annai'])) ? htmlentities($_POST['sel_annai'], ENT_QUOTES, "UTF-8") : "";
$sel_annai_txt = (!empty($_POST['sel_annai_txt'])) ? htmlentities($_POST['sel_annai_txt'], ENT_QUOTES, "UTF-8") : "";
$textarea = (!empty($_POST['textarea'])) ? htmlentities($_POST['textarea'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
