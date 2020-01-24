<?php
namespace Was;

class Tb_ceu_quiz_joho
{
    public function __construct()
    {
    }

    public function findByQuizjoho($param)
    {
        try {
            // DB接続
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
        FROM
            (
                SELECT DISTINCT
                    tb_ceu_quiz_joho.kanren_kiji_url,
                    tb_ceu_quiz_joho.shutoku_naiyo,
                    tb_ceu_quiz_joho.ceu_id,
                    tb_ceu_quiz_joho_meisai.kaiin_no,
                    CASE
                        WHEN tb_ceu_quiz_joho_meisai.gohi_kbn IS NULL THEN 2
                        ELSE tb_ceu_quiz_joho_meisai.gohi_kbn
                    END gohi_kbn,
                    tb_ceu_quiz_joho_meisai.nonyubi,
                    tb_ceu_quiz_joho.keisai_kaishi_kikan,
                    tb_ceu_quiz_joho.keisai_shuryo_kikan,
                    tb_ceu_quiz_joho.sankaryo
                FROM
                    tb_ceu_quiz_joho
                    LEFT JOIN tb_ceu_quiz_joho_meisai
                    ON  tb_ceu_quiz_joho.ceu_id = tb_ceu_quiz_joho_meisai.ceu_id
                    AND tb_ceu_quiz_joho_meisai.kaiin_no = :kaiin_no
                    AND tb_ceu_quiz_joho_meisai.sakujo_flg = 0
                    AND ((tb_ceu_quiz_joho_meisai.nonyu_hoho_kbn IS NOT NULL) OR
                         (tb_ceu_quiz_joho.sankaryo = 0.00))
                WHERE
                    tb_ceu_quiz_joho.keisai_kaishi_kikan < now()
                AND tb_ceu_quiz_joho.keisai_shuryo_kikan > now()
                ORDER BY tb_ceu_quiz_joho_meisai.ceu_quiz_meisai_id DESC
            ) a
        ORDER BY
            a.keisai_kaishi_kikan DESC,
            a.ceu_id DESC");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_ceu_quiz_joho = $sth->fetchAll();
            error_log(print_r($Tb_ceu_quiz_joho, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanihara_select_log.txt');
        } catch (\PDOException $e) {
            $Tb_ceu_quiz_joho = [];
        }
        return $Tb_ceu_quiz_joho;
    }



    public function GetByQuizjoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT tb_ceu_quiz_joho.shutoku_naiyo, tb_ceu_quiz_joho.sankaryo FROM tb_ceu_quiz_joho 
                                 WHERE tb_ceu_quiz_joho.ceu_id	= :ceu_id");
            $sth->execute([':ceu_id' => $param['ceu_id'],]);
            $Tb_ceu_quiz_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_ceu_quiz_joho = [];
        }
        return $Tb_ceu_quiz_joho;
    }


    public function GetByQuizAnswer($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT tb_ceu_quiz_joho.shutoku_naiyo, tb_ceu_quiz_setsumon.setsumon_no, tb_ceu_quiz_setsumon.setsumon, tb_ceu_quiz_joho.sentakushisu,
                                        tb_ceu_quiz_setsumon.sentakushi_a, tb_ceu_quiz_setsumon.sentakushi_b, tb_ceu_quiz_setsumon.sentakushi_c, tb_ceu_quiz_setsumon.sentakushi_d,
                                        tb_ceu_quiz_setsumon.kaito_kbn, tb_ceu_quiz_joho.category_kbn
                                 FROM 
                                        tb_ceu_quiz_joho
                                 LEFT JOIN
                                        tb_ceu_quiz_setsumon
                                 ON
                                        tb_ceu_quiz_joho.ceu_id = tb_ceu_quiz_setsumon.ceu_id   
                                 WHERE 
                                        tb_ceu_quiz_joho.ceu_id	= :ceu_id
                                 ORDER BY      
                                        tb_ceu_quiz_setsumon.setsumon_no
                                ");
                                

            $sth->execute([':ceu_id' => $param['ceu_id'],]);
            $Tb_ceu_quiz_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_ceu_quiz_joho = [];
        }
        return $Tb_ceu_quiz_joho;
    }







}
