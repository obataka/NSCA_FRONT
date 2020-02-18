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

$wk_kaiin_no = 10251033;

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

// cpt認定日取得処理
$result_cpt = (new Tb_nintei_meisai())->findBycptNinteibi($db, $param);

// cscs認定日がある場合
if ($result_cscs == TRUE || $result_cscs == TRUE) {

    //明細行をカウントする処理
    $result_Meisai = (new Vceu_shutoku_shosai())->findByMeisai($db,$param);
    
    // 明細行がない場合
    if ($result_Meisai['COUNT(*)'] == 0) {
        
        $result_total_null = (new Tb_kaiin_ceu())->getTotalNull($db, $param);
        
    // 明細行がある場合
    } else {
        
        $ninteibi = [
            'cscs_ninteibi'  => $result_cscs['ninteibi'],
            'cpt_ninteibi'  => $result_cpt['ninteibi'],
        ];
        
        $result_total_value = (new Tb_kaiin_ceu())->getTotal($db, $param, $ninteibi);
        
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
