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

    public function deleteSalesCartData($db, $param)
    {
        try {

                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho_meisai
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND hambai_id = :hambai_id
				  AND konyu_id = :konyu_id
                  AND hambai_size_kbn = :hambai_size_kbn
                  AND hambai_color_kbn = :hambai_color_kbn;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					'hambai_id'             => $param['hambai_id']
					,':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                    ,':hambai_size_kbn'     => $param['size_kbn']
					,':hambai_color_kbn'    => $param['color_kbn']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    public function chkMeisaiExists($db, $param)
    {
        try {

                $sql = <<<SQL
                SELECT *
                FROM tb_hambai_konyusha_joho_meisai
                WHERE konyu_id = :konyu_id
                AND   sakujo_flg = 0;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					'hambai_id'             => $param['hambai_id']
					,':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                    ,':hambai_size_kbn'     => $param['size_kbn']
					,':hambai_color_kbn'    => $param['color_kbn']
                ]);
                $meisaiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meisaiJoho = [];
        }
        return $meisaiJoho;
    }

    public function deleteAllSalesCartData($db, $param)
    {
        try {

                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho_meisai
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND konyu_id = :konyu_id;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    public function soryoKeisan1($db, $param, $soryo_gokei, $soryo)
    {
        try {

                $sql = <<<SQL
                SELECT  $soryo_gokei + $soryo 
                FROM tb_hambai_konyusha_joho_meisai
                LEFT JOIN tb_hambai_joho
                ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
                WHERE konyu_id = :konyu_id
                AND   sakujo_flg = 0
                AND   (tb_hambai_joho.hambai_kbn = 7 OR tb_hambai_joho.hambai_kbn = 8)
                LIMIT 1;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':konyu_id'            => $param['konyu_id']
                ]);
                $meisaiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meisaiJoho = [];
        }
        return $meisaiJoho;
    }

    public function soryoKeisan2($db, $param, $soryo_gokei, $soryo)
    {
        try {

                $sql = <<<SQL
                SELECT $soryo_gokei + $soryo 
                FROM tb_hambai_konyusha_joho_meisai
                LEFT JOIN tb_hambai_joho
                ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
                WHERE konyu_id = :konyu_id
                AND   sakujo_flg = 0
                AND   tb_hambai_joho.hambai_kbn = 9
                LIMIT 1;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':konyu_id'            => $param['konyu_id']
                ]);
                $meisaiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meisaiJoho = [];
        }
        return $meisaiJoho;
    }
}
