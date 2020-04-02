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

   /*
    * 登録
    * @param array $param
    * @return boolean
    */
   public function insertRec($param)
   {
      $db = Db::getInstance();
      $db->beginTransaction();
      try {
         $sql = <<<SQL
         INSERT
            INTO tb_kaiin_nintei (
                 kaiin_no
               , level_1_ninteibi
               , level_2_ninteibi
               , level_2_point
               , level_2_theme_1
               , level_2_theme_2
               , level_2_theme_3
               , level_2_theme_4
               , level_2_theme_5
               , level_2_theme_6
               , level_3_ninteibi
               , kenteiin_ninteibi
               , kenteiin_yuko_kigembi
               , kenteiin_nintei_koshimbi
               , basic_ninteibi
               , performance_ninteibi
               , athlete_ninteibi
               , coach_ninteibi
               , senior_coach_ninteibi
               , sakujo_flg
               , sakusei_user_id
               , koshin_user_id
               , sakusei_nichiji
               , koshin_nichiji
         )
         VALUES (
                 :kaiin_no
               , :level_1_ninteibi
               , :level_2_ninteibi
               , :level_2_point
               , :level_2_theme_1
               , :level_2_theme_2
               , :level_2_theme_3
               , :level_2_theme_4
               , :level_2_theme_5
               , :level_2_theme_6
               , :level_3_ninteibi
               , :kenteiin_ninteibi
               , :kenteiin_yuko_kigembi
               , :kenteiin_nintei_koshimbi
               , :basic_ninteibi
               , :performance_ninteibi
               , :athlete_ninteibi
               , :coach_ninteibi
               , :senior_coach_ninteibi
               , :sakujo_flg
               , :sakusei_user_id
               , :koshin_user_id
               , :sakusei_nichiji
               , :koshin_nichiji
         );
         SQL;
         $sth = $db->prepare($sql);
         $sth->execute([
               ':kaiin_no' => $param['kaiin_no'],
               ':level_1_ninteibi' => $param['level_1_ninteibi'],
               ':level_2_ninteibi' => $param['level_2_ninteibi'],
               ':level_2_point' => $param['level_2_point'],
               ':level_2_theme_1' => $param['level_2_theme_1'],
               ':level_2_theme_2' => $param['level_2_theme_2'],
               ':level_2_theme_3' => $param['level_2_theme_3'],
               ':level_2_theme_4' => $param['level_2_theme_4'],
               ':level_2_theme_5' => $param['level_2_theme_5'],
               ':level_2_theme_6' => $param['level_2_theme_6'],
               ':level_3_ninteibi' => $param['level_3_ninteibi'],
               ':kenteiin_ninteibi' => $param['kenteiin_ninteibi'],
               ':kenteiin_yuko_kigembi' => $param['kenteiin_yuko_kigembi'],
               ':kenteiin_nintei_koshimbi' => $param['kenteiin_nintei_koshimbi'],
               ':basic_ninteibi' => $param['basic_ninteibi'],
               ':performance_ninteibi' => $param['performance_ninteibi'],
               ':athlete_ninteibi' => $param['athlete_ninteibi'],
               ':coach_ninteibi' => $param['coach_ninteibi'],
               ':senior_coach_ninteibi' => $param['senior_coach_ninteibi'],
               ':sakujo_flg' => $param['sakujo_flg'],
               ':sakusei_user_id' => $param['sakusei_user_id'],
               ':koshin_user_id' => $param['koshin_user_id'],
               ':sakusei_nichiji' => $param['sakusei_nichiji'],
               ':koshin_nichiji' => $param['koshin_nichiji']
         ]);
         $db->commit();
      } catch (\PDOException $e) {
         error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
         $db->rollBack();
         return FALSE;
      }
      return TRUE;
   }

   /*
    * 登録（接続及びトランザクションは外側実施）
    * @param object $db
    * @param array $param
    * @return boolean
    */
   public function insertRec_noTran($db, $param)
   {
      try {
         $sql = <<<SQL
         INSERT
            INTO tb_kaiin_nintei (
                 kaiin_no
               , level_1_ninteibi
               , level_2_ninteibi
               , level_2_point
               , level_2_theme_1
               , level_2_theme_2
               , level_2_theme_3
               , level_2_theme_4
               , level_2_theme_5
               , level_2_theme_6
               , level_3_ninteibi
               , kenteiin_ninteibi
               , kenteiin_yuko_kigembi
               , kenteiin_nintei_koshimbi
               , basic_ninteibi
               , performance_ninteibi
               , athlete_ninteibi
               , coach_ninteibi
               , senior_coach_ninteibi
               , sakujo_flg
               , sakusei_user_id
               , koshin_user_id
               , sakusei_nichiji
               , koshin_nichiji
         )
         VALUES (
                 :kaiin_no
               , :level_1_ninteibi
               , :level_2_ninteibi
               , :level_2_point
               , :level_2_theme_1
               , :level_2_theme_2
               , :level_2_theme_3
               , :level_2_theme_4
               , :level_2_theme_5
               , :level_2_theme_6
               , :level_3_ninteibi
               , :kenteiin_ninteibi
               , :kenteiin_yuko_kigembi
               , :kenteiin_nintei_koshimbi
               , :basic_ninteibi
               , :performance_ninteibi
               , :athlete_ninteibi
               , :coach_ninteibi
               , :senior_coach_ninteibi
               , :sakujo_flg
               , :sakusei_user_id
               , :koshin_user_id
               , :sakusei_nichiji
               , :koshin_nichiji
         );
         SQL;
         $sth = $db->prepare($sql);
         $sth->execute([
               ':kaiin_no' => $param['kaiin_no'],
               ':level_1_ninteibi' => $param['level_1_ninteibi'],
               ':level_2_ninteibi' => $param['level_2_ninteibi'],
               ':level_2_point' => $param['level_2_point'],
               ':level_2_theme_1' => $param['level_2_theme_1'],
               ':level_2_theme_2' => $param['level_2_theme_2'],
               ':level_2_theme_3' => $param['level_2_theme_3'],
               ':level_2_theme_4' => $param['level_2_theme_4'],
               ':level_2_theme_5' => $param['level_2_theme_5'],
               ':level_2_theme_6' => $param['level_2_theme_6'],
               ':level_3_ninteibi' => $param['level_3_ninteibi'],
               ':kenteiin_ninteibi' => $param['kenteiin_ninteibi'],
               ':kenteiin_yuko_kigembi' => $param['kenteiin_yuko_kigembi'],
               ':kenteiin_nintei_koshimbi' => $param['kenteiin_nintei_koshimbi'],
               ':basic_ninteibi' => $param['basic_ninteibi'],
               ':performance_ninteibi' => $param['performance_ninteibi'],
               ':athlete_ninteibi' => $param['athlete_ninteibi'],
               ':coach_ninteibi' => $param['coach_ninteibi'],
               ':senior_coach_ninteibi' => $param['senior_coach_ninteibi'],
               ':sakujo_flg' => $param['sakujo_flg'],
               ':sakusei_user_id' => $param['sakusei_user_id'],
               ':koshin_user_id' => $param['koshin_user_id'],
               ':sakusei_nichiji' => $param['sakusei_nichiji'],
               ':koshin_nichiji' => $param['koshin_nichiji']
         ]);
      } catch (\PDOException $e) {
         error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
         return FALSE;
      }
      return TRUE;
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
            UPDATE tb_kaiin_nintei
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
