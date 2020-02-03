<?php
namespace Was;

class event_joho_shutoku {
    public function __construct()
    {
    }
    /*
     *
     * @return array|mixed
     */
    public function findByEventJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM :tb_name
            WHERE ceu_id = :ceu_id
            ");
            $sth->execute([
                ':ceu_id'                                   => $param['ceu_id'],
                ':tb_name'                                  => $param['tb_name'],
            ]);
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }
}