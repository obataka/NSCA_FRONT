<?php

namespace Was;

class Tb_kaiin_nintei
{
   public function __construct()
   {
   }

   public function chkExistsLevel2($db, $param)
   {
      try {
         $sth = $db->prepare("SELECT 
                                    *
                                 FROM
                                    tb_kaiin_nintei
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND 
                                    sakujo_flg = 0
                                ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([
            ':kaiin_no'  => $param['kaiin_no'],
         ]);
         $countcpt = $sth->fetchAll();
      } catch (\PDOException $e) {
         $countcpt = [];
      }
      return $countcpt;
   }

   public function updateLevel2($db, $param, $level_2_point)
   {
      try {
         $sth = $db->prepare("UPDATE tb_kaiin_nintei
                              SET
                                 level_2_point = IFNULL(level_2_point, 0) + $level_2_point,
                                 koshin_user_id = :koshin_user_id 
                              
                              WHERE
                                 kaiin_no = :kaiin_no
                              AND 
                                 sakujo_flg = 0
                              ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([
            ':kaiin_no'          => $param['kaiin_no'],
            ':koshin_user_id'    => $param['user_id'],
         ]);
      } catch (\PDOException $e) {
         $db->rollBack();
         return FALSE;
      }
      return TRUE;
   }

   public function updateLevel2Theme($db, $param, $meisho_cd)
   {
      try {
         $sth = $db->prepare("UPDATE tb_kaiin_nintei
                              SET
                                 level_2_theme_$meisho_cd = 1,
                                 koshin_user_id = :koshin_user_id 
                              
                              WHERE
                                 kaiin_no = :kaiin_no
                              AND 
                                 sakujo_flg = 0
                              ");
         // $sth->execute([':kaiin_no' => '10251033',]);
         $sth->execute([
            ':kaiin_no'          => $param['kaiin_no'],
            ':shutokubi'         => $param['shutokubi'],
            ':koshin_user_id'    => $param['user_id'],
         ]);
      } catch (\PDOException $e) {
         $db->rollBack();
         return FALSE;
      }
      return TRUE;
   }

}
