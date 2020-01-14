<?php
namespace Was;

session_start();
//会員Noを取得し、会員Noパラメータとして送る
// if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
 // }
require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}
error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');
/**********************
* 会員番号セット
***********************/

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];
// データ取得処理
$result = (new Tb_kaiin_joho())->findBykaiinjoho($param);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
