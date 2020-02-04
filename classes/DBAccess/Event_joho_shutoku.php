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
    public function findByCeuConferenceJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM  tb_ceu_conference_joho
            WHERE ceu_id = :ceu_id
            ");
            $sth->execute([
                ':ceu_id'                                   => $param['ceu_id'],
            ]);
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }

    public function findByCeuJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM  tb_ceu_joho
            WHERE ceu_id = :ceu_id
            ");
            $sth->execute([
                ':ceu_id'                                   => $param['ceu_id'],
            ]);
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }

    public function findByCeuSokaiJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM  tb_ceu_sokai_joho
            WHERE ceu_id = :ceu_id
            ");
            $sth->execute([
                ':ceu_id'                                   => $param['ceu_id'],
            ]);
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }

    public function findByTorekenJoho($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM  tb_toreken_joho
            WHERE ceu_id = :ceu_id
            ");
            $sth->execute([
                ':ceu_id'                                   => $param['ceu_id'],
            ]);
            $cm_job = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $cm_job = [];
        }

        return $cm_job;
    }
}