<?php
namespace Was;

class Tb_keiri_joho
{
    public function __construct()
    {
    }

    /*
     * 会員番号から指定した期間内の支払済データを取得する（マイページ表示用）
     * @param varchar $kaiinNo
     * @param varchar $startDate
     * @param varchar $endDate
     * @return array|mixed
     */
    public function findByKaiinNoShiharaizumi($kaiinNo,$startDate,$endDate)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT *
	FROM(
	
			SELECT
				CASE 
					WHEN exa_id IS NOT NULL THEN tb_kako_shiken_joho.shiken_title
					WHEN etc_id IS NOT NULL AND keiri_shumoku_cd_1 = '02' AND keiri_shumoku_cd_2 = '08' THEN doga_title
					WHEN tb_keiri_joho.ceu_id IS NOT NULL THEN ceu_meisyo.meisyo
					ELSE CONCAT(daikeiri_shumokumei , ' ' , ifnull(chukeiri_shumokumei,''))
				END															    AS uchiwake
				,tb_keiri_joho.keiri_id											AS keiri_id
				,tb_keiri_joho.nonyubi											AS nonyubi
				,tb_keiri_joho.nonyu_kingaku									AS nonyu_kingaku
				,vms_meisho.meisho                               				AS nonyu_hoho
			FROM tb_keiri_joho
			LEFT JOIN tb_kako_shiken_joho
				 ON tb_kako_shiken_joho.shiken_id = exa_id
			LEFT JOIN tb_doga_joho
				 ON tb_doga_joho.doga_id = etc_id
			LEFT JOIN ms_daikeiri_shumoku
				 ON ms_daikeiri_shumoku.daikeiri_shumoku_cd = keiri_shumoku_cd_1
			LEFT JOIN ms_chukeiri_shumoku
				 ON ms_chukeiri_shumoku.daikeiri_shumoku_cd = keiri_shumoku_cd_1
				 AND ms_chukeiri_shumoku.chukeiri_shumoku_cd = keiri_shumoku_cd_2
			LEFT JOIN vms_meisho
				 ON meisho_cd = nonyu_hoho_kbn
				AND meisho_kbn = 6
			LEFT JOIN (
					-- ■CEU情報（トレ検以外）
					SELECT 
						tb_ceu_joho.ceu_id,
						ceu_meisai_id AS ceu_meisai_id,
						shutoku_naiyo AS meisyo 
					FROM tb_ceu_joho
					INNER JOIN tb_ceu_joho_meisai
						ON tb_ceu_joho.ceu_id = tb_ceu_joho_meisai.ceu_id
					WHERE event_shurui_kbn <> 3
					UNION
					-- ■クイズ情報
					SELECT 
						tb_ceu_quiz_joho.ceu_id,
						ceu_quiz_meisai_id AS ceu_meisai_id,
						shutoku_naiyo AS meisyo 
					FROM tb_ceu_quiz_joho
					INNER JOIN tb_ceu_quiz_joho_meisai
						ON tb_ceu_quiz_joho.ceu_id = tb_ceu_quiz_joho_meisai.ceu_id
					UNION
					-- ■カンファレンス情報
					SELECT 
						tb_ceu_conference_joho.ceu_id,
						ceu_conference_meisai_id AS ceu_meisai_id,
						shutoku_naiyo AS meisyo 
					FROM tb_ceu_conference_joho
					INNER JOIN tb_ceu_conference_joho_meisai
						ON tb_ceu_conference_joho.ceu_id = tb_ceu_conference_joho_meisai.ceu_id
					UNION
					-- ■トレ検情報
					SELECT 
						tb_ceu_joho.ceu_id,
						ceu_meisai_id AS ceu_meisai_id,
						CONCAT(shutoku_naiyo, '【', title, '(', jisshi_jikan,')】')  AS meisyo 
					FROM tb_ceu_joho
					INNER JOIN tb_toreken_jisshi_shosai 
						ON tb_ceu_joho.ceu_id = tb_toreken_jisshi_shosai.ceu_id
					INNER JOIN tb_ceu_joho_meisai
						ON tb_toreken_jisshi_shosai.ceu_id = tb_ceu_joho_meisai.ceu_id
					   AND tb_toreken_jisshi_shosai.jisshi_no = tb_ceu_joho_meisai.jisshi_no
					WHERE event_shurui_kbn <> 3
				) AS ceu_meisyo
				ON ceu_meisyo.ceu_id = tb_keiri_joho.ceu_id
				AND ceu_meisyo.ceu_meisai_id = tb_keiri_joho.ceu_meisai_id
			WHERE tb_keiri_joho.sakujo_flg	= 0
				AND kaiin_no = :kaiin_no
				AND nonyubi BETWEEN :startDate AND :endDate
			AND keiri_shumoku_cd_1 <> '12'								-- 返金は表示しない
			AND ((keiri_shumoku_cd_1 = '02' AND keiri_shumoku_cd_2 = '08') OR (keiri_shumoku_cd_1 <> '02'))	-- 02販売は除く

			UNION ALL

			SELECT
				'物品 販売'								        	AS uchiwake
				,keiri_id											AS keiri_id
				,nonyubi											AS nonyubi
				,SUM(nonyu_kingaku)									AS nonyu_kingaku
				,vms_meisho.meisho                               	AS nonyu_hoho
			FROM tb_keiri_joho
			LEFT JOIN vms_meisho
				 ON meisho_cd = nonyu_hoho_kbn
				AND meisho_kbn = 6
			WHERE sakujo_flg	=	0
				AND kaiin_no = :kaiin_no
				AND nonyubi BETWEEN :startDate AND :endDate
				AND keiri_shumoku_cd_1 = '02'
				AND keiri_shumoku_cd_2 <> '08'
			GROUP BY etc_id,nonyubi,nonyu_hoho_kbn
	) AS shiharai_joho
	ORDER BY nonyubi
;
            ");
            $sth->execute([
					':kaiin_no' => $kaiinNo
					,':startDate' => $startDate
					,':endDate' => $endDate
			]);
            $keiriJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $keiriJoho = [];
        }
        return $keiriJoho;
    }


    /*
     * 伝票番号(ID)後発で、有効な同一ETCIDを持つ物販経理を返却する
     * 経理種目CD2：01（教材）、03（名刺）、07（送料）、09(物販)、99（その他）
     * @param varchar $id
     * @return array|mixed
     */
    public function findByEtcId($id,$etc_id)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT * FROM tb_keiri_joho
	WHERE id = :id
		AND sakujo_flg = 0
		AND	id	>   :id
		AND	keiri_shumoku_cd_1	=   '02'     -- 販売
		AND	keiri_shumoku_cd_2	IN ('01','03','07','09','99')
		AND	etc_id	= :etc_id
;
            ");
            $sth->execute([
					':id' => $id
					,':etc_id' => $etc_id
			]);
            $keiriJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $keiriJoho = [];
        }
        return $keiriJoho;
    }



    /*
     * 経理情報テーブルを削除する(削除フラグ=1でUPDATE)（マイページ表示）
     * @param varchar $id
     * @return boolean
     */
    public function updateSakujoFlg($id,$koshin_user_id)
    {
            $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_keiri_joho
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE id	= :id
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':id' => $id
					,':koshin_user_id' => $koshin_user_id
                ]);
            $db->commit();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 会員番号更新処理（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateKaiinNoByOldKaiinNo_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            UPDATE tb_keiri_joho
               SET kaiin_no = :kaiin_no
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :old_kaiin_no;
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':old_kaiin_no' => $param['old_kaiin_no']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 経理情報テーブル検索処理
     * @param array $param
     * @return 経理情報テーブルデータ
     */
    public function findByKeiriDempyoNoAndId($param)
    {
		$db = Db::getInstance();
		$rtn = null;
        try {
            $sql = <<<SQL
            SELECT *
              FROM tb_keiri_joho
             WHERE sakujo_flg = 0
               AND keiri_dempyo_no = :keiri_dempyo_no
               AND id = :id;
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':keiri_dempyo_no' => $param['keiri_dempyo_no'],
                ':id' => $param['id']
			]);
			$rtn = $sth->fetch();

        } catch (\PDOException $e) {
			error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
			$rtn = [];
        }
        return $rtn;
    }

    /*
     * 登録（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function insertRec_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            INSERT
              INTO tb_keiri_joho(
                   keiri_id
                 , keiri_dempyo_no
                 , id
                 , kaiin_no
                 , keiri_shumoku_cd_1
                 , keiri_shumoku_cd_2
                 , keiri_shumoku_cd_3
                 , ceu_id
                 , ceu_meisai_id
                 , exa_id
                 , shiken_meisai_id
                 , hpc_yoyaku_id
                 , etc_id
                 , etc_meisai_id
                 , keiri_nyuryokubi
                 , hoken_id
                 , nonyubi
                 , nonyu_kingaku
                 , keiri_biko
                 , nonyu_hoho_kbn
                 , shikentoshi
                 , fusoku_flg
                 , naiyo
                 , sakujo_flg
                 , sakusei_user_id
                 , koshin_user_id
                 , sakusei_nichiji
                 , koshin_nichiji
            )
            VALUES (
                   :keiri_id
                 , :keiri_dempyo_no
                 , :id
                 , :kaiin_no
                 , :keiri_shumoku_cd_1
                 , :keiri_shumoku_cd_2
                 , :keiri_shumoku_cd_3
                 , :ceu_id
                 , :ceu_meisai_id
                 , :exa_id
                 , :shiken_meisai_id
                 , :hpc_yoyaku_id
                 , :etc_id
                 , :etc_meisai_id
                 , :keiri_nyuryokubi
                 , :hoken_id
                 , :nonyubi
                 , :nonyu_kingaku
                 , :keiri_biko
                 , :nonyu_hoho_kbn
                 , :shikentoshi
                 , :fusoku_flg
                 , :naiyo
                 , :sakujo_flg
                 , :sakusei_user_id
                 , :koshin_user_id
                 , :sakusei_nichiji
                 , :koshin_nichiji
            );
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':keiri_id' => $param['keiri_id'],
                ':keiri_dempyo_no' => $param['keiri_dempyo_no'],
                ':id' => $param['id'],
                ':kaiin_no' => $param['kaiin_no'],
                ':keiri_shumoku_cd_1' => $param['keiri_shumoku_cd_1'],
                ':keiri_shumoku_cd_2' => $param['keiri_shumoku_cd_2'],
                ':keiri_shumoku_cd_3' => $param['keiri_shumoku_cd_3'],
                ':ceu_id' => $param['ceu_id'],
                ':ceu_meisai_id' => $param['ceu_meisai_id'],
                ':exa_id' => $param['exa_id'],
                ':shiken_meisai_id' => $param['shiken_meisai_id'],
                ':hpc_yoyaku_id' => $param['hpc_yoyaku_id'],
                ':etc_id' => $param['etc_id'],
                ':etc_meisai_id' => $param['etc_meisai_id'],
                ':keiri_nyuryokubi' => $param['keiri_nyuryokubi'],
                ':hoken_id' => $param['hoken_id'],
                ':nonyubi' => $param['nonyubi'],
                ':nonyu_kingaku' => $param['nonyu_kingaku'],
                ':keiri_biko' => $param['keiri_biko'],
                ':nonyu_hoho_kbn' => $param['nonyu_hoho_kbn'],
                ':shikentoshi' => $param['shikentoshi'],
                ':fusoku_flg' => $param['fusoku_flg'],
                ':naiyo' => $param['naiyo'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji']
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }


}
