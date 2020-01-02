<?php
namespace Was;

class Tb_kaiin_token_front
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
            INTO tb_kaiin_token_front(
                    kaiin_no
                  , one_time_token
                  , yukokigen_nichiji
                  , sakusei_nichiji
                  , koshin_nichiji
            )
            VALUES (
                    :kaiin_no
                  , :one_time_token
                  , :yukokigen_nichiji
                  , now()
                  , now()
            )
			ON DUPLICATE KEY UPDATE
				one_time_token    = :one_time_token,
				yukokigen_nichiji = :yukokigen_nichiji,
				koshin_nichiji    = now()
;

SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'              => $argument['kaiin_no'],
                ':one_time_token'        => $argument['one_time_token'],
                ':yukokigen_nichiji'     => $argument['yukokigen_nichiji']
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }


    /*
     * トークンから有効な会員番号を取得する
     * @param varchar $token
     * @return array|mixed
     */
    public function findBytoken($token)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
                      FROM tb_kaiin_token_front
                     WHERE one_time_token = :token
                       AND yukokigen_nichiji > now() ;
            ");
            $sth->execute([':token' => $token]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            $row = [];
        }
        return $row;
    }


}
