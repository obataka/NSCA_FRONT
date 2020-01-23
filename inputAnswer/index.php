<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/inputAnswer/inputAnswer_tpl.php';


$ceu_id1 = (!empty($_POST['ceu_id1'])) ? htmlentities($_POST['ceu_id1'], ENT_QUOTES, "UTF-8") : "";

$q_ = ($_POST['q_']);   //選択したラジオボタンの値を受け取り

//配列$q_をエスケープする
if (!empty($q_)){
    foreach($q_ as $key => $value) {
        $q_[$key] = htmlentities($value, ENT_QUOTES);
    }
};
    
error_log(print_r($q_, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_modoripost_log.txt');
include_once $includeView;
