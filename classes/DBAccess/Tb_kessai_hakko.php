<?php
namespace Was;

class Tb_kessai_hakko
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
               , now()
               , now()
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
                ':shop_id' => $argument['shop_id'],
                ':id' => $argument['id'],
                ':pay' => $argument['pay'],
                ':user_name_1' => $argument['user_name_1'],
                ':user_name_2' => $argument['user_name_2'],
                ':user_name_kana_1' => $argument['user_name_kana_1'],
                ':user_name_kana_2' => $argument['user_name_kana_2'],
                ':user_tel' => $argument['user_tel'],
                ':user_mail' => $argument['user_mail'],
                ':user_id' => $argument['user_id'],
                ':auth_key' => $argument['auth_key'],
                ':item_title' => $argument['item_title'],
                ':item_name' => $argument['item_name'],
                ':item_name_kana' => $argument['item_name_kana'],
                ':expire' => $argument['expire'],
                ':char_code' => $argument['char_code'],
                ':pay_type_specify' => $argument['pay_type_specify'],
                ':pay_mode_specify' => $argument['pay_mode_specify'],
                ':settleno' => $argument['settleno'],
                ':seq_no' => $argument['seq_no'],
                ':pay_ment_type' => $argument['pay_ment_type'],
                ':auth_code' => $argument['auth_code'],
                ':status' => $argument['status'],
                ':ua' => $argument['ua'],
                ':ceu_id' => $argument['ceu_id'],
                ':ceu_meisai_id' => $argument['ceu_meisai_id'],
                ':shiken_meisai_id' => $argument['shiken_meisai_id'],
                ':zenshiken_meisai_id' => $argument['zenshiken_meisai_id'],
                ':etc_id' => $argument['etc_id'],
                ':etc_meisai_id' => $argument['etc_meisai_id'],
                ':keiri_shumoku_cd_1' => $argument['keiri_shumoku_cd_1'],
                ':keiri_shumoku_cd_2' => $argument['keiri_shumoku_cd_2'],
                ':keiri_shumoku_cd_3' => $argument['keiri_shumoku_cd_3'],
                ':kessai_kekka' => $argument['kessai_kekka'],
                ':error_code' => $argument['error_code'],
                ':error_message' => $argument['error_message'],
                ':kaiin_no' => $argument['kaiin_no'],
                ':sakujo_flg' => $argument['sakujo_flg'],
                ':sakusei_user_id' => $argument['sakusei_user_id'],
                ':koshin_user_id' => $argument['koshin_user_id'],
                ':cscs_shikaku_koshinryo_nofu_kbn' => $argument['cscs_shikaku_koshinryo_nofu_kbn'],
                ':cpt_shikaku_koshinryo_nofu_kbn' => $argument['cpt_shikaku_koshinryo_nofu_kbn'],
                ':scsc_koshinryo' => $argument['scsc_koshinryo'],
                ':cpt_koshinryo' => $argument['cpt_koshinryo'],
                ':yoyaku_kaiin_sbt' => $argument['yoyaku_kaiin_sbt'],
                ':konyubi' => $argument['konyubi']
            ]);
            $db->commit();

        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error.txt');
            $db->rollBack();
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
}
