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
// confirmMember.jsでセットしたPOSTデータを取得する
// 会員情報
$kaiin_no = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$shimei = (!empty($_POST['shimei'])) ? htmlentities($_POST['shimei'], ENT_QUOTES, "UTF-8") : "";
$furigana = (!empty($_POST['furigana'])) ? htmlentities($_POST['furigana'], ENT_QUOTES, "UTF-8") : "";
$first = (!empty($_POST['first'])) ? htmlentities($_POST['first'], ENT_QUOTES, "UTF-8") : "";
$last = (!empty($_POST['last'])) ? htmlentities($_POST['last'], ENT_QUOTES, "UTF-8") : "";
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
$fax = (!empty($_POST['fax'])) ? htmlentities($_POST['fax'], ENT_QUOTES, "UTF-8") : "";
$keitai_denwa = (!empty($_POST['keitai_denwa'])) ? htmlentities($_POST['keitai_denwa'], ENT_QUOTES, "UTF-8") : "";
$keitai_denwa_shurui = (!empty($_POST['keitai_denwa_shurui'])) ? htmlentities($_POST['keitai_denwa_shurui'], ENT_QUOTES, "UTF-8") : "";
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
$gakuseisho_filemei_1 = (!empty($_POST['gakuseisho_filemei_1'])) ? htmlentities($_POST['gakuseisho_filemei_1'], ENT_QUOTES, "UTF-8") : "";
$gakuseisho_filemei_2 = (!empty($_POST['gakuseisho_filemei_2'])) ? htmlentities($_POST['gakuseisho_filemei_2'], ENT_QUOTES, "UTF-8") : "";
$yoyaku_kaiin_sbt = (!empty($_POST['yoyaku_kaiin_sbt'])) ? htmlentities($_POST['yoyaku_kaiin_sbt'], ENT_QUOTES, "UTF-8") : "";
$email = (!empty($_POST['email'])) ? htmlentities($_POST['email'], ENT_QUOTES, "UTF-8") : "";
$keitai_email = (!empty($_POST['keitai_email'])) ? htmlentities($_POST['keitai_email'], ENT_QUOTES, "UTF-8") : "";
$merumaga_haishin_pc_email = (!empty($_POST['merumaga_haishin_pc_email'])) ? htmlentities($_POST['merumaga_haishin_pc_email'], ENT_QUOTES, "UTF-8") : "";
$merumaga_haishin_keitai_email = (!empty($_POST['merumaga_haishin_keitai_email'])) ? htmlentities($_POST['merumaga_haishin_keitai_email'], ENT_QUOTES, "UTF-8") : "";
$merumaga_haishin_smartphone = (!empty($_POST['merumaga_haishin_smartphone'])) ? htmlentities($_POST['merumaga_haishin_smartphone'], ENT_QUOTES, "UTF-8") : "";
$renraku_hoho_yuso = (!empty($_POST['renraku_hoho_yuso'])) ? htmlentities($_POST['renraku_hoho_yuso'], ENT_QUOTES, "UTF-8") : "";
$renraku_hoho_denshi_email = (!empty($_POST['renraku_hoho_denshi_email'])) ? htmlentities($_POST['renraku_hoho_denshi_email'], ENT_QUOTES, "UTF-8") : "";
$yubin_haitatsusaki_kbn = (!empty($_POST['yubin_haitatsusaki_kbn'])) ? htmlentities($_POST['yubin_haitatsusaki_kbn'], ENT_QUOTES, "UTF-8") : "";
$website_keisai_kbn = (!empty($_POST['website_keisai_kbn'])) ? htmlentities($_POST['website_keisai_kbn'], ENT_QUOTES, "UTF-8") : "";
$daisansha_questionnaire_kbn = (!empty($_POST['daisansha_questionnaire_kbn'])) ? htmlentities($_POST['daisansha_questionnaire_kbn'], ENT_QUOTES, "UTF-8") : "";
$meisho_cd_shikaku = (!empty($_POST['meisho_cd_shikaku'])) ? htmlentities($_POST['meisho_cd_shikaku'], ENT_QUOTES, "UTF-8") : "";
$shikaku_sonota = (!empty($_POST['shikaku_sonota'])) ? htmlentities($_POST['shikaku_sonota'], ENT_QUOTES, "UTF-8") : "";
$meisho_cd_chiiki = (!empty($_POST['meisho_cd_chiiki'])) ? htmlentities($_POST['meisho_cd_chiiki'], ENT_QUOTES, "UTF-8") : "";
$meisho_cd_bunya = (!empty($_POST['meisho_cd_bunya'])) ? htmlentities($_POST['meisho_cd_bunya'], ENT_QUOTES, "UTF-8") : "";
$bunya_sonota = (!empty($_POST['bunya_sonota'])) ? htmlentities($_POST['bunya_sonota'], ENT_QUOTES, "UTF-8") : "";
// 更新用パラメーター設定
$param = [
    'henkobi'                                   => date("Y/m/d"),
    'shinkyu_kbn'                               => "0",
    'kojin_no'                                  => "0",
    'kaiin_no'                                  => $kaiin_no,
    'shimei'                                    => $shimei,
    'furigana'                                  => $furigana,
    'first'                                     => $first,
    'last'                                      => $last,
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
    'fax'                                       => $fax,
    'keitai_denwa'                              => $keitai_denwa,
    'keitai_denwa_shurui'                       => $keitai_denwa_shurui,
    'email'                                     => $email,
    'keitai_email'                              => $keitai_email,
    'url'                                       => $url_1,
    'shokugyo_kbn_1'                            => $shokugyo_kbn_1,
    'shokugyo_kbn_2'                            => $shokugyo_kbn_2,
    'shokugyo_kbn_3'                            => $shokugyo_kbn_3,
    'kimmusakimei'                              => $kimmusakimei,
    'kimmusaki_yubin_no'                        => $kimmusaki_yubin_no,
    'kimmusaki_ken_no'                          => $kimmusaki_ken_no,
    'kimmusaki_kemmei'                          => $kimmusaki_kemmei,
    'kimmusaki_jusho_1'                         => $kimmusaki_jusho_1,
    'kimmusaki_jusho_2'                         => $kimmusaki_jusho_2,
    'kimmusaki_tel'                             => $kimmusaki_tel,
    'kimmusaki_fax'                             => $kimmusaki_fax,
    'gakuseisho_filemei'                        => $gakuseisho_filemei_1,
    'gakuseisho_filemei_2'                      => $gakuseisho_filemei_2,
    'yoyaku_kaiin_sbt'                          => $yoyaku_kaiin_sbt,
    'merumaga_haishin_pc_email'                 => $merumaga_haishin_pc_email,
    'merumaga_haishin_keitai_email'             => $merumaga_haishin_keitai_email,
    'merumaga_hashin_smartphone'                => $merumaga_haishin_smartphone,
    'renraku_hoho_yuso'                         => $renraku_hoho_yuso,
    'renraku_hoho_denshi_email'                 => $renraku_hoho_denshi_email,
    'yubin_haitatsusaki_kbn'                    => $yubin_haitatsusaki_kbn,
    'website_keisai_kbn'                        => $website_keisai_kbn,
    'daisansha_questionnaire_kbn'               => $daisansha_questionnaire_kbn,
    'sonota_shikaku'                            => $meisho_cd_shikaku,
    'sonota_shikaku_kijutsu'                    => $shikaku_sonota,
    'kyominoaru_bunya'                          => $meisho_cd_bunya,
    'kyominoaru_bunya_kijutsu'                  => $bunya_sonota,
    'kyominoaru_chiiki'                         => $meisho_cd_chiiki,
    'sakusei_user_id'                           => "Web",
    'koshin_user_id'                            => "Web",
    'sakusei_nichiji'                           => date("Y/m/d H:i:s"),
    'koshin_nichiji'                            => date("Y/m/d H:i:s"),
];
error_log(print_r($param, true). PHP_EOL, '3', 'shibata_log.txt');
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


