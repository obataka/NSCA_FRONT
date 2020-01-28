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

}
