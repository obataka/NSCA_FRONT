<?php
namespace Was;

class Tb_hambai_joho
{
    public function __construct()
    {
    }

    /*
     * 会員番号で、有効な販売情報一覧を返却する
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findSalesListByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("

 SELECT * 
 FROM(
	SELECT
		tb_hambai_joho.hambai_id,
		tb_hambai_joho.shurui,
		tb_hambai_joho.hambai_kbn,
--		tb_hambai_joho.hambai_settei_kbn,
--		tb_hambai_joho.keiri_shumoku_cd_2,
--		ifnull(tb_hambai_joho.shikaku_kbn,0) AS shikaku_kbn,
      	tb_hambai_joho.hambai_title,
		ifnull(tb_hambai_joho.hambai_title_chuigaki,'') AS hambai_title_chuigaki,
		tb_hambai_joho.hambai_title_tsuiki,
		tb_hambai_joho.gaiyo,
		tb_hambai_joho.setsumei,
		tb_hambai_joho.gazo_url,

	-- 会員種別などにより取得する価格を設定（一般・正会員・学生会員・利用登録・流山市民）
		CASE 
			WHEN kaiin_no IS NULL THEN FLOOR(ippan_kakaku * zeiritu)                     -- 一般（登録なし）
			WHEN nagareyama_shimin = 1 THEN FLOOR(nagareyama_shimin_kakaku * zeiritu)   -- 流山市民
			WHEN kaiin_sbt_kbn = 1 THEN FLOOR(kaiin_kakaku * zeiritu)                    -- 正会員
			WHEN kaiin_sbt_kbn = 0 THEN FLOOR(riyo_toroku_kakaku * zeiritu)              -- 利用登録（無料）
			WHEN kaiin_sbt_kbn = 2 THEN FLOOR(gakusei_kakaku * zeiritu)                  -- 学生会員
		ELSE 0
		END AS kakaku_zeikomi,

		CASE 
			WHEN kaiin_no IS NULL THEN '一般'                   -- 一般（登録なし）
			WHEN nagareyama_shimin = 1 THEN '流山市民'             -- 流山市民
			WHEN kaiin_sbt_kbn = 1 THEN '会員'                  -- 正会員
			WHEN kaiin_sbt_kbn = 0 THEN '利用登録'              -- 利用登録（無料）
			WHEN kaiin_sbt_kbn = 2 THEN '学生'                  -- 学生会員
		ELSE 0
		END AS kakaku_title,

		-- 一般の場合会員価格も表示する
		FLOOR(kaiin_kakaku * zeiritu) AS kaiin_kakaku_zeikomi,
		'会員' AS kaiin_kakaku_title,

		tb_hambai_joho.menu_sort_jun,
		tb_hambai_joho.hambai_sort_jun,
		kaiin_sbt_kbn,
		ifnull(shutoku_jokyo,0) AS shutoku_jokyo,
		tb_hambai_joho_seigen_shikaku_nashi.meisho_cd AS hyoji_seigen,
		tb_hambai_joho_seigen_shikaku_ari.meisho_cd AS hyoji_seigen_shikaku
	FROM tb_hambai_joho 
	LEFT JOIN tb_hambai_joho_seigen AS tb_hambai_joho_seigen_shikaku_nashi
			ON tb_hambai_joho.hambai_id = tb_hambai_joho_seigen_shikaku_nashi.hambai_id
			AND tb_hambai_joho_seigen_shikaku_nashi.sakujo_flg = 0
			AND tb_hambai_joho_seigen_shikaku_nashi.seigen_kbn = 0                        -- 表示制限
			AND tb_hambai_joho_seigen_shikaku_nashi.meisho_cd < 4                        -- 資格認定
	LEFT JOIN tb_hambai_joho_seigen AS tb_hambai_joho_seigen_shikaku_ari
			ON tb_hambai_joho_seigen_shikaku_nashi.hambai_id = tb_hambai_joho_seigen_shikaku_ari.hambai_id
			AND tb_hambai_joho_seigen_shikaku_ari.sakujo_flg = 0
			AND tb_hambai_joho_seigen_shikaku_ari.seigen_kbn = 0                        -- 表示制限
			AND tb_hambai_joho_seigen_shikaku_ari.meisho_cd = 4                        -- 資格認定
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
		-- 掲載期間
		AND tb_hambai_joho.keisai_kikan_kaishi <= now()
		AND tb_hambai_joho.keisai_kikan_shuryo >= now()

 )	hanbai_joho
WHERE 
-- 一般(未ログイン)
(hyoji_seigen = 1 AND :kaiin_no = '')
-- 登録会員・資格なし
OR (hyoji_seigen = 2 AND hyoji_seigen_shikaku IS NULL AND kaiin_sbt_kbn = 0)
-- 登録会員・資格あり
OR (hyoji_seigen = 2 AND hyoji_seigen_shikaku IS NOT NULL AND kaiin_sbt_kbn = 0 AND shutoku_jokyo > 0)
-- 会員・資格なし
OR (hyoji_seigen = 3 AND hyoji_seigen_shikaku IS NULL AND kaiin_sbt_kbn = 1)
-- 会員・資格あり
OR (hyoji_seigen = 3 AND hyoji_seigen_shikaku IS NOT NULL AND kaiin_sbt_kbn = 1 AND shutoku_jokyo > 0)

ORDER BY menu_sort_jun,hambai_sort_jun

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

    /*
     * 販売IDで、有効な販売情報を返却する
     * @param varchar $hambai_id
     * @return array|mixed
     */
    public function findProductByHambaiId($hambai_id,$kaiin_no)
    {

        try {
            $db = Db::getInstance();
            $sth = $db->prepare("

 SELECT * 
 FROM(
	SELECT
		tb_hambai_joho.hambai_id,
		tb_hambai_joho.shurui,
		tb_hambai_joho.hambai_kbn,
--		tb_hambai_joho.hambai_settei_kbn,
--		tb_hambai_joho.keiri_shumoku_cd_2,
--		ifnull(tb_hambai_joho.shikaku_kbn,0) AS shikaku_kbn,
      	tb_hambai_joho.hambai_title,
		ifnull(tb_hambai_joho.hambai_title_chuigaki,'') AS hambai_title_chuigaki,
		tb_hambai_joho.hambai_title_tsuiki,
		ifnull(tb_hambai_joho.gaiyo,'') AS gaiyo,
		ifnull(tb_hambai_joho.setsumei,'') AS setsumei,
		tb_hambai_joho.gazo_url,
		tb_hambai_joho.setsumei_gazo_url_1,
		tb_hambai_joho.setsumei_gazo_url_2,
		tb_hambai_joho.setsumei_gazo_url_3,
		tb_hambai_joho.setsumei_gazo_url_4,

	-- 会員種別などにより取得する価格を設定（一般・正会員・学生会員・利用登録・流山市民）
		CASE 
			WHEN kaiin_no IS NULL THEN FLOOR(ippan_kakaku * zeiritu)                     -- 一般（登録なし）
			WHEN nagareyama_shimin = 1 THEN FLOOR(nagareyama_shimin_kakaku * zeiritu)   -- 流山市民
			WHEN kaiin_sbt_kbn = 1 THEN FLOOR(kaiin_kakaku * zeiritu)                    -- 正会員
			WHEN kaiin_sbt_kbn = 0 THEN FLOOR(riyo_toroku_kakaku * zeiritu)              -- 利用登録（無料）
			WHEN kaiin_sbt_kbn = 2 THEN FLOOR(gakusei_kakaku * zeiritu)                  -- 学生会員
		ELSE 0
		END AS kakaku_zeikomi,

		CASE 
			WHEN kaiin_no IS NULL THEN '一般'                   -- 一般（登録なし）
			WHEN nagareyama_shimin = 1 THEN '流山市民'             -- 流山市民
			WHEN kaiin_sbt_kbn = 1 THEN '会員'                  -- 正会員
			WHEN kaiin_sbt_kbn = 0 THEN '利用登録'              -- 利用登録（無料）
			WHEN kaiin_sbt_kbn = 2 THEN '学生'                  -- 学生会員
		ELSE 0
		END AS kakaku_title,

		-- 一般の場合会員価格も表示する
		FLOOR(kaiin_kakaku * zeiritu) AS kaiin_kakaku_zeikomi,
		'会員' AS kaiin_kakaku_title,

		FLOOR(ippan_kakaku * zeiritu) AS ippan_kakaku_zeikomi,
		tb_hambai_joho.menu_sort_jun,
		tb_hambai_joho.hambai_sort_jun,
		kaiin_sbt_kbn,
		ifnull(shutoku_jokyo,0) AS shutoku_jokyo,
		tb_hambai_joho_seigen_shikaku_nashi.meisho_cd AS hyoji_seigen,
		tb_hambai_joho_seigen_shikaku_ari.meisho_cd AS hyoji_seigen_shikaku
	FROM tb_hambai_joho 
	LEFT JOIN tb_hambai_joho_seigen AS tb_hambai_joho_seigen_shikaku_nashi
			ON tb_hambai_joho.hambai_id = tb_hambai_joho_seigen_shikaku_nashi.hambai_id
			AND tb_hambai_joho_seigen_shikaku_nashi.sakujo_flg = 0
			AND tb_hambai_joho_seigen_shikaku_nashi.seigen_kbn = 0                        -- 表示制限
			AND tb_hambai_joho_seigen_shikaku_nashi.meisho_cd < 4                        -- 資格認定
	LEFT JOIN tb_hambai_joho_seigen AS tb_hambai_joho_seigen_shikaku_ari
			ON tb_hambai_joho_seigen_shikaku_nashi.hambai_id = tb_hambai_joho_seigen_shikaku_ari.hambai_id
			AND tb_hambai_joho_seigen_shikaku_ari.sakujo_flg = 0
			AND tb_hambai_joho_seigen_shikaku_ari.seigen_kbn = 0                        -- 表示制限
			AND tb_hambai_joho_seigen_shikaku_ari.meisho_cd = 4                        -- 資格認定
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
		AND tb_hambai_joho.hambai_id = :hambai_id
		-- 掲載期間
		AND tb_hambai_joho.keisai_kikan_kaishi <= now()
		AND tb_hambai_joho.keisai_kikan_shuryo >= now()

 )	hanbai_joho
WHERE 
-- 一般(未ログイン)
(hyoji_seigen = 1 AND :kaiin_no = '')
-- 登録会員・資格なし
OR (hyoji_seigen = 2 AND hyoji_seigen_shikaku IS NULL AND kaiin_sbt_kbn = 0)
-- 登録会員・資格あり
OR (hyoji_seigen = 2 AND hyoji_seigen_shikaku IS NOT NULL AND kaiin_sbt_kbn = 0 AND shutoku_jokyo > 0)
-- 会員・資格なし
OR (hyoji_seigen = 3 AND hyoji_seigen_shikaku IS NULL AND kaiin_sbt_kbn = 1)
-- 会員・資格あり
OR (hyoji_seigen = 3 AND hyoji_seigen_shikaku IS NOT NULL AND kaiin_sbt_kbn = 1 AND shutoku_jokyo > 0)

;

            ");
            $sth->execute([
				':hambai_id' => $hambai_id
				,':kaiin_no' => $kaiin_no
			]);
            $hambaiJoho  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $hambaiJoho = [];
        }
        return $hambaiJoho;



	}

}
