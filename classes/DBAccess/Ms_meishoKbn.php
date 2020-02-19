<?php

namespace Was;

class Ms_meishoKbn
{
    public function __construct()
    {
    }

    /**
     * @return array|mixed
     */

    //EΖζΎ
    public function findByMeisho()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 23
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //σ±σΤζͺζΎ
    public function findByJukenJotai()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 38
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //±νΚζͺζΎ
    public function findByShikenSbt()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 1
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //ΘΪIπζͺζΎ
    public function findByKamokuSentaku()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 33
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //²ΖΨΎmFζͺζΎ
    public function findBySotsugyoShomeisho()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 3
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //CPRAEDmFζͺζΎ
    public function findByCPRAED()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 5
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //CxgνΚζΎ
    public function findByEvent()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 59
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }
	
	//ΔουiζΎ
    public function findByBeikokuShikaku()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho 
            FROM   ms_meisho_kbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 26
            ORDER BY CHILD.meisho_cd
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }

    //±νΚζΎ
    public function findByShikenSbtKbn($db, $shiken_sbt_kbn)
    {
        try {
            $sth = $db->prepare("SELECT meisho 
            FROM   ms_meisho
            WHERE  meisho_id = 1
            AND    meisho_cd = $shiken_sbt_kbn
            ");
            $sth->execute();
            $ms_meisho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $ms_meisho = [];
        }

        return $ms_meisho;
    }
}
