<?php

namespace Was;

class Tb_kaiin_ceu
{
    public function __construct()
    {
    }

    /*
     * 会員番号からCSCS情報(試験種別区分=1)を取得する
     * @param varchar $kaiin_no
     * @return array|mixed
     */
    public function findCscsByKaiinNo($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT 
						  hitsuyo_ceusu         AS hitsuyo_ceusu_c
						, hitsuyo_ceu_zansu     AS hitsuyo_ceu_zansu_c
						, genzai_shutoku_ceusu  AS genzai_shutoku_ceusu_c
                     FROM tb_kaiin_ceu
					 INNER JOIN cm_control 
					 	ON 1=1
                     WHERE kaiin_no = :kaiin_no
                       AND tb_kaiin_ceu.nendo_id = cm_control.nendo_id
                       AND sakujo_flg = 0
                       AND shiken_sbt_kbn = 1
 ;
            ");
            $sth->execute([':kaiin_no' => $kaiin_no]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            $row = [];
        }
        return $row;
    }

    /*
     * 会員番号からNSCA情報(試験種別区分=2)を取得する
     * @param varchar $kaiin_no
     * @return array|mixed
     */
    public function findNscaByKaiinNo($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT 
						  hitsuyo_ceusu         AS hitsuyo_ceusu_n
						, hitsuyo_ceu_zansu     AS hitsuyo_ceu_zansu_n
						, genzai_shutoku_ceusu  AS genzai_shutoku_ceusu_n
                     FROM tb_kaiin_ceu
					 INNER JOIN cm_control 
					 	ON 1=1
                     WHERE kaiin_no = :kaiin_no
                       AND tb_kaiin_ceu.nendo_id = cm_control.nendo_id
                       AND sakujo_flg = 0
                       AND shiken_sbt_kbn = 2
 ;
            ");
            $sth->execute([':kaiin_no' => $kaiin_no]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            $row = [];
        }
        return $row;
    }




    public function getTotalNull($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT
                                     NULL kaiin_no
                                    ,NULL nendo_id
                                    ,NULL shiken_sbt_kbn
                                    ,NULL category_a_gokei
                                    ,NULL category_b_gokei
                                    ,NULL category_c_gokei
                                    ,NULL category_d_gokei
                                    ,NULL hitsuyo_ceusu
                                    ,NULL genzai_shutoku_ceusu
                                    ,NULL hitsuyo_ceu_zansu
                                    ,NULL shikaku_koshinryo_nofu_kbn
                                 UNION

                                 SELECT
                                     tb_kaiin_ceu.kaiin_no
                                    ,tb_kaiin_ceu.nendo_id
                                    ,tb_kaiin_ceu.shiken_sbt_kbn
                                    ,tb_kaiin_ceu.category_a_gokei
                                    ,tb_kaiin_ceu.category_b_gokei
                                    ,tb_kaiin_ceu.category_c_gokei
                                    ,tb_kaiin_ceu.category_d_gokei
                                    ,tb_kaiin_ceu.hitsuyo_ceusu
                                    ,tb_kaiin_ceu.genzai_shutoku_ceusu
                                    ,tb_kaiin_ceu.hitsuyo_ceu_zansu
                                    ,tb_kaiin_ceu.shikaku_koshinryo_nofu_kbn
                                 FROM
                                    tb_kaiin_ceu
                                 LEFT JOIN
	                                cm_control
                                 ON
                                    tb_kaiin_ceu.nendo_id		= cm_control.nendo_id
                                 WHERE
	                                tb_kaiin_ceu.kaiin_no		= :kaiin_no
                                 AND
	                                tb_kaiin_ceu.nendo_id		= cm_control.nendo_id
                                 AND	
	                                tb_kaiin_ceu.sakujo_flg	= 0
                                ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            // $sth->execute([':kaiin_no' => '10251033',]);
            $TotalValue = $sth->fetch();
        } catch (\PDOException $e) {
            $TotalValue = [];
        }
        return $TotalValue;
    }

    public function getTotal($db, $param, $ninteibi)
    {
        try {
            $sth = $db->prepare("SELECT
                                     tb_kaiin_ceu.kaiin_no
                                    ,tb_kaiin_ceu.nendo_id
                                    ,tb_kaiin_ceu.shiken_sbt_kbn
                                    ,tb_kaiin_ceu.category_a_gokei
                                    ,tb_kaiin_ceu.category_b_gokei
                                    ,tb_kaiin_ceu.category_c_gokei
                                    ,tb_kaiin_ceu.category_d_gokei
                                    ,tb_kaiin_ceu.hitsuyo_ceusu
                                    ,tb_kaiin_ceu.genzai_shutoku_ceusu
                                    ,tb_kaiin_ceu.hitsuyo_ceu_zansu
                                    ,tb_kaiin_ceu.shikaku_koshinryo_nofu_kbn
                                 FROM
                                    tb_kaiin_ceu
                                 LEFT JOIN
	                                cm_control
                                 ON
                                    tb_kaiin_ceu.nendo_id		= cm_control.nendo_id
                                WHERE
                                    tb_kaiin_ceu.kaiin_no = :kaiin_no
                                AND
                                    tb_kaiin_ceu.nendo_id = cm_control.nendo_id
                                AND
                                    tb_kaiin_ceu.sakujo_flg = 0
                                
                                UNION
                                
                                SELECT	DISTINCT 
                                    vceu_shutoku_shosai.kaiin_no
                                    ,vceu_shutoku_shosai.nendo_id
                                    ,NULL
                                    ,a.ceusu
                                    ,b.ceusu
                                    ,c.ceusu
                                    ,d.ceusu
                                    ,NULL
                                    ,NULL
                                    ,NULL
                                    ,NULL
                                FROM
                                    vceu_shutoku_shosai
                                LEFT JOIN
                                (
                                SELECT
                                    kaiin_no
                                    ,nendo_id
                                    ,category_kbn
                                    ,ceusu
                                FROM
                                    vceu_shutoku_shosai
                                WHERE
                                    ((ceu_shutokubi >= :cscs_ninteibi) OR (ceu_shutokubi >= :cpt_ninteibi))
                                GROUP BY 
                                    kaiin_no, nendo_id, category_kbn
                                ) AS a
                                ON
                                    vceu_shutoku_shosai.kaiin_no = a.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = a.nendo_id
                                AND
                                    a.category_kbn = 1
                                LEFT JOIN
                                    (
                                    SELECT
                                        kaiin_no
                                        ,nendo_id
                                        ,category_kbn
                                        ,ceusu
                                    FROM
                                        vceu_shutoku_shosai
                                    WHERE
                                        ((ceu_shutokubi >= :cscs_ninteibi) OR (ceu_shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS b
                                ON
                                    vceu_shutoku_shosai.kaiin_no = b.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = b.nendo_id
                                AND
                                    b.category_kbn = 2
                                LEFT JOIN
                                    (
                                    SELECT
                                        kaiin_no
                                        ,nendo_id
                                        ,category_kbn
                                        ,ceusu
                                    FROM
                                        vceu_shutoku_shosai
                                    WHERE
                                        ((ceu_shutokubi >= :cscs_ninteibi) OR (ceu_shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS c
                                ON
                                    vceu_shutoku_shosai.kaiin_no = c.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = c.nendo_id
                                AND
                                    c.category_kbn = 3
                                LEFT JOIN
                                    (
                                    SELECT
                                        kaiin_no
                                        ,nendo_id
                                        ,category_kbn
                                        ,ceusu
                                    FROM
                                        vceu_shutoku_shosai
                                    WHERE
                                        ((ceu_shutokubi >= :cscs_ninteibi) OR (ceu_shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS d
                                ON
                                    vceu_shutoku_shosai.kaiin_no = d.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = d.nendo_id
                                AND
                                    d.category_kbn = 4
                                LEFT JOIN
                                    cm_control
                                ON
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                WHERE
                                    vceu_shutoku_shosai.kaiin_no = :kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'], ':cscs_ninteibi' => $ninteibi['cscs_ninteibi'], ':cpt_ninteibi' => $ninteibi['cpt_ninteibi'],]);
            // $sth->execute([':kaiin_no' => '10251033',]);
            $TotalValue = $sth->fetchAll();
        } catch (\PDOException $e) {
            $TotalValue = [];
        }
        return $TotalValue;
    }

    /*
    * 更新処理
    * @param array $param
    * @return boolean
    */
    public function updateRecCSCS($db, $param)
    {
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_ceu
                SET
                	  cpraed_kakunin_kbn            = 1
                    , cpraed_kakunimbi              = :nonyubi
                    , nonyubi                       = :nonyubi
                    , nonyu_hoho_kbn                = NULL
                    , nonyu_kingaku                 = NULL
                    , shikaku_koshinryo_nofu_kbn    = 0
                    , kanryo_hizuke                 = :nonyubi
                    , koshin_user_id                = :koshin_user_id
                WHERE
                    shiken_sbt_kbn = 1
                AND
                    kaiin_no = :kaiin_no
                AND
                    nendo_id = :nendo_id;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':koshin_user_id'                   => $param['user_id'],
                ':nonyubi'                          => $param['nonyubi'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertRecCSCS($db, $param)
    {
        try {
            $sql = <<<SQL
                INSERT 
                INTO tb_kaiin_ceu(
                    kaiin_no
                  , nendo_id
                  , shiken_sbt_kbn
                  , cpraed_kakunin_kbn
                  , cpraed_kakunimbi
                  , shikaku_koshinryo_nofu_kbn
                  , nonyubi
                  , nonyu_hoho_kbn
                  , nonyu_kingaku
                  , kanryo_hizuke
                  , sakujo_flg
                  , sakusei_user_id
                  , koshin_user_id

                )
                VALUES (
                    :kaiin_no
                  , :nendo_id
                  , 1
                  , 1
                  , :nonyubi
                  , 0
                  , :nonyubi
                  , NULL
                  , NULL
                  , :nonyubi
                  , 0
                  , :koshin_user_id
                  , :koshin_user_id
                );
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':koshin_user_id'                   => $param['user_id'],
                ':nonyubi'                          => $param['nonyubi'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateRecCPT($db, $param)
    {
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_ceu
                SET
                	  cpraed_kakunin_kbn            = 1
                    , cpraed_kakunimbi              = :nonyubi
                    , nonyubi                       = :nonyubi
                    , nonyu_hoho_kbn                = NULL
                    , nonyu_kingaku                 = NULL
                    , shikaku_koshinryo_nofu_kbn    = 0
                    , kanryo_hizuke                 = :nonyubi
                    , koshin_user_id                = :koshin_user_id
                WHERE
                    shiken_sbt_kbn = 2
                AND
                    kaiin_no = :kaiin_no
                AND
                    nendo_id = :nendo_id;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':koshin_user_id'                   => $param['user_id'],
                ':nonyubi'                          => $param['nonyubi'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertRecCPT($db, $param)
    {
        try {
            $sql = <<<SQL
                INSERT 
                INTO tb_kaiin_ceu(
                    kaiin_no
                  , nendo_id
                  , shiken_sbt_kbn
                  , cpraed_kakunin_kbn
                  , cpraed_kakunimbi
                  , shikaku_koshinryo_nofu_kbn
                  , nonyubi
                  , nonyu_hoho_kbn
                  , nonyu_kingaku
                  , kanryo_hizuke
                  , sakujo_flg
                  , sakusei_user_id
                  , koshin_user_id

                )
                VALUES (
                    :kaiin_no
                  , :nendo_id
                  , 2
                  , 1
                  , :nonyubi
                  , 0
                  , :nonyubi
                  , NULL
                  , NULL
                  , :nonyubi
                  , 0
                  , :koshin_user_id
                  , :koshin_user_id
                );
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':koshin_user_id'                   => $param['user_id'],
                ':nonyubi'                          => $param['nonyubi'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function chkExistsCSCS($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    *
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 1
                                AND
                                    nendo_id = :nendo_id");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cscs = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cscs = [];
        }
        return $cscs;
    }

    public function chkExistsCSCSFlg($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    *
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 1
                                AND
                                    nendo_id = :nendo_id
                                AND
                                    sakujo_flg = 0");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cscs = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cscs = [];
        }
        return $cscs;
    }

    public function chkExistsCPT($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    *
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 2
                                AND
                                    nendo_id = :nendo_id");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cpt = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cpt = [];
        }
        return $cpt;
    }

    public function chkExistsCPTFlg($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    *
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 2
                                AND
                                    nendo_id = :nendo_id
                                AND
                                    sakujo_flg = 0");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cscs = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cscs = [];
        }
        return $cscs;
    }

    public function getCSCSCEUsu($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    hitsuyo_ceusu,
                                    genzai_shutoku_ceusu
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 1
                                AND
                                    nendo_id = :nendo_id
                                ");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cscs = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cscs = [];
        }
        return $cscs;
    }

    public function getCPTCEUsu($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT 
                                    hitsuyo_ceusu,
                                    genzai_shutoku_ceusu
                                FROM
                                    tb_kaiin_ceu
                                WHERE
                                    kaiin_no = :kaiin_no
                                AND 
                                    shiken_sbt_kbn = 2
                                AND
                                    nendo_id = :nendo_id
                                ");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                         => $param['nendo_id'],
            ]);
            $cscs = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
            $cscs = [];
        }
        return $cscs;
    }

    public function updateCEUsuCSCS($db, $param, $koshin_ceusu)
    {
        try {
            $sth = $db->prepare("UPDATE tb_kaiin_ceu
								SET
									category_a_gokei         			= CASE WHEN {$param['category_kbn']} = 1 THEN category_a_gokei + $koshin_ceusu ELSE category_a_gokei END,
									, category_b_gokei                	= CASE WHEN {$param['category_kbn']} = 2 THEN category_b_gokei + $koshin_ceusu ELSE category_b_gokei END,
									, category_c_gokei                 	= CASE WHEN {$param['category_kbn']} = 3 THEN category_c_gokei + $koshin_ceusu ELSE category_c_gokei END,
									, category_d_gokei                  = CASE WHEN {$param['category_kbn']} = 4 THEN category_d_gokei + $koshin_ceusu ELSE category_d_gokei END,
									, genzai_shutoku_ceusu              = CASE WHEN {$param['category_kbn']} IN (1,2,3,4) THEN genzai_shutoku_ceusu +$koshin_ceusu ELSE genzai_shutoku_ceusu END,
                                    , koshin_user_id                    = :koshin_user_id
								WHERE
									nendo_id = :nendo_id
								AND
									kaiin_no = :kaiin_no
                                AND
                                    shiken_sbt_kbn = 1
								");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                   		=> $param['ceu_id'],
				':koshin_user_id'                   => $param['user_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateCEUsuZanCSCS($db, $param)
    {
        try {
            $sth = $db->prepare("UPDATE tb_kaiin_ceu
								SET
									hitsuyo_ceusu_zan   = CASE
							                            WHEN hitsuyo_ceusu - genzai_shutoku_ceusu < 0 THEN 
                                                            0
                                                        ELSE
                                                            hitsuyo_ceusu - genzai_shutoku_ceusu
                                                        END
								WHERE
									nendo_id = :nendo_id
								AND
									kaiin_no = :kaiin_no
                                AND
                                    shiken_sbt_kbn = 1
								");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                   		=> $param['ceu_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateCEUsuCPT($db, $param, $koshin_ceusu)
    {
        try {
            $sth = $db->prepare("UPDATE tb_kaiin_ceu
								SET
									category_a_gokei         			= CASE WHEN {$param['category_kbn']} = 1 THEN category_a_gokei + $koshin_ceusu ELSE category_a_gokei END,
									, category_b_gokei                	= CASE WHEN {$param['category_kbn']} = 2 THEN category_b_gokei + $koshin_ceusu ELSE category_b_gokei END,
									, category_c_gokei                 	= CASE WHEN {$param['category_kbn']} = 3 THEN category_c_gokei + $koshin_ceusu ELSE category_c_gokei END,
									, category_d_gokei                  = CASE WHEN {$param['category_kbn']} = 4 THEN category_d_gokei + $koshin_ceusu ELSE category_d_gokei END,
									, genzai_shutoku_ceusu              = CASE WHEN {$param['category_kbn']} IN (1,2,3,4) THEN genzai_shutoku_ceusu +$koshin_ceusu ELSE genzai_shutoku_ceusu END,
                                    , koshin_user_id                    = :koshin_user_id
								WHERE
									nendo_id = :nendo_id
								AND
									kaiin_no = :kaiin_no
                                AND
                                    shiken_sbt_kbn = 2
								");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                   		=> $param['ceu_id'],
				':koshin_user_id'                   => $param['user_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateCEUsuZanCPT($db, $param)
    {
        try {
            $sth = $db->prepare("UPDATE tb_kaiin_ceu
								SET
									hitsuyo_ceusu_zan   = CASE
							                            WHEN hitsuyo_ceusu - genzai_shutoku_ceusu < 0 THEN 
                                                            0
                                                        ELSE
                                                            hitsuyo_ceusu - genzai_shutoku_ceusu
                                                        END
								WHERE
									nendo_id = :nendo_id
								AND
									kaiin_no = :kaiin_no
                                AND
                                    shiken_sbt_kbn = 2
								");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':nendo_id'                   		=> $param['ceu_id'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
