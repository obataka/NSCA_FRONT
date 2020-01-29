<?php

namespace Was;

class Tb_kaiin_joho
{
    public function __construct()
    {
    }

    /*
     * ログイン判定
     * @param varchar $loginId
     * @return array|mixed
     */
    public function findByEmail($loginId)
    {
        try {
            $db = Db::getInstance();
            $sql = <<<SQL
                    SELECT joho.*, hex(sonota.email_1_login) AS login1, hex(sonota.email_2_login) AS login2
                      FROM tb_kaiin_joho joho
                     INNER JOIN tb_kaiin_sonota sonota
                        ON joho.kaiin_no = sonota.kaiin_no
                     WHERE (joho.toroku_jokyo_kbn = 1)
                       AND (joho.sakujo_flg = 0)
                       AND (sonota.sakujo_flg = 0)
                       AND ((joho.email_1 = :loginId) OR (joho.email_2 = :loginId) OR (joho.kaiin_no = :loginId));
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([':loginId' => $loginId,]);
            $kaiinJoho = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinJoho = [];
        }

        return $kaiinJoho;
    }

    /* 該当日の会員番号の最大値を取得する
    * @param varchar $kaiin_no
    * @return array|mixed
    */
    public function findMemberNo($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT RIGHT(MAX(kaiin_no), 2) AS max_no FROM tb_kaiin_joho WHERE kaiin_no LIKE :kaiin_no;");
            $sth->execute([':kaiin_no' => $kaiin_no,]);
            $mstProduct = $sth->fetch();
        } catch (\PDOException $e) {
            $mstProduct = [];
        }
        return $mstProduct;
    }


    /*
     * 存在チェック（パスワード変更用）
     * @param varchar $kaiinNo
     * @param varchar $mailAddress
     * @return resultCount(0:該当なし、1:該当あり、9:エラー)
     */
    public function findByKaiinNoAndEmail($kaiinNo, $mailAddress)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT COUNT(*) AS resultCount
                      FROM tb_kaiin_joho
                     WHERE kaiin_no = :kaiin_no
                       AND (email_1 = :mailAddress OR email_2 = :mailAddress)
                       AND toroku_jokyo_kbn = 1
                       AND sakujo_flg = 0;
            ");
            $sth->execute([':mailAddress' => $mailAddress, ':kaiin_no' => $kaiinNo]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            return 9;
        }
        return $row["resultCount"];
    }

    /*
     * 登録
     * @param array $param
     * @return boolean
     */
    public function insertRec($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kaiin_joho(
                  kaiin_no
                , kyukaiin_no
                , toroku_jokyo_kbn
                , kaiin_jokyo_kbn
                , kaiin_sbt_kbn
                , beikoku_kaiin_no
                , beikoku_kaiin_shikaku_kbn
                , shimei_sei
                , shimei_mei
                , keisho_kbn
                , furigana_sei
                , furigana_mei
                , kyusei
                , seinengappi
                , seibetsu_kbn
                , yubin_no
                , ken_no
                , chiiki_id
                , kemmei
                , jusho_1
                , jusho_2
                , kana_jusho_1
                , kana_jusho_2
                , tel
                , fax
                , keitai_no
                , keitai_denwa_shurui
                , email_1
                , email_2
                , url_1
                , url_2
                , shokugyo_kbn_1
                , shokugyo_kbn_2
                , shokugyo_kbn_3
                , kimmusakimei
                , kimmusaki_bushomei
                , kimmusaki_yubin_no
                , kimmusaki_ken_no
                , kimmusaki_kemmei
                , kimmusaki_jusho_1
                , kimmusaki_jusho_2
                , kimmusaki_tel
                , kimmusaki_fax
                , first
                , last
                , honor_kbn
                , address
                , city
                , prefecture
                , country
                , postal_code
                , biko
                , my_page_password
                , gakuseisho_filemei
                , gakuseisho_filemei_2
                , web_nyukai_kbn
                , torokukeiro
                , nagareyama_shimin
                , sotsugyo_shomeisho_kakunin_kbn
                , sotsugyo_shomeisho_teishutsubi
                , sotsugyo_shomeisho_kakunimbi
                , gakureki_shosho_kakunimbi
                , gakui_kbn
                , sotsugyo_yoteibi
                , shutoku_gakui_bunya_kbn
                , shutoku_gakka
                , cpraed_kakunin_kbn
                , cpraed_kakunimbi
                , cpraed_senseibi
                , cpraed_hoji_kbn
                , cpraed_ninteibi
                , cpraed_yuko_kigembi
                , jiko_shokai_keisai
                , shashin_file_path
                , jiko_shokai
                , jiko_shokai_email
                , jiko_shokai_tel
                , jiko_shokai_sns1
                , jiko_shokai_sns2
                , sakujo_flg
                , sakusei_user_id
                , koshin_user_id
                , sakusei_nichiji
                , koshin_nichiji
                , kako_shikaku_umu_kbn
            )
            VALUES (
                  :kaiin_no
                , :kyukaiin_no
                , :toroku_jokyo_kbn
                , :kaiin_jokyo_kbn
                , :kaiin_sbt_kbn
                , :beikoku_kaiin_no
                , :beikoku_kaiin_shikaku_kbn
                , :shimei_sei
                , :shimei_mei
                , :keisho_kbn
                , :furigana_sei
                , :furigana_mei
                , :kyusei
                , :seinengappi
                , :seibetsu_kbn
                , :yubin_no
                , :ken_no
                , :chiiki_id
                , :kemmei
                , :jusho_1
                , :jusho_2
                , :kana_jusho_1
                , :kana_jusho_2
                , :tel
                , :fax
                , :keitai_no
                , :keitai_denwa_shurui
                , :email_1
                , :email_2
                , :url_1
                , :url_2
                , :shokugyo_kbn_1
                , :shokugyo_kbn_2
                , :shokugyo_kbn_3
                , :kimmusakimei
                , :kimmusaki_bushomei
                , :kimmusaki_yubin_no
                , :kimmusaki_ken_no
                , :kimmusaki_kemmei
                , :kimmusaki_jusho_1
                , :kimmusaki_jusho_2
                , :kimmusaki_tel
                , :kimmusaki_fax
                , :first
                , :last
                , :honor_kbn
                , :address
                , :city
                , :prefecture
                , :country
                , :postal_code
                , :biko
                , :my_page_password
                , :gakuseisho_filemei
                , :gakuseisho_filemei_2
                , :web_nyukai_kbn
                , :torokukeiro
                , :nagareyama_shimin
                , :sotsugyo_shomeisho_kakunin_kbn
                , :sotsugyo_shomeisho_teishutsubi
                , :sotsugyo_shomeisho_kakunimbi
                , :gakureki_shosho_kakunimbi
                , :gakui_kbn
                , :sotsugyo_yoteibi
                , :shutoku_gakui_bunya_kbn
                , :shutoku_gakka
                , :cpraed_kakunin_kbn
                , :cpraed_kakunimbi
                , :cpraed_senseibi
                , :cpraed_hoji_kbn
                , :cpraed_ninteibi
                , :cpraed_yuko_kigembi
                , :jiko_shokai_keisai
                , :shashin_file_path
                , :jiko_shokai
                , :jiko_shokai_email
                , :jiko_shokai_tel
                , :jiko_shokai_sns1
                , :jiko_shokai_sns2
                , :sakujo_flg
                , :sakusei_user_id
                , :koshin_user_id
                , :sakusei_nichiji
                , :koshin_nichiji
                , :kako_shikaku_umu_kbn
            );

SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':kyukaiin_no'                      => $param['kyukaiin_no'],
                ':toroku_jokyo_kbn'                 => $param['toroku_jokyo_kbn'],
                ':kaiin_jokyo_kbn'                  => $param['kaiin_jokyo_kbn'],
                ':kaiin_sbt_kbn'                    => $param['kaiin_sbt_kbn'],
                ':beikoku_kaiin_no'                 => $param['beikoku_kaiin_no'],
                ':beikoku_kaiin_shikaku_kbn'        => $param['beikoku_kaiin_shikaku_kbn'],
                ':shimei_sei'                       => $param['shimei_sei'],
                ':shimei_mei'                       => $param['shimei_mei'],
                ':keisho_kbn'                       => $param['keisho_kbn'],
                ':furigana_sei'                     => $param['furigana_sei'],
                ':furigana_mei'                     => $param['furigana_mei'],
                ':kyusei'                           => $param['kyusei'],
                ':seinengappi'                      => $param['seinengappi'],
                ':seibetsu_kbn'                     => $param['seibetsu_kbn'],
                ':yubin_no'                         => $param['yubin_no'],
                ':ken_no'                           => $param['ken_no'],
                ':chiiki_id'                        => $param['chiiki_id'],
                ':kemmei'                           => $param['kemmei'],
                ':jusho_1'                          => $param['jusho_1'],
                ':jusho_2'                          => $param['jusho_2'],
                ':kana_jusho_1'                     => $param['kana_jusho_1'],
                ':kana_jusho_2'                     => $param['kana_jusho_2'],
                ':tel'                              => $param['tel'],
                ':fax'                              => $param['fax'],
                ':keitai_no'                        => $param['keitai_no'],
                ':keitai_denwa_shurui'              => $param['keitai_denwa_shurui'],
                ':email_1'                          => $param['email_1'],
                ':email_2'                          => $param['email_2'],
                ':url_1'                            => $param['url_1'],
                ':url_2'                            => $param['url_2'],
                ':shokugyo_kbn_1'                   => $param['shokugyo_kbn_1'],
                ':shokugyo_kbn_2'                   => $param['shokugyo_kbn_2'],
                ':shokugyo_kbn_3'                   => $param['shokugyo_kbn_3'],
                ':kimmusakimei'                     => $param['kimmusakimei'],
                ':kimmusaki_bushomei'               => $param['kimmusaki_bushomei'],
                ':kimmusaki_yubin_no'               => $param['kimmusaki_yubin_no'],
                ':kimmusaki_ken_no'                 => $param['kimmusaki_ken_no'],
                ':kimmusaki_kemmei'                 => $param['kimmusaki_kemmei'],
                ':kimmusaki_jusho_1'                => $param['kimmusaki_jusho_1'],
                ':kimmusaki_jusho_2'                => $param['kimmusaki_jusho_2'],
                ':kimmusaki_tel'                    => $param['kimmusaki_tel'],
                ':kimmusaki_fax'                    => $param['kimmusaki_fax'],
                ':first'                            => $param['first'],
                ':last'                             => $param['last'],
                ':honor_kbn'                        => $param['honor_kbn'],
                ':address'                          => $param['address'],
                ':city'                             => $param['city'],
                ':prefecture'                       => $param['prefecture'],
                ':country'                          => $param['country'],
                ':postal_code'                      => $param['postal_code'],
                ':biko'                             => $param['biko'],
                ':my_page_password'                 => $param['my_page_password'],
                ':gakuseisho_filemei'               => $param['gakuseisho_filemei'],
                ':gakuseisho_filemei_2'             => $param['gakuseisho_filemei_2'],
                ':web_nyukai_kbn'                   => $param['web_nyukai_kbn'],
                ':torokukeiro'                      => $param['torokukeiro'],
                ':nagareyama_shimin'                => $param['nagareyama_shimin'],
                ':sotsugyo_shomeisho_kakunin_kbn'   => $param['sotsugyo_shomeisho_kakunin_kbn'],
                ':sotsugyo_shomeisho_teishutsubi'   => $param['sotsugyo_shomeisho_teishutsubi'],
                ':sotsugyo_shomeisho_kakunimbi'     => $param['sotsugyo_shomeisho_kakunimbi'],
                ':gakureki_shosho_kakunimbi'        => $param['gakureki_shosho_kakunimbi'],
                ':gakui_kbn'                        => $param['gakui_kbn'],
                ':sotsugyo_yoteibi'                 => $param['sotsugyo_yoteibi'],
                ':shutoku_gakui_bunya_kbn'          => $param['shutoku_gakui_bunya_kbn'],
                ':shutoku_gakka'                    => $param['shutoku_gakka'],
                ':cpraed_kakunin_kbn'               => $param['cpraed_kakunin_kbn'],
                ':cpraed_kakunimbi'                 => $param['cpraed_kakunimbi'],
                ':cpraed_senseibi'                  => $param['cpraed_senseibi'],
                ':cpraed_hoji_kbn'                  => $param['cpraed_hoji_kbn'],
                ':cpraed_ninteibi'                  => $param['cpraed_ninteibi'],
                ':cpraed_yuko_kigembi'              => $param['cpraed_yuko_kigembi'],
                ':jiko_shokai_keisai'               => $param['jiko_shokai_keisai'],
                ':shashin_file_path'                => $param['shashin_file_path'],
                ':jiko_shokai'                      => $param['jiko_shokai'],
                ':jiko_shokai_email'                => $param['jiko_shokai_email'],
                ':jiko_shokai_tel'                  => $param['jiko_shokai_tel'],
                ':jiko_shokai_sns1'                 => $param['jiko_shokai_sns1'],
                ':jiko_shokai_sns2'                 => $param['jiko_shokai_sns2'],
                ':sakujo_flg'                       => $param['sakujo_flg'],
                ':sakusei_user_id'                  => $param['sakusei_user_id'],
                ':koshin_user_id'                   => $param['koshin_user_id'],
                ':sakusei_nichiji'                  => $param['sakusei_nichiji'],
                ':koshin_nichiji'                   => $param['koshin_nichiji'],
                ':kako_shikaku_umu_kbn'             => $param['kako_shikaku_umu_kbn'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 登録（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function insertRec_noTran($db, $param)
    {

        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kaiin_joho(
                  kaiin_no
                , kyukaiin_no
                , toroku_jokyo_kbn
                , kaiin_jokyo_kbn
                , kaiin_sbt_kbn
                , beikoku_kaiin_no
                , beikoku_kaiin_shikaku_kbn
                , shimei_sei
                , shimei_mei
                , keisho_kbn
                , furigana_sei
                , furigana_mei
                , kyusei
                , seinengappi
                , seibetsu_kbn
                , yubin_no
                , ken_no
                , chiiki_id
                , kemmei
                , jusho_1
                , jusho_2
                , kana_jusho_1
                , kana_jusho_2
                , tel
                , fax
                , keitai_no
                , keitai_denwa_shurui
                , email_1
                , email_2
                , url_1
                , url_2
                , shokugyo_kbn_1
                , shokugyo_kbn_2
                , shokugyo_kbn_3
                , kimmusakimei
                , kimmusaki_bushomei
                , kimmusaki_yubin_no
                , kimmusaki_ken_no
                , kimmusaki_kemmei
                , kimmusaki_jusho_1
                , kimmusaki_jusho_2
                , kimmusaki_tel
                , kimmusaki_fax
                , first
                , last
                , honor_kbn
                , address
                , city
                , prefecture
                , country
                , postal_code
                , biko
                , my_page_password
                , gakuseisho_filemei
                , gakuseisho_filemei_2
                , web_nyukai_kbn
                , torokukeiro
                , nagareyama_shimin
                , sotsugyo_shomeisho_kakunin_kbn
                , sotsugyo_shomeisho_teishutsubi
                , sotsugyo_shomeisho_kakunimbi
                , gakureki_shosho_kakunimbi
                , gakui_kbn
                , sotsugyo_yoteibi
                , shutoku_gakui_bunya_kbn
                , shutoku_gakka
                , cpraed_kakunin_kbn
                , cpraed_kakunimbi
                , cpraed_senseibi
                , cpraed_hoji_kbn
                , cpraed_ninteibi
                , cpraed_yuko_kigembi
                , jiko_shokai_keisai
                , shashin_file_path
                , jiko_shokai
                , jiko_shokai_email
                , jiko_shokai_tel
                , jiko_shokai_sns1
                , jiko_shokai_sns2
                , sakujo_flg
                , sakusei_user_id
                , koshin_user_id
                , sakusei_nichiji
                , koshin_nichiji
                , kako_shikaku_umu_kbn
            )
            VALUES (
                  :kaiin_no
                , :kyukaiin_no
                , :toroku_jokyo_kbn
                , :kaiin_jokyo_kbn
                , :kaiin_sbt_kbn
                , :beikoku_kaiin_no
                , :beikoku_kaiin_shikaku_kbn
                , :shimei_sei
                , :shimei_mei
                , :keisho_kbn
                , :furigana_sei
                , :furigana_mei
                , :kyusei
                , :seinengappi
                , :seibetsu_kbn
                , :yubin_no
                , :ken_no
                , :chiiki_id
                , :kemmei
                , :jusho_1
                , :jusho_2
                , :kana_jusho_1
                , :kana_jusho_2
                , :tel
                , :fax
                , :keitai_no
                , :keitai_denwa_shurui
                , :email_1
                , :email_2
                , :url_1
                , :url_2
                , :shokugyo_kbn_1
                , :shokugyo_kbn_2
                , :shokugyo_kbn_3
                , :kimmusakimei
                , :kimmusaki_bushomei
                , :kimmusaki_yubin_no
                , :kimmusaki_ken_no
                , :kimmusaki_kemmei
                , :kimmusaki_jusho_1
                , :kimmusaki_jusho_2
                , :kimmusaki_tel
                , :kimmusaki_fax
                , :first
                , :last
                , :honor_kbn
                , :address
                , :city
                , :prefecture
                , :country
                , :postal_code
                , :biko
                , :my_page_password
                , :gakuseisho_filemei
                , :gakuseisho_filemei_2
                , :web_nyukai_kbn
                , :torokukeiro
                , :nagareyama_shimin
                , :sotsugyo_shomeisho_kakunin_kbn
                , :sotsugyo_shomeisho_teishutsubi
                , :sotsugyo_shomeisho_kakunimbi
                , :gakureki_shosho_kakunimbi
                , :gakui_kbn
                , :sotsugyo_yoteibi
                , :shutoku_gakui_bunya_kbn
                , :shutoku_gakka
                , :cpraed_kakunin_kbn
                , :cpraed_kakunimbi
                , :cpraed_senseibi
                , :cpraed_hoji_kbn
                , :cpraed_ninteibi
                , :cpraed_yuko_kigembi
                , :jiko_shokai_keisai
                , :shashin_file_path
                , :jiko_shokai
                , :jiko_shokai_email
                , :jiko_shokai_tel
                , :jiko_shokai_sns1
                , :jiko_shokai_sns2
                , :sakujo_flg
                , :sakusei_user_id
                , :koshin_user_id
                , :sakusei_nichiji
                , :koshin_nichiji
                , :kako_shikaku_umu_kbn
            );

SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':kyukaiin_no'                      => $param['kyukaiin_no'],
                ':toroku_jokyo_kbn'                 => $param['toroku_jokyo_kbn'],
                ':kaiin_jokyo_kbn'                  => $param['kaiin_jokyo_kbn'],
                ':kaiin_sbt_kbn'                    => $param['kaiin_sbt_kbn'],
                ':beikoku_kaiin_no'                 => $param['beikoku_kaiin_no'],
                ':beikoku_kaiin_shikaku_kbn'        => $param['beikoku_kaiin_shikaku_kbn'],
                ':shimei_sei'                       => $param['shimei_sei'],
                ':shimei_mei'                       => $param['shimei_mei'],
                ':keisho_kbn'                       => $param['keisho_kbn'],
                ':furigana_sei'                     => $param['furigana_sei'],
                ':furigana_mei'                     => $param['furigana_mei'],
                ':kyusei'                           => $param['kyusei'],
                ':seinengappi'                      => $param['seinengappi'],
                ':seibetsu_kbn'                     => $param['seibetsu_kbn'],
                ':yubin_no'                         => $param['yubin_no'],
                ':ken_no'                           => $param['ken_no'],
                ':chiiki_id'                        => $param['chiiki_id'],
                ':kemmei'                           => $param['kemmei'],
                ':jusho_1'                          => $param['jusho_1'],
                ':jusho_2'                          => $param['jusho_2'],
                ':kana_jusho_1'                     => $param['kana_jusho_1'],
                ':kana_jusho_2'                     => $param['kana_jusho_2'],
                ':tel'                              => $param['tel'],
                ':fax'                              => $param['fax'],
                ':keitai_no'                        => $param['keitai_no'],
                ':keitai_denwa_shurui'              => $param['keitai_denwa_shurui'],
                ':email_1'                          => $param['email_1'],
                ':email_2'                          => $param['email_2'],
                ':url_1'                            => $param['url_1'],
                ':url_2'                            => $param['url_2'],
                ':shokugyo_kbn_1'                   => $param['shokugyo_kbn_1'],
                ':shokugyo_kbn_2'                   => $param['shokugyo_kbn_2'],
                ':shokugyo_kbn_3'                   => $param['shokugyo_kbn_3'],
                ':kimmusakimei'                     => $param['kimmusakimei'],
                ':kimmusaki_bushomei'               => $param['kimmusaki_bushomei'],
                ':kimmusaki_yubin_no'               => $param['kimmusaki_yubin_no'],
                ':kimmusaki_ken_no'                 => $param['kimmusaki_ken_no'],
                ':kimmusaki_kemmei'                 => $param['kimmusaki_kemmei'],
                ':kimmusaki_jusho_1'                => $param['kimmusaki_jusho_1'],
                ':kimmusaki_jusho_2'                => $param['kimmusaki_jusho_2'],
                ':kimmusaki_tel'                    => $param['kimmusaki_tel'],
                ':kimmusaki_fax'                    => $param['kimmusaki_fax'],
                ':first'                            => $param['first'],
                ':last'                             => $param['last'],
                ':honor_kbn'                        => $param['honor_kbn'],
                ':address'                          => $param['address'],
                ':city'                             => $param['city'],
                ':prefecture'                       => $param['prefecture'],
                ':country'                          => $param['country'],
                ':postal_code'                      => $param['postal_code'],
                ':biko'                             => $param['biko'],
                ':my_page_password'                 => $param['my_page_password'],
                ':gakuseisho_filemei'               => $param['gakuseisho_filemei'],
                ':gakuseisho_filemei_2'             => $param['gakuseisho_filemei_2'],
                ':web_nyukai_kbn'                   => $param['web_nyukai_kbn'],
                ':torokukeiro'                      => $param['torokukeiro'],
                ':nagareyama_shimin'                => $param['nagareyama_shimin'],
                ':sotsugyo_shomeisho_kakunin_kbn'   => $param['sotsugyo_shomeisho_kakunin_kbn'],
                ':sotsugyo_shomeisho_teishutsubi'   => $param['sotsugyo_shomeisho_teishutsubi'],
                ':sotsugyo_shomeisho_kakunimbi'     => $param['sotsugyo_shomeisho_kakunimbi'],
                ':gakureki_shosho_kakunimbi'        => $param['gakureki_shosho_kakunimbi'],
                ':gakui_kbn'                        => $param['gakui_kbn'],
                ':sotsugyo_yoteibi'                 => $param['sotsugyo_yoteibi'],
                ':shutoku_gakui_bunya_kbn'          => $param['shutoku_gakui_bunya_kbn'],
                ':shutoku_gakka'                    => $param['shutoku_gakka'],
                ':cpraed_kakunin_kbn'               => $param['cpraed_kakunin_kbn'],
                ':cpraed_kakunimbi'                 => $param['cpraed_kakunimbi'],
                ':cpraed_senseibi'                  => $param['cpraed_senseibi'],
                ':cpraed_hoji_kbn'                  => $param['cpraed_hoji_kbn'],
                ':cpraed_ninteibi'                  => $param['cpraed_ninteibi'],
                ':cpraed_yuko_kigembi'              => $param['cpraed_yuko_kigembi'],
                ':jiko_shokai_keisai'               => $param['jiko_shokai_keisai'],
                ':shashin_file_path'                => $param['shashin_file_path'],
                ':jiko_shokai'                      => $param['jiko_shokai'],
                ':jiko_shokai_email'                => $param['jiko_shokai_email'],
                ':jiko_shokai_tel'                  => $param['jiko_shokai_tel'],
                ':jiko_shokai_sns1'                 => $param['jiko_shokai_sns1'],
                ':jiko_shokai_sns2'                 => $param['jiko_shokai_sns2'],
                ':sakujo_flg'                       => $param['sakujo_flg'],
                ':sakusei_user_id'                  => $param['sakusei_user_id'],
                ':koshin_user_id'                   => $param['koshin_user_id'],
                ':sakusei_nichiji'                  => $param['sakusei_nichiji'],
                ':koshin_nichiji'                   => $param['koshin_nichiji'],
                ':kako_shikaku_umu_kbn'             => $param['kako_shikaku_umu_kbn'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    public function findBykaiinjoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM tb_kaiin_joho LEFT JOIN tb_kaiin_jotai ON tb_kaiin_joho.kaiin_no = tb_kaiin_jotai.kaiin_no
                                 AND tb_kaiin_jotai.sakujo_flg = 0 LEFT JOIN tb_kaiin_sonota ON tb_kaiin_joho.kaiin_no = tb_kaiin_sonota.kaiin_no
                                 AND tb_kaiin_sonota.sakujo_flg = 0 LEFT JOIN tb_kaiin_journal ON tb_kaiin_joho.kaiin_no = tb_kaiin_journal.kaiin_no
                                 AND tb_kaiin_journal.sakujo_flg = 0 WHERE tb_kaiin_joho.kaiin_no = :kaiin_no AND tb_kaiin_joho.sakujo_flg = 0");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }


    /*
    * 更新処理
    * @param array $param
    * @return boolean
    */
    public function updateMember($db, $param)
    {
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                	  kaiin_sbt_kbn         = :kaiin_sbt_kbn	
                    , shimei_sei            = :shimei_sei
                    , shimei_mei            = :shimei_mei
                    , furigana_sei          = :furigana_sei
                    , furigana_mei          = :furigana_mei
                    , gakuseisho_filemei    = :gakuseisho_filemei 
                    , gakuseisho_filemei_2  = :gakuseisho_filemei_2 
                    , furigana_mei          = :furigana_mei
                    , seinengappi           = :seinengappi
                    , seibetsu_kbn          = :seibetsu_kbn
                    , yubin_no              = :yubin_no
                    , ken_no                = :ken_no
                    , chiiki_id             = :chiiki_id
                    , kemmei                = :kemmei
                    , jusho_1               = :jusho_1
                    , jusho_2               = :jusho_2
                    , kana_jusho_1          = :kana_jusho_1
                    , kana_jusho_2          = :kana_jusho_2
                    , tel                   = :tel
                    , keitai_no             = :keitai_no
                    , fax                   = :fax
                    , url_1                 = :url_1
                    , shokugyo_kbn_1        = :shokugyo_kbn_1
                    , shokugyo_kbn_2        = :shokugyo_kbn_2
                    , shokugyo_kbn_3        = :shokugyo_kbn_3
                    , kimmusakimei          = :kimmusakimei
                    , kimmusaki_yubin_no    = :kimmusaki_yubin_no
                    , kimmusaki_ken_no      = :kimmusaki_ken_no
                    , kimmusaki_kemmei      = :kimmusaki_kemmei
                    , kimmusaki_jusho_1     = :kimmusaki_jusho_1
                    , kimmusaki_jusho_2     = :kimmusaki_jusho_2
                    , kimmusaki_tel         = :kimmusaki_tel
                    , kimmusaki_fax         = :kimmusaki_fax
                    , last                  = :last
                    , first                 = :first
                    , nagareyama_shimin     = :nagareyama_shimin
                    , koshin_user_id        = :koshin_user_id
                    , koshin_nichiji        = :koshin_nichiji
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':kaiin_sbt_kbn'                    => $param['kaiin_sbt_kbn'],
                ':shimei_sei'                       => $param['shimei_sei'],
                ':shimei_mei'                       => $param['shimei_mei'],
                ':furigana_sei'                     => $param['furigana_sei'],
                ':furigana_mei'                     => $param['furigana_mei'],
                ':gakuseisho_filemei'               => $param['gakuseisho_filemei'],
                ':gakuseisho_filemei_2'             => $param['gakuseisho_filemei_2'],
                ':seinengappi'                      => $param['seinengappi'],
                ':seibetsu_kbn'                     => $param['seibetsu_kbn'],
                ':yubin_no'                         => $param['yubin_no'],
                ':ken_no'                           => $param['ken_no'],
                ':chiiki_id'                        => $param['chiiki_id'],
                ':kemmei'                           => $param['kemmei'],
                ':jusho_1'                          => $param['jusho_1'],
                ':jusho_2'                          => $param['jusho_2'],
                ':kana_jusho_1'                     => $param['kana_jusho_1'],
                ':kana_jusho_2'                     => $param['kana_jusho_2'],
                ':tel'                              => $param['tel'],
                ':fax'                              => $param['fax'],
                ':keitai_no'                        => $param['keitai_no'],
                ':url_1'                            => $param['url_1'],
                ':shokugyo_kbn_1'                   => $param['shokugyo_kbn_1'],
                ':shokugyo_kbn_2'                   => $param['shokugyo_kbn_2'],
                ':shokugyo_kbn_3'                   => $param['shokugyo_kbn_3'],
                ':kimmusakimei'                     => $param['kimmusakimei'],
                ':kimmusaki_yubin_no'               => $param['kimmusaki_yubin_no'],
                ':kimmusaki_ken_no'                 => $param['kimmusaki_ken_no'],
                ':kimmusaki_kemmei'                 => $param['kimmusaki_kemmei'],
                ':kimmusaki_jusho_1'                => $param['kimmusaki_jusho_1'],
                ':kimmusaki_jusho_2'                => $param['kimmusaki_jusho_2'],
                ':kimmusaki_tel'                    => $param['kimmusaki_tel'],
                ':kimmusaki_fax'                    => $param['kimmusaki_fax'],
                ':first'                            => $param['first'],
                ':last'                             => $param['last'],
                ':nagareyama_shimin'                => $param['nagareyama_shimin'],
                ':koshin_user_id'                   => $param['koshin_user_id'],
                ':koshin_nichiji'                   => $param['koshin_nichiji'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

	public function findBykaiinjoho2($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM tb_kaiin_joho LEFT JOIN tb_kaiin_sonota ON tb_kaiin_joho.kaiin_no = tb_kaiin_sonota.kaiin_no
                                 WHERE tb_kaiin_joho.kaiin_no = :kaiin_no AND tb_kaiin_joho.sakujo_flg = 0");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }

    /**
     * パスワード更新処理
     * @param array $param
     * @return boolean
     */
    public function updatePassword($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                      my_page_password      = :my_page_password
                    , koshin_user_id        = 'ResetPassword'
                    , koshin_nichiji        = now()
                WHERE
                      kaiin_no = :kaiin_no
                  AND toroku_jokyo_kbn = 1
                  AND sakujo_flg = 0;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                       => $param['kaiin_no'],
                ':my_page_password'               => $param['my_page_password'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 会員番号から有効な会員情報を取得する
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT joho.kaiin_no
 	, CONCAT(shimei_sei ,'　', shimei_mei) as kaiin_name
	, kaiin_sbt_kbn
	, meisho_kaiin_sbt.meisho as kaiin_sbt
	, DATE_FORMAT(yuko_hizuke,'%Y/%m/%d') as yuko_hizuke
	, eibun_option_kbn
	, meisho_eibun.meisho as eibun_option
	, taikai_shorui_juribi
	, hasso_teishibi
	, kaihi_kessai_error_code
	, eibun_option_kikan_to
FROM tb_kaiin_joho joho
	
LEFT JOIN tb_kaiin_jotai jotai
	ON  joho.kaiin_no = jotai.kaiin_no
LEFT JOIN tb_kaiin_journal journal 
	ON  joho.kaiin_no = journal.kaiin_no

-- 名称取得（会員種別）
LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho 
		WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
	    AND meisho_kbn = 10)  meisho_kaiin_sbt
	ON meisho_kaiin_sbt.meisho_cd = kaiin_sbt_kbn
-- 名称取得（英文オプション）
LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho 
		WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
	    AND meisho_kbn = 12)  meisho_eibun
	ON meisho_eibun.meisho_cd = journal.eibun_option_kbn

WHERE joho.kaiin_no = :kaiin_no
    AND toroku_jokyo_kbn = 1
    AND joho.sakujo_flg = 0
;

            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinJoho  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinJoho = [];
        }
        return $kaiinJoho;
    }
    //登録済みのメールアドレス1かどうかチェック
    public function searchAddress1($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT count(*) FROM tb_kaiin_joho WHERE email_1 = :mail OR email_2 = :mail");
            $sth->execute([':mail' => $param['mail']]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }

    //登録済みのメールアドレス2かどうかチェック
    public function searchAddress2($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT count(*) FROM tb_kaiin_joho WHERE email_1 = :mail OR email_2 = :mail");
            $sth->execute([':mail' => $param['mail']]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }

    //会員種別を取得する
    public function findBykaiinSbt($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT kaiin_sbt_kbn FROM tb_kaiin_joho WHERE kaiin_no = :kaiin_no");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }

    /*
    * 更新（接続及びトランザクションは外側実施）
    * @param object $db
    * @param array $param1
    * @return boolean
    */
    public function torokuJohoKbn($db, $param2)
    {
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                      toroku_jokyo_kbn              = :toroku_jokyo_kbn
                    , koshin_user_id                = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':toroku_jokyo_kbn'         => $param2['toroku_jokyo_kbn'],
                ':koshin_user_id'           => $param2['koshin_user_id'],
                ':kaiin_no'                 => $param2['kaiin_no'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /**
    * 更新処理
    * @param array $param
    * @return boolean
    */
    public function reissueMailAddress1($param)
    {
         $db = Db::getInstance();
         $db->beginTransaction();
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                    email_1               = :email_1
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':email_1'                 => $param['mail'],
                    ':kaiin_no'                => $param['kaiin_no'],
                ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /**
    * 更新処理
    * @param array $param
    * @return boolean
    */
    public function reissueMailAddress2($param)
    {
         $db = Db::getInstance();
         $db->beginTransaction();
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                    email_2               = :email_2
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':email_2'                 => $param['mail'],
                    ':kaiin_no'                => $param['kaiin_no'],
                ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

        /*
     * 登録（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateRiyo($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                      shimei_sei            = :shimei_sei
                    , shimei_mei            = :shimei_mei
                    , furigana_sei          = :furigana_sei
                    , furigana_mei          = :furigana_mei
                    , seinengappi           = :seinengappi
                    , seibetsu_kbn          = :seibetsu_kbn
                    , yubin_no              = :yubin_no
                    , ken_no                = :ken_no
                    , chiiki_id             = :chiiki_id
                    , kemmei                = :kemmei
                    , jusho_1               = :jusho_1
                    , jusho_2               = :jusho_2
                    , kana_jusho_1          = :kana_jusho_1
                    , kana_jusho_2          = :kana_jusho_2
                    , tel                   = :tel
                    , keitai_no             = :keitai_no
                    , nagareyama_shimin     = :nagareyama_shimin
                    , koshin_user_id        = :koshin_user_id
                    , koshin_nichiji        = :koshin_nichiji
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':shimei_sei'              => $param['shimei_sei'],
                    ':shimei_mei'              => $param['shimei_mei'],
                    ':furigana_sei'            => $param['furigana_sei'],
                    ':furigana_mei'            => $param['furigana_mei'],
                    ':seinengappi'             => $param['seinengappi'],
                    ':seibetsu_kbn'            => $param['seibetsu_kbn'],
                    ':yubin_no'                => $param['yubin_no'],
                    ':ken_no'                  => $param['ken_no'],
                    ':chiiki_id'               => $param['chiiki_id'],
                    ':kemmei'                  => $param['kemmei'],
                    ':jusho_1'                 => $param['jusho_1'],
                    ':jusho_2'                 => $param['jusho_2'],
                    ':kana_jusho_1'            => $param['kana_jusho_1'],
                    ':kana_jusho_2'            => $param['kana_jusho_2'],
                    ':tel'                     => $param['tel'],
                    ':keitai_no'               => $param['keitai_no'],
                    ':nagareyama_shimin'       => $param['nagareyama_shimin'],
                    ':koshin_user_id'          => $param['koshin_user_id'],
                    ':koshin_nichiji'          => $param['koshin_nichiji'],
                    ':kaiin_no'               => $param['kaiin_no'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }





















}

