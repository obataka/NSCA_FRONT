<?php
namespace Was;

class Tb_kaiin_joho
{
    public function __construct()
    {
    }

    /**
     * ログイン判定
     * @param varchar $loginId
     * @param varchar $loginPswd
     * @return array|mixed
     */
    public function findByEmailAndPassword($loginId, $loginPswd)
    {
        try {
            $db = Db::getInstance();
            $sql = <<<SQL
                    SELECT *
                      FROM tb_kaiin_joho
                     WHERE (email_1 = :email_1 OR email_2 = :email_1 OR kaiin_no = :email_1)
                       AND my_page_password = :my_page_password;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([':email_1' => $loginId, ':my_page_password' => $loginPswd,]);
            $mstProduct = $sth->fetch();
        } catch (\PDOException $e) {
            $mstProduct = [];
        }

        return $mstProduct;
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
    

    /**
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
                       AND (email_1 = :mailAddress OR email_2 = :mailAddress);
            ");
            $sth->execute([':mailAddress' => $mailAddress, ':kaiin_no' => $kaiinNo]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            return 9;
        }
        return $row["resultCount"];
    }
    /**
     * 登録
     * @param array $param
     * @return boolean
     */
    public function insertRec ($param)
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
        } catch (\Throwable $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function findBykaiinjoho()
    {
        $wk_kaiin_no = "";
        // if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
        // }
        //$wk_kaiin_no = 10251033;
        $wk_kaiin_no = 819121118;
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM tb_kaiin_joho LEFT JOIN tb_kaiin_jotai ON tb_kaiin_joho.kaiin_no = tb_kaiin_jotai.kaiin_no
                                 AND tb_kaiin_jotai.sakujo_flg = 0 LEFT JOIN tb_kaiin_sonota ON tb_kaiin_joho.kaiin_no = tb_kaiin_sonota.kaiin_no
                                 AND tb_kaiin_sonota.sakujo_flg = 0 LEFT JOIN tb_kaiin_journal ON tb_kaiin_joho.kaiin_no = tb_kaiin_journal.kaiin_no
                                 AND tb_kaiin_journal.sakujo_flg = 0 WHERE tb_kaiin_joho.kaiin_no = :kaiin_no AND tb_kaiin_joho.sakujo_flg = 0");
            $sth->execute([':kaiin_no' => $wk_kaiin_no,]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }


    /**
    * 更新処理
    * @param array $param
    * @return boolean
    */
    public function updateMember($param)
    {
         // if (isset($_SESSION['kaiin_no'])) {
         //         $wk_kaiin_no = $_SESSION['kaiin_no'];
         // }
         //$wk_kaiin_no = 819121118;
         $db = Db::getInstance();
         $db->beginTransaction();
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
                    , fax                   = :fax
                    , email_1               = :email_1
                    , email_2               = :email_2
                    , url                   = :url
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
                      kaiin_no = 819121118;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                ':shimei_sei'                       => $param['shimei_sei'],
                ':shimei_mei'                       => $param['shimei_mei'],
                ':furigana_sei'                     => $param['furigana_sei'],
                ':furigana_mei'                     => $param['furigana_mei'],
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
                ':email_1'                          => $param['email_1'],
                ':email_2'                          => $param['email_2'],
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
            $db->commit();
        } catch (\Throwable $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function findBykaiinjoho2()
    {
        $wk_kaiin_no = "";
        // if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
        // }
        //$wk_kaiin_no = 10251033;
        $wk_kaiin_no = 819121118;
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM tb_kaiin_joho LEFT JOIN tb_kaiin_sonota ON tb_kaiin_joho.kaiin_no = tb_kaiin_sonota.kaiin_no
                                 WHERE tb_kaiin_joho.kaiin_no = :kaiin_no AND tb_kaiin_joho.sakujo_flg = 0");
            $sth->execute([':kaiin_no' => $wk_kaiin_no,]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_joho = [];
        }
        return $Tb_kaiin_joho;
    }

           
//     /**
//      * @param varchar $kaiin_no
//      * @return array|mixed
//      */
//     public function findByEmailAndPassword($kaiin_no)
//     {
//         try {
//             $db = Db::getInstance();
//             $sql = <<<SQL
//                     SELECT RIGHT(MAX(kaiin_no), 2)
//                     FROM tb_kaiin_joho
//                     WHERE kaiin_no LIKE $wk_kaiin_no'%';
// SQL;
//             $sth = $db->prepare($sql);
//             $sth->execute([':kaiin_no' => $kaiin_no,]);
//             $mstProduct = $sth->fetch();
//         } catch (\PDOException $e) {
//             error_log(print_r($e, true). PHP_EOL, '3', 'tanihara_log.txt');
//             $mstProduct = [];
//         }

//         return $mstProduct;
//     }

//
//    /**
//     * エリア日付検索
//     * @param integer $area
//     * @param integer $ymd
//     * @return array|mixed
//     */
//    public function findByAreaAndYmd($area, $ymd)
//    {
//        try {
//            $db = Db::getInstance();
//            $sth = $db->prepare("SELECT * FROM T_REMAIN_MNG_BY_DATE WHERE AREA_ID = :AREA_ID AND RESERVE_YMD = :RESERVE_YMD;");
//            $sth->execute([':AREA_ID' => $area,':RESERVE_YMD' => $ymd,]);
//            $mstProduct = $sth->fetch();
//        } catch (\PDOException $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $mstProduct = [];
//        }
//
//        return $mstProduct;
//    }
//
//    /**
//     * 日付期間検索
//     * @param integer $fromYmd
//     * @param integer $toYmd
//     * @return array|mixed
//     */
//    public function findBetweenYmd($fromYmd, $toYmd, $selArea)
//    {
//        try {
//            $db = Db::getInstance();
//            $sth = $db->prepare("SELECT * FROM T_REMAIN_MNG_BY_DATE WHERE RESERVE_YMD BETWEEN :FROM_RESERVE_YMD AND :TO_RESERVE_YMD AND AREA_ID = :AREA_ID ORDER BY RESERVE_YMD;");
//            $sth->execute([':FROM_RESERVE_YMD' => $fromYmd, ':TO_RESERVE_YMD' => $toYmd, ':AREA_ID' => $selArea,]);
//            $mstProduct = $sth->fetchAll();
//        } catch (\PDOException $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $mstProduct = [];
//        }
//
//        return $mstProduct;
//    }
//
//    /**
//     * 全件取得
//     * @return array
//     */
//    public function findAll()
//    {
//        try {
//            $db = Db::getInstance();
//            $sth = $db->prepare("SELECT * FROM T_REMAIN_MNG_BY_DATE ORDER BY RESERVE_YMD;");
//            $sth->execute();
//            $mstProduct = $sth->fetchAll();
//        } catch (\PDOException $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $mstProduct = [];
//        }
//
//        return $mstProduct;
//    }
//
//    /**
//     * 最大日付取得　※カスタマイズ済み
//     * @return array|mixed
//     */
//    public function getMaxYmd($argument)
//    {
//        try {
//            $db = Db::getInstance();
//            $sth = $db->prepare("SELECT MAX(RESERVE_YMD) AS MAX_YMD FROM T_REMAIN_MNG_BY_DATE WHERE AREA_ID = :AREA_ID;");
//            $sth->execute([':AREA_ID' => $argument,]);
//            $maxYmd = $sth->fetch();
//        } catch (\PDOException $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $maxYmd = '';
//        }
//
//        return $maxYmd;
//    }
//
//    /**
//     * 日次バッチ用削除処理
//     * @param integer $ymd
//     * @return boolean
//     */
//    public function deleteDailyBatch($ymd)
//    {
//        $db = Db::getInstance();
//        $db->beginTransaction();
//        try {
//            $sql = <<<SQL
//            DELETE
//            FROM
//                T_REMAIN_MNG_BY_DATE
//            WHERE
//                RESERVE_YMD <= :RESERVE_YMD
//                ;
//
//SQL;
//            $sth = $db->prepare($sql);
//            $sth->execute([':RESERVE_YMD' => $ymd,]);
//
//            $db->commit();
//        } catch (\Throwable $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $db->rollBack();
//            return FALSE;
//        }
//        return TRUE;
//    }
//
//    /**
//     * 日次バッチ用更新処理
//     * @param array $ymd
//     * @return boolean
//     */
//    public function updateDailyBatch($ymd)
//    {
//        $db = Db::getInstance();
//        $db->beginTransaction();
//        try {
//            $sql = <<<SQL
//            UPDATE T_REMAIN_MNG_BY_DATE
//            SET
//                  RESERVE_PROP  = 0
//                , UPD_ADMIN_DTS = now()
//                , UPD_ADMIN_USR = 'DailyBatchUpd'
//                , UPD_USER_DTS  = now()
//                , UPD_USER_USR  = 'DailyBatchUpd'
//            WHERE
//                  RESERVE_YMD   = :RESERVE_YMD
//            ;
//
//SQL;
//            $sth = $db->prepare($sql);
//            $sth->execute([':RESERVE_YMD' => $ymd,]);
//
//            $db->commit();
//        } catch (\Throwable $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $db->rollBack();
//            return false;
//        }
//        return true;
//    }
//
//    /**
//     * 管理用更新処理
//     * @param array $argument
//     * @return boolean
//     */
//    public function updateAdmin($argument)
//    {
//        $db = Db::getInstance();
//        $db->beginTransaction();
//        try {

//            // 予約不可の場合
//            if ($argument['RESERVE_PROP'] == Config::RESERVE_PROP_NO) {

//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_PROP    = :RESERVE_PROP
//                    , UPD_ADMIN_DTS   = now()
//                    , UPD_ADMIN_USR   = :UPD_ADMIN_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;

// SQL;
//            // 予約可の場合
//            } else {

//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_PROP          = :RESERVE_PROP
//                    , RESERVE_TIME_FROM_1   = :RESERVE_TIME_FROM_1
//                    , RESERVE_TIME_FROM_2   = :RESERVE_TIME_FROM_2
//                    , RESERVE_TIME_FROM_3   = :RESERVE_TIME_FROM_3
//                    , RESERVE_TIME_FROM_4   = :RESERVE_TIME_FROM_4
//                    , RESERVE_TIME_FROM_5   = :RESERVE_TIME_FROM_5
//                    , RESERVE_TIME_TO_1     = :RESERVE_TIME_TO_1
//                    , RESERVE_TIME_TO_2     = :RESERVE_TIME_TO_2
//                    , RESERVE_TIME_TO_3     = :RESERVE_TIME_TO_3
//                    , RESERVE_TIME_TO_4     = :RESERVE_TIME_TO_4
//                    , RESERVE_TIME_TO_5     = :RESERVE_TIME_TO_5
//                    , RESERVE_LIMIT_1       = :RESERVE_LIMIT_1
//                    , RESERVE_LIMIT_2       = :RESERVE_LIMIT_2
//                    , RESERVE_LIMIT_3       = :RESERVE_LIMIT_3
//                    , RESERVE_LIMIT_4       = :RESERVE_LIMIT_4
//                    , RESERVE_LIMIT_5       = :RESERVE_LIMIT_5
//                    , RESERVE_CNT_1         = :RESERVE_CNT_1
//                    , RESERVE_CNT_2         = :RESERVE_CNT_2
//                    , RESERVE_CNT_3         = :RESERVE_CNT_3
//                    , RESERVE_CNT_4         = :RESERVE_CNT_4
//                    , RESERVE_CNT_5         = :RESERVE_CNT_5
//                    , UPD_ADMIN_DTS         = now()
//                    , UPD_ADMIN_USR         = :UPD_ADMIN_USR
//                WHERE
//                      AREA_ID     = :AREA_ID
//                AND   RESERVE_YMD = :RESERVE_YMD
//                ;

// SQL;
//            }
           
//            $sth = $db->prepare($sql);

//            // 予約不可の場合
//            if ($argument['RESERVE_PROP'] == Config::RESERVE_PROP_NO) {
//                $sth->execute([
//                    ':AREA_ID'          => $argument['AREA_ID'],
//                    ':RESERVE_YMD'      => $argument['RESERVE_YMD'],
//                    ':RESERVE_PROP'     => $argument['RESERVE_PROP'],
//                    ':UPD_ADMIN_USR'    => $argument['UPD_ADMIN_USR'],
//                ]);

//            // 予約可の場合
//            } else {
//                $sth->execute([
//                    ':AREA_ID'              => $argument['AREA_ID'],
//                    ':RESERVE_YMD'          => $argument['RESERVE_YMD'],
//                    ':RESERVE_PROP'         => $argument['RESERVE_PROP'],
//                    ':RESERVE_TIME_FROM_1'  => $argument['RESERVE_TIME_FROM_1'],
//                    ':RESERVE_TIME_FROM_2'  => $argument['RESERVE_TIME_FROM_2'],
//                    ':RESERVE_TIME_FROM_3'  => $argument['RESERVE_TIME_FROM_3'],
//                    ':RESERVE_TIME_FROM_4'  => $argument['RESERVE_TIME_FROM_4'],
//                    ':RESERVE_TIME_FROM_5'  => $argument['RESERVE_TIME_FROM_5'],
//                    ':RESERVE_TIME_TO_1'    => $argument['RESERVE_TIME_TO_1'],
//                    ':RESERVE_TIME_TO_2'    => $argument['RESERVE_TIME_TO_2'],
//                    ':RESERVE_TIME_TO_3'    => $argument['RESERVE_TIME_TO_3'],
//                    ':RESERVE_TIME_TO_4'    => $argument['RESERVE_TIME_TO_4'],
//                    ':RESERVE_TIME_TO_5'    => $argument['RESERVE_TIME_TO_5'],
//                    ':RESERVE_LIMIT_1'      => $argument['RESERVE_LIMIT_1'],
//                    ':RESERVE_LIMIT_2'      => $argument['RESERVE_LIMIT_2'],
//                    ':RESERVE_LIMIT_3'      => $argument['RESERVE_LIMIT_3'],
//                    ':RESERVE_LIMIT_4'      => $argument['RESERVE_LIMIT_4'],
//                    ':RESERVE_LIMIT_5'      => $argument['RESERVE_LIMIT_5'],
//                    ':RESERVE_CNT_1'        => $argument['RESERVE_CNT_1'],
//                    ':RESERVE_CNT_2'        => $argument['RESERVE_CNT_2'],
//                    ':RESERVE_CNT_3'        => $argument['RESERVE_CNT_3'],
//                    ':RESERVE_CNT_4'        => $argument['RESERVE_CNT_4'],
//                    ':RESERVE_CNT_5'        => $argument['RESERVE_CNT_5'],
//                    ':UPD_ADMIN_USR'        => $argument['UPD_ADMIN_USR'],
//                ]);
//            }

//            $db->commit();
//        } catch (\Throwable $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $db->rollBack();
//            return false;
//        }
//        return true;
//    }

//    /**
//     * ユーザー用更新処理
//     * @param array $argument
//     * @return boolean
//     */
//    public function updateUser($argument)
//    {
//        $db = Db::getInstance();
//        $db->beginTransaction();
//        try {
//
//            // 枠１の場合
//            if ($argument['WAKU'] == 1) {
//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_CNT_1 = :RESERVE_CNT
//                    , UPD_USER_DTS  = now()
//                    , UPD_USER_USR  = :UPD_USER_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;
//
//SQL;
//            // 枠２の場合
//            } elseif ($argument['WAKU'] == 2) {
//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_CNT_2 = :RESERVE_CNT
//                    , UPD_USER_DTS  = now()
//                    , UPD_USER_USR  = :UPD_USER_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;
//
//SQL;
//            // 枠３の場合
//            } elseif ($argument['WAKU'] == 3) {
//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_CNT_3 = :RESERVE_CNT
//                    , UPD_USER_DTS  = now()
//                    , UPD_USER_USR  = :UPD_USER_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;
//
//SQL;
//            // 枠４の場合
//            } elseif ($argument['WAKU'] == 4) {
//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_CNT_4 = :RESERVE_CNT
//                    , UPD_USER_DTS  = now()
//                    , UPD_USER_USR  = :UPD_USER_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;
//
//SQL;
//            // 枠５の場合
//            } else {
//                $sql = <<<SQL
//                UPDATE T_REMAIN_MNG_BY_DATE
//                SET
//                      RESERVE_CNT_5 = :RESERVE_CNT
//                    , UPD_USER_DTS  = now()
//                    , UPD_USER_USR  = :UPD_USER_USR
//                WHERE
//                      AREA_ID       = :AREA_ID
//                AND   RESERVE_YMD   = :RESERVE_YMD
//                ;
//
//SQL;
//            }
//            
//            $sth = $db->prepare($sql);
//            $sth->execute([
//                ':AREA_ID'      => $argument['AREA_ID'],
//                ':RESERVE_YMD'  => $argument['RESERVE_YMD'],
//                ':RESERVE_CNT'  => $argument['RESERVE_CNT'],
//                ':UPD_USER_USR' => $argument['UPD_USER_USR'],
//            ]);
//
//            $db->commit();
//        } catch (\Throwable $e) {
//            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
//            $db->rollBack();
//            return false;
//        }
//        return true;
//    }
}
