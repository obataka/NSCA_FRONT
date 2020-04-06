<?php
namespace Was;

class Tb_hambai_konyusha_joho_meisai
{
    public function __construct()
    {
    }

    /*
     * 決済済み名刺購入情報を取得する（マイページ【名刺入力フォーム】リンク表示用）
     * 名刺A販売区分：7、名刺B販売区分:8
     * @param varchar $kaiin_no
     * @return array|mixed
     */
    public function findMeishiJohoByKaiinNoKonyuId($kaiin_no,$konyu_id)
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
		AND tb_hambai_konyusha_joho.konyu_id = :konyu_id
		AND	tb_hambai_joho.hambai_kbn IN (7,8)
;
            ");
            $sth->execute([
					':kaiin_no' => $kaiin_no
					,':konyu_id' => $konyu_id
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
					':hambai_id'             => $param['hambai_id']
					,':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                    ,':hambai_size_kbn'     => $param['size_kbn']
					,':hambai_color_kbn'    => $param['color_kbn']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
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
					':hambai_id'             => $param['hambai_id']
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
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function soryoKeisan($db, $param)
    {
        try {

                $sql = <<<SQL
                SELECT  tb_hambai_joho.hambai_kbn
                FROM tb_hambai_konyusha_joho_meisai
                LEFT JOIN tb_hambai_joho
                ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
                WHERE konyu_id = :konyu_id
                AND   sakujo_flg = 0
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

    public function updateAllSalesCartData($db, $param)
    {
        try {
                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho_meisai
                SET   suryo = :suryo
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND konyu_id = :konyu_id
                  AND hambai_id = :hambai_id
                  AND size_kbn = :size_kbn
                  AND color_kbn = :color_kbn;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':konyu_id'             => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                    ,':suryo'               => $param['konyusu']
                    ,':hambai_id'           => $param['hambai_id']
                    ,':size_kbn'            => $param['size_kbn']
                    ,':color_kbn'           => $param['color_kbn']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 会員のかごに入れた商品情報を登録する（ショップジャパン）
     * @param varchar $db
     * @param varchar $param
     * @return boolean
     */
    public function insert($db, $param)
    {
        try {
                $sql = <<<SQL
                INSERT INTO	tb_hambai_konyusha_joho_meisai
				(
					konyu_id
					,hambai_id
					,hambai_size_kbn
					,hambai_color_kbn
					,hambai_sentakushi_kbn
					,kakaku
                    ,suryo
                    ,torokubi
					,sakujo_flg
					,sakusei_user_id
					,koshin_user_id
                    , sakusei_nichiji
                    , koshin_nichiji
				)
				VALUES 
				(
                     :konyu_id
					,:hambai_id
					,:size_kbn
					,:color_kbn
					,:hambai_sentakushi_kbn
                    ,:kakaku
                    ,:suryo
                    ,now()
					,0
					,:user_id
					,:user_id
                    , now()
                    , now()
				);
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                     ':konyu_id'               => $param['konyu_id']
                    ,':hambai_id'              => $param['hambai_id']
                    ,':size_kbn'               => $param['size_kbn']
                    ,':color_kbn'              => $param['color_kbn']
                    ,':hambai_sentakushi_kbn'  => $param['hambai_sentakushi_kbn']
                    ,':kakaku'                 => $param['kakaku']
                    ,':suryo'                  => $param['suryo']
                    ,':user_id'                => $param['user_id']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 買い物かご情報を取得する
     * @param varchar $konyu_id
     * @return array|mixed
     */
    public function findByKonyuId($konyu_id)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT * FROM tb_hambai_konyusha_joho_meisai
	LEFT JOIN tb_hambai_konyusha_joho 
		ON tb_hambai_konyusha_joho_meisai.konyu_id = tb_hambai_konyusha_joho.konyu_id
	WHERE tb_hambai_konyusha_joho_meisai.konyu_id = :konyu_id
		AND tb_hambai_konyusha_joho_meisai.sakujo_flg = 0
		AND tb_hambai_konyusha_joho.sakujo_flg = 0
		AND tb_hambai_konyusha_joho.konyubi IS NULL
;
            ");
            $sth->execute([
					':konyu_id' => $konyu_id
			]);
            $meishiJoho  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meishiJoho = [];
        }
        return $meishiJoho;
    }

}
