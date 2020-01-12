<?php
namespace Was;

include_once '../ctrl/parts/beforeLoginHeader.php';

require '../classes/Config/Config.php';
require '../classes/DBAccess/Db.php';
require '../classes/DBAccess/Tb_new_token.php';

$wk_error_msg = "";
$includeView = '../views/registSbtSelect/registSbtSelect_tpl.php';

// GETパラメータのチェック
// GETパラメータにidがない場合
if (!isset($_GET['id'])) {

    // エラーメッセージを設定
    $wk_error_msg = "URLが無効です。";

    // テンプレートをエラー用に設定
    $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

// GETパラメータにidはあるがtokenがない場合
} elseif (!isset($_GET['token'])) {

    // エラーメッセージを設定
    $wk_error_msg = "URLが無効です。";

    // テンプレートをエラー用に設定
    $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

// GETパラメータは設定がある場合
} else {

    // GETパラメータを退避
    $wk_id = $_GET['id'];
    $wk_token = $_GET['token'];

    // TB新規入会用トークンテーブルからデータを取得する
    $tb_new_token = (new Tb_new_token())->findById($wk_id);

    // 該当データなしの場合
    if ($tb_new_token == "") {

        // エラーメッセージを設定
        $wk_error_msg = "URLが無効です。";

        // テンプレートをエラー用に設定
        $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

    // 該当データありの場合
    } else {

        // トークンがテーブルとGETパラメータで異なる場合
        if ($wk_token != $tb_new_token['token']) {

            // エラーメッセージを設定
            $wk_error_msg = "URLが無効です。";

            // テンプレートをエラー用に設定
            $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

            // TB新規入会用トークンテーブルの該当データを削除
            $del_ret = (new Tb_new_token())->deleteRec($wk_id);

        // トークンがテーブルとGETパラメータで同じ場合
        } else {

            $limitMax = date("Y-m-d H:i:s", $tb_new_token['koshin_nichiji']);
            $wkNow = date("Y-m-d H:i:s");

            // 有効期限を超えてる場合
            if ($limitMax < $wkNow) {

                // エラーメッセージを設定
                $wk_error_msg = "URLが無効です。";

                // テンプレートをエラー用に設定
                $includeView = '../views/registSbtSelect/registSbtSelectError_tpl.php';

                // TB新規入会用トークンテーブルの該当データを削除
                $del_ret = (new Tb_new_token())->deleteRec($wk_id);

            // 有効期限を超えていない場合
            } else {

                // TB新規入会用トークンテーブルの該当データを削除
                $del_ret = (new Tb_new_token())->deleteRec($wk_id);

            }
        }
    }
}

include_once $includeView;
