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

    //職業取得
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

    //受験状態区分取得
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

    //試験種別区分取得
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

    //科目選択区分取得
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

    //卒業証明書確認区分取得
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

    //CPRAED確認区分取得
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

    //イベント種別取得
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
	
	//米国会員資格取得
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
}
