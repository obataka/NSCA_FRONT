<?php

namespace Was;

class Tb_nintei_meisai
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
						  DATE_FORMAT(ninteibi,'%Y/%m/%d') as ninteibi_c
						, nintei_no as nintei_no_c
						, DATE_FORMAT(kiso_gokakubi,'%Y/%m/%d') as kiso_gokkubi_c
						, DATE_FORMAT(jissen_gokakubi,'%Y/%m/%d') as jissen_gokakubi_c
						, d_shinsei_kbn as d_shinsei_kbn_c
						, DATE_FORMAT(yuko_kigen,'%Y/%m/%d') as yuko_kigen_c
						, DATE_FORMAT(torikeshi_hizuke,'%Y/%m/%d') as torikeshi_hizuke_c
                     FROM tb_nintei_meisai
                     WHERE kaiin_no = :kaiin_no
                       AND sakujo_flg = 0
					   AND NULLIF(nintei_no,'') IS NOT NULL
					   AND ninteibi IS NOT NULL
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
						  DATE_FORMAT(ninteibi,'%Y/%m/%d') as ninteibi_n
						, nintei_no as nintei_no_n
						, DATE_FORMAT(kiso_gokakubi,'%Y/%m/%d') as kiso_gokkubi_n
						, DATE_FORMAT(jissen_gokakubi,'%Y/%m/%d') as jissen_gokakubi_n
						, d_shinsei_kbn as d_shinsei_kbn_n
						, DATE_FORMAT(yuko_kigen,'%Y/%m/%d') as yuko_kigen_n
						, DATE_FORMAT(torikeshi_hizuke,'%Y/%m/%d') as torikeshi_hizuke_n
                     FROM tb_nintei_meisai
                     WHERE kaiin_no = :kaiin_no
                       AND sakujo_flg = 0
					   AND NULLIF(nintei_no,'') IS NOT NULL
					   AND ninteibi IS NOT NULL
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


   public function findBycscsNinteibi($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT
                                    ninteibi
                                 FROM
                                    tb_nintei_meisai
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    shiken_sbt_kbn = 1
                                 AND 
                                    sakujo_flg = 0
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $CSCSninteibi = $sth->fetchAll();
      } catch (\PDOException $e) {
         $CSCSninteibi = [];
      }
      return $CSCSninteibi;
   }


   public function findBycptNinteibi($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT
                                    ninteibi
                                 FROM
                                    tb_nintei_meisai
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    shiken_sbt_kbn = 2
                                 AND 
                                    sakujo_flg = 0
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $CPTninteibi = $sth->fetchAll();
      } catch (\PDOException $e) {
         $CPTninteibi = [];
      }
      return $CPTninteibi;
   }

   public function countcscsShutokujokyo($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT
                                    COUNT(*)
                                 FROM
                                    tb_nintei_meisai
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    shiken_sbt_kbn = 1
                                 AND 
                                    sakujo_flg = 0
                                 AND 
                                    NULLIF(nintei_no, '') IS NOT NULL 
                                 AND 
                                    ninteibi IS NOT NULL  
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcscs = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcscs = [];
      }
      return $countcscs;
   }

   public function countcptShutokujokyo($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT
                                    COUNT(*)
                                 FROM
                                    tb_nintei_meisai
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    shiken_sbt_kbn = 2
                                 AND 
                                    sakujo_flg = 0
                                 AND 
                                    NULLIF(nintei_no, '') IS NOT NULL 
                                 AND 
                                    ninteibi IS NOT NULL  
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

   public function findByNinteiMeisai($db, $param, $wk_shiken_sbt_kbn)
   {
      try {
         $sth = $db->prepare("SELECT 
                                    *
                                 FROM
                                    tb_nintei_meisai 
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    shiken_sbt_kbn = $wk_shiken_sbt_kbn
                                 AND 
                                    sakujo_flg = 0
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

   public function findByNinteiMeisaiRyo($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT 
                                    *
                                 FROM
                                    tb_nintei_meisai a
                                 LEFT JOIN tb_nintei_meisai cscs_nintei
                                    ON  cscs_nintei.kaiin_no = :kaiin_no
                                    AND cscs_nintei.shiken_sbt_kbn = 1
                                    AND cscs_nintei.sakujo_flg = 0
                                    AND cscs_nintei.torikeshi_hizuke IS NULL
                                 LEFT JOIN tb_nintei_meisai cpt_nintei
                                    ON  cpt_nintei.kaiin_no = :kaiin_no
                                    AND cpt_nintei.shiken_sbt_kbn = 2
                                    AND cpt_nintei.sakujo_flg = 0
                                    AND cpt_nintei.torikeshi_hizuke IS NULL
                                 WHERE
                                    a.kaiin_no = :kaiin_no
                                 AND 
                                    a.sakujo_flg = 0
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

   public function getceuKanrihi($db, $param, $shiken_sbt_kbn, $ceu_kanrihi)
   {

      try {
         $sth = $db->prepare("SELECT 
                                    '$shiken_sbt_kbn' AS shiken_sbt_kbn, $ceu_kanrihi AS ceu_kanrihi
                                 FROM
                                    tb_nintei_meisai
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND 
                                    sakujo_flg = 0
                                 AND
                                    torikeshi_hizuke IS NULL
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

   public function getceuKanrihiRyo($db, $param, $shiken_sbt_kbn, $ceu_kanrihi)
   {
      try {
         $sth = $db->prepare("SELECT 
                                    '$shiken_sbt_kbn' AS shiken_sbt_kbn, $ceu_kanrihi AS ceu_kanrihi
                                 FROM
                                    tb_nintei_meisai a
                                 LEFT JOIN tb_nintei_meisai cscs_nintei
                                    ON  cscs_nintei.kaiin_no = :kaiin_no
                                    AND cscs_nintei.shiken_sbt_kbn = 1
                                    AND cscs_nintei.sakujo_flg = 0
                                    AND cscs_nintei.torikeshi_hizuke IS NULL
                                 LEFT JOIN tb_nintei_meisai cpt_nintei
                                    ON  cpt_nintei.kaiin_no = :kaiin_no
                                    AND cpt_nintei.shiken_sbt_kbn = 2
                                    AND cpt_nintei.sakujo_flg = 0
                                    AND cpt_nintei.torikeshi_hizuke IS NULL
                                 WHERE
                                    a.kaiin_no = :kaiin_no
                                 AND 
                                    a.sakujo_flg = 0
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

    /*
     * 会員番号更新処理（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateKaiinNoByOldKaiinNo_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            UPDATE tb_nintei_meisai
               SET kaiin_no = :kaiin_no
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :old_kaiin_no;
            SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':old_kaiin_no' => $param['old_kaiin_no']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

}
