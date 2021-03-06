<?php
namespace Was;

class Cm_control
{
    public function __construct()
    {
    }

    /*
     * ID検索
     * @param varchar $id
     * @return array|mixed
     */
    public function findById($id)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM cm_control WHERE id = :id;");
            $sth->execute([':id' => $id,]);
            $cmControl = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cmControl = [];
        }

        return $cmControl;
    }

    /*
    * @return boolean
    */

    public function findByCmControl()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM cm_control WHERE id = :id;");
            $sth->execute([':id' => '1',]);
            $cmControl = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $cmControl = [];
        }

        return $cmControl;
    }
    
    public function findByCmControlNoTran($db)
    {
        try {
            $sth = $db->prepare("SELECT * FROM cm_control WHERE id = :id;");
            $sth->execute([':id' => '1',]);
            $cmControl = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $cmControl = [];
        }

        return $cmControl;
    }

    public function findByNendoId($db)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    nendo_id
                                 FROM 
                                    cm_control
                                 WHERE id = :id;");
            $sth->execute([':id' => '1',]);
            $cmControl = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $cmControl = [];
        }

        return $cmControl;
    }

    /*
     * 決済連番をカウントアップします（外側でトランザクション開始）
     * @param object db
     * @return 成功 true / 失敗 false
     */
    public function countUpKessaiRemban_noTran($db) 
    {
        try {
            $sql = <<<SQL
                UPDATE cm_control
                   SET kessai_remban = kessai_remban + 1
                 WHERE id = 1
SQL;

            $sth = $db->prepare($sql);
            $sth->execute();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return false;
        }
        return true;
    }

    /*
     * 決済連番をフォーマットして取得します
     */
    public function getKessaiRemban()
    {
        $db = Db::getInstance();
        $rtn = [];

        try {
            $sql = <<<SQL
                SELECT concat(
                            DATE_FORMAT(now(), '%Y%m%d'), 
                            right(concat('000000000000', convert(kessai_remban, char)), 12)
                       ) as kessai_remban
                  FROM cm_control
                 WHERE id = 1
SQL;

            $sth = $db->prepare($sql);
            $sth->execute();
            $rtn = $sth->fetch();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            $rtn = [];
        }
      return $rtn;
    }

    /*
     * 経理伝票番号をカウントアップします（外側でトランザクション開始）
     * @param object db
     * @return 成功 true / 失敗 false
     */
    public function countUpKeiriDempyoNo_noTran($db) 
    {
        try {
            $sql = <<<SQL
                UPDATE cm_control
                   SET kessai_remban = kessai_remban + 1
                 WHERE id = 1
SQL;

            $sth = $db->prepare($sql);
            $sth->execute();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return false;
        }
        return true;
    }

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
//     * 登録
//     * @param array $argument
//     * @return boolean
//     */
//    public function insertRec ($argument)
//    {
//        $db = Db::getInstance();
//        $db->beginTransaction();
//        try {
//            $sql = <<<SQL
//            INSERT
//            INTO T_REMAIN_MNG_BY_DATE(
//                    AREA_ID
//                  , RESERVE_YMD
//                  , RESERVE_WEEK
//                  , RESERVE_PROP
//                  , RESERVE_TYPE_1
//                  , RESERVE_TIME_FROM_1
//                  , RESERVE_TIME_TO_1
//                  , RESERVE_LIMIT_1
//                  , RESERVE_CNT_1
//                  , RESERVE_TYPE_2
//                  , RESERVE_TIME_FROM_2
//                  , RESERVE_TIME_TO_2
//                  , RESERVE_LIMIT_2
//                  , RESERVE_CNT_2
//                  , RESERVE_TYPE_3
//                  , RESERVE_TIME_FROM_3
//                  , RESERVE_TIME_TO_3
//                  , RESERVE_LIMIT_3
//                  , RESERVE_CNT_3
//                  , RESERVE_TYPE_4
//                  , RESERVE_TIME_FROM_4
//                  , RESERVE_TIME_TO_4
//                  , RESERVE_LIMIT_4
//                  , RESERVE_CNT_4
//                  , RESERVE_TYPE_5
//                  , RESERVE_TIME_FROM_5
//                  , RESERVE_TIME_TO_5
//                  , RESERVE_LIMIT_5
//                  , RESERVE_CNT_5
//                  , CRT_DTS
//                  , CRT_USR
//                  , UPD_ADMIN_DTS
//                  , UPD_ADMIN_USR
//                  , UPD_USER_DTS
//                  , UPD_USER_USR
//            )
//            VALUES (
//                    :AREA_ID
//                  , :RESERVE_YMD
//                  , :RESERVE_WEEK
//                  , :RESERVE_PROP
//                  , :RESERVE_TYPE_1
//                  , :RESERVE_TIME_FROM_1
//                  , :RESERVE_TIME_TO_1
//                  , :RESERVE_LIMIT_1
//                  , :RESERVE_CNT_1
//                  , :RESERVE_TYPE_2
//                  , :RESERVE_TIME_FROM_2
//                  , :RESERVE_TIME_TO_2
//                  , :RESERVE_LIMIT_2
//                  , :RESERVE_CNT_2
//                  , :RESERVE_TYPE_3
//                  , :RESERVE_TIME_FROM_3
//                  , :RESERVE_TIME_TO_3
//                  , :RESERVE_LIMIT_3
//                  , :RESERVE_CNT_3
//                  , :RESERVE_TYPE_4
//                  , :RESERVE_TIME_FROM_4
//                  , :RESERVE_TIME_TO_4
//                  , :RESERVE_LIMIT_4
//                  , :RESERVE_CNT_4
//                  , :RESERVE_TYPE_5
//                  , :RESERVE_TIME_FROM_5
//                  , :RESERVE_TIME_TO_5
//                  , :RESERVE_LIMIT_5
//                  , :RESERVE_CNT_5
//                  , now()
//                  , :CRT_USR
//                  , now()
//                  , :UPD_ADMIN_USR
//                  , now()
//                  , :UPD_USER_USR
//            );
//
//SQL;
//
//            $sth = $db->prepare($sql);
//            $sth->execute([
//                ':AREA_ID'              => $argument['AREA_ID'],
//                ':RESERVE_YMD'          => $argument['RESERVE_YMD'],
//                ':RESERVE_WEEK'         => $argument['RESERVE_WEEK'],
//                ':RESERVE_PROP'         => $argument['RESERVE_PROP'],
//                ':RESERVE_TYPE_1'       => $argument['RESERVE_TYPE_1'],
//                ':RESERVE_TIME_FROM_1'  => $argument['RESERVE_TIME_FROM_1'],
//                ':RESERVE_TIME_TO_1'    => $argument['RESERVE_TIME_TO_1'],
//                ':RESERVE_LIMIT_1'      => $argument['RESERVE_LIMIT_1'],
//                ':RESERVE_CNT_1'        => $argument['RESERVE_CNT_1'],
//                ':RESERVE_TYPE_2'       => $argument['RESERVE_TYPE_2'],
//                ':RESERVE_TIME_FROM_2'  => $argument['RESERVE_TIME_FROM_2'],
//                ':RESERVE_TIME_TO_2'    => $argument['RESERVE_TIME_TO_2'],
//                ':RESERVE_LIMIT_2'      => $argument['RESERVE_LIMIT_2'],
//                ':RESERVE_CNT_2'        => $argument['RESERVE_CNT_2'],
//                ':RESERVE_TYPE_3'       => $argument['RESERVE_TYPE_3'],
//                ':RESERVE_TIME_FROM_3'  => $argument['RESERVE_TIME_FROM_3'],
//                ':RESERVE_TIME_TO_3'    => $argument['RESERVE_TIME_TO_3'],
//                ':RESERVE_LIMIT_3'      => $argument['RESERVE_LIMIT_3'],
//                ':RESERVE_CNT_3'        => $argument['RESERVE_CNT_3'],
//                ':RESERVE_TYPE_4'       => $argument['RESERVE_TYPE_4'],
//                ':RESERVE_TIME_FROM_4'  => $argument['RESERVE_TIME_FROM_4'],
//                ':RESERVE_TIME_TO_4'    => $argument['RESERVE_TIME_TO_4'],
//                ':RESERVE_LIMIT_4'      => $argument['RESERVE_LIMIT_4'],
//                ':RESERVE_CNT_4'        => $argument['RESERVE_CNT_4'],
//                ':RESERVE_TYPE_5'       => $argument['RESERVE_TYPE_5'],
//                ':RESERVE_TIME_FROM_5'  => $argument['RESERVE_TIME_FROM_5'],
//                ':RESERVE_TIME_TO_5'    => $argument['RESERVE_TIME_TO_5'],
//                ':RESERVE_LIMIT_5'      => $argument['RESERVE_LIMIT_5'],
//                ':RESERVE_CNT_5'        => $argument['RESERVE_CNT_5'],
//                ':CRT_USR'              => $argument['CRT_USR'],
//                ':UPD_ADMIN_USR'        => $argument['UPD_ADMIN_USR'],
//                ':UPD_USER_USR'         => $argument['UPD_USER_USR'],
//            ]);
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
