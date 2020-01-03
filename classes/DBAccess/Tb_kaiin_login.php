<?php
namespace Was;

class Tb_kaiin_login
{
    public function __construct()
    {
    }

    /*
     * 会員Noで検索
     * @param varchar $loginId
     * @return array|mixed
     */
    public function findByKaiinNo($loginId)
    {
        try {
            $db = Db::getInstance();
            $sql = <<<SQL
                    SELECT login.*
                      FROM tb_kaiin_login login
                     WHERE (login.kaiin_no = :loginId)
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([':loginId' => $loginId,]);
            $kaiinLogin = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinLogin = [];
        }

        return $kaiinLogin;
    }

    /*
     * 登録
     * @param array $param
     * @return boolean
     */
    public function insertRec ($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kaiin_login(
                  kaiin_no
                , security_cd
                , sakusei_nichiji
                , koshin_nichiji
            )
            VALUES (
                  :kaiin_no
                , :security_cd
                , now()
                , now()
            );

SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'     => $param['kaiin_no'],
                ':security_cd'  => $param['security_cd'],
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
     * セキュリティコード更新処理
     * @param array $param
     * @return boolean
     */
    public function updateSecurityCd($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            UPDATE tb_kaiin_login
            SET    security_cd    = :security_cd
                 , koshin_nichiji = now()
            WHERE  kaiin_no       = :kaiin_no
            ;
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no'     => $param['kaiin_no'],
                ':security_cd'  => $param['security_cd'],
            ]);
            $db->commit();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
}
