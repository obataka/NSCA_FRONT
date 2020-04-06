<?php
namespace Was;

class Tb_kessai_hakko
{
    public function __construct()
    {
    }

    /*
     * 登録
     * @param  array $param
     * @return boolean
     */
    public function insertRec ($param)
    {
        $db = Db::getInstance();
        $db->beginTransaction();
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kessai_hakko(
                 shop_id
               , id
               , pay
               , user_name_1
               , user_name_2
               , user_name_kana_1
               , user_name_kana_2
               , user_tel
               , user_mail
               , user_id
               , auth_key
               , item_title
               , item_name
               , item_name_kana
               , expire
               , char_code
               , pay_type_specify
               , pay_mode_specify
               , settleno
               , seq_no
               , pay_ment_type
               , auth_code
               , status
               , ua
               , ceu_id
               , ceu_meisai_id
               , shiken_meisai_id
               , zenshiken_meisai_id
               , etc_id
               , etc_meisai_id
               , keiri_shumoku_cd_1
               , keiri_shumoku_cd_2
               , keiri_shumoku_cd_3
               , kessai_kekka
               , error_code
               , error_message
               , kaiin_no
               , sakujo_flg
               , sakusei_user_id
               , koshin_user_id
               , sakusei_nichiji
               , koshin_nichiji
               , cscs_shikaku_koshinryo_nofu_kbn
               , cpt_shikaku_koshinryo_nofu_kbn
               , scsc_koshinryo
               , cpt_koshinryo
               , yoyaku_kaiin_sbt
               , konyubi
            ) VALUES (
                 :shop_id
               , :id
               , :pay
               , :user_name_1
               , :user_name_2
               , :user_name_kana_1
               , :user_name_kana_2
               , :user_tel
               , :user_mail
               , :user_id
               , :auth_key
               , :item_title
               , :item_name
               , :item_name_kana
               , :expire
               , :char_code
               , :pay_type_specify
               , :pay_mode_specify
               , :settleno
               , :seq_no
               , :pay_ment_type
               , :auth_code
               , :status
               , :ua
               , :ceu_id
               , :ceu_meisai_id
               , :shiken_meisai_id
               , :zenshiken_meisai_id
               , :etc_id
               , :etc_meisai_id
               , :keiri_shumoku_cd_1
               , :keiri_shumoku_cd_2
               , :keiri_shumoku_cd_3
               , :kessai_kekka
               , :error_code
               , :error_message
               , :kaiin_no
               , :sakujo_flg
               , :sakusei_user_id
               , :koshin_user_id
               , :sakusei_nichiji
               , :koshin_nichiji
               , :cscs_shikaku_koshinryo_nofu_kbn
               , :cpt_shikaku_koshinryo_nofu_kbn
               , :scsc_koshinryo
               , :cpt_koshinryo
               , :yoyaku_kaiin_sbt
               , :konyubi
            );
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':shop_id' => $param['shop_id'],
                ':id' => $param['id'],
                ':pay' => $param['pay'],
                ':user_name_1' => $param['user_name_1'],
                ':user_name_2' => $param['user_name_2'],
                ':user_name_kana_1' => $param['user_name_kana_1'],
                ':user_name_kana_2' => $param['user_name_kana_2'],
                ':user_tel' => $param['user_tel'],
                ':user_mail' => $param['user_mail'],
                ':user_id' => $param['user_id'],
                ':auth_key' => $param['auth_key'],
                ':item_title' => $param['item_title'],
                ':item_name' => $param['item_name'],
                ':item_name_kana' => $param['item_name_kana'],
                ':expire' => $param['expire'],
                ':char_code' => $param['char_code'],
                ':pay_type_specify' => $param['pay_type_specify'],
                ':pay_mode_specify' => $param['pay_mode_specify'],
                ':settleno' => $param['settleno'],
                ':seq_no' => $param['seq_no'],
                ':pay_ment_type' => $param['pay_ment_type'],
                ':auth_code' => $param['auth_code'],
                ':status' => $param['status'],
                ':ua' => $param['ua'],
                ':ceu_id' => $param['ceu_id'],
                ':ceu_meisai_id' => $param['ceu_meisai_id'],
                ':shiken_meisai_id' => $param['shiken_meisai_id'],
                ':zenshiken_meisai_id' => $param['zenshiken_meisai_id'],
                ':etc_id' => $param['etc_id'],
                ':etc_meisai_id' => $param['etc_meisai_id'],
                ':keiri_shumoku_cd_1' => $param['keiri_shumoku_cd_1'],
                ':keiri_shumoku_cd_2' => $param['keiri_shumoku_cd_2'],
                ':keiri_shumoku_cd_3' => $param['keiri_shumoku_cd_3'],
                ':kessai_kekka' => $param['kessai_kekka'],
                ':error_code' => $param['error_code'],
                ':error_message' => $param['error_message'],
                ':kaiin_no' => $param['kaiin_no'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji'],
                ':cscs_shikaku_koshinryo_nofu_kbn' => $param['cscs_shikaku_koshinryo_nofu_kbn'],
                ':cpt_shikaku_koshinryo_nofu_kbn' => $param['cpt_shikaku_koshinryo_nofu_kbn'],
                ':scsc_koshinryo' => $param['scsc_koshinryo'],
                ':cpt_koshinryo' => $param['cpt_koshinryo'],
                ':yoyaku_kaiin_sbt' => $param['yoyaku_kaiin_sbt'],
                ':konyubi' => $param['konyubi']
            ]);
            $db->commit();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 登録
     * @param  object $db
     * @param  array $param
     * @return boolean
     */
    public function insertRec_noTran ($db, $param)
    {
        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kessai_hakko(
                 shop_id
               , id
               , pay
               , user_name_1
               , user_name_2
               , user_name_kana_1
               , user_name_kana_2
               , user_tel
               , user_mail
               , user_id
               , auth_key
               , item_title
               , item_name
               , item_name_kana
               , expire
               , char_code
               , pay_type_specify
               , pay_mode_specify
               , settleno
               , seq_no
               , pay_ment_type
               , auth_code
               , status
               , ua
               , ceu_id
               , ceu_meisai_id
               , shiken_meisai_id
               , zenshiken_meisai_id
               , etc_id
               , etc_meisai_id
               , keiri_shumoku_cd_1
               , keiri_shumoku_cd_2
               , keiri_shumoku_cd_3
               , kessai_kekka
               , error_code
               , error_message
               , kaiin_no
               , sakujo_flg
               , sakusei_user_id
               , koshin_user_id
               , sakusei_nichiji
               , koshin_nichiji
               , cscs_shikaku_koshinryo_nofu_kbn
               , cpt_shikaku_koshinryo_nofu_kbn
               , scsc_koshinryo
               , cpt_koshinryo
               , yoyaku_kaiin_sbt
               , konyubi
            ) VALUES (
                 :shop_id
               , :id
               , :pay
               , :user_name_1
               , :user_name_2
               , :user_name_kana_1
               , :user_name_kana_2
               , :user_tel
               , :user_mail
               , :user_id
               , :auth_key
               , :item_title
               , :item_name
               , :item_name_kana
               , :expire
               , :char_code
               , :pay_type_specify
               , :pay_mode_specify
               , :settleno
               , :seq_no
               , :pay_ment_type
               , :auth_code
               , :status
               , :ua
               , :ceu_id
               , :ceu_meisai_id
               , :shiken_meisai_id
               , :zenshiken_meisai_id
               , :etc_id
               , :etc_meisai_id
               , :keiri_shumoku_cd_1
               , :keiri_shumoku_cd_2
               , :keiri_shumoku_cd_3
               , :kessai_kekka
               , :error_code
               , :error_message
               , :kaiin_no
               , :sakujo_flg
               , :sakusei_user_id
               , :koshin_user_id
               , :sakusei_nichiji
               , :koshin_nichiji
               , :cscs_shikaku_koshinryo_nofu_kbn
               , :cpt_shikaku_koshinryo_nofu_kbn
               , :scsc_koshinryo
               , :cpt_koshinryo
               , :yoyaku_kaiin_sbt
               , :konyubi
            );
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':shop_id' => $param['shop_id'],
                ':id' => $param['id'],
                ':pay' => $param['pay'],
                ':user_name_1' => $param['user_name_1'],
                ':user_name_2' => $param['user_name_2'],
                ':user_name_kana_1' => $param['user_name_kana_1'],
                ':user_name_kana_2' => $param['user_name_kana_2'],
                ':user_tel' => $param['user_tel'],
                ':user_mail' => $param['user_mail'],
                ':user_id' => $param['user_id'],
                ':auth_key' => $param['auth_key'],
                ':item_title' => $param['item_title'],
                ':item_name' => $param['item_name'],
                ':item_name_kana' => $param['item_name_kana'],
                ':expire' => $param['expire'],
                ':char_code' => $param['char_code'],
                ':pay_type_specify' => $param['pay_type_specify'],
                ':pay_mode_specify' => $param['pay_mode_specify'],
                ':settleno' => $param['settleno'],
                ':seq_no' => $param['seq_no'],
                ':pay_ment_type' => $param['pay_ment_type'],
                ':auth_code' => $param['auth_code'],
                ':status' => $param['status'],
                ':ua' => $param['ua'],
                ':ceu_id' => $param['ceu_id'],
                ':ceu_meisai_id' => $param['ceu_meisai_id'],
                ':shiken_meisai_id' => $param['shiken_meisai_id'],
                ':zenshiken_meisai_id' => $param['zenshiken_meisai_id'],
                ':etc_id' => $param['etc_id'],
                ':etc_meisai_id' => $param['etc_meisai_id'],
                ':keiri_shumoku_cd_1' => $param['keiri_shumoku_cd_1'],
                ':keiri_shumoku_cd_2' => $param['keiri_shumoku_cd_2'],
                ':keiri_shumoku_cd_3' => $param['keiri_shumoku_cd_3'],
                ':kessai_kekka' => $param['kessai_kekka'],
                ':error_code' => $param['error_code'],
                ':error_message' => $param['error_message'],
                ':kaiin_no' => $param['kaiin_no'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji'],
                ':cscs_shikaku_koshinryo_nofu_kbn' => $param['cscs_shikaku_koshinryo_nofu_kbn'],
                ':cpt_shikaku_koshinryo_nofu_kbn' => $param['cpt_shikaku_koshinryo_nofu_kbn'],
                ':scsc_koshinryo' => $param['scsc_koshinryo'],
                ':cpt_koshinryo' => $param['cpt_koshinryo'],
                ':yoyaku_kaiin_sbt' => $param['yoyaku_kaiin_sbt'],
                ':konyubi' => $param['konyubi']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 決済発行テーブルを更新
     * @param varchar $id
     * @param varchar $settleno
     * @param varchar $status
     * @param varchar $error_code
     * @param varchar $error_message
     * @param varchar $koshin_user_id
     * @return boolean
     */
    public function updateStatus($id,$settleno,$status,$error_code,$error_message,$koshin_user_id)
    {
           $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_kessai_hakko
                SET   status = :status
					, error_code = :error_code
					, error_message = :error_message
					, koshin_user_id = :koshin_user_id
					, koshin_nichiji = now()
				WHERE sakujo_flg = 0
					AND id	= :id
					AND settleno = :settleno
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':id' => $id
					,':settleno' => $settleno
					,':status' => $status
					,':error_code' => $error_code
					,':error_message' => $error_message
					,':koshin_user_id' => $koshin_user_id
                ]);
            $db->commit();


        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
      return TRUE;
    }

    /*
     * 経理情報テーブルを削除する(削除フラグ=1でUPDATE)（マイページ表示）
     * @param varchar $id
     * @return boolean
     */
    public function updateSakujoFlg($kaiin_no,$etc_id,$koshin_user_id)
    {
            $db = Db::getInstance();
	         $db->beginTransaction();
        try {

                $sql = <<<SQL
                UPDATE tb_keiri_joho
                SET   sakujo_flg = 1
					, koshin_user_id = :koshin_user_id
				WHERE etc_id	= :etc_id
					AND kaiin_no = :kaiin_no
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
					':id' => $id
					,':koshin_user_id' => $koshin_user_id
                ]);
            $db->commit();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    public function findByKessaiHakko($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
            FROM   tb_kessai_hakko
            WHERE kaiin_no = :kaiin_no
            ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Tb_kessai_hakko = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $Tb_kessai_hakko = [];
        }
        return $Tb_kessai_hakko;
    }

    /*
     * ID と Settleno を指定して決済発行テーブルからデータを取得
     * @param varchar $id
     * @param varchar $settleno
     * @return 決済発行テーブルデータ
     */
    public function findByIdAndSettleno($id, $settleno)
    {
        $db = Db::getInstance();
        try {
            $sql = <<<SQL
                SELECT *
                  FROM tb_kessai_hakko
                 WHERE sakujo_flg = 0
                   AND id = :id
                   AND settleno = :settleno
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':id' => $id
               ,':settleno' => $settleno
            ]);
            $Tb_kessai_hakko = $sth->fetchAll();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            $Tb_kessai_hakko = [];
        }
      return $Tb_kessai_hakko;
    }

    /*
     * 会員番号更新処理（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateKaiinNoByOldKaiinNo_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            UPDATE tb_kessai_hakko
               SET kaiin_no = :kaiin_no
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :old_kaiin_no
SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':old_kaiin_no' => $param['old_kaiin_no']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }

}
