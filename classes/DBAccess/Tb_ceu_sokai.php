<?php

namespace Was;

class Tb_ceu_sokai
{
    public function __construct()
    { }

    /**
     * @return array|mixed
     */
    public function findByAllRec()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM  tb_ceu_sokai_joho");  
            $sth->execute();
            $tb_ceu_sokai = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $tb_ceu_sokai = [];
        }

        return $tb_ceu_sokai;
    }
}
