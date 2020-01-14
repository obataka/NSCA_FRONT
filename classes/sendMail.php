<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_new_token.php';
require './Common/Util.php';

$ret = "";
$insert_ret = "";
$mail_send_ret = "";

//西暦4桁、月（0埋め）、日（0埋め）、時（0埋め）、秒（0埋め）、連番2桁0うめ
$id = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s');

// 該当日付の会員の最大値取得処理
$id_max = (new Tb_new_token())->findMaxId($id . '%');

// 登録用会員番号生成用の連番を設定
if ($id_max['max_no'] == '') {
    $id_no = 1;
} else {
    $id_no = intval($id_max['max_no']) + 1;
}

// 登録用会員番号生成
$wk_no = $id . sprintf('%02d', $id_no);

//メールアドレス取得
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";

//トークンを作成し、アドレスとトークンと有効期限をDBに登録する。
$limit = time();    //有効期限
$limit = date("Y-m-d H:i:s", $limit+(3600));
$token= rand(0,100).uniqid();//トークン

// 登録用パラメーター設定
$param = [
    'id'                    => $wk_no,
    'mail_address'          => $mail,
    'one_time_token'        => $token,
    'yukokigen_nichiji'     => $limit,
];

// 登録処理
$insert_ret = (new Tb_new_token())->insertRec($param);

// 登録失敗の場合
if (!$insert_ret) {
    // 戻り値に0設定
    $ret = 0;
// 登録成功の場合
} else {
    $message="新規登録するには、以下のアドレスを開いてください。\n60分以内にアクセスが無かった場合は無効となります。\n";
    $message.="https://www.demo-nls02.work/registSbtSelect/?id=" . $wk_no ."&token=" .$token;

    $subject ="入会案内";

    $mail_send_ret = (new Util())->my_send_mail($mail, $subject, $message);

    if (!$mail_send_ret) {
        // 戻り値に0設定
        $ret = 0;
    } else {
        // 戻り値に1設定
        $ret = 1;
    }
}

echo $ret;
die();
