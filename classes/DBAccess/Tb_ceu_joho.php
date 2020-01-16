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
    public function findByKaiinNoMimoushikomi($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
-- セミナー・レベル1・トレ検
SELECT
		 tb_ceu_joho.ceu_id
		, event_kbn
		, shutoku_naiyo
		, meisho
		, CASE WHEN zansho_ikichi IS NOT NULL AND zansho_ikichi < ifnull(moushikomi_suu,0) THEN 1
		  ELSE 0
		  END AS nokori
, moushikomi
FROM tb_ceu_joho
LEFT JOIN (SELECT ceu_id,count(kaiin_no) AS moushikomi,sum(nonyu_kingaku) as nonyu_kingaku FROM tb_ceu_joho_meisai
 			WHERE sakujo_flg=0 and kaiin_no = :kaiin_no GROUP BY ceu_id)  ceu_joho_kaiin
 	ON tb_ceu_joho.ceu_id = ceu_joho_kaiin.ceu_id
LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho
		WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
	    AND meisho_kbn = 59)  meisho_event_kbn
	ON meisho_event_kbn.meisho_cd = event_kbn
LEFT JOIN (SELECT ceu_id,count(kaiin_no) AS moushikomi_suu FROM tb_ceu_joho_meisai
			WHERE sakujo_flg=0 GROUP BY ceu_id)  ceu_joho_meisai
	ON tb_ceu_joho.ceu_id = ceu_joho_meisai.ceu_id
WHERE sakujo_flg=0 AND keisai_kaishi_kikan < now() AND keisai_shuryo_kikan > now() AND moushikomi is null
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
LEFT JOIN (SELECT ceu_id,count(kaiin_no) AS moushikomi,sum(nonyu_kingaku) as nonyu_kingaku ,MAX(nonyubi) AS nonyubi, MAX(nonyu_hoho_kbn) AS nonyu_hoho_kbn
 			 FROM tb_ceu_joho_meisai WHERE sakujo_flg=0 and kaiin_no = :kaiin_no GROUP BY ceu_id)  ceu_joho_kaiin
 	ON tb_ceu_joho.ceu_id = ceu_joho_kaiin.ceu_id
WHERE sakujo_flg=0 AND keisai_kaishi_kikan < now() AND keisai_shuryo_kikan > now()
      AND moushikomi > 0 AND nonyubi IS NULL
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

    /*
     * 会員番号から有効なイベント情報（支払済）を取得する（マイページ表示用）
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNoShiharaizumi($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT
		 tb_ceu_joho.ceu_id
		, event_kbn
		, shutoku_naiyo
FROM tb_ceu_joho
LEFT JOIN (SELECT ceu_id,count(kaiin_no) AS moushikomi,sum(nonyu_kingaku) as nonyu_kingaku ,MAX(nonyubi) AS nonyubi FROM tb_ceu_joho_meisai
 			WHERE sakujo_flg=0 and kaiin_no = :kaiin_no GROUP BY ceu_id)  ceu_joho_kaiin
 	ON tb_ceu_joho.ceu_id = ceu_joho_kaiin.ceu_id
WHERE sakujo_flg=0 AND keisai_kaishi_kikan < now() AND keisai_shuryo_kikan > now() AND nonyubi IS NOT NULL
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
