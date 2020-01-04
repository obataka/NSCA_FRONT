<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_login.php';

$result = "";
$ret = "";

// POSTデータを取得
$securityCodeId = (!empty($_POST['securityCodeId'])) ? htmlentities($_POST['securityCodeId'], ENT_QUOTES, "UTF-8") : "";

// SESSIONデータを取得
$kaiinNo = (!empty($_SESSION['kaiinNo'])) ? $_SESSION['kaiinNo'] : "";

// データ取得処理
$result = (new Tb_kaiin_login())->findByKaiinNo($kaiinNo);

$limitMax = date("Y-m-d H:i:s",strtotime($result['koshin_nichiji'] . "+10 minute"));
$wkNow = date("Y-m-d H:i:s");

// 該当データなしの場合
if ($result == "") {
    $ret = 0;

// 該当データありの場合
} else {

    // セキュリティコードが一致している
    if ($result['security_cd'] == $securityCodeId) {

        // 有効期限以内
        if ($limitMax >= $wkNow) {

            // 登録用パラメーター設定
            $param = [
                'kaiin_no'      => $kaiinNo,
                'security_cd'   => NULL,
            ];

            // 更新処理
            $updRet = (new Tb_kaiin_login())->updateSecurityCd($param);

            // 更新成功
            if ($updRet) {
                $ret = 99;
            // 登録失敗
            } else {
                $ret = 99;
            }

            // ログインタイマー開始
            $_SESSION['time'] = time();

        // 有効期限超過
        } else {
            $ret = 1;
        }

    // セキュリティコードが一致していない
    } else {
        $ret = 2;
    }
}

echo $ret;
die();
