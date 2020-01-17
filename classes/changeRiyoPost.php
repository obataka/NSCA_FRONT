<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_sonota.php';   
$ret = '';
$wk_no = 0;
//セッションから会員番号を取得
$wk_kaiin_no = '';
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}
// POSTデータを取得
// changeConfirmRiyo.jsでセットしたPOSTデータを取得する
// 会員情報
$shimei_sei = (!empty($_POST['shimei_sei'])) ? htmlentities($_POST['shimei_sei'], ENT_QUOTES, "UTF-8") : "";
$shimei_mei = (!empty($_POST['shimei_mei'])) ? htmlentities($_POST['shimei_mei'], ENT_QUOTES, "UTF-8") : "";
$furigana_sei = (!empty($_POST['furigana_sei'])) ? htmlentities($_POST['furigana_sei'], ENT_QUOTES, "UTF-8") : "";
$furigana_mei = (!empty($_POST['furigana_mei'])) ? htmlentities($_POST['furigana_mei'], ENT_QUOTES, "UTF-8") : "";
$seinengappi = (!empty($_POST['seinengappi'])) ? htmlentities($_POST['seinengappi'], ENT_QUOTES, "UTF-8") : "";
$seibetsu_kbn = (!empty($_POST['seibetsu_kbn'])) ? htmlentities($_POST['seibetsu_kbn'], ENT_QUOTES, "UTF-8") : "";
$ken_no = (!empty($_POST['ken_no'])) ? htmlentities($_POST['ken_no'], ENT_QUOTES, "UTF-8") : "";
$kemmei = (!empty($_POST['kemmei'])) ? htmlentities($_POST['kemmei'], ENT_QUOTES, "UTF-8") : "";
$yubin_no = (!empty($_POST['yubin_no'])) ? htmlentities($_POST['yubin_no'], ENT_QUOTES, "UTF-8") : "";
$jusho_1 = (!empty($_POST['jusho_1'])) ? htmlentities($_POST['jusho_1'], ENT_QUOTES, "UTF-8") : "";
$jusho_2 = (!empty($_POST['jusho_2'])) ? htmlentities($_POST['jusho_2'], ENT_QUOTES, "UTF-8") : "";
$kana_jusho_1 = (!empty($_POST['kana_jusho_1'])) ? htmlentities($_POST['kana_jusho_1'], ENT_QUOTES, "UTF-8") : "";
$kana_jusho_2 = (!empty($_POST['kana_jusho_2'])) ? htmlentities($_POST['kana_jusho_2'], ENT_QUOTES, "UTF-8") : "";
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$keitai_no = (!empty($_POST['keitai_no'])) ? htmlentities($_POST['keitai_no'], ENT_QUOTES, "UTF-8") : "";
$nagareyama_shimin = (!empty($_POST['nagareyama_shimin'])) ? htmlentities($_POST['nagareyama_shimin'], ENT_QUOTES, "UTF-8") : "";
$chiiki_id = (!empty($_POST['chiiki_id'])) ? htmlentities($_POST['chiiki_id'], ENT_QUOTES, "UTF-8") : "";
//会員その他
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
$merumaga = (!empty($_POST['merumaga'])) ? htmlentities($_POST['merumaga'], ENT_QUOTES, "UTF-8") : "";
$hoho = (!empty($_POST['hoho'])) ? htmlentities($_POST['hoho'], ENT_QUOTES, "UTF-8") : "";
//メルマガ配信を希望する　かつ　メール受信希望のメールアドレスがメール1の場合
if ($merumaga == 1 && $mail == 1) {
    $wk_mail1 = TRUE;
} else {
    $wk_mail1 = FALSE;
}
//メルマガ配信を希望する　かつ　メール受信希望のメールアドレスがメール2の場合
if ($merumaga == 1 && $mail == 2) {
    $wk_mail2 = TRUE;
} else {
    $wk_mail2 = FALSE;
}
//メール受信希望のメールアドレスが1の場合
if ($mail == 1) {
    $receive_mail1 = TRUE;
} else {
    $receive_mail1 = FALSE;
}
//メール受信希望のメールアドレスが2の場合
if ($mail == 2) {
    $receive_mail2 = TRUE;
} else {
    $receive_mail2 = FALSE;
}      
//連絡方法
if ($hoho == 1) {
    $wk_hoho1 = TRUE;
} else {
    $wk_hoho1 = FALSE;
}
if ($hoho == 2) {
    $wk_hoho2 = TRUE;
} else {
    $wk_hoho2 = FALSE;
}
/**********************
* 更新用パラメーター設定
***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

$param = [
    'shimei_sei'                        => $shimei_sei,
    'shimei_mei'                        => $shimei_mei,
    'furigana_sei'                      => $furigana_sei,
    'furigana_mei'                      => $furigana_mei,
    'seinengappi'                       => $seinengappi,
    'seibetsu_kbn'                      => $seibetsu_kbn,
    'yubin_no'                          => $yubin_no,
    'ken_no'                            => $ken_no,
    'chiiki_id'                         => $chiiki_id,
    'kemmei'                            => $kemmei,
    'jusho_1'                           => $jusho_1,
    'jusho_2'                           => $jusho_2,
    'kana_jusho_1'                      => $kana_jusho_1,
    'kana_jusho_2'                      => $kana_jusho_2,
    'tel'                               => $tel,
    'keitai_no'                         => $keitai_no,
    'nagareyama_shimin'                 => $nagareyama_shimin,
    'koshin_user_id'                    => NULL,
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
    'kaiin_no'                          => $wk_kaiin_no,
];
// 登録処理
$result_joho = (new Tb_kaiin_joho())->updateRiyo($db, $param);

// 更新成功の場合
if ($result_joho == TRUE) {
    
    //sonota更新用パラメーター設定
    $param1 = [
        'renraku_hoho_yuso'                 => $wk_hoho2,
        'renraku_hoho_denshi_email'         => $wk_hoho1,
        'email_1_merumaga_haishin'          => $wk_mail1,
        'email_2_merumaga_haishin'          => $wk_mail2,
        'email_1_oshirase_uketori'          => $receive_mail1,
        'email_2_oshirase_uketori'          => $receive_mail2,
        'koshin_user_id'                    => "Web",
        'koshin_nichiji'                    => date("Y/m/d H:i:s"),
        'kaiin_no'                          => $wk_kaiin_no,
    ];

    // 更新処理
    $result_sonota = (new Tb_kaiin_sonota())->updateRiyoSonota($db, $param1);

    // 更新成功の場合
if ($result_sonota == TRUE) {
    // commit
    $db->commit();

    // 戻り値に1設定
    $result = 1;

// 更新失敗の場合
} else {
    // ロールバック
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
}

// 更新成功の場合
} else {
    // ロールバック
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
}

echo $result;
die();


