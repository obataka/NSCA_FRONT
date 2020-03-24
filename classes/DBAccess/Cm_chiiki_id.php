<?php

namespace Was;

class Cm_chiiki_id
{
    public function __construct()
    { }

    /**
     * @return array|mixed
     */
    public function findChiikiList()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT meisho_cd, chiikimei
            FROM  cm_chiiki_id
            ORDER BY meisho_cd;");  
            $sth->execute();
            $ChiikiList = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ChiikiList = [];
        }

        return $ChiikiList;
    }
}
