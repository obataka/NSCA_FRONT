<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_my_page_koshin_rireki.php';

$ret = '';
$wk_no = 0;
$wk_kaiin_no = '';


// POSTデータを取得
// confirmRiyo.jsでセットしたPOSTデータを取得する
// 会員情報
$kaiin_no = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$shimei = (!empty($_POST['shimei'])) ? htmlentities($_POST['shimei'], ENT_QUOTES, "UTF-8") : "";
$furigana = (!empty($_POST['furigana'])) ? htmlentities($_POST['furigana'], ENT_QUOTES, "UTF-8") : "";
$seinengappi = (!empty($_POST['seinengappi'])) ? htmlentities($_POST['seinengappi'], ENT_QUOTES, "UTF-8") : "";
$seibetsu_kbn = (!empty($_POST['seibetsu_kbn'])) ? htmlentities($_POST['seibetsu_kbn'], ENT_QUOTES, "UTF-8") : "";
$yubin_no = (!empty($_POST['yubin_no'])) ? htmlentities($_POST['yubin_no'], ENT_QUOTES, "UTF-8") : "";
$ken_no = (!empty($_POST['ken_no'])) ? htmlentities($_POST['ken_no'], ENT_QUOTES, "UTF-8") : "";
$chiiki_id = (!empty($_POST['chiiki_id'])) ? htmlentities($_POST['chiiki_id'], ENT_QUOTES, "UTF-8") : "";
$kemmei = (!empty($_POST['kemmei'])) ? htmlentities($_POST['kemmei'], ENT_QUOTES, "UTF-8") : "";
$jusho_1 = (!empty($_POST['jusho_1'])) ? htmlentities($_POST['jusho_1'], ENT_QUOTES, "UTF-8") : "";
$jusho_2 = (!empty($_POST['jusho_2'])) ? htmlentities($_POST['jusho_2'], ENT_QUOTES, "UTF-8") : "";
$kana_jusho_1 = (!empty($_POST['kana_jusho_1'])) ? htmlentities($_POST['kana_jusho_1'], ENT_QUOTES, "UTF-8") : "";
$kana_jusho_2 = (!empty($_POST['kana_jusho_2'])) ? htmlentities($_POST['kana_jusho_2'], ENT_QUOTES, "UTF-8") : "";
$tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$keitai_denwa = (!empty($_POST['keitai_denwa'])) ? htmlentities($_POST['keitai_denwa'], ENT_QUOTES, "UTF-8") : "";
$email = (!empty($_POST['email'])) ? htmlentities($_POST['email'], ENT_QUOTES, "UTF-8") : "";
$keitai_email = (!empty($_POST['keitai_email'])) ? htmlentities($_POST['keitai_email'], ENT_QUOTES, "UTF-8") : "";
$merumaga_haishin_pc_email = (!empty($_POST['merumaga_haishin_pc_email'])) ? htmlentities($_POST['merumaga_haishin_pc_email'], ENT_QUOTES, "UTF-8") : "";
$merumaga_haishin_keitai_email = (!empty($_POST['merumaga_haishin_keitai_email'])) ? htmlentities($_POST['merumaga_haishin_keitai_email'], ENT_QUOTES, "UTF-8") : "";
$renraku_hoho_yuso = (!empty($_POST['renraku_hoho_yuso'])) ? htmlentities($_POST['renraku_hoho_yuso'], ENT_QUOTES, "UTF-8") : "";
$renraku_hoho_denshi_email = (!empty($_POST['renraku_hoho_denshi_email'])) ? htmlentities($_POST['renraku_hoho_denshi_email'], ENT_QUOTES, "UTF-8") : "";

// 更新用パラメーター設定
$param = [
    'henkobi'                                   => date("Y/m/d"),
    'shinkyu_kbn'                               => "0",
    'kojin_no'                                  => "0",
    'kaiin_no'                                  => $kaiin_no,
    'shimei'                                    => $shimei,
    'furigana'                                  => $furigana,
    'first'                                     => NULL,
    'last'                                      => NULL,
    'seinengappi'                               => $seinengappi,
    'seibetsu_kbn'                              => $seibetsu_kbn,
    'yubin_no'                                  => $yubin_no,
    'ken_no'                                    => $ken_no,
    'chiiki_id'                                 => $chiiki_id,
    'kemmei'                                    => $kemmei,
    'jusho_1'                                   => $jusho_1,
    'jusho_2'                                   => $jusho_2,
    'kana_jusho_1'                              => $kana_jusho_1,
    'kana_jusho_2'                              => $kana_jusho_2,
    'tel'                                       => $tel,
    'fax'                                       => NULL,
    'keitai_denwa'                              => $keitai_denwa,
    'keitai_denwa_shurui'                       => NULL,
    'email'                                     => $email,
    'keitai_email'                              => $keitai_email,
    'url'                                       => NULL,
    'shokugyo_kbn_1'                            => NULL,
    'shokugyo_kbn_2'                            => NULL,
    'shokugyo_kbn_3'                            => NULL,
    'kimmusakimei'                              => NULL,
    'kimmusaki_yubin_no'                        => NULL,
    'kimmusaki_ken_no'                          => NULL,
    'kimmusaki_kemmei'                          => NULL,
    'kimmusaki_jusho_1'                         => NULL,
    'kimmusaki_jusho_2'                         => NULL,
    'kimmusaki_tel'                             => NULL,
    'kimmusaki_fax'                             => NULL,
    'gakuseisho_filemei'                        => NULL,
    'gakuseisho_filemei_2'                      => NULL,
    'yoyaku_kaiin_sbt'                          => NULL,
    'merumaga_haishin_pc_email'                 => $merumaga_haishin_pc_email,
    'merumaga_haishin_keitai_email'             => $merumaga_haishin_keitai_email,
    'merumaga_hashin_smartphone'                => NULL,
    'renraku_hoho_yuso'                         => $renraku_hoho_yuso,
    'renraku_hoho_denshi_email'                 => $renraku_hoho_denshi_email,
    'yubin_haitatsusaki_kbn'                    => NULL,
    'website_keisai_kbn'                        => NULL,
    'daisansha_questionnaire_kbn'               => NULL,
    'sonota_shikaku'                            => NULL,
    'sonota_shikaku_kijutsu'                    => NULL,
    'kyominoaru_bunya'                          => NULL,
    'kyominoaru_bunya_kijutsu'                  => NULL,
    'kyominoaru_chiiki'                         => NULL,
    'sakusei_user_id'                           => "Web",
    'koshin_user_id'                            => "Web",
    'sakusei_nichiji'                           => date("Y/m/d H:i:s"),
    'koshin_nichiji'                            => date("Y/m/d H:i:s"),
];
error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');

// 更新処理
$result = (new Tb_kaiin_my_page_koshin_rireki())->insertRec($param);
// 更新失敗の場合
if ($result == false) {
    NULL;
// 更新成功の場合
} else {
    NULL;
}
echo $result;
die();


