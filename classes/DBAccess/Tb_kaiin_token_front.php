<?php
namespace Was;

class token_front
{
    public function __construct()
    {
    }

    /**
     * 登録
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
            );

SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'              => $argument['kaiin_no'],
                ':one_time_token'        => $argument['one_time_token'],
                ':yukokigen_nichiji'     => $argument['yukokigen_nichiji']
            ]);
            $db->commit();
        } catch (\Throwable $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }


}
