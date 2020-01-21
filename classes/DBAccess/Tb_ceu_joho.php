<?php
namespace Was;

class Tb_ceu_joho
{
    public function __construct()
    {
    }

    /*
     * 会員番号から有効なイベント情報（未申込）を取得する（マイページ表示用）
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNoMimoshikomi($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
-- セミナー（総会含む）・トレ検・カンファレンス

		-- ■■■　セミナー　■■■
			SELECT 
				tb_ceu_joho.ceu_id
				, shutoku_naiyo
				, moshikomi_mae_annai_url
				, event_kbn
				, shutokubi
			FROM tb_ceu_joho
			LEFT JOIN (
						SELECT ceu_id
							   , COUNT(*) AS sanka_ninzu
						FROM tb_ceu_joho_meisai 
						WHERE sakujo_flg =0 
						  AND (staff_kbn = 0 OR staff_kbn IS NULL )	 -- スタッフ以外
						  AND nonyu_hoho_kbn IS NOT NULL	-- 納入方法区分がない場合は参加者に数えない
						GROUP BY  ceu_id
						) AS ceu_sanka_ninzu
				ON tb_ceu_joho.ceu_id = ceu_sanka_ninzu.ceu_id
			LEFT JOIN (
				-- 会員が参加するイベントを返却
				SELECT ceu_id
				FROM tb_ceu_joho_meisai
				WHERE sakujo_flg	= 0
				  AND kaiin_no		= :kaiin_no
				  AND nonyu_hoho_kbn IS NOT NULL
			) AS tb_sanka_ceu
				ON tb_ceu_joho.ceu_id		= tb_sanka_ceu.ceu_id
			WHERE tb_ceu_joho.sakujo_flg	= 0
			  AND keisai_kaishi_kikan		<= now()
			  AND keisai_shuryo_kikan		>= now()
			  AND event_shurui_kbn <> 3                     -- トレ検以外
			  AND tb_sanka_ceu.ceu_id	IS NULL            -- 参加していないセミナーのみ返却
			  AND event_kbn			<> 10                  -- パーソナルデベロップメントは表示しない
			  AND (teiinsu IS NULL OR teiinsu > ifnull(sanka_ninzu,0))       -- 空席あり

			UNION

		-- ■■■　トレ検　■■■
			SELECT 
				tb_toreken.ceu_id
				,shutoku_naiyo
				,moshikomi_mae_annai_url
				,event_kbn
				,shutokubi
			FROM (
				SELECT 
					tb_ceu_joho.ceu_id,
					CONCAT(tb_ceu_joho.shutoku_naiyo , ' ' , meisho_kyu_kbn.meisho) AS shutoku_naiyo,
					moshikomi_mae_annai_url,
					event_kbn,
					shutokubi,
					CASE 
						WHEN tb_toreken_jisshi_shosai.teiinsu > ifnull(sankasya,0) THEN 0
						ELSE 1
					END AS kuuseki,
					tb_toreken_jisshi_shosai.jisshi_no,
					keisai_kaishi_kikan,
					keisai_shuryo_kikan
				FROM tb_ceu_joho
				LEFT JOIN tb_toreken_jisshi_shosai
					ON tb_ceu_joho.ceu_id = tb_toreken_jisshi_shosai.ceu_id
				LEFT JOIN (
					SELECT ceu_id,jisshi_no,COUNT(*) AS sankasya
					FROM tb_ceu_joho_meisai 
					WHERE staff_kbn =0
					  AND sakujo_flg=0
					  AND nonyu_hoho_kbn IS NOT NULL
					GROUP BY ceu_id,jisshi_no
						) AS tb_toreken_sankasya
					ON tb_ceu_joho.ceu_id = tb_toreken_sankasya.ceu_id
					AND  tb_toreken_jisshi_shosai.jisshi_no = tb_toreken_sankasya.jisshi_no
				-- 名称取得（会員種別）
				LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho 
						WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
					    AND meisho_kbn = 58)  meisho_kyu_kbn
					ON meisho_kyu_kbn.meisho_cd = tb_ceu_joho.kyu_kbn
				WHERE tb_ceu_joho.sakujo_flg = 0
				  AND event_shurui_kbn = 3
				  AND tb_toreken_jisshi_shosai.sakujo_flg = 0
			) AS tb_toreken
			LEFT JOIN (
				-- 会員が参加するイベントを返却
				SELECT ceu_id
				FROM tb_ceu_joho_meisai
				WHERE sakujo_flg	= 0
					AND kaiin_no	= kaiin_no
					AND nonyu_hoho_kbn IS NOT NULL
			) AS tb_sanka_toreken
				ON tb_toreken.ceu_id		= tb_sanka_toreken.ceu_id
			WHERE keisai_kaishi_kikan			<= now()
			  AND keisai_shuryo_kikan			>= now()
			  AND tb_sanka_toreken.ceu_id	IS NULL -- 参加していないセミナーのみ返却
			  AND tb_toreken.kuuseki = 0
			GROUP BY 
				tb_toreken.ceu_id
				,shutoku_naiyo
				,moshikomi_mae_annai_url
				,event_kbn
				,shutokubi

			UNION

		-- ■■■　カンファレンス　■■■
		SELECT 
			tb_ceu_conference_joho.ceu_id,
			tb_ceu_conference_joho.shutoku_naiyo,
			tb_ceu_conference_joho.moshikomi_mae_annai_url,
			tb_ceu_conference_joho.event_kbn,
			tb_ceu_conference_joho.shutokubi
		FROM tb_ceu_conference_joho
		LEFT JOIN (
			-- カンファレンスに参加している
			SELECT ceu_id
			FROM tb_ceu_conference_joho_meisai
			WHERE sakujo_flg	= 0
				AND kaiin_no	= kaiin_no
				AND nonyu_hoho_kbn IS NOT NULL
		) AS tb_sanka_conference
			ON tb_ceu_conference_joho.ceu_id=tb_sanka_conference.ceu_id
		WHERE keisai_kaishi_kikan			<= now()
		  AND keisai_shuryo_kikan			>= now()
		  AND sakujo_flg					= 0
		  AND tb_sanka_conference.ceu_id	IS NULL
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

    /*
     * 会員番号から有効なイベント情報（申込済,未支払）を取得する（マイページ表示用）
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNoMoushikomizumi($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT
		 tb_ceu_joho.ceu_id
		, event_kbn
		, shutoku_naiyo
		, CASE WHEN nonyu_hoho_kbn = 2 THEN '支払番号表示'
		  ELSE '支払'
		  END AS button_text
FROM tb_ceu_joho
LEFT JOIN (SELECT ceu_id,count(kaiin_no) AS moshikomi,sum(nonyu_kingaku) as nonyu_kingaku ,MAX(nonyubi) AS nonyubi, MAX(nonyu_hoho_kbn) AS nonyu_hoho_kbn
 			 FROM tb_ceu_joho_meisai WHERE sakujo_flg=0 and kaiin_no = :kaiin_no GROUP BY ceu_id)  ceu_joho_kaiin
 	ON tb_ceu_joho.ceu_id = ceu_joho_kaiin.ceu_id
WHERE sakujo_flg=0 AND keisai_kaishi_kikan < now() AND keisai_shuryo_kikan > now()
      AND moshikomi > 0 AND nonyubi IS NULL
ORDER BY event_kbn
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
