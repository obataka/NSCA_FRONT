<?php
namespace Was;

class Tb_hambai_joho
{
    public function __construct()
    {
    }

    /*
     * 会員番号で、有効な販売情報を返却する
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findSalesListByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("

	SELECT
		tb_hambai_joho.hambai_id,
		tb_hambai_joho.hambai_kbn,
		tb_hambai_joho.hambai_settei_kbn,
--		dbo.csf00010(@tinthambai_settei_kbn,tb_hambai_joho.hambai_settei_kbn) AS 販売設定名称,
		tb_hambai_joho.keiri_shumoku_cd_2,
		ifnull(tb_hambai_joho.shikaku_kbn,0) AS shikaku_kbn,
--		dbo.csf00010(@tintshikaku_kbn,tb_hambai_joho.shikaku_kbn) AS 資格名称,
      	tb_hambai_joho.hambai_title,
		tb_hambai_joho.hambai_title_chuigaki,
		tb_hambai_joho.hambai_title_tsuiki,
		tb_hambai_joho.gaiyo,
		tb_hambai_joho.setsumei,
		tb_hambai_joho.gazo_url,
		tb_hambai_joho.setsumei_gazo_url_1,
		tb_hambai_joho.setsumei_gazo_url_2,
		tb_hambai_joho.setsumei_gazo_url_3,
		tb_hambai_joho.setsumei_gazo_url_4,
		tb_hambai_joho.pdf_url,
		tb_hambai_joho.kaiin_kakaku,
		FLOOR(kaiin_kakaku * zeiritu) AS kaiin_kakaku_zeikomi,
		tb_hambai_joho.ippan_kakaku,
		FLOOR(ippan_kakaku * zeiritu) AS ippan_kakaku_zeikomi,

		tb_hambai_joho.riyo_toroku_kakaku,
		tb_hambai_joho.ninteikosei_kakaku,
		tb_hambai_joho.gakusei_kakaku,
		tb_hambai_joho.nagareyama_shimin_kakaku,

		tb_hambai_joho.menu_sort_jun,
		tb_hambai_joho.hambai_sort_jun
--		dbo.csf00010(@tint販売区分,tb_hambai_joho.販売区分) AS メニュー名
	FROM tb_hambai_joho 
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
	LEFT JOIN tb_kaiin_joho
		ON tb_kaiin_joho.kaiin_no = :kaiin_no
		AND tb_kaiin_joho.sakujo_flg = 0
	LEFT JOIN (
				SELECT 
					SUM(shiken_sbt_kbn) AS shutoku_jokyo
                 FROM tb_kaiin_ceu
				 INNER JOIN cm_control 
				 	ON 1=1
                 WHERE kaiin_no = :kaiin_no
                   AND tb_kaiin_ceu.nendo_id = cm_control.nendo_id
                   AND sakujo_flg = 0
				GROUP BY kaiin_no
			) tb_kaiin_ceu
			ON 1=1
	WHERE tb_hambai_joho.sakujo_flg = 0
		-- 販売中、在庫切れ
		AND (tb_hambai_joho.hambai_settei_kbn = 1 OR tb_hambai_joho.hambai_settei_kbn = 3)
		-- 会員＋CSCSのみ
		AND (((kaiin_sbt_kbn = 1) AND (shutoku_jokyo = 1) 
		AND ((ifnull(shikaku_kbn,0) = 1) OR (ifnull(shikaku_kbn,0) = 2) OR (ifnull(shikaku_kbn,0) = 3) OR (ifnull(shikaku_kbn,0) = 0)))
		-- 会員＋NSCA-CPTのみ
		OR ((kaiin_sbt_kbn = 1) AND (shutoku_jokyo = 2) 
		AND ((ifnull(shikaku_kbn,0) = 1) OR (ifnull(shikaku_kbn,0) = 2) OR (ifnull(shikaku_kbn,0) = 4) OR (ifnull(shikaku_kbn,0) = 0)))
		-- 会員＋両認定
		OR ((kaiin_sbt_kbn = 1) AND (shutoku_jokyo = 3) 
		AND ((ifnull(shikaku_kbn,0) = 1) OR (ifnull(shikaku_kbn,0) = 3) OR (ifnull(shikaku_kbn,0) = 4) OR (ifnull(shikaku_kbn,0) = 5) OR (ifnull(shikaku_kbn,0) = 0)))	-- いずれかの認定は除く
		-- 会員＋資格なし
		OR ((kaiin_sbt_kbn = 1) AND (shutoku_jokyo = 0) 
		AND ((ifnull(shikaku_kbn,0) = 1) OR (ifnull(shikaku_kbn,0) = 0)))
		-- 一般
		OR ((kaiin_sbt_kbn = 0) AND (ifnull(shikaku_kbn,0) = 0)))


	ORDER BY tb_hambai_joho.menu_sort_jun,tb_hambai_joho.hambai_sort_jun
;


            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $hambaiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $hambaiJoho = [];
        }
        return $hambaiJoho;

	}
}
