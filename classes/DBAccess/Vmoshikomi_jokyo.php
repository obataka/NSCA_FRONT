<?php
namespace Was;

class Vmoshikomi_jokyo
{
    public function __construct()
    {
    }

    /*
     * 会員番号から申込状況を取得する（マイページ表示用）
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT *
	FROM (
		
		SELECT 
			detail.ceu_id,
			detail.shutoku_naiyo,
			detail.ceu_meisai_id,
			detail.kaiin_no,
			purch.id,
			ifnull(purch.nonyubi,detail.nonyubi)	AS nonyubi,
			issue.settleno,
			issue.kessai_kekka,
			issue.status,
			issue.koshin_user_id,
			issue.pay_type_specify,
			issue.koshin_nichiji,
--			@dtm取得日時						AS 取得日時,
			detail.etc_id,
			detail.etc_meisai_id,
			detail.moshikomi_go_annai_url,
			detail.staff_kbn,
			detail.cancel_shimekiribi,
			detail.gohi_kbn,
			detail.event_kbn,
			detail.nonyu_hoho_kbn,
			detail.hasso_dempyo_no,
			buppan_kbn
		FROM vwmoshikomi_jokyo detail		
		LEFT JOIN tb_keiri_joho purch
		ON	((detail.ceu_id		= purch.ceu_id 
			AND detail.ceu_meisai_id	= purch.ceu_meisai_id)	-- CEU関連
			OR(detail.etc_id			= purch.etc_id
			AND detail.etc_meisai_id	= purch.etc_meisai_id)	-- 販売関連
			OR(detail.id			= purch.id))		        -- 会費関連
			AND detail.kaiin_no		= purch.kaiin_no 
			AND purch.sakujo_flg	= 0
			AND purch.nonyu_hoho_kbn	IS NOT NULL			    -- GMO申込途中中止を除外
		LEFT JOIN tb_kessai_hakko issue
		ON	((detail.ceu_id		= detail.ceu_id 
			AND issue.ceu_meisai_id	= detail.ceu_meisai_id)		-- CEU関連
			OR(issue.etc_id			= detail.etc_id 
			AND issue.etc_meisai_id	= detail.etc_meisai_id)		-- 販売関連
			OR(issue.id			= detail.id))			        -- 会費関連
			AND issue.kaiin_no		= detail.kaiin_no 
	  		AND purch.id			= issue.id 
	  		AND issue.sakujo_flg	= 0
		  WHERE	detail.event_kbn	NOT IN (40, 10, 41, 42, 60)																	-- 非表示データ 40:会費 10:パーソナルディブロップメント 41:CEU報告 42:パーソナルデベロップメント
			AND ((detail.event_kbn IN (3, 50)) OR (DATE_FORMAT(sysdate(),'%Y%m%d') <= DATE_FORMAT(detail.ceu_shutokubi,'%Y%m%d')))	-- CEU取得日が現在または未来(クイズ、動画購入以外)
			AND ((detail.event_kbn NOT IN (50)) OR (detail.nonyubi IS NULL))													-- 動画購入は未納入の物だけを表示
			AND ((purch.keiri_shumoku_cd_1 IS NULL) OR (purch.keiri_shumoku_cd_1 <> '12'))													-- 返金済みは表示しない
			AND detail.kaiin_no		= :kaiin_no

		UNION ALL

		-- 会費・CEU報告・英文オプション
		SELECT 
			vwmoshikomi_jokyo.ceu_id,
			shutoku_naiyo,
			vwmoshikomi_jokyo.ceu_meisai_id,
			vwmoshikomi_jokyo.kaiin_no,
			vwmoshikomi_jokyo.id,
			ifnull(nonyubi,nonyubi)	AS nonyubi,
			settleno,
			kessai_kekka,
			status,
			koshin_user_id,
			pay_type_specify,
			koshin_nichiji,
--			@dtm取得日時			AS 取得日時,
			vwmoshikomi_jokyo.etc_id,
			vwmoshikomi_jokyo.etc_meisai_id,
			moshikomi_go_annai_url,
			staff_kbn,
			cancel_shimekiribi,
			gohi_kbn,
			event_kbn,
			nonyu_hoho_kbn,
			vwmoshikomi_jokyo.hasso_dempyo_no,
			buppan_kbn
		FROM vwmoshikomi_jokyo
		LEFT JOIN tb_kessai_hakko
			ON vwmoshikomi_jokyo.id=tb_kessai_hakko.id
		WHERE event_kbn IN (40,41,42)
		  AND nonyubi IS NULL
		  AND vwmoshikomi_jokyo.kaiin_no		= :kaiin_no

		UNION ALL

		-- 物販
		SELECT 
			vwmoshikomi_jokyo.ceu_id,
			shutoku_naiyo,
			vwmoshikomi_jokyo.ceu_meisai_id,
			vwmoshikomi_jokyo.kaiin_no,
			vwmoshikomi_jokyo.id,
			ifnull(nonyubi,nonyubi)	AS nonyubi,
			settleno,
			kessai_kekka,
			status,
			koshin_user_id,
			pay_type_specify,
			koshin_nichiji,
--			@dtm取得日時			AS 取得日時,
			vwmoshikomi_jokyo.etc_id,
			vwmoshikomi_jokyo.etc_meisai_id,
			moshikomi_go_annai_url,
			staff_kbn,
			cancel_shimekiribi,
			gohi_kbn,
			event_kbn,
			nonyu_hoho_kbn,
			vwmoshikomi_jokyo.hasso_dempyo_no,
			buppan_kbn
		FROM vwmoshikomi_jokyo
		LEFT JOIN tb_kessai_hakko
			ON vwmoshikomi_jokyo.id=tb_kessai_hakko.id
		WHERE event_kbn = 60
		  AND vwmoshikomi_jokyo.kaiin_no		= :kaiin_no

	) AS tb申込
	ORDER BY nonyubi,id
;
            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinJoho = [];
        }
        return $kaiinJoho;
    }


}
