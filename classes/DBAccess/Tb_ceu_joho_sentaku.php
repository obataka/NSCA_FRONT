<?php

namespace Was;

class Tb_ceu_joho_sentaku
{
   public function __construct()
   {
   }

   public function chkExistsLevel2Theme($db, $meisho_cd)
   {
      try {
         $sth = $db->prepare("SELECT 
                                    *
                                 FROM
                                    tb_ceu_joho_sentaku
                                 WHERE
                                    ceu_id = NULL
                                 AND
                                    meisho_kbn = 47
                                 AND
                                    meisho_cd = $meisho_cd
                                 AND 
                                    sakujo_flg = 0
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute();
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }
}
