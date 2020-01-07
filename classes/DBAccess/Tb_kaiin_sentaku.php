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
    public function findBySentaku()
    {
        $wk_kaiin_no = "";
        // if (isset($_SESSION['kaiin_no'])) {
        //         $wk_kaiin_no = $_SESSION['kaiin_no'];
        // }
        $wk_kaiin_no = 10251033;
        //$wk_kaiin_no = 819121118;
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT meisho_kbn, meisho_cd, biko
            FROM   tb_kaiin_sentaku
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $wk_kaiin_no,]);
            $Tb_kaiin_sentaku = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $Tb_kaiin_sentaku = [];
        }

        return $Tb_kaiin_sentaku;
    }

    public function deleteRec($param3)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
                    DELETE
                    FROM tb_kaiin_sentaku
                    WHERE kaiin_no = :kaiin_no;

SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'                         => $param3['kaiin_no'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }

        return TRUE;
    }

    public function insertShikaku($param4)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        $wk_arr_shikaku = explode(",", $param4['meisho_cd_shikaku']);

        try {
            if ($wk_arr_shikaku != "") {
                foreach ($wk_arr_shikaku as $value) {
                    $biko_val = "";
                    $meisho_cd = str_replace(" ", "", $value);
                    if ($value == 99) {
                        $biko_val = $param4['biko_shikaku'];
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
                        ':kaiin_no'                         => $param4['kaiin_no'],
                        ':meisho_kbn'                       => 22,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => $biko_val,
                        ':sakujo_flg'                       => $param4['sakujo_flg'],
                        ':sakusei_user_id'                  => $param4['sakusei_user_id'],
                        ':koshin_user_id'                   => $param4['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param4['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param4['koshin_nichiji'],
                    ]);
                }
                $db->commit();
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertChiiki($param5)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        $wk_arr_chiiki = explode(",", $param5['meisho_cd_chiiki']);
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
                        ':kaiin_no'                         => $param5['kaiin_no'],
                        ':meisho_kbn'                       => 32,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => "",
                        ':sakujo_flg'                       => $param5['sakujo_flg'],
                        ':sakusei_user_id'                  => $param5['sakusei_user_id'],
                        ':koshin_user_id'                   => $param5['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param5['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param5['koshin_nichiji'],
                    ]);
                }
                $db->commit();
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertBunya($param6)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        $wk_arr_bunya = explode(",", $param6['meisho_cd_bunya']);
        try {

            if ($wk_arr_bunya != "") {
                foreach ($wk_arr_bunya as $value) {
                    $meisho_cd = str_replace(" ", "", $value);
                    $biko_val = "";
                    if ($value == 99) {
                        $biko_val = $param6['biko_bunya'];
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
                        ':kaiin_no'                         => $param6['kaiin_no'],
                        ':meisho_kbn'                       => 24,
                        ':meisho_cd'                        => $meisho_cd,
                        ':biko'                             => $biko_val,
                        ':sakujo_flg'                       => $param6['sakujo_flg'],
                        ':sakusei_user_id'                  => $param6['sakusei_user_id'],
                        ':koshin_user_id'                   => $param6['koshin_user_id'],
                        ':sakusei_nichiji'                  => $param6['sakusei_nichiji'],
                        ':koshin_nichiji'                   => $param6['koshin_nichiji'],
                    ]);
                }
                $db->commit();
            }
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
