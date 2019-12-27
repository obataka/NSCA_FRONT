<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_sonota.php';
require './DBAccess/Tb_kaiin_journal.php';   
require './DBAccess/Tb_kaiin_sentaku.php';
$ret = '';
$wk_no = 0;
$wk_kaiin_no = '';

// POSTデータを取得
// changeConfirmMember.jsでセットしたPOSTデータを取得する

// 会員情報
$shimei_sei = (!empty($_POST['shimei_sei'])) ? htmlentities($_POST['shimei_sei'], ENT_QUOTES, "UTF-8") : "";
$shimei_mei = (!empty($_POST['shimei_mei'])) ? htmlentities($_POST['shimei_mei'], ENT_QUOTES, "UTF-8") : "";
$furigana_sei = (!empty($_POST['furigana_sei'])) ? htmlentities($_POST['furigana_sei'], ENT_QUOTES, "UTF-8") : "";
$furigana_mei = (!empty($_POST['furigana_mei'])) ? htmlentities($_POST['furigana_mei'], ENT_QUOTES, "UTF-8") : "";
$first = (!empty($_POST['first'])) ? htmlentities($_POST['first'], ENT_QUOTES, "UTF-8") : "";
$last = (!empty($_POST['last'])) ? htmlentities($_POST['last'], ENT_QUOTES, "UTF-8") : "";
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
$fax = (!empty($_POST['fax'])) ? htmlentities($_POST['fax'], ENT_QUOTES, "UTF-8") : "";
$keitai_no = (!empty($_POST['keitai_no'])) ? htmlentities($_POST['keitai_no'], ENT_QUOTES, "UTF-8") : "";
$url_1 = (!empty($_POST['url_1'])) ? htmlentities($_POST['url_1'], ENT_QUOTES, "UTF-8") : "";
$shokugyo_kbn_1 = (!empty($_POST['shokugyo_kbn_1'])) ? htmlentities($_POST['shokugyo_kbn_1'], ENT_QUOTES, "UTF-8") : "";
$shokugyo_kbn_2 = (!empty($_POST['shokugyo_kbn_2'])) ? htmlentities($_POST['shokugyo_kbn_2'], ENT_QUOTES, "UTF-8") : "";
$shokugyo_kbn_3 = (!empty($_POST['shokugyo_kbn_3'])) ? htmlentities($_POST['shokugyo_kbn_3'], ENT_QUOTES, "UTF-8") : "";
$kimmusakimei = (!empty($_POST['kimmusakimei'])) ? htmlentities($_POST['kimmusakimei'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_yubin_no = (!empty($_POST['kimmusaki_yubin_no'])) ? htmlentities($_POST['kimmusaki_yubin_no'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_ken_no = (!empty($_POST['kimmusaki_ken_no'])) ? htmlentities($_POST['kimmusaki_ken_no'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_kemmei = (!empty($_POST['kimmusaki_kemmei'])) ? htmlentities($_POST['kimmusaki_kemmei'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_jusho_1 = (!empty($_POST['kimmusaki_jusho_1'])) ? htmlentities($_POST['kimmusaki_jusho_1'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_jusho_2 = (!empty($_POST['kimmusaki_jusho_2'])) ? htmlentities($_POST['kimmusaki_jusho_2'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_tel = (!empty($_POST['kimmusaki_tel'])) ? htmlentities($_POST['kimmusaki_tel'], ENT_QUOTES, "UTF-8") : "";
$kimmusaki_fax = (!empty($_POST['kimmusaki_fax'])) ? htmlentities($_POST['kimmusaki_fax'], ENT_QUOTES, "UTF-8") : "";
$email_1 = (!empty($_POST['email_1'])) ? htmlentities($_POST['email_1'], ENT_QUOTES, "UTF-8") : "";
$email_2 = (!empty($_POST['email_2'])) ? htmlentities($_POST['email_2'], ENT_QUOTES, "UTF-8") : "";
$nagareyama_shimin = (!empty($_POST['nagareyama_shimin'])) ? htmlentities($_POST['nagareyama_shimin'], ENT_QUOTES, "UTF-8") : "";
$chiiki_id = (!empty($_POST['chiiki_id'])) ? htmlentities($_POST['chiiki_id'], ENT_QUOTES, "UTF-8") : "";

//会員その他
$mail = (!empty($_POST['mail'])) ? htmlentities($_POST['mail'], ENT_QUOTES, "UTF-8") : "";
$merumaga = (!empty($_POST['merumaga'])) ? htmlentities($_POST['merumaga'], ENT_QUOTES, "UTF-8") : "";
$hoho = (!empty($_POST['hoho'])) ? htmlentities($_POST['hoho'], ENT_QUOTES, "UTF-8") : "";
$yubin = (!empty($_POST['yubin'])) ? htmlentities($_POST['yubin'], ENT_QUOTES, "UTF-8") : "";
$web = (!empty($_POST['web'])) ? htmlentities($_POST['web'], ENT_QUOTES, "UTF-8") : "";
$qa = (!empty($_POST['qa'])) ? htmlentities($_POST['qa'], ENT_QUOTES, "UTF-8") : "";

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

//郵便物配達先区分
if ($yubin == 1) {
    $wk_yubin = TRUE;
} else {
    $wk_yubin = FALSE;
}
//アンケート協力
if ($qa == 1) {
    $wk_qa = TRUE;
} else {
    $wk_qa = FALSE;
}
//ウェブサイト掲載
if ($web == 1) {
    $wk_web = TRUE;
} else {
    $wk_web = FALSE;
}

//会員ジャーナル
$eibun_option_kbn = (!empty($_POST['eibun_option_kbn'])) ? htmlentities($_POST['eibun_option_kbn'], ENT_QUOTES, "UTF-8") : "";
if ($eibun_option_kbn == 1) {
    $eibun_option_kbn = TRUE;
} else {
    $eibun_option_kbn = FALSE;
}

//会員選択
$meisho_cd_shikaku = (!empty($_POST['meisho_cd_shikaku'])) ? htmlentities($_POST['meisho_cd_shikaku'], ENT_QUOTES, "UTF-8") : "";
$meisho_cd_chiiki = (!empty($_POST['meisho_cd_chiiki'])) ? htmlentities($_POST['meisho_cd_chiiki'], ENT_QUOTES, "UTF-8") : "";
$meisho_cd_bunya = (!empty($_POST['meisho_cd_bunya'])) ? htmlentities($_POST['meisho_cd_bunya'], ENT_QUOTES, "UTF-8") : "";
$biko_bunya = (!empty($_POST['biko_bunya'])) ? htmlentities($_POST['biko_bunya'], ENT_QUOTES, "UTF-8") : "";
$biko_shikaku = (!empty($_POST['biko_shikaku'])) ? htmlentities($_POST['biko_shikaku'], ENT_QUOTES, "UTF-8") : "";

/**********************
* 更新用パラメーター設定
***********************/
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
    'fax'                               => $fax,
    'email_1'                           => $email_1,
    'email_2'                           => $email_2,
    'url_1'                             => $url_1,
    'shokugyo_kbn_1'                    => $shokugyo_kbn_1,
    'shokugyo_kbn_2'                    => $shokugyo_kbn_2,
    'shokugyo_kbn_3'                    => $shokugyo_kbn_3,
    'kimmusakimei'                      => $kimmusakimei,
    'kimmusaki_yubin_no'                => $kimmusaki_yubin_no,
    'kimmusaki_ken_no'                  => $kimmusaki_ken_no,
    'kimmusaki_kemmei'                  => $kimmusaki_kemmei,
    'kimmusaki_jusho_1'                 => $kimmusaki_jusho_1,
    'kimmusaki_jusho_2'                 => $kimmusaki_jusho_2,
    'kimmusaki_tel'                     => $kimmusaki_tel,
    'kimmusaki_fax'                     => $kimmusaki_fax,
    'last'                              => $last,
    'first'                             => $first,
    'nagareyama_shimin'                 => $nagareyama_shimin,
    'koshin_user_id'                    => NULL,
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_joho())->updateMember($param);
// 更新失敗の場合
if ($result == false) {
    NULL;
// 更新成功の場合
} else {
    NULL;
}
echo $result;
/****************************
* sonota更新用パラメーター設定
*****************************/
$param1 = [
    'renraku_hoho_yuso'                 => $wk_hoho2,
    'renraku_hoho_denshi_email'         => $wk_hoho1,
    'email_1_merumaga_haishin'          => $wk_mail1,
    'email_2_merumaga_haishin'          => $wk_mail2,
    'email_1_oshirase_uketori'          => $receive_mail1,
    'email_2_oshirase_uketori'          => $receive_mail2,
    'yubin_haitatsusaki_kbn'            => $wk_yubin,
    'website_keisai_kbn'                => $wk_web,
    'daisansha_questionnaire_kbn'       => $wk_qa,
    'koshin_user_id'                    => "Web",
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_sonota())->updateMemberSonota($param1);

// 登録失敗の場合
if ($result == false) {
    NULL;
// 登録成功の場合
} else {
    NULL; 
}
echo $result;
// if ($mail == 1) {
//     //メールアドレス取得
//     $message="無料会員登録が完了しました。";
//     my_send_mail($email_1,'会員登録完了お知らせ',$message);
    

//     function my_send_mail($mailto, $subject, $message)
//         {
 
//             $message = mb_convert_encoding($message, "JIS", "UTF-8");
//             $subject = mb_convert_encoding($subject, "JIS", "UTF-8");
 
//             $header ="From: NSCAジャパン <info@example.com>\n";
 
//             mb_send_mail($mailto, $subject, $message, $header);
//         }
//  } else {
//     $wk_mail2 = FALSE;
// }

/****************************
* journal更新用パラメーター設定
*****************************/
$param2 = [
    'eibun_option_kbn'                  => $eibun_option_kbn,
    'koshin_user_id'                    => "Web",
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_journal())->updateMemberJournal($param2);

// 登録失敗の場合
if ($result == false) {
    NULL;
// 登録成功の場合
} else {
    NULL; 
}
echo $result;

/****************************
* 会員選択のレコード削除処理
*****************************/
// 削除処理
$param3 = [
    'kaiin_no'                          => 10251033,
];
$result = (new Tb_kaiin_sentaku())->deleteRec($param3);

// 削除失敗の場合
if ($result == false) {
    NULL;
// 削除成功の場合
} else {
    NULL; 
}
echo $result;

/****************************
* 会員選択作成用パラメーター設定
*****************************/
$param4 = [
    'kaiin_no'                          => 10251033,
    'meisho_cd_shikaku'                 => $meisho_cd_shikaku,
    'biko_shikaku'                      => $biko_shikaku,
    'sakujo_flg'                        => 0,
    'sakusei_user_id'                   => "Web",
    'koshin_user_id'                    => "Web",
    'sakusei_nichiji'                   => date("Y/m/d H:i:s"),
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_sentaku())->insertShikaku($param4);

// 登録失敗の場合
if ($result == false) {
    NULL;
// 登録成功の場合
} else {
    NULL; 
}

echo $result;

$param5 = [
    'kaiin_no'                          => 10251033,
    'meisho_cd_chiiki'                  => $meisho_cd_chiiki,
    'sakujo_flg'                        => 0,
    'sakusei_user_id'                   => "Web",
    'koshin_user_id'                    => "Web",
    'sakusei_nichiji'                   => date("Y/m/d H:i:s"),
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_sentaku())->insertChiiki($param5);

// 登録失敗の場合
if ($result == false) {
    NULL;
// 登録成功の場合
} else {
    NULL; 
}

echo $result;

$param6 = [
    'kaiin_no'                          => 10251033,
    'meisho_cd_bunya'                   => $meisho_cd_bunya,
    'biko_bunya'                        => $biko_bunya,
    'sakujo_flg'                        => 0,
    'sakusei_user_id'                   => "Web",
    'koshin_user_id'                    => "Web",
    'sakusei_nichiji'                   => date("Y/m/d H:i:s"),
    'koshin_nichiji'                    => date("Y/m/d H:i:s"),
];
// 登録処理
$result = (new Tb_kaiin_sentaku())->insertBunya($param6);

// 登録失敗の場合
if ($result == false) {
    NULL;
// 登録成功の場合
} else {
    NULL; 
}

echo $result;

die();


