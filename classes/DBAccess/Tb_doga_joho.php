<?php
namespace Was;

class Tb_doga_joho
{
    public function __construct()
    {
    }

    public function findByDogaJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM   tb_doga_joho
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_kessai_hakko = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_kessai_hakko = [];
        }
        return $Tb_kessai_hakko;
    }
}
