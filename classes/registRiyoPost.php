<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_sonota.php';   

$ret = '';
$wk_no = 0;
$wk_kaiin_no = '';

// POSTデータを取得
// confirmRiyo.jsでセットしたPOSTデータを取得する
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
$email_1 = (!empty($_POST['email_1'])) ? htmlentities($_POST['email_1'], ENT_QUOTES, "UTF-8") : "";
$email_2 = (!empty($_POST['email_2'])) ? htmlentities($_POST['email_2'], ENT_QUOTES, "UTF-8") : "";
$nagareyama_shimin = (!empty($_POST['nagareyama_shimin'])) ? htmlentities($_POST['nagareyama_shimin'], ENT_QUOTES, "UTF-8") : "";
$chiiki_id = (!empty($_POST['chiiki_id'])) ? htmlentities($_POST['chiiki_id'], ENT_QUOTES, "UTF-8") : "";
$my_page_password = (!empty($_POST['pass'])) ? htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8") : "";
//error_log(print_r($nagareyama_shimin, true). PHP_EOL, '3', 'tanihara_log.txt'); //18番目 流山市民チェック
//error_log(print_r($chiiki_id, true). PHP_EOL, '3', 'tanihara_log.txt');         //19番目 地域ID
//会員その他
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
$merumaga = (!empty($_POST['merumaga'])) ? htmlentities($_POST['merumaga'], ENT_QUOTES, "UTF-8") : "";
error_log(print_r($mail, true). PHP_EOL, '3', 'tanihara_log1.txt');
error_log(print_r($merumaga, true). PHP_EOL, '3', 'tanihara_log1.txt');
error_log(print_r($nagareyama_shimin, true). PHP_EOL, '3', 'tanihara_log1.txt');
// 先頭8、西暦の下2桁、月（0埋め）、日（0埋め）、連番2桁0うめ
//　　 8 . date('y') . date('m') . date('d')
$wk_kaiin_no_joken =  "8" . date('y') . date('m') . date('d');

// 該当日付の会員の最大値取得処理
$wk_kaiin_no_max = (new Tb_kaiin_joho())->findMemberNo($wk_kaiin_no_joken . '%');

// 登録用会員番号生成用の連番を設定
if ($wk_kaiin_no_max['max_no'] == '') {
    $wk_no = 1;
} else {
    $wk_no = intval($wk_kaiin_no_max['max_no']) + 1;
}

// 登録用会員番号生成
$wk_kaiin_no = $wk_kaiin_no_joken . sprintf('%02d', $wk_no);

// ハッシュを作る
$my_page_password = password_hash($_REQUEST[$my_page_password], PASSWORD_BCRYPT);

//メルマガ配信を希望する　かつ　メール受信希望のメールアドレスがメール1の場合
if ($merumaga == 1 && $mail == 1) {
    $wk_mail1 = TRUE;
} else {
    $wk_mail1 = FALSE;
}
error_log(print_r($wk_mail1, true). PHP_EOL, '3', 'tanihara_log1.txt');
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
// error_log(print_r($wk_mail1, true). PHP_EOL, '3', 'tanihara_log1.txt'); 
// error_log(print_r($wk_mail2, true). PHP_EOL, '3', 'tanihara_log1.txt');         
// error_log(print_r($receive_mail1, true). PHP_EOL, '3', 'tanihara_log1.txt'); 
// error_log(print_r($receive_mai2, true). PHP_EOL, '3', 'tanihara_log1.txt');         

// 登録用パラメーター設定
$param = [
    'kaiin_no'                          => $wk_kaiin_no,
    'kyukaiin_no'                       => NULL,
    'toroku_jokyo_kbn'                  => "1",
    'kaiin_jokyo_kbn'                   => "3",
    'kaiin_sbt_kbn'                     => "0",
    'beikoku_kaiin_no'                  => NULL,
    'beikoku_kaiin_shikaku_kbn'         => NULL,
    'shimei_sei'                        => $shimei_sei,
    'shimei_mei'                        => $shimei_mei,
    'keisho_kbn'                        => NULL,
    'furigana_sei'                      => $furigana_sei,
    'furigana_mei'                      => $furigana_mei,
    'kyusei'                            => NULL,
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
    'fax'                               => NULL,
    'keitai_no'                         => $keitai_no,
    'keitai_denwa_shurui'               => NULL,
    'email_1'                           => $email_1,
    'email_2'                           => $email_2,
    'url_1'                             => NULL,
    'url_2'                             => NULL,
    'shokugyo_kbn_1'                    => NULL,
    'shokugyo_kbn_2'                    => NULL,
    'shokugyo_kbn_3'                    => NULL,
    'kimmusakimei'                      => NULL,
    'kimmusaki_bushomei'                => NULL,
    'kimmusaki_yubin_no'                => NULL,
    'kimmusaki_ken_no'                  => NULL,
    'kimmusaki_kemmei'                  => NULL,
    'kimmusaki_jusho_1'                 => NULL,
    'kimmusaki_jusho_2'                 => NULL,
    'kimmusaki_tel'                     => NULL,
    'kimmusaki_fax'                     => NULL,
    'first'                             => NULL,
    'last'                              => NULL,
    'honor_kbn'                         => NULL,
    'address'                           => NULL,
    'city'                              => NULL,
    'prefecture'                        => NULL,
    'country'                           => NULL,
    'postal_code'                       => NULL,
    'biko'                              => NULL,
    'my_page_password'                  => $my_page_password,
    'gakuseisho_filemei'                => NULL,
    'gakuseisho_filemei_2'              => NULL,
    'web_nyukai_kbn'                    => "1",
    'torokukeiro'                       => NULL,
    'nagareyama_shimin'                 => $nagareyama_shimin,
    'sotsugyo_shomeisho_kakunin_kbn'   => NULL,
    'sotsugyo_shomeisho_teishutsubi'    => NULL,
    'sotsugyo_shomeisho_kakunimbi'      => NULL,
    'gakureki_shosho_kakunimbi'         => NULL,
    'gakui_kbn'                         => NULL,
    'sotsugyo_yoteibi'                  => NULL,
    'shutoku_gakui_bunya_kbn'           => NULL,
    'shutoku_gakka'                     => NULL,
    'cpraed_kakunin_kbn'                => NULL,
    'cpraed_kakunimbi'                  => NULL,
    'cpraed_senseibi'                   => NULL,
    'cpraed_hoji_kbn'                   => "0",
    'cpraed_ninteibi'                   => NULL,
    'cpraed_yuko_kigembi'               => NULL,
    'jiko_shokai_keisai'                => NULL,
    'shashin_file_path'                 => NULL,
    'jiko_shokai'                       => NULL,
    'jiko_shokai_email'                 => NULL,
    'jiko_shokai_tel'                   => NULL,
    'jiko_shokai_sns1'                  => NULL,
    'jiko_shokai_sns2'                  => NULL,
    'sakujo_flg'                        => "0",
    'sakusei_user_id'                   => NULL,
    'koshin_user_id'                    => NULL,
    'sakusei_nichiji'                   => date("Y/m/d H:i:s"),
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
    'kako_shikaku_umu_kbn'              => NULL,
];
error_log(print_r($param, true). PHP_EOL, '3', 'tanihara_log.txt');     //動作確認

// 登録処理
$result = (new Tb_kaiin_joho())->insertRec($param);
error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log.txt');

// 登録失敗の場合
if ($result == false) {
    NULL;
    error_log(print_r("登録失敗", true). PHP_EOL, '3', 'tanihara_log.txt');
// 登録成功の場合
} else {
    NULL;
    error_log(print_r("登録成功", true). PHP_EOL, '3', 'tanihara_log.txt');
}
echo $result;
// sonota登録用パラメーター設定
$param1 = [
    'kaiin_no'                          => $wk_kaiin_no,
    'renraku_hoho_yuso'                 => FALSE,
    'renraku_hoho_denshi_email'         => TRUE,
    'email_1_merumaga_haishin'          => $wk_mail1,
    'email_2_merumaga_haishin'          => $wk_mail2,
    'marumaga_haishin_smartphone'       => NULL,
    'yubin_haitatsusaki_kbn'            => NULL,
    'daisansha_questionnaire_kbn'       => NULL,
    'taikaigono_oshirase_kbn'           => NULL,
    'website_keisai_kbn'                => NULL,
    'card_toroku'                       => NULL,
    'email_1_oshirase_uketori'          => $receive_mail1,
    'email_1_login'                     => TRUE,
    'email_2_oshirase_uketori'          => $receive_mail2,
    'email_2_login'                     => FALSE,
    'sakujo_flg'                        => "0",
    'sakusei_user_id'                   => NULL,
    'koshin_user_id'                    => NULL,
    'sakusei_nichiji'                   => date("Y/m/d H:i:s"),
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
error_log(print_r($param1, true). PHP_EOL, '3', 'tanihara_log1.txt');     //動作確認

// 登録処理
$result = (new Tb_kaiin_sonota())->insertRec($param1);
error_log(print_r($result, true). PHP_EOL, '3', 'tanihara_log1.txt');

// 登録失敗の場合
if ($result == false) {
    NULL;
    error_log(print_r("登録失敗", true). PHP_EOL, '3', 'tanihara_log1.txt');
// 登録成功の場合
} else {
    NULL; 
    error_log(print_r("登録成功", true). PHP_EOL, '3', 'tanihara_log1.txt');
}
if ($mail == 1) {
    //メールアドレス取得
    $message="無料会員登録が完了しました。";
    my_send_mail($email_1,'会員登録完了お知らせ',$message);
    

    function my_send_mail($mailto, $subject, $message)
        {
 
            $message = mb_convert_encoding($message, "JIS", "UTF-8");
            $subject = mb_convert_encoding($subject, "JIS", "UTF-8");
 
            $header ="From: NSCAジャパン <info@example.com>\n";
 
            mb_send_mail($mailto, $subject, $message, $header);
        }
 } //else {
//     $wk_mail2 = FALSE;
// }
echo $result;
die();


