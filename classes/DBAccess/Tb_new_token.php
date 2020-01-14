<?php
namespace Was;

class Tb_new_token
{
    public function __construct()
    {
    }

    /**
     * 登録
     * (既存データがある場合はUPDATE)
     * @param array $argument
     * @return boolean
     */
    public function insertRec ($argument)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_new_token(
                    id
                  , mail_address
                  , one_time_token
                  , yukokigen_nichiji
                  , sakusei_nichiji
                  , koshin_nichiji
            )
            VALUES (
                    :id
                  , :mail_address
                  , :one_time_token
                  , :yukokigen_nichiji
                  , now()
                  , now()
            )
;

SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':id'                   => $argument['id'],
                ':mail_address'         => $argument['mail_address'],
                ':one_time_token'       => $argument['one_time_token'],
                ':yukokigen_nichiji'    => $argument['yukokigen_nichiji']
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }


    /*
     * IDからデータを取得する
     * @param varchar $id
     * @return array|mixed
     */
    public function findById($id)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
                      FROM tb_new_token
                     WHERE id = :id;
            ");
            $sth->execute([':id' => $id]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $row = [];
        }
        return $row;
    }


    /*
     * 削除
     * @param  varchar $id
     * @return boolean
     */

    public function deleteRec($id)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
                    DELETE
                    FROM tb_new_token
                    WHERE id = :id;

SQL;
            $sth = $db->prepare($sql);
            $sth->execute([':id' => $id]);
            $db->commit();
        } catch (\PDOException $e) {
            $db->rollBack();
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /* 該当日の会員番号の最大値を取得する
    * @param varchar $kaiin_no
    * @return array|mixed
    */
   public function findMaxId($id)
   {
       try {
           $db = Db::getInstance();
           $sth = $db->prepare("SELECT RIGHT(MAX(id), 2) AS max_no FROM tb_new_token WHERE id LIKE :id;");
           $sth->execute([':id' => $id,]);
           $mstProduct = $sth->fetch();
       } catch (\PDOException $e) {
           $mstProduct = [];
       }
       return $mstProduct;
   }




}
