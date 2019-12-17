<?php

namespace Was;

class Ms_meishoKbn_Area
{
    public function __construct()
    { }

    /**
     * @return array|mixed
     */
    public function findByArea()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT meisho_cd, chiikimei
            FROM  cm_chiiki_id
            ORDER BY meisho_cd;");  
            $sth->execute();
            $ms_Area = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_Area = [];
        }

        return $ms_Area;
    }
}
