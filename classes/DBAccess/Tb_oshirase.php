<?php
namespace Was;

class oshirase
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
	SELECT mongon
 	FROM  tb_oshirase
--	LEFT JOIN tb_hambai_joho 
--		ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
	WHERE tb_oshirase.sakujo_flg = 0
		AND hyoji_yuko_kikan_kaishi_nichiji <= now()
		AND hyoji_yuko_kikan_shuryo_nichiji >= now()
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
