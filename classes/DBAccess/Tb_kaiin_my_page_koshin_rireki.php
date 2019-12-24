<?php
namespace Was;

class Tb_kaiin_my_page_koshin_rireki
{
    public function __construct()
    {
    }

   /* 該当日の会員番号の最大値を取得する
    * @param varchar $koshin_rireki_id
    * @return array|mixed
    */
   public function findMemberNo($koshin_rireki_id)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT RIGHT(MAX(koshin_rireki_id), 2) AS max_no FROM Tb_kaiin_my_page_koshin_rireki WHERE koshin_rireki_id LIKE :koshin_rireki_id;");
            $sth->execute([':koshin_rireki_id' => $koshin_rireki_id,]);
            $mstProduct = $sth->fetch();
        } catch (\PDOException $e) {
            $mstProduct = [];
        }
        return $mstProduct;
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
            INTO tb_kaiin_my_page_koshin_rireki (
                  koshin_rireki_id
                , henkobi
                , shinkyu_kbn
                , kojin_no
                , kaiin_no
                , shimei
                , furigana
                , first
                , last
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
                , keitai_denwa
                , keitai_denwa_shurui
                , email
                , keitai_email
                , url
                , shokugyo_kbn_1
                , shokugyo_kbn_2
                , shokugyo_kbn_3
                , kimmusakimei
                , kimmusaki_yubin_no
                , kimmusaki_ken_no
                , kimmusaki_kemmei
                , kimmusaki_jusho_1
                , kimmusaki_jusho_2
                , kimmusaki_tel
                , kimmusaki_fax
                , gakuseisho_filemei
                , gakuseisho_filemei_2
                , yoyaku_kaiin_sbt
                , merumaga_haishin_pc_email
                , merumaga_haishin_keitai_email
                , merumaga_hashin_smartphone
                , renraku_hoho_yuso
                , renraku_hoho_denshi_email
                , yubin_haitatsusaki_kbn
                , website_keisai_kbn
                , daisansha_questionnaire_kbn
                , sonota_shikaku
                , sonota_shikaku_kijutsu
                , kyominoaru_bunya
                , kyominoaru_bunya_kijutsu
                , kyominoaru_chiiki
                , sakusei_user_id
                , koshin_user_id
                , sakusei_nichiji
                , koshin_nichiji
            )
            VALUES (
                  :koshin_rireki_id
                , :henkobi
                , :shinkyu_kbn
                , :kojin_no
                , :kaiin_no
                , :shimei
                , :furigana
                , :first
                , :last
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
                , :keitai_denwa
                , :keitai_denwa_shurui
                , :email
                , :keitai_email
                , :url
                , :shokugyo_kbn_1
                , :shokugyo_kbn_2
                , :shokugyo_kbn_3
                , :kimmusakimei
                , :kimmusaki_yubin_no
                , :kimmusaki_ken_no
                , :kimmusaki_kemmei
                , :kimmusaki_jusho_1
                , :kimmusaki_jusho_2
                , :kimmusaki_tel
                , :kimmusaki_fax
                , :gakuseisho_filemei
                , :gakuseisho_filemei_2
                , :yoyaku_kaiin_sbt
                , :merumaga_haishin_pc_email
                , :merumaga_haishin_keitai_email
                , :merumaga_hashin_smartphone
                , :renraku_hoho_yuso
                , :renraku_hoho_denshi_email
                , :yubin_haitatsusaki_kbn
                , :website_keisai_kbn
                , :daisansha_questionnaire_kbn
                , :sonota_shikaku
                , :sonota_shikaku_kijutsu
                , :kyominoaru_bunya
                , :kyominoaru_bunya_kijutsu
                , :kyominoaru_chiiki
                , :sakusei_user_id
                , :koshin_user_id
                , :sakusei_nichiji
                , :koshin_nichiji
            );
           
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':koshin_rireki_id'                          => $param['koshin_rireki_id'],
                ':henkobi'                                   => $param['henkobi'],
                ':shinkyu_kbn'                               => $param['shinkyu_kbn'],
                ':kojin_no'                                  => $param['kojin_no'],
                ':kaiin_no'                                  => $param['kaiin_no'],
                ':shimei'                                    => $param['shimei'],
                ':furigana'                                  => $param['furigana'],
                ':first'                                     => $param['first'],
                ':last'                                      => $param['last'],
                ':seinengappi'                               => $param['seinengappi'],
                ':seibetsu_kbn'                              => $param['seibetsu_kbn'],
                ':yubin_no'                                  => $param['yubin_no'],
                ':ken_no'                                    => $param['ken_no'],
                ':chiiki_id'                                 => $param['chiiki_id'],
                ':kemmei'                                    => $param['kemmei'],
                ':jusho_1'                                   => $param['jusho_1'],
                ':jusho_2'                                   => $param['jusho_2'],
                ':kana_jusho_1'                              => $param['kana_jusho_1'],
                ':kana_jusho_2'                              => $param['kana_jusho_2'],
                ':tel'                                       => $param['tel'],
                ':fax'                                       => $param['fax'],
                ':keitai_denwa'                              => $param['keitai_denwa'],
                ':keitai_denwa_shurui'                       => $param['keitai_denwa_shurui'],
                ':email'                                     => $param['email'],
                ':keitai_email'                              => $param['keitai_email'],
                ':url'                                       => $param['url'],
                ':shokugyo_kbn_1'                            => $param['shokugyo_kbn_1'],
                ':shokugyo_kbn_2'                            => $param['shokugyo_kbn_2'],
                ':shokugyo_kbn_3'                            => $param['shokugyo_kbn_3'],
                ':kimmusakimei'                              => $param['kimmusakimei'],
                ':kimmusaki_yubin_no'                        => $param['kimmusaki_yubin_no'],
                ':kimmusaki_ken_no'                          => $param['kimmusaki_ken_no'],
                ':kimmusaki_kemmei'                          => $param['kimmusaki_kemmei'],
                ':kimmusaki_jusho_1'                         => $param['kimmusaki_jusho_1'],
                ':kimmusaki_jusho_2'                         => $param['kimmusaki_jusho_2'],
                ':kimmusaki_tel'                             => $param['kimmusaki_tel'],
                ':kimmusaki_fax'                             => $param['kimmusaki_fax'],
                ':gakuseisho_filemei'                        => $param['gakuseisho_filemei'],
                ':gakuseisho_filemei_2'                      => $param['gakuseisho_filemei_2'],
                ':yoyaku_kaiin_sbt'                          => $param['yoyaku_kaiin_sbt'],
                ':merumaga_haishin_pc_email'                 => $param['merumaga_haishin_pc_email'],
                ':merumaga_haishin_keitai_email'             => $param['merumaga_haishin_keitai_email'],
                ':merumaga_hashin_smartphone'                => $param['merumaga_hashin_smartphone'],
                ':renraku_hoho_yuso'                         => $param['renraku_hoho_yuso'],
                ':renraku_hoho_denshi_email'                 => $param['renraku_hoho_denshi_email'],
                ':yubin_haitatsusaki_kbn'                    => $param['yubin_haitatsusaki_kbn'],
                ':website_keisai_kbn'                        => $param['website_keisai_kbn'],
                ':daisansha_questionnaire_kbn'               => $param['daisansha_questionnaire_kbn'],
                ':sonota_shikaku'                            => $param['sonota_shikaku'],
                ':sonota_shikaku_kijutsu'                    => $param['sonota_shikaku_kijutsu'],
                ':kyominoaru_bunya'                          => $param['kyominoaru_bunya'],
                ':kyominoaru_bunya_kijutsu'                  => $param['kyominoaru_bunya_kijutsu'],
                ':kyominoaru_chiiki'                         => $param['kyominoaru_chiiki'],
                ':sakusei_user_id'                           => $param['sakusei_user_id'],
                ':koshin_user_id'                            => $param['koshin_user_id'],
                ':sakusei_nichiji'                           => $param['sakusei_nichiji'],
                ':koshin_nichiji'                            => $param['koshin_nichiji'],
            ]);
            $db->commit();
        } catch (\Throwable $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
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
