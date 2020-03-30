<?php

namespace Was;

class Tb_kaiin_sentaku
{
    public function __construct()
    {
    }

    /**
     * @return array|mixed
     */
    public function findBySentaku($kaiin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT meisho_kbn, meisho_cd, biko
            FROM   tb_kaiin_sentaku
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $kaiin_no]);
            $Tb_kaiin_sentaku = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $Tb_kaiin_sentaku = [];
        }

        return $Tb_kaiin_sentaku;
    }

    public function deleteRec($db, $param4)
    {
        try {
            $sql = <<<SQL
                    DELETE
                    FROM tb_kaiin_sentaku
                    WHERE kaiin_no = :kaiin_no;

SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param4['kaiin_no'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }

        return TRUE;
    }

    public function insertShikaku($db, $param5)
    {
        $wk_arr_shikaku = explode(",", $param5['meisho_cd_shikaku']);

        try {
            if ($wk_arr_shikaku != "") {
                foreach ($wk_arr_shikaku as $value) {
                    $biko_val = "";
                    $meisho_cd = str_replace(" ", "", $value);
                    if ($value == 99) {
                        $biko_val = $param5['biko_shikaku'];
                    }
                    $sql = <<<SQL
                    INSERT
                    INTO tb_kaiin_sentaku(
                        kaiin_no
                        , meisho_kbn
                        , meisho_cd
                        , biko
                        , sakujo_flg
                        , sakusei_user_id
                        , koshin_user_id
                        , sakusei_nichiji
                        , koshin_nichiji
                    )
                    VALUES (
                        :kaiin_no
                        , :meisho_kbn
                        , :meisho_cd
                        , :biko
                        , :sakujo_flg
                        , :sakusei_user_id
                        , :koshin_user_id
                        , :sakusei_nichiji
                        , :koshin_nichiji
                    );

SQL;
                    $sth = $db->prepare($sql);
                    $sth->execute([
                        ':kaiin_no'                         => $param5['kaiin_no'],
                        ':meisho_kbn'                       => 22,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => $biko_val,
                        ':sakujo_flg'                       => $param5['sakujo_flg'],
                        ':sakusei_user_id'                  => $param5['sakusei_user_id'],
                        ':koshin_user_id'                   => $param5['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param5['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param5['koshin_nichiji'],
                    ]);
                }
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertChiiki($db, $param6)
    {
        $wk_arr_chiiki = explode(",", $param6['meisho_cd_chiiki']);
        try {
            if ($wk_arr_chiiki != "") {
                foreach ($wk_arr_chiiki as $value) {
                    $meisho_cd = str_replace(" ", "", $value);
                    $sql = <<<SQL
                    INSERT
                    INTO tb_kaiin_sentaku(
                        kaiin_no
                        , meisho_kbn
                        , meisho_cd
                        , biko
                        , sakujo_flg
                        , sakusei_user_id
                        , koshin_user_id
                        , sakusei_nichiji
                        , koshin_nichiji
                    )
                    VALUES (
                        :kaiin_no
                        , :meisho_kbn
                        , :meisho_cd
                        , :biko
                        , :sakujo_flg
                        , :sakusei_user_id
                        , :koshin_user_id
                        , :sakusei_nichiji
                        , :koshin_nichiji
                    );

SQL;
                    $sth = $db->prepare($sql);
                    $sth->execute([
                        ':kaiin_no'                         => $param6['kaiin_no'],
                        ':meisho_kbn'                       => 32,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => "",
                        ':sakujo_flg'                       => $param6['sakujo_flg'],
                        ':sakusei_user_id'                  => $param6['sakusei_user_id'],
                        ':koshin_user_id'                   => $param6['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param6['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param6['koshin_nichiji'],
                    ]);
                }
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertBunya($db, $param7)
    {
        $wk_arr_bunya = explode(",", $param7['meisho_cd_bunya']);
        try {

            if ($wk_arr_bunya != "") {
                foreach ($wk_arr_bunya as $value) {
                    $meisho_cd = str_replace(" ", "", $value);
                    $biko_val = "";
                    if ($value == 99) {
                        $biko_val = $param7['biko_bunya'];
                    }

                    $sql = <<<SQL
                    INSERT
                    INTO tb_kaiin_sentaku(
                        kaiin_no
                        , meisho_kbn
                        , meisho_cd
                        , biko
                        , sakujo_flg
                        , sakusei_user_id
                        , koshin_user_id
                        , sakusei_nichiji
                        , koshin_nichiji
                    )
                    VALUES (
                        :kaiin_no
                        , :meisho_kbn
                        , :meisho_cd
                        , :biko
                        , :sakujo_flg
                        , :sakusei_user_id
                        , :koshin_user_id
                        , :sakusei_nichiji
                        , :koshin_nichiji
                    );

SQL;
                    $sth = $db->prepare($sql);
                    $sth->execute([
                        ':kaiin_no'                         => $param7['kaiin_no'],
                        ':meisho_kbn'                       => 24,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => $biko_val,
                        ':sakujo_flg'                       => $param7['sakujo_flg'],
                        ':sakusei_user_id'                  => $param7['sakusei_user_id'],
                        ':koshin_user_id'                   => $param7['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param7['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param7['koshin_nichiji'],
                    ]);
                }
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
