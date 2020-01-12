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
						, yuko_kigen as yuko_kigen_c
						, DATE_FORMAT(torikeshi_hizuke,'%Y/%m/%d') as torikeshi_hizuke_c
                     FROM tb_nintei_meisai
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
						  DATE_FORMAT(ninteibi,'%Y/%m/%d') as ninteibi_n
						, nintei_no as nintei_no_n
						, DATE_FORMAT(kiso_gokakubi,'%Y/%m/%d') as kiso_gokkubi_n
						, DATE_FORMAT(jissen_gokakubi,'%Y/%m/%d') as jissen_gokakubi_n
						, d_shinsei_kbn as d_shinsei_kbn_n
						, yuko_kigen as yuko_kigen_n
						, DATE_FORMAT(torikeshi_hizuke,'%Y/%m/%d') as torikeshi_hizuke_n
                     FROM tb_nintei_meisai
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