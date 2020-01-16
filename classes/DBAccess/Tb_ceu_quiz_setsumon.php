<?php
namespace Was;

class Tb_ceu_quiz_setsumon
{
    public function __construct()
    {
    }

    public function findByQuizSetsumon($param)
    {
        try {
            // DB接続
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT
            tb_ceu_quiz_joho.shutoku_naiyo
           ,tb_ceu_quiz_setsumon.setsumon_no
           ,tb_ceu_quiz_setsumon.setsumon
           ,tb_ceu_quiz_joho.sentakushisu
           ,tb_ceu_quiz_setsumon.sentakushi_a
           ,tb_ceu_quiz_setsumon.sentakushi_b
           ,tb_ceu_quiz_setsumon.sentakushi_c
           ,tb_ceu_quiz_setsumon.sentakushi_d
           ,tb_ceu_quiz_setsumon.kaito_kbn
           ,tb_ceu_quiz_joho.category_kbn
            FROM tb_ceu_quiz_setsumon
            LEFT JOIN tb_ceu_quiz_joho
            ON tb_ceu_quiz_setsumon.ceu_id = tb_ceu_quiz_setsumon.ceu_id
            WHERE tb_ceu_quiz_setsumon.ceu_id = :ceu_id
            ORDER BY tb_ceu_quiz_setsumon.setsumon_no
           ");
            $sth->execute([':ceu_id' => $param['ceu_id'],]);
            $Tb_ceu_quiz_setsumon = $sth->fetchAll();
            error_log(print_r($Tb_ceu_quiz_setsumon, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_select22_log.txt');
        } catch (\PDOException $e) {
            $Tb_ceu_quiz_setsumon = [];
        }
        return $Tb_ceu_quiz_setsumon;
    }
}
