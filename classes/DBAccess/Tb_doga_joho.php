<?php
namespace Was;

class Tb_doga_joho
{
    public function __construct()
    {
    }

    public function findByDogaJoho()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM   tb_doga_joho
            ");
            $sth->execute();
            $Tb_kessai_hakko = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_kessai_hakko = [];
        }
        return $Tb_kessai_hakko;
    }

    public function findOnSaleDogaJoho()
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT 
				doga_id
				, event_kbn
				, doga_title
				, gaiyo
				, umekomi_tag
				, hyoji_gazo_url
				, sample_doga_url
				, kakaku
				, FLOOR(kakaku * zeiritu) AS kakaku_zeikomi
            FROM   tb_doga_joho
			LEFT JOIN (
					SELECT 
				 CASE 
					WHEN kirikae_nengappi_1 IS NULL OR now() < kirikae_nengappi_1 THEN 1 + zei_1
					WHEN kirikae_nengappi_2 IS NULL OR now() < kirikae_nengappi_2 THEN 1 + zei_2
					WHEN now() > kirikae_nengappi_2 THEN 1 + zei_3
				 END AS zeiritu
				 , nendo_id
				FROM cm_control
				) cm_control
				ON 1=1
			WHERE sakujo_flg = 0
				AND hambai_shuryo_settei_kbn <> 1 
				AND hambai_kaishi <= now()
				AND hambai_shuryo >= now()
            ");
            $sth->execute();
            $Tb_doga_joho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_doga_joho = [];
        }
        return $Tb_doga_joho;
    }

}
