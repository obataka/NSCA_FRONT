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
						  tb_kaiin_ceu.*
                     FROM tb_kaiin_ceu
					 INNER JOIN (select nendo_id from cm_nendo where now() between ceu_kikan_from and ceu_kikan_to) nendo
					    ON nendo.nendo_id = tb_kaiin_ceu.nendo_id
                     WHERE kaiin_no = :kaiin_no
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
						  tb_kaiin_ceu.*
                     FROM tb_kaiin_ceu
					 INNER JOIN (select nendo_id from cm_nendo where now() between ceu_kikan_from and ceu_kikan_to) nendo
					    ON nendo.nendo_id = tb_kaiin_ceu.nendo_id
                     WHERE kaiin_no = :kaiin_no
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
            // $sth->execute([':kaiin_no' => '807031506',]);
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
                                    ((shutokubi >= :cscs_ninteibi) OR (shutokubi >= :cpt_ninteibi))
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
                                        ((shutokubi >= :cscs_ninteibi) OR (shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS b
                                ON
                                    vceu_shutoku_shosai.kaiin_no = b.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = b.nendo_id
                                AND
                                    a.category_kbn = 2
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
                                        ((shutokubi >= :cscs_ninteibi) OR (shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS c
                                ON
                                    vceu_shutoku_shosai.kaiin_no = c.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = c.nendo_id
                                AND
                                    a.category_kbn = 3
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
                                        ((shutokubi >= :cscs_ninteibi) OR (shutokubi >= :cpt_ninteibi))
                                    GROUP BY 
                                        kaiin_no, nendo_id, category_kbn
                                ) AS d
                                ON
                                    vceu_shutoku_shosai.kaiin_no = d.kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = d.nendo_id
                                AND
                                    a.category_kbn = 4
                                LEFT JOIN
                                    cm_control
                                ON
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                WHERE
                                    vceu_shutoku_shosai.kaiin_no = :kaiin_no
                                AND
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                ");
            $sth->execute([':kaiin_no' => '807031506', ':cscs_ninteibi' => $ninteibi['cscs_ninteibi'], ':cpt_ninteibi' => $ninteibi['cpt_ninteibi'],]);
            // $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $TotalValue = $sth->fetch();
        } catch (\PDOException $e) {
            $TotalValue = [];
        }
        return $TotalValue;
    }

}
