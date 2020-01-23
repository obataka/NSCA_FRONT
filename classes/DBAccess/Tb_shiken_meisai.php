<?php

namespace Was;

class Tb_shiken_meisai
{
    public function __construct()
    {
    }

    /**
     * @return array|mixed
     */
    public function findByJukenJotaiKbn($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT shiken_sbt_kbn, juken_jotai_kbn, cbt_saijuken_kbn, kiso_gohi_kbn, jissen_gohi_kbn
            FROM   tb_shiken_meisai
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_juken_jotai = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_juken_jotai = [];
        }
        return $Tb_juken_jotai;
    }

    public function findByShutokuGakui($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT gakui_kbn, sotsugyo_yoteibi, shutoku_gakui_bunya_kbn, shutoku_gakui
            FROM   tb_shiken_meisai
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_juken_jotai = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_juken_jotai = [];
        }
        return $Tb_juken_jotai;
    }

    public function findByShutokuGakuiMeisho()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho
            FROM   ms_meishoKbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 27
            ORDER BY CHILD.meisho_cd");
            $sth->execute();
            $Tb_juken_jotai = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_juken_jotai = [];
        }
        return $Tb_juken_jotai;
    }

    public function findByShutokuGakuiBunya()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT CHILD.meisho_cd, CHILD.meisho
            FROM   ms_meishoKbn MST
            INNER JOIN ms_meisho CHILD
            ON    MST.meisho_id = CHILD.meisho_id
            WHERE MST.meisho_kbn = 28
            ORDER BY CHILD.meisho_cd");
            $sth->execute();
            $Tb_juken_jotai = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_juken_jotai = [];
        }
        return $Tb_juken_jotai;
    }
}
