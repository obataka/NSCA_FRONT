<?php

namespace Was;

class Tb_kyujin_joho
{
    public function __construct()
    { }

    /**
     * マイページ画面に表示する掲載期間内のデータを取得する
     * ソート順：新着区分（降順）、掲載開始期間（降順）、ID（降順）
     * @param int $page_no
     * @return array|mixed
     */
    public function findShowData($page_no)
    {
	error_log(print_r($start_row, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka4_log.txt');

        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT 
				  kyujin_title        AS naiyo
				, kyujin_shosai_url AS url
				, shinchaku_kbn     AS shinchaku
				, betsu_wind_kbn    AS betsugamen
				, size_shitei_kbn
				, yokohaba
				, tatehaba
            FROM  tb_kyujin_joho
			WHERE sakujo_flg = 0
				AND kesai_kashi_kikan <= now() AND keisai_shuryo_kikan >= now()
			ORDER BY shinchaku_kbn DESC,kesai_kashi_kikan DESC, id DESC;
			");  
            $sth->execute();
           $tb_kyujin_joho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $tb_kyujin_joho = [];
        }

        return $tb_kyujin_joho;
    }
}
