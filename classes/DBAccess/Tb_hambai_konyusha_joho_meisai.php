<?php
namespace Was;

class Tb_hambai_konyusha_joho_meisai
{
    public function __construct()
    {
    }

    /*
     * お買い物かご名刺情報を取得する※会員のみ発送前全て
     * 名刺A販売区分：7、名刺B販売区分:8
     * @param varchar $kaiin_no
     * @return array|mixed
     */
    public function findMeishiJohoByKaiinNo($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT tb_hambai_konyusha_joho.konyu_id FROM tb_hambai_konyusha_joho_meisai
	LEFT JOIN tb_hambai_joho 
		ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
	LEFT JOIN tb_hambai_konyusha_joho 
		ON tb_hambai_konyusha_joho_meisai.konyu_id = tb_hambai_konyusha_joho.konyu_id
	WHERE tb_hambai_konyusha_joho.kaiin_no = :kaiin_no
		AND tb_hambai_konyusha_joho_meisai.sakujo_flg = 0
		AND tb_hambai_konyusha_joho.sakujo_flg = 0
		AND tb_hambai_konyusha_joho.nonyu_hoho_kbn IS NOT NULL
		AND	tb_hambai_joho.hambai_kbn IN (7,8)
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
