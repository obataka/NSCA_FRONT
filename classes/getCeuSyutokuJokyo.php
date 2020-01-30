<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Vceu_shutoku_shosai.php';
require './DBAccess/Tb_kaiin_ceu.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

/**********************
* 会員番号セット
***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

// cscs認定日取得処理
$result_cscs = (new Tb_nintei_meisai())->findBycscsNinteibi($db, $param);
error_log(print_r($result_cscs, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_cscs_log.txt');
// cpt認定日取得処理
$result_cpt = (new Tb_nintei_meisai())->findBycptNinteibi($db, $param);

// cscs認定日がある場合
if ($result_cscs == TRUE || $result_cscs == TRUE) {

    //明細行をカウントする処理
    $result_Meisai = (new Vceu_shutoku_shosai())->findByMeisai($db,$param);
    error_log(print_r($result_Meisai, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_Meisai_log.txt');
    
    // 明細行がない場合
    if ($result_Meisai['COUNT(*)'] == 0) {
        
        
        $result_total_null = (new Tb_kaiin_ceu())->getTotalNull($db, $param);
        error_log(print_r($result_total_null, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_total_null_log.txt');
        
    // 明細行がある場合
    } else {
        
        $ninteibi = [
            'cscs_ninteibi'  => $result_cscs['ninteibi'],
            'cpt_ninteibi'  => $result_cpt['ninteibi'],
        ];
        
        error_log(print_r($ninteibi, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_ninteibi_log.txt');
        $result_total_value = (new Tb_kaiin_ceu())->getTotal($db, $param, $ninteibi);
        error_log(print_r($result_total_value, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_result_total_value_log.txt');
        echo json_encode($result_total_value);
        // commit
        $db->commit();

    }
// cscs認定日がない場合
} else {

    // commit
    $db->commit();

    // 戻り値に0設定
    $result = 0;
}

echo $result;
die();
