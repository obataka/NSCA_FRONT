<?php
namespace Was;

class Ms_meishoKbn_Shikaku
{
    public function __construct()
    {
    }

    /**
     * @return array|mixed
     */
    public function findByShikaku()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meishoKbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 22
            ORDER BY CHILD.meisho_cd;
            ");
            $sth->execute();
            $ms_shikaku = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $ms_shikaku = [];
        }

        return $ms_shikaku;
    }
}