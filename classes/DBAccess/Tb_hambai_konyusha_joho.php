<?php
namespace Was;

class Tb_hambai_konyusha_joho
{
    public function __construct()
    {
    }

    /*
     * 購入販売情報を更新する（マイページ表示）
     * @param varchar $id
     * @return boolean
     */
    public function updateKonyubi($kaiin_no,$konyu_id,$koshin_user_id)
    {
            $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho
                SET   nonyu_hoho_kbn = NULL
					, konyubi = NULL
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND kaiin_no = :kaiin_no
				  AND konyu_id = :konyu_id
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':kaiin_no' => $kaiin_no
					,':konyu_id' => $konyu_id
					,':koshin_user_id' => $koshin_user_id
                ]);
            $db->commit();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    public function findBySalesCartList($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT
                                    tb_hambai_konyusha_joho.konyu_id
                                    ,tb_hambai_konyusha_joho.kaiin_no
                                    ,tb_hambai_konyusha_joho.konyusha_kbn
                                    ,tb_hambai_konyusha_joho.gokei_kingaku
                                    ,tb_hambai_konyusha_joho.konyubi
                                    ,tb_hambai_konyusha_joho_meisai.hambai_id
                                    ,tb_hambai_konyusha_joho_meisai.hambai_size_kbn AS size_kbn
                                    ,tb_hambai_konyusha_joho_meisai.hambai_color_kbn AS color_kbn
                                    ,CAST(tb_hambai_konyusha_joho_meisai.kakaku AS SIGNED) AS kakaku
                                    ,tb_hambai_konyusha_joho_meisai.suryo
                                    ,tb_hambai_joho.hambai_title
                                    ,tb_hambai_joho.hambai_title_chuigaki
                                    ,tb_hambai_joho.gazo_url
                                    ,CAST(tb_hambai_joho.kaiin_kakaku AS SIGNED) AS kaiin_kakaku
                                    ,CAST(tb_hambai_joho.ippan_kakaku AS SIGNED) AS ippan_kakaku
                                    ,tb_hambai_joho.gaiyo
                                    ,tb_hambai_joho.setsumei
                                    ,tb_hambai_joho.hambai_kbn
                                    ,tb_hambai_joho.hambai_settei_kbn
                                    ,tb_hambai_joho.shikaku_kbn
                                FROM tb_hambai_konyusha_joho
                                LEFT JOIN tb_hambai_konyusha_joho_meisai ON tb_hambai_konyusha_joho.konyu_id = tb_hambai_konyusha_joho_meisai.konyu_id
                                LEFT JOIN tb_hambai_joho ON tb_hambai_konyusha_joho_meisai.hambai_id = tb_hambai_joho.hambai_id
                                WHERE tb_hambai_konyusha_joho.kaiin_no = :kaiin_no
                                AND tb_hambai_konyusha_joho.nonyu_hoho_kbn IS NULL	
                                AND tb_hambai_konyusha_joho.sakujo_flg = 0
                                AND tb_hambai_konyusha_joho_meisai.sakujo_flg = 0");

            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
            ]);
            $tb_ceu_joho = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $tb_ceu_joho = [];
        }

        return $tb_ceu_joho;
    }

    public function deleteAllKonyushaJoho($db, $param)
    {
        try {

                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND konyu_id = :konyu_id
                  AND kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'            => $param['kaiin_no']
					,':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateGokeiKingaku($db, $param, $gokei, $soryo_gokei)
    {
        try {

                $sql = <<<SQL
                UPDATE tb_hambai_konyusha_joho
                SET   gokei_kingaku = $gokei + $soryo_gokei
                    , soryo = $soryo_gokei
					, koshin_user_id = :koshin_user_id
				WHERE sakujo_flg	= 0
				  AND konyu_id = :konyu_id
                  AND kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'            => $param['kaiin_no']
					,':konyu_id'            => $param['konyu_id']
                    ,':koshin_user_id'      => $param['koshin_user_id']
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
                INSERT INTO	tb_hambai_konyusha_joho
				(
					  kaiin_no
					, konyusha_kbn
					, gokei_kingaku
					, soryo
					, sofusaki_henko_kbn
					, sakujo_flg
					, uketsuke_flg
					, sakusei_user_id
					, koshin_user_id
                    , sakusei_nichiji
                    , koshin_nichiji
				)
			VALUES
				(
					  :kaiin_no
					, :konyusha_kbn
					, :gokei_kingaku
					, :soryo
					, 0
					, 0
					, 0
					, :user_id
					, :user_id
                    , now()
                    , now()
				);
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'           => $param['kaiin_no']
					,':konyusha_kbn'      => $param['konyusha_kbn']
                    ,':gokei_kingaku'     => $param['gokei_kingaku']
                    ,':soryo'             => $param['soryo']
                    ,':user_id'           => $param['user_id']
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 直前に登録した購入販売情報の購入IDを取得する
     * @param varchar $db
     * @return $konyu_id
     */

    public function getLastKonyuId($db)
    {
        try {

			$konyu_id = $db->lastInsertId();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return $konyu_id;
    }

}
