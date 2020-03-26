<?php
namespace Was;

class Tb_kaiin_jotai
{
    public function __construct()
    {
    }

    /*
    * ログイン判定
    * @param varchar $loginId
    * @param varchar $loginPswd
    * @return array|mixed
    */
    public function findByYukohizuke($param)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT yuko_hizuke FROM tb_kaiin_jotai WHERE tb_kaiin_jotai.kaiin_no = :kaiin_no");
            $sth->execute([':kaiin_no' => $param['kaiin_no']]);
            // $sth->execute([':kaiin_no' => $kaiin_no,]);
            $Tb_kaiin_jotai = $sth->fetch();
        } catch (\PDOException $e) {
            $Tb_kaiin_jotai = [];
        }
        return $Tb_kaiin_jotai;
    }
    
    /*
    * 更新（接続及びトランザクションは外側実施）
    * @param object $db
    * @param array $param
    * @return boolean
    */
    public function updateKaiinJotai($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      taikai_shorui_juribi    = :taikai_shorui_juribi
                    , taikai_riyu_kbn         = :taikai_riyu_kbn
                    , taikai_riyu_biko        = :taikai_riyu_biko
                    , koshin_user_id          = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':taikai_shorui_juribi'     => $param['taikai_shorui_juribi'],
                    ':taikai_riyu_kbn'          => $param['taikai_riyu_kbn'],
                    ':taikai_riyu_biko'         => $param['taikai_riyu_biko'],
                    ':koshin_user_id'           => $param['koshin_user_id'],
                    ':kaiin_no'                 => $param['kaiin_no'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }
    
    /*
    * 更新（接続及びトランザクションは外側実施）
    * @param object $db
    * @param array $param
    * @return boolean
    */
    public function Taikaihizuke($db, $param3)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      taikai_hizuke          = :taikai_hizuke
                    , koshin_user_id         = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':taikai_hizuke'            => $param3['taikai_hizuke'],
                    ':koshin_user_id'           => $param3['koshin_user_id'],
                    ':kaiin_no'                 => $param3['kaiin_no'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }




    /*
    * 更新（接続及びトランザクションは外側実施）
    * @param object $db
    * @param array $param
    * @return boolean
    */
    public function TaikaiYoyaku($db, $param4)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      taikai_shorui_juribi    = :taikai_shorui_juribi
                    , koshin_user_id         = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':taikai_shorui_juribi'             => $param4['taikai_shorui_juribi'],
                    ':koshin_user_id'                   => $param4['koshin_user_id'],
                    ':kaiin_no'                         => $param4['kaiin_no'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/eroor_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }


    /*
     * 会員番号から継続会費の支払状況を取得する
     * @param varchar $kaiinNo
     * @return array
     */
    public function findKeizokuKaihiByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT
	  yuko_hizuke
	, gakuseisho_kakunin_kbn
	, sbt_henko_yoyakubi
	, tb_kaiin_jotai.yoyaku_kaiin_sbt
	, tekiyo_kaishibi
	, kaihi_nyukimbi
	, kaihi_shiharai_hoho_kbn
	, keiri_dempyo_no
	, nonyubi
	, nonyu_kingaku
	, nonyu_hoho_kbn
	, tb_kessai_hakko.id
	, tb_kessai_hakko.settleno
	, tb_kessai_hakko.koshin_nichiji
FROM tb_kaiin_jotai
INNER JOIN (
	SELECT kaiin_no 
		, MAX(keiri_dempyo_no)  AS max_dempyo_no
	FROM tb_keiri_joho
	WHERE keiri_shumoku_cd_1 = '01'
		AND keiri_shumoku_cd_2 = '02'
		AND sakujo_flg = 0
		AND nonyu_hoho_kbn IS NOT NULL
		AND kaiin_no = :kaiin_no
	GROUP BY kaiin_no
) tb_keiri_joho_max
	ON  tb_kaiin_jotai.kaiin_no = tb_keiri_joho_max.kaiin_no
LEFT JOIN tb_keiri_joho
	ON tb_kaiin_jotai.kaiin_no = tb_keiri_joho.kaiin_no
	AND max_dempyo_no = keiri_dempyo_no
LEFT JOIN tb_kessai_hakko
	ON tb_keiri_joho.id = tb_kessai_hakko.id
WHERE tb_kaiin_jotai.sakujo_flg = 0
;
            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinJotai  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinJotai = [];
        }
        return $kaiinJotai;
    }

    public function updateKaiinJotai_sbtChange($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      sbt_henko_yoyakubi            = NULL
                    , yoyaku_kaiin_sbt              = NULL
                    , tekiyo_kaishibi               = NULL
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

    public function updateKaiinJotai_limitCheck($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      taikai_hizuke                 = :yuko_hizuke
                    , koshin_user_id                = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'                 => $param['kaiin_no'],
                    ':yuko_hizuke'              => $param['yuko_hizuke'],
                    ':koshin_user_id'           => $param['koshin_user_id'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateKaiinJotai_autoQuit($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                      taikai_hizuke                 = :yuko_hizuke
                    , taikai_riyu_kbn               = 5
                    , koshin_user_id                = :koshin_user_id
                WHERE
                      kaiin_no = :kaiin_no;
SQL;
                $sth = $db->prepare($sql);
                $sth->execute([
                    ':kaiin_no'                 => $param['kaiin_no'],
                    ':yuko_hizuke'              => $param['yuko_hizuke'],
                    ':koshin_user_id'           => $param['koshin_user_id'],
                ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateKaiinJotai_kaiinshoClear($db, $kisanbi)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                    kaiinsho_hassobi                 = NULL
                WHERE
                    COALESCE(keizoku_hizuke,nyukaibi) < '$kisanbi';
SQL;
                $sth = $db->prepare($sql);
                $sth->execute();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function updateKaiinJotai_gakuseishoClear($db, $param)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                    gakuseisho_kakunimbi                 = NULL
                  , gakuseisho_kakunin_kbn               = NULL
                  , koshin_user_id                       = :koshin_user_id
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

    public function updateKaiinJotai_errorCodeClear($db, $kisanbi)
    {
         try {
                $sql = <<<SQL
                UPDATE tb_kaiin_jotai
                SET
                    kaihi_kessai_error_code                 = NULL
                  , koshin_user_id                          = 'system'
                WHERE
                    kaihi_kessai_jikkobi < '$kisanbi'
                AND
                    kaihi_kessai_error_code	IN (1,3);
SQL;
                $sth = $db->prepare($sql);
                $sth->execute();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

}
