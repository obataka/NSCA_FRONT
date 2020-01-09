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



}
