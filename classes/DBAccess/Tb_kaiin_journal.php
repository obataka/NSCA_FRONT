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

    public function updateKaiinJournal_eibun_sbtChange($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_journal
                SET
                      journal_hasso_kbn             = 1
                    , journal_hassosu               = 1
                    , koshin_user_id                = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no
                AND
                      hasso_teishibi IS NULL
                AND
                      IFNULL(journal_hasso_kbn,0) = 0
                AND
                      IFNULL(journal_hassosu,0) = 0;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'                 => $param['kaiin_no'],
                    ':koshin_user_id'           => $param['koshin_user_id'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateKaiinJournal_batch($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_journal
                SET
                      journal_hasso_kbn             = 0
                    , journal_hassosu               = 0
                    , koshin_user_id                = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'                 => $param['kaiin_no'],
                    ':koshin_user_id'           => $param['koshin_user_id'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 登録
     * @param array $param
     * @return boolean
     */
    public function insertRec($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
              INTO tb_kaiin_journal (
                   kaiin_no
                 , eibun_option_kbn
                 , eibun_option_kikan_from
                 , eibun_option_kikan_to
                 , eibun_option_kotei_kbn
                 , journal_hasso_kbn
                 , journal_hassosu
                 , journal_hassosu_kotei_kbn
                 , eibun_journal_hassosu
                 , beikoku_website_id_kbn
                 , kaigai_hasso_id_tsuchi_kbn
                 , hasso_teishibi
                 , yubin_fuchakubi
                 , yubin_fuchaku_riyu_cd
                 , expiration_date
                 , sakujo_flg
                 , sakusei_user_id
                 , koshin_user_id
                 , sakusei_nichiji
                 , koshin_nichiji
            )
            VALUES (
                   :kaiin_no
                 , :eibun_option_kbn
                 , :eibun_option_kikan_from
                 , :eibun_option_kikan_to
                 , :eibun_option_kotei_kbn
                 , :journal_hasso_kbn
                 , :journal_hassosu
                 , :journal_hassosu_kotei_kbn
                 , :eibun_journal_hassosu
                 , :beikoku_website_id_kbn
                 , :kaigai_hasso_id_tsuchi_kbn
                 , :hasso_teishibi
                 , :yubin_fuchakubi
                 , :yubin_fuchaku_riyu_cd
                 , :expiration_date
                 , :sakujo_flg
                 , :sakusei_user_id
                 , :koshin_user_id
                 , :sakusei_nichiji
                 , :koshin_nichiji
            );
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':eibun_option_kbn' => $param['eibun_option_kbn'],
                ':eibun_option_kikan_from' => $param['eibun_option_kikan_from'],
                ':eibun_option_kikan_to' => $param['eibun_option_kikan_to'],
                ':eibun_option_kotei_kbn' => $param['eibun_option_kotei_kbn'],
                ':journal_hasso_kbn' => $param['journal_hasso_kbn'],
                ':journal_hassosu' => $param['journal_hassosu'],
                ':journal_hassosu_kotei_kbn' => $param['journal_hassosu_kotei_kbn'],
                ':eibun_journal_hassosu' => $param['eibun_journal_hassosu'],
                ':beikoku_website_id_kbn' => $param['beikoku_website_id_kbn'],
                ':kaigai_hasso_id_tsuchi_kbn' => $param['kaigai_hasso_id_tsuchi_kbn'],
                ':hasso_teishibi' => $param['hasso_teishibi'],
                ':yubin_fuchakubi' => $param['yubin_fuchakubi'],
                ':yubin_fuchaku_riyu_cd' => $param['yubin_fuchaku_riyu_cd'],
                ':expiration_date' => $param['expiration_date'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji']
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 登録（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function insertRec_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            INSERT
              INTO tb_kaiin_journal (
                   kaiin_no
                 , eibun_option_kbn
                 , eibun_option_kikan_from
                 , eibun_option_kikan_to
                 , eibun_option_kotei_kbn
                 , journal_hasso_kbn
                 , journal_hassosu
                 , journal_hassosu_kotei_kbn
                 , eibun_journal_hassosu
                 , beikoku_website_id_kbn
                 , kaigai_hasso_id_tsuchi_kbn
                 , hasso_teishibi
                 , yubin_fuchakubi
                 , yubin_fuchaku_riyu_cd
                 , expiration_date
                 , sakujo_flg
                 , sakusei_user_id
                 , koshin_user_id
                 , sakusei_nichiji
                 , koshin_nichiji
            )
            VALUES (
                   :kaiin_no
                 , :eibun_option_kbn
                 , :eibun_option_kikan_from
                 , :eibun_option_kikan_to
                 , :eibun_option_kotei_kbn
                 , :journal_hasso_kbn
                 , :journal_hassosu
                 , :journal_hassosu_kotei_kbn
                 , :eibun_journal_hassosu
                 , :beikoku_website_id_kbn
                 , :kaigai_hasso_id_tsuchi_kbn
                 , :hasso_teishibi
                 , :yubin_fuchakubi
                 , :yubin_fuchaku_riyu_cd
                 , :expiration_date
                 , :sakujo_flg
                 , :sakusei_user_id
                 , :koshin_user_id
                 , :sakusei_nichiji
                 , :koshin_nichiji
            );
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':eibun_option_kbn' => $param['eibun_option_kbn'],
                ':eibun_option_kikan_from' => $param['eibun_option_kikan_from'],
                ':eibun_option_kikan_to' => $param['eibun_option_kikan_to'],
                ':eibun_option_kotei_kbn' => $param['eibun_option_kotei_kbn'],
                ':journal_hasso_kbn' => $param['journal_hasso_kbn'],
                ':journal_hassosu' => $param['journal_hassosu'],
                ':journal_hassosu_kotei_kbn' => $param['journal_hassosu_kotei_kbn'],
                ':eibun_journal_hassosu' => $param['eibun_journal_hassosu'],
                ':beikoku_website_id_kbn' => $param['beikoku_website_id_kbn'],
                ':kaigai_hasso_id_tsuchi_kbn' => $param['kaigai_hasso_id_tsuchi_kbn'],
                ':hasso_teishibi' => $param['hasso_teishibi'],
                ':yubin_fuchakubi' => $param['yubin_fuchakubi'],
                ':yubin_fuchaku_riyu_cd' => $param['yubin_fuchaku_riyu_cd'],
                ':expiration_date' => $param['expiration_date'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji']
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 削除フラグ更新処理（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateSakujoFlg_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            UPDATE tb_kaiin_journal
               SET sakujo_flg = :sakujo_flg
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :kaiin_no;
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':sakujo_flg' => $param['sakujo_flg'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':kaiin_no' => $param['kaiin_no']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

}
