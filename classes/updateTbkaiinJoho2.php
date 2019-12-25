<?php
namespace Was;

session_start();
//会員Noを取得し、会員Noパラメータとして送る
// if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
 // }
require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho2.php';

// データ取得処理
$result = (new Tb_kaiin_joho2())->findBykaiinjoho2();

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
