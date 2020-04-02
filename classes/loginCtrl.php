<?php
namespace Was;

use ErrorException;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_login.php';
require './Common/Util.php';

$result = "";
$ret = "";
$sendMailAddr = "";

// POSTデータを取得
$loginId = (!empty($_POST['loginId'])) ? htmlentities($_POST['loginId'], ENT_QUOTES, "UTF-8") : "";
$loginPswd = (!empty($_POST['loginPswd'])) ? htmlentities($_POST['loginPswd'], ENT_QUOTES, "UTF-8") : "";

// データ取得処理
$result = (new Tb_kaiin_joho())->findByEmail($loginId);

// 該当データなしの場合
if ($result == "") {
    $ret = 0;

// 該当データありの場合
} else {

    // パスワードが未入力の場合
    if ($loginPswd == "") {

        // パスワードが未設定の場合
        if ($result['my_page_password'] == "") {
            $ret = 2;

        // パスワードが設定済みの場合
        } else {
            $ret = 1;
        }

    // パスワードが入力済みの場合
    } else {

        // パスワードチェック
        // パスワードアンマッチ
        if (!password_verify($loginPswd, $result['my_page_password'])){
            $ret = 0;

        // パスワード一致
        } else {

            // TB会員その他．メール1ログイン = 0 かつ TB会員その他．メール2ログイン = 0 の場合
            if (($result['login1'] == 0) && ($result['login2'] == 0)) {
                $ret = 3;

            // TB会員その他．メール1ログイン ≠ 0 または TB会員その他．メール2ログイン ≠ 0 の場合
            } else {

                // メール1をログインに使用する場合
                if ($result['login2'] == 0) {
                    // メール1が未設定の場合はエラー
                    if ($result['email_1'] == "") {
                        $ret = 3;
                    } else {
                        $sendMailAddr = $result['email_1'];
                    }
                // メール2をログインに使用する場合
                } else {
                    // メール2が未設定の場合はエラー
                    if ($result['email_2'] == "") {
                        $ret = 3;
                    } else {
                        $sendMailAddr = $result['email_2'];
                    }
                }

                // ログインIDが会員Noと同じ場合
                if ($result['kaiin_no'] == $loginId) {

                    // ログイン管理準備処理
                    $loginCtrlRet = loginCtrlPre($result['kaiin_no'], $sendMailAddr);

                    // ログイン管理準備処理成功時
                    if ($loginCtrlRet == 0) {
                        $ret = 99;
                        $_SESSION['kaiinNo'] = $result['kaiin_no'];
                        $_SESSION['shimeiSei'] = $result['shimei_sei'];
                        $_SESSION['shimeiMei'] = $result['shimei_mei'];
                    // ログイン管理準備処理失敗時
                    } else {
                        $ret = 4;
                    }

                // ログインIDが会員Noと異なる場合
                } else {

                    // メール1をログインに使用する場合
                    if ($result['login1'] == 1) {

                        // 入力されたログインIDがメール1の場合
                        if ($result['email_1'] == $loginId) {

                            // ログイン管理準備処理
                            $loginCtrlRet = loginCtrlPre($result['kaiin_no'], $sendMailAddr);

                            // ログイン管理準備処理成功時
                            if ($loginCtrlRet == 0) {
                                $ret = 99;
                                $_SESSION['kaiinNo'] = $result['kaiin_no'];
                                $_SESSION['shimeiSei'] = $result['shimei_sei'];
                                $_SESSION['shimeiMei'] = $result['shimei_mei'];
                            // ログイン管理準備処理失敗時
                            } else {
                                $ret = 4;
                            }
                        // 入力されたログインID≠メール1の場合
                        } else {
                            $ret = 0;
                        }

                    // メール2をログインに使用する場合
                    } else {

                        // 入力されたログインIDがメール2の場合
                        if ($result['email_2'] == $loginId) {

                            // ログイン管理準備処理
                            $loginCtrlRet = loginCtrlPre($result['kaiin_no'], $sendMailAddr);

                            // ログイン管理準備処理成功時
                            if ($loginCtrlRet == 0) {
                                $ret = 99;
                                $_SESSION['kaiinNo'] = $result['kaiin_no'];
                                $_SESSION['shimeiSei'] = $result['shimei_sei'];
                                $_SESSION['shimeiMei'] = $result['shimei_mei'];
                            // ログイン管理準備処理失敗時
                            } else {
                                $ret = 4;
                            }
                        // 入力されたログインID≠メール2の場合
                        } else {
                            $ret = 0;
                        }
                    }
                }
            }
        }
    }
}

/*
 * ログイン管理準備処理
 * @params $kaiinNo
 * @params $sendMailAddr
 */
function loginCtrlPre($kaiinNo, $sendMailAddr) {

    // 8桁のセキュリティコードを生成する
    $securityCd = create_passwd(8);

    // TB会員ログイン情報の検索
    $kaiinLogin = (new Tb_kaiin_login())->findByKaiinNo($kaiinNo);

    // 登録用パラメーター設定
    $param = [
        'kaiin_no'      => $kaiinNo,
        'security_cd'   => $securityCd,
    ];

    // 該当データなしの場合
    if ($kaiinLogin == "") {

        // 登録処理
        $insRet = (new Tb_kaiin_login())->insertRec($param);

        // 登録成功
        if ($insRet) {

            // 本文
            $message  = "追加認証に必要な情報をご案内いたします。\n\n\n";
            $message .= "セキュリティコード：". $securityCd. "\n";
            $message .= "有効期限：10分\n\n\n";
            $message .= "上記を入力して認証手続きをお願いいたします。\n";

            // 件名
            $subject = "セキュリティコードご案内";

            $mail_send_ret = (new Util())->my_send_mail($sendMailAddr, $subject, $message);

            if (!$mail_send_ret) {
                return -1;
            } else {
                return 0;
            }

        // 登録失敗
        } else {
            return -1;
        }

    // 該当データありの場合
    } else {

        // 更新処理
        $updRet = (new Tb_kaiin_login())->updateSecurityCd($param);

        // 更新成功
        if ($updRet) {

            // 本文
            $message  = "追加認証に必要な情報をご案内いたします。\n\n\n";
            $message .= "セキュリティコード：". $securityCd. "\n";
            $message .= "有効期限：10分\n\n\n";
            $message .= "上記を入力して認証手続きをお願いいたします。\n";

            // 件名
            $subject = "セキュリティコードご案内";

            $mail_send_ret = (new Util())->my_send_mail($sendMailAddr, $subject, $message);

            if (!$mail_send_ret) {
                return -1;
            } else {
                return 0;
            }

        // 登録失敗
        } else {
            return -1;
        }
    }
}

/*
 * 英数小文字nケタのセキュリティコードを生成する
 * @params $length
 */
function create_passwd($length) {

    //vars
    $pwd = array();
    $pwd_strings = array(
        "sletter" => range('a', 'z'),
        "cletter" => range('A', 'Z'),
        "number"  => range('0', '9'),
    );

    //logic
    while (count($pwd) < $length) {
        // 3種類必ず入れる
        if (count($pwd) < 3) {
            $key = key($pwd_strings);
            next($pwd_strings);
        } else {
            // 後はランダムに取得
            $key = array_rand($pwd_strings);
        }
        $pwd[] = $pwd_strings[$key][array_rand($pwd_strings[$key])];
    }

    // 生成したパスワードの順番をランダムに並び替え
    shuffle($pwd);

    return implode($pwd);
}

echo $ret;
die();
