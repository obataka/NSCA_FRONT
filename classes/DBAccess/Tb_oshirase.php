<?php
namespace Was;

class TB_oshirase
{
    public function __construct()
    {
    }

     // ****** 会員情報に合致条件未実装*********
     /*
     * 会員情報に合致したお知らせテーブル情報取得
     * @param varchar $kaiin_no
     * @return array|mixed
     */
    public function findInformationData($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT MAX(mongon) AS naiyo
			, MAX(button_title) AS button_text 
			, MAX(shosai_url) AS url 
 	FROM  tb_oshirase
	LEFT JOIN tb_oshirase_hyoji_joken_sentaku
		ON tb_oshirase.oshirase_id = tb_oshirase_hyoji_joken_sentaku.oshirase_id
	LEFT JOIN (
			SELECT
				yuko_hizuke
				, CASE 
					WHEN keizoku_hizuke IS NOT NULL THEN keizoku_hizuke
					ELSE nyukaibi
				 END AS nyukai_keizoku_hizuke
			FROM tb_kaiin_jotai
			WHERE sakujo_flg = 0
				AND kaiin_no = :kaiin_no
			) tb_kaiin_jotai
		ON 1=1
	LEFT JOIN (
			SELECT
				kaiin_sbt_kbn
				,kaiin_jokyo_kbn
			FROM tb_kaiin_joho
			WHERE sakujo_flg = 0
				AND kaiin_no = :kaiin_no
			) tb_kaiin_joho
		ON 1=1
	LEFT JOIN (
			SELECT
				eibun_option_kbn
			FROM tb_kaiin_journal
			WHERE sakujo_flg = 0
				AND kaiin_no = :kaiin_no
			) tb_kaiin_journal
		ON 1=1
	LEFT JOIN (
			SELECT
				SUM(shiken_sbt_kbn) AS nintei_kbn
			FROM tb_nintei_meisai
			WHERE sakujo_flg = 0
				AND kaiin_no = :kaiin_no
			   AND NULLIF(nintei_no,'') IS NOT NULL
			   AND ninteibi IS NOT NULL
			   GROUP BY kaiin_no
			) tb_nintei_meisai
		ON 1=1
	WHERE tb_oshirase.sakujo_flg = 0
		AND hyoji_yuko_kikan_kaishi_nichiji <= now()
		AND hyoji_yuko_kikan_shuryo_nichiji >= now()
 		AND (nyukai_koshin_kaishi_nissu IS NULL OR DATE_ADD(nyukai_keizoku_hizuke,INTERVAL nyukai_koshin_kaishi_nissu DAY) < now())
 		AND (nyukai_koshin_shuryo_nissu IS NULL OR DATE_ADD(nyukai_keizoku_hizuke,INTERVAL nyukai_koshin_shuryo_nissu DAY) > now())
 		AND (yuko_kikan_kaishi_nissu IS NULL OR DATE_SUB(yuko_hizuke,INTERVAL yuko_kikan_kaishi_nissu DAY) < now())
 		AND (yuko_kikan_shuryo_nissu IS NULL OR DATE_ADD(yuko_hizuke,INTERVAL yuko_kikan_shuryo_nissu DAY) > now())
		AND (meisho_kbn IS NULL OR meisho_kbn <> '247' OR  meisho_cd = kaiin_sbt_kbn OR (meisho_cd ='99' AND eibun_option_kbn =1))
		AND (meisho_kbn IS NULL OR meisho_kbn <> '9' OR  meisho_cd = kaiin_jokyo_kbn )
		AND (meisho_kbn IS NULL OR meisho_kbn <> '26' OR  meisho_cd = nintei_kbn OR nintei_kbn = 3 )
	GROUP BY tb_oshirase.oshirase_id
;
            ");
            $sth->execute([
					':kaiin_no' => $kaiin_no
			]);
            $meishiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meishiJoho = [];
        }
        return $meishiJoho;
    }


}
