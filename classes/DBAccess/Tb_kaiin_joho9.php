<?php
namespace Was;

class Tb_kaiin_joho9
{
    public function __construct()
    {
    }

    /*
     * 会員番号から有効な会員情報を取得する
     * @param varchar $kaiinNo
     * @return array|mixed
     */
    public function findByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT joho.kaiin_no
 	, CONCAT(shimei_sei ,'　', shimei_mei) as kaiin_name
	, kaiin_sbt_kbn
	, meisho_kaiin_sbt.meisho as kaiin_sbt
	, DATE_FORMAT(yuko_hizuke,'%Y/%m/%d') as yuko_hizuke
	, meisho_eibun.meisho as eibun_option
FROM tb_kaiin_joho joho
	
LEFT JOIN tb_kaiin_jotai jotai
	ON  joho.kaiin_no = jotai.kaiin_no
LEFT JOIN tb_kaiin_journal journal 
	ON  joho.kaiin_no = journal.kaiin_no

-- 名称取得（会員種別）
LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho 
		WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
	    AND meisho_kbn = 10)  meisho_kaiin_sbt
	ON meisho_kaiin_sbt.meisho_cd = kaiin_sbt_kbn
-- 名称取得（英文オプション）
LEFT JOIN (SELECT meisho_cd,meisho FROM ms_meishoKbn,ms_meisho 
		WHERE ms_meishoKbn.meisho_id = ms_meisho.meisho_id
	    AND meisho_kbn = 12)  meisho_eibun
	ON meisho_eibun.meisho_cd = journal.eibun_option_kbn

WHERE joho.kaiin_no = :kaiin_no
    AND toroku_jokyo_kbn = 1
    AND joho.sakujo_flg = 0
;

            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinJoho  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinJoho = [];
        }
        return $kaiinJoho;
    }


    /*
     * 存在チェック（パスワード変更用）
     * @param varchar $kaiinNo
     * @param varchar $mailAddress
     * @return resultCount(0:該当なし、1:該当あり、9:エラー)
     */
    public function findByKaiinNoAndEmail($kaiinNo, $mailAddress)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT COUNT(*) AS resultCount
                      FROM tb_kaiin_joho
                     WHERE kaiin_no = :kaiin_no
                       AND (email_1 = :mailAddress OR email_2 = :mailAddress)
                       AND toroku_jokyo_kbn = 1
                       AND sakujo_flg = 0;
            ");
            $sth->execute([':mailAddress' => $mailAddress, ':kaiin_no' => $kaiinNo]);
            $row  = $sth->fetch();
        } catch (\PDOException $e) {
            return 9;
        }
        return $row["resultCount"];
    }

    /**
    * パスワード更新処理
    * @param array $param
    * @return boolean
    */
    public function updatePassword($param)
    {
         $db = Db::getInstance();
         $db->beginTransaction();
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_joho
                SET
                      my_page_password      = :my_page_password
                    , koshin_user_id        = 'ResetPassword'
                    , koshin_nichiji        = now()
                WHERE
                      kaiin_no = :kaiin_no
                  AND toroku_jokyo_kbn = 1
                  AND sakujo_flg = 0;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                ':kaiin_no'                       => $param['kaiin_no'],
                ':my_page_password'               => $param['my_page_password'],
                ]);
            $db->commit();
         } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }


}
