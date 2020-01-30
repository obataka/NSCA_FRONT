<?php

namespace Was;

class Tb_toreken_joho
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
            FROM  tb_toreken_joho");  
            $sth->execute();
            $tb_toreken_joho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $tb_toreken_joho = [];
        }

        return $tb_toreken_joho;
    }
}
