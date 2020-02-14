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

    //�E�Ǝ擾
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

    //�󌱏�ԋ敪�擾
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

    //������ʋ敪�擾
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

    //�ȖڑI���敪�擾
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

    //���Əؖ����m�F�敪�擾
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

    //CPRAED�m�F�敪�擾
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

    //�C�x���g��ʎ擾
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
	
	//�č�������i�擾
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
