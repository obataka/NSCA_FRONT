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
    public function updateMemberJournal($db, $param3)
    {
        try {
            $sql = <<<SQL
                UPDATE tb_kaiin_journal
                SET
                eibun_option_kbn            = :eibun_option_kbn
                , koshin_user_id            = :koshin_user_id
                , koshin_nichiji            = :koshin_nichiji
                WHERE
                kaiin_no = :kaiin_no;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                      => $param3['kaiin_no'],
                ':eibun_option_kbn'              => $param3['eibun_option_kbn'],
                ':koshin_user_id'                => $param3['koshin_user_id'],
                ':koshin_nichiji'                => $param3['koshin_nichiji'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
