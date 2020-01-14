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
            $sth = $db->prepare("SELECT * FROM (SELECT DISTINCT tb_ceu_quiz_joho.kanren_kiji_url, tb_ceu_quiz_joho.shutoku_naiyo,
                                tb_ceu_quiz_joho.ceu_id, tb_ceu_quiz_joho_meisai.kaiin_no, ISNULL(tb_ceu_quiz_joho_meisai.gohi_kbn,2),
                                tb_ceu_quiz_joho_meisai.nonyubi, tb_ceu_quiz_joho.keisai_kaishi_kikan, tb_ceu_quiz_joho.keisai_shuryo_kikan,
                                tb_ceu_quiz_joho.sankaryo, ROW_NUMBER() OVER(PARTITION BY tb_ceu_quiz_joho.ceu_id ORDER BY tb_ceu_quiz_joho_meisai.gohi_kbn) ROWNUM
                                FROM tb_ceu_quiz_joho
                                LEFT JOIN tb_ceu_quiz_joho_meisai
                                ON tb_ceu_quiz_joho.ceu_id = tb_ceu_quiz_joho_meisai.ceu_id
                                AND tb_ceu_quiz_joho_meisai.kaiin_no = :kaiin_no
                                AND tb_ceu_quiz_joho_meisai.sakujo_flg = 0
                                AND ((tb_ceu_quiz_joho_meisai.nonyu_hoho_kbn IS NOT NULL)
                                OR (tb_ceu_quiz_joho.sankaryo = 0.00))
                                WHERE tb_ceu_quiz_joho.keisai_kaishi_kikan < now()
                                AND tb_ceu_quiz_joho.keisai_shuryo_kikan > now()
                                ) a
                                WHERE a.ROWNUM = 1
                                ORDER BY tb_ceu_quiz_joho.keisai_kaishi_kikan DESC, tb_ceu_quiz_joho.ceu_id DESC
                                ")                   
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_ceu_quiz_joho = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_ceu_quiz_joho = [];
        }
        return $Tb_ceu_quiz_joho;
    }
}
