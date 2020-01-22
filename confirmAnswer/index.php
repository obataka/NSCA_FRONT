<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/confirmAnswer/confirmAnswer_tpl.php';


 $ceu_id1   = (!empty($_POST['ceu_id1'])) ? htmlentities($_POST['ceu_id1'], ENT_QUOTES, "UTF-8") : "";
 $types = $_POST['q_'];
 $val_q1_1  = (!empty($_POST['val_q1_1'])) ? htmlentities($_POST['val_q1_1'], ENT_QUOTES, "UTF-8") : "";
 $sel_q1_1  = (!empty($_POST['sel_q1_1'])) ? htmlentities($_POST['sel_q1_1'], ENT_QUOTES, "UTF-8") : "";
// $quiz_txt = (!empty($_POST['quiz_txt'])) ? htmlentities($_POST['quiz_txt'], ENT_QUOTES, "UTF-8") : "";

error_log(print_r($types, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_post_log.txt');

include_once $includeView;
