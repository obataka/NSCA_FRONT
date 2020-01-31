<?php
namespace Was;

class Vceu_shutoku_shosai
{
   public function __construct()
   {
   }

   public function findByMeisai($db, $param)
   {
      try {
            $sth = $db->prepare("SELECT
                                    COUNT(*)
                                 FROM
                                    vceu_shutoku_shosai
                                 LEFT JOIN
                                    cm_control
                                 ON
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                ");
            // $sth->execute([':kaiin_no' => '10251033',]);
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Meisai = $sth->fetch();
         } catch (\PDOException $e) {
            $meisai = [];
         }
         return $Meisai;
   }


   public function findByCeuJoho($param)
   {
      try {
             
               $db = Db::getInstance();
               $sth = $db->prepare("SELECT
                                     CONVERT (ceu_shutokubi, DATE) AS shutokubi
                                    ,(
                                       SELECT
                                       meisho
                                       FROM
                                       vms_meisho
                                       WHERE
                                       meisho_kbn = 48
                                       AND
                                       meisho_cd = vceu_shutoku_shosai.category_kbn
                                       ) AS category
                                    ,ceusu
                                    ,CASE
                                       WHEN event_kbn = 10 THEN
                                          CASE
                                             WHEN
                                                (fnc_get_nintei_jokyo(:kaiin_no) like N'CSCS有り'
                                             OR
                                                fnc_get_nintei_jokyo(:kaiin_no) like N'両認定')
                                                AND
                                                   shutokubi >= cscsnintei.ninteibi
                                                THEN
                                                   IFNULL(ceusu, 0.00)
                                             ELSE
                                                0.00
                                             END
                                       ELSE
                                          CASE
                                             WHEN
                                                (fnc_get_nintei_jokyo(:kaiin_no) like N'CSCS有り'
                                             OR
                                                fnc_get_nintei_jokyo(:kaiin_no) like N'両認定')
                                                AND
                                                   ceu_shutokubi >= cscsnintei.ninteibi
                                                THEN
                                                   IFNULL(ceusu, 0.00)
                                             ELSE
                                                0.00
                                             END
                                       END AS CSCS
                                    ,CASE
                                       WHEN event_kbn = 10 THEN
                                          CASE
                                             WHEN
                                                (fnc_get_nintei_jokyo(:kaiin_no) like N'CPT有り'
                                             OR
                                                fnc_get_nintei_jokyo(:kaiin_no) like N'両認定')
                                                AND
                                                   shutokubi >= cptnintei.ninteibi
                                                THEN
                                                   IFNULL(ceusu, 0.00)
                                             ELSE
                                                0.00
                                             END
                                       ELSE
                                          CASE
                                             WHEN
                                                (fnc_get_nintei_jokyo(:kaiin_no) like N'CPT有り'
                                             OR
                                                fnc_get_nintei_jokyo(:kaiin_no) like N'両認定')
                                                AND
                                                   ceu_shutokubi >= cptnintei.ninteibi
                                                THEN
                                                   IFNULL(ceusu, 0.00)
                                             ELSE
                                                0.00
                                             END
                                       END AS CPT
                                    ,IFNULL(level2_point ,0.00) AS level2_point
                                    ,shutoku_naiyo
                                 FROM
                                    vceu_shutoku_shosai
                                 LEFT JOIN 
                                    cm_nendo
                                 ON
                                    vceu_shutoku_shosai.nendo_id = cm_nendo.nendo_id
                                 LEFT JOIN
                                    tb_nintei_meisai cscsnintei
                                 ON
                                    vceu_shutoku_shosai.kaiin_no = cscsnintei.kaiin_no
                                 AND
                                    cscsnintei.shiken_sbt_kbn = 1
                                 AND
                                    cscsnintei.sakujo_flg = 0
                                 AND
                                    cscsnintei.torikeshi_hizuke IS NULL
                                 LEFT JOIN
                                    tb_nintei_meisai cptnintei
                                 ON
                                    vceu_shutoku_shosai.kaiin_no = cptnintei.kaiin_no
                                 AND
                                    cptnintei.shiken_sbt_kbn = 2
                                 AND
                                    cptnintei.sakujo_flg = 0
                                 AND
                                    cptnintei.torikeshi_hizuke IS NULL
                                 WHERE
                                    vceu_shutoku_shosai.kaiin_no = :kaiin_no
                                 AND
                                    vceu_shutoku_shosai.nendo_id = (SELECT nendo_id FROM cm_control)
                                 AND
                                    ((vceu_shutoku_shosai.ceu_shutokubi >= cscsnintei.ninteibi) OR (vceu_shutoku_shosai.ceu_shutokubi >= cptnintei.ninteibi))
                                ");
            // $sth->execute([':kaiin_no' => '10251033',]);
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $CeuJoho = $sth->fetchAll();
         } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $CeuJoho = [];
         }
         return $CeuJoho;
   }




}
