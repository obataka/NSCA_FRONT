<?php
namespace Was;

class Cm_job {
    public function __construct()
    {
    }
    /*
     *
     * @return array|mixed
     */
    public function findByJob()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd,CHILD.meisho
            FROM   ms_meishoKbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 23
            ORDER BY CHILD.meisho_cd;
            ");
            $sth->execute();
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }
}