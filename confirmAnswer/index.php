<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/confirmAnswer/confirmAnswer_tpl.php';


$ceu_id1   = (!empty($_POST['ceu_id1'])) ? htmlentities($_POST['ceu_id1'], ENT_QUOTES, "UTF-8") : "";
$q_ = $_POST['q_'];     //選択したラジオボタンの値を受け取り
$sel_q = $_POST['sel_q'];  //選択したラジオボタンのテキスト受け取り

//配列$q_をエスケープする
if (!empty($q_)) {
    foreach($q_ as $key => $value) {
    $q_[$key] = htmlentities($value, ENT_QUOTES);
    }
};

//配列$sel_qをエスケープする
if (!empty($sel_q)) {
    foreach((array)$sel_q as $key => $value) {
        $sel_q[$key] = htmlentities($value, ENT_QUOTES);
    }
};

error_log(print_r($q_, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_post_log.txt');
error_log(print_r($sel_q, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_post_sel_log.txt');


include_once $includeView;
