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
                 joho.shutoku_naiyo
                ,setsumon.setsumon_no
                ,setsumon.setsumon
                ,joho.sentakushisu
                ,setsumon.sentakushi_a
                ,setsumon.sentakushi_b
                ,setsumon.sentakushi_c
                ,setsumon.sentakushi_d
                ,setsumon.kaito_kbn
                ,joho.category_kbn
            FROM tb_ceu_quiz_joho joho
            LEFT JOIN tb_ceu_quiz_setsumon setsumon
                ON joho.ceu_id = setsumon.ceu_id
                AND setsumon.sakujo_flg = 0
            WHERE joho.ceu_id =  :ceu_id
                AND joho.sakujo_flg = 0
            ORDER BY setsumon.setsumon_no
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
