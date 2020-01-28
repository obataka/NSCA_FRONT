<?php
namespace Was;

class Tb_kessai_hakko
{
    public function __construct()
    {
    }

    /*
     * 決済発行テーブルを更新
     * @param varchar $id
     * @param varchar $settleno
     * @param varchar $status
     * @param varchar $error_code
     * @param varchar $error_message
     * @param varchar $koshin_user_id
     * @return boolean
     */
    public function updateStatus($id,$settleno,$status,$error_code,$error_message,$koshin_user_id)
    {
           $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_kessai_hakko
                SET   status = :status
					, error_code = :error_code
					, error_message = :error_message
					, koshin_user_id = :koshin_user_id
					, koshin_nichiji = now()
				WHERE sakujo_flg = 0
					AND id	= :id
					AND settleno = :settleno
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':id' => $id
					,':settleno' => $settleno
					,':status' => $status
					,':error_code' => $error_code
					,':error_message' => $error_message
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
     * 経理情報テーブルを削除する(削除フラグ=1でUPDATE)（マイページ表示）
     * @param varchar $id
     * @return boolean
     */
    public function updateSakujoFlg($kaiin_no,$etc_id,$koshin_user_id)
    {
            $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_keiri_joho
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE etc_id	= :etc_id
					AND kaiin_no = :kaiin_no
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

}
