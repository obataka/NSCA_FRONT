<?php
namespace Was;

class Tb_kaiin_sonota2
{
    public function __construct()
    {
    }
    /**
     * 登録
     * @param array $param
     * @return boolean
     */
    public function insertRec ($param1)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kaiin_sonota(
                  kaiin_no
                , renraku_hoho_yuso
                , renraku_hoho_denshi_email
                , email_1_merumaga_haishin
                , email_2_merumaga_haishin
                , marumaga_haishin_smartphone
                , yubin_haitatsusaki_kbn
                , daisansha_questionnaire_kbn
                , taikaigono_oshirase_kbn
                , website_keisai_kbn
                , card_toroku
                , email_1_oshirase_uketori
                , email_1_login
                , email_2_oshirase_uketori
                , email_2_login
                , sakujo_flg
                , sakusei_user_id
                , koshin_user_id
                , sakusei_nichiji
                , koshin_nichiji
            )
            VALUES (
                  :kaiin_no
                , :renraku_hoho_yuso
                , :renraku_hoho_denshi_email
                , :email_1_merumaga_haishin
                , :email_2_merumaga_haishin
                , :marumaga_haishin_smartphone
                , :yubin_haitatsusaki_kbn
                , :daisansha_questionnaire_kbn
                , :taikaigono_oshirase_kbn
                , :website_keisai_kbn
                , :card_toroku
                , :email_1_oshirase_uketori
                , :email_1_login
                , :email_2_oshirase_uketori
                , :email_2_login
                , :sakujo_flg
                , :sakusei_user_id
                , :koshin_user_id
                , :sakusei_nichiji
                , :koshin_nichiji
            );
           
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param1['kaiin_no'],
                ':renraku_hoho_yuso'                => $param1['renraku_hoho_yuso'],
                ':renraku_hoho_denshi_email'        => $param1['renraku_hoho_denshi_email'],
                ':email_1_merumaga_haishin'         => $param1['email_1_merumaga_haishin'],
                ':email_2_merumaga_haishin'         => $param1['email_2_merumaga_haishin'],
                ':marumaga_haishin_smartphone'      => $param1['marumaga_haishin_smartphone'],
                ':yubin_haitatsusaki_kbn'           => $param1['yubin_haitatsusaki_kbn'],
                ':daisansha_questionnaire_kbn'      => $param1['daisansha_questionnaire_kbn'],
                ':taikaigono_oshirase_kbn'          => $param1['taikaigono_oshirase_kbn'],
                ':website_keisai_kbn'               => $param1['website_keisai_kbn'],
                ':card_toroku'                      => $param1['card_toroku'],
                ':email_1_oshirase_uketori'         => $param1['email_1_oshirase_uketori'],
                ':email_1_login'                    => $param1['email_1_login'],
                ':email_2_oshirase_uketori'         => $param1['email_2_oshirase_uketori'],
                ':email_2_login'                    => $param1['email_2_login'],
                ':sakujo_flg'                       => $param1['sakujo_flg'],
                ':sakusei_user_id'                  => $param1['sakusei_user_id'],
                ':koshin_user_id'                   => $param1['koshin_user_id'],
                ':sakusei_nichiji'                  => $param1['sakusei_nichiji'],
                ':koshin_nichiji'                   => $param1['koshin_nichiji'],
            ]);
            $db->commit();

        } catch (\Throwable $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

/**
    * 更新処理
    * @param array $param1
    * @return boolean
    */
    public function updateRiyoSonota($param1)
    {
         // if (isset($_SESSION['kaiin_no'])) {
         //         $wk_kaiin_no = $_SESSION['kaiin_no'];
         // }
         //$wk_kaiin_no = 819121118;
         $db = Db::getInstance();
         $db->beginTransaction();
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_sonota
                SET
                      renraku_hoho_yuso             = :renraku_hoho_yuso
                    , renraku_hoho_denshi_email     = :renraku_hoho_denshi_email
                    , email_1_merumaga_haishin      = :email_1_merumaga_haishin
                    , email_2_merumaga_haishin      = :email_2_merumaga_haishin
                    , email_1_oshirase_uketori      = :email_1_oshirase_uketori
                    , email_2_oshirase_uketori      = :email_2_oshirase_uketori
                    , koshin_user_id                = :koshin_user_id
                    , koshin_nichiji                = :koshin_nichiji
                WHERE
                      kaiin_no = 819121119;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':renraku_hoho_yuso'                    => $param1['renraku_hoho_yuso'],
                    ':renraku_hoho_denshi_email'            => $param1['renraku_hoho_denshi_email'],
                    ':email_1_merumaga_haishin'             => $param1['email_1_merumaga_haishin'],
                    ':email_2_merumaga_haishin'             => $param1['email_2_merumaga_haishin'],
                    ':email_1_oshirase_uketori'             => $param1['email_1_oshirase_uketori'],
                    ':email_2_oshirase_uketori'             => $param1['email_2_oshirase_uketori'],
                    ':koshin_user_id'                       => $param1['koshin_user_id'],
                    ':koshin_nichiji'                       => $param1['koshin_nichiji'],
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
//
//            // 予約不可の場合
//            if ($argument['RESERVE_PROP'] == Config::RESERVE_PROP_NO) {
//
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
//
//SQL;
//            // 予約可の場合
//            } else {
//
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
//
//SQL;
//            }
//            
//            $sth = $db->prepare($sql);
//
//            // 予約不可の場合
//            if ($argument['RESERVE_PROP'] == Config::RESERVE_PROP_NO) {
//                $sth->execute([
//                    ':AREA_ID'          => $argument['AREA_ID'],
//                    ':RESERVE_YMD'      => $argument['RESERVE_YMD'],
//                    ':RESERVE_PROP'     => $argument['RESERVE_PROP'],
//                    ':UPD_ADMIN_USR'    => $argument['UPD_ADMIN_USR'],
//                ]);
//
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
