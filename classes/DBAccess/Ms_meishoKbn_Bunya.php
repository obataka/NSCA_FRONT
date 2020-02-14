<?php

namespace Was;

class Ms_meishoKbn_Bunya
{
    public function __construct()
    { }

    /**
     * @return array|mixed
     */
    public function findByBunya()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 24
            ORDER BY CHILD.meisho_cd");
            $sth->execute();
            $ms_Bunya = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_Bunya = [];
        }

        return $ms_Bunya;
    }
}
