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


    /*
     * 会員番号で、有効な動画情報一覧を返却する（購入済みは除く）
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findSalesList($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	-- 配信中の動画
	SELECT tb_haishintyu.*
	FROM (
		-- 販売終了日設定しないタイプ
		SELECT
			tb_doga_joho.doga_id,
			tb_doga_joho.doga_title,
			tb_doga_joho.hyoji_gazo_url,
			tb_doga_joho.sample_doga_url,
			REPLACE(REPLACE(tb_doga_joho.gaiyo, CHAR(13), ''), CHAR(10), '</br>')  AS gaiyo,
			tb_doga_joho.kakaku,
			tb_doga_joho.hambai_shuryo_settei_kbn,
			DATE_FORMAT(tb_doga_joho.hambai_kaishi, '%Y/%m/%d') AS hambai_kaishi,
			DATE_FORMAT(tb_doga_joho.hambai_shuryo, '%Y/%m/%d') AS hambai_shuryo
		FROM tb_doga_joho
		WHERE tb_doga_joho.sakujo_flg = 0
		  AND tb_doga_joho.hambai_shuryo_settei_kbn = 1
		  AND tb_doga_joho.hambai_kaishi <= now()

		UNION 

		-- 販売終了日を設定するタイプ
			SELECT
			tb_doga_joho.doga_id,
			tb_doga_joho.doga_title,
			tb_doga_joho.hyoji_gazo_url,
			tb_doga_joho.sample_doga_url,
			REPLACE(REPLACE(tb_doga_joho.gaiyo, CHAR(13), ''), CHAR(10), '</br>')  AS gaiyo,
			tb_doga_joho.kakaku,
			tb_doga_joho.hambai_shuryo_settei_kbn,
			DATE_FORMAT(tb_doga_joho.hambai_kaishi, '%Y/%m/%d') AS hambai_kaishi,
			DATE_FORMAT(tb_doga_joho.hambai_shuryo, '%Y/%m/%d') AS hambai_shuryo
		FROM tb_doga_joho
		WHERE tb_doga_joho.sakujo_flg = 0
		  AND tb_doga_joho.hambai_shuryo_settei_kbn = 2
		  AND now() BETWEEN	tb_doga_joho.hambai_kaishi AND tb_doga_joho.hambai_shuryo

	) AS tb_haishintyu
	LEFT JOIN (
		-- 会員が視聴中の動画のID
		SELECT doga_id
		FROM tb_doga_konyusha_meisai
		WHERE kaiin_no=:kaiin_no
		  AND ((shicho_shuryobi IS NULL) OR (shicho_shuryobi >= now()))   -- 入金が完了していない/視聴が終了してない
		  AND nonyu_hoho_kbn IS NOT NULL
		  AND sakujo_flg = 0
		GROUP BY doga_id
	) AS tb_shityotyu
		ON tb_haishintyu.doga_id = tb_shityotyu.doga_id
	WHERE tb_shityotyu.doga_id IS NULL
	ORDER BY tb_haishintyu.doga_title
            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $Tb_doga_joho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_doga_joho = [];
        }
        return $Tb_doga_joho;
    }
}
