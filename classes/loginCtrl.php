<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';

$ret = '';

// POSTデータを取得
$loginId = (!empty($_POST['loginId'])) ? htmlentities($_POST['loginId'], ENT_QUOTES, "UTF-8") : "";
$loginPswd = (!empty($_POST['loginPswd'])) ? htmlentities($_POST['loginPswd'], ENT_QUOTES, "UTF-8") : "";

// パスワードが未入力の場合
if ($loginPswd == "") {

    // データ取得処理（パスワード検索条件なし）
    $result = (new Tb_kaiin_joho())->findByEmail($loginId);

    // 該当データなしの場合
    if ($result == "") {
        echo 0;

    // 該当データありの場合
    } else {

//        error_log(print_r('検索結果'. date("Y/m/d H:i:s"), true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
//        error_log(print_r($result['my_page_password'], true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');

        // パスワードが未設定の場合
        if ($result['my_page_password'] == "") {
            echo 2;

        // パスワードが設定済みの場合
        } else {
            echo 1;
        }

    }

// パスワードが入力済みの場合
} else {
    echo json_encode($result);
}

die();
