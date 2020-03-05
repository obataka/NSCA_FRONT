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

			SELECT 
				tb_ceu_joho.ceu_id
				, shutoku_naiyo
				, moshikomi_mae_annai_url
				, event_kbn
				, shutokubi
				, CASE WHEN teiinsu IS NULL OR (zansho_ikichi IS NOT NULL AND zansho_ikichi < ifnull(sanka_ninzu,0)) THEN 1
				  ELSE 0
				  END AS nokori
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
				, CASE WHEN zansho_ikichi IS NOT NULL AND zansho_ikichi < ifnull(sanka_ninzu,0) THEN 1
				  ELSE 0
				  END AS nokori
			FROM (
				SELECT 
					tb_ceu_joho.ceu_id,
					CONCAT(tb_ceu_joho.shutoku_naiyo , ' ' , vms_meisho.meisho) AS shutoku_naiyo,
					moshikomi_mae_annai_url,
					event_kbn,
					shutokubi,
					CASE 
						WHEN tb_toreken_jisshi_shosai.teiinsu > ifnull(sanka_ninzu,0) THEN 0
						ELSE 1
					END AS kuuseki,
					tb_toreken_jisshi_shosai.jisshi_no,
					keisai_kaishi_kikan,
					keisai_shuryo_kikan,
					zansho_ikichi,
					sanka_ninzu

				FROM tb_ceu_joho
				LEFT JOIN tb_toreken_jisshi_shosai
					ON tb_ceu_joho.ceu_id = tb_toreken_jisshi_shosai.ceu_id
				LEFT JOIN (
					SELECT ceu_id,jisshi_no,COUNT(*) AS sanka_ninzu
					FROM tb_ceu_joho_meisai 
					WHERE staff_kbn =0
					  AND sakujo_flg=0
					  AND nonyu_hoho_kbn IS NOT NULL
					GROUP BY ceu_id,jisshi_no
						) AS tb_toreken_sankasya
					ON tb_ceu_joho.ceu_id = tb_toreken_sankasya.ceu_id
					AND  tb_toreken_jisshi_shosai.jisshi_no = tb_toreken_sankasya.jisshi_no
				-- 名称取得（会員種別）
				LEFT JOIN vms_meisho
					ON meisho_cd = tb_ceu_joho.kyu_kbn
					AND meisho_kbn = 58 
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
			tb_ceu_conference_joho.ceu_id
			, tb_ceu_conference_joho.shutoku_naiyo
			, tb_ceu_conference_joho.moshikomi_mae_annai_url
			, tb_ceu_conference_joho.event_kbn
			, tb_ceu_conference_joho.shutokubi
			, 0 AS nokori
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

	/**
	 * @return array|mixed
	 */
	public function findByAllRec()
	{
		try {
			$db = Db::getInstance();
			$sth = $db->prepare("SELECT *
            FROM  tb_ceu_joho");
			$sth->execute();
			$tb_ceu_joho = $sth->fetchAll();
		} catch (\PDOException $e) {
			error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
			$tb_ceu_joho = [];
		}

		return $tb_ceu_joho;
	}

	public function findByPersonalDevelopment($db, $param, $ninteibi, $kaiin_column)
	{
		try {
			$sth = $db->query("SET @hyoji_No = 0; 
								SET @nendo_id = NULL; ");
			$sth = $db->prepare("SELECT tb_ceu_joho.nendo_id,
										IF (@nendo_id != cm_nendo.nendo_id, @hyoji_No = 1, @hyoji_No = @hyoji_No + 1) AS hyoji_No,
										CASE @hyoji_No
											WHEN 1 THEN YEAR(cm_nendo.ceu_kikan_from)
											WHEN 2 THEN YEAR(cm_nendo.ceu_kikan_from) + 1
											WHEN 3 THEN YEAR(cm_nendo.ceu_kikan_from) + 2
										END AS hyoji_nendo,
										tb_ceu_joho.ceu_id,
										tb_ceu_joho.category_kbn,
										tb_ceu_joho.shutokubi,
										tb_ceu_joho.ceusu,
										CASE 
											WHEN '$ninteibi' > tb_ceu_joho.shutokubi THEN 1
											ELSE IFNULL(tb_ceu_joho_meisai.keijo_kbn,0)
										END	AS keijo_kbn
								FROM  tb_ceu_joho
								LEFT JOIN tb_ceu_joho_meisai
								ON	tb_ceu_joho.ceu_id 		        = tb_ceu_joho_meisai.ceu_id 	
								AND tb_ceu_joho_meisai.kaiin_no		= :kaiin_no
								AND tb_ceu_joho_meisai.sakujo_flg	= 0
								LEFT JOIN cm_nendo
								ON	tb_ceu_joho.nendo_id			= cm_nendo.nendo_id
								WHERE
								tb_ceu_joho.event_kbn 				= 10	
								AND	cm_nendo.nendo_id 				= :nendo_id
								AND	tb_ceu_joho.sakujo_flg 			= 0
								GROUP BY
								cm_nendo.nendo_id
								,tb_ceu_joho.ceu_id
								,tb_ceu_joho.nendo_id
								,tb_ceu_joho.shutoku_naiyo
								,tb_ceu_joho.shutokubi
								,tb_ceu_joho.$kaiin_column
								,tb_ceu_joho.ippan_sankaryo
								,tb_ceu_joho.teiinsu
								,tb_ceu_joho.event_kbn
								,tb_ceu_joho.category_kbn
								,cm_nendo.ceu_kikan_from
								,tb_ceu_joho.ceusu
								,tb_ceu_joho_meisai.keijo_kbn;
								");
			$sth->execute([
				':kaiin_no' => $param['kaiin_no'],
				':nendo_id' => $param['nendo_id'],
			]);
			$tb_ceu_joho = $sth->fetchAll();
		} catch (\PDOException $e) {
			error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
			$tb_ceu_joho = [];
		}

		return $tb_ceu_joho;
	}

	

}
