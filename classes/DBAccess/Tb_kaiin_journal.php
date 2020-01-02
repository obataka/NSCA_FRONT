<?php

namespace Was;

class Tb_kaiin_journal
{
    public function __construct()
    {
    }

    /**
     * @return array|mixed
     */
    public function updateMemberJournal($param2)
    {
        // if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
        // }
        //$wk_kaiin_no = 819121118;
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_journal
                SET
                eibun_option_kbn            = :eibun_option_kbn
                , koshin_user_id            = :koshin_user_id
                , koshin_nichiji            = :koshin_nichiji
                WHERE
                      kaiin_no = 819121118;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':eibun_option_kbn'              => $param2['eibun_option_kbn'],
                ':koshin_user_id'                => $param2['koshin_user_id'],
                ':koshin_nichiji'                => $param2['koshin_nichiji'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
