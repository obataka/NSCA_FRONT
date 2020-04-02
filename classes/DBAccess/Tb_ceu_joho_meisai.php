<?php
namespace Was;

class Tb_ceu_joho_meisai
{
    public function __construct()
    {
    }

	public function chkExistsJoho($db, $param)
	{
		try {$sth = $db->prepare("SELECT 
									*
								FROM
									tb_ceu_joho_meisai
								WHERE
									kaiin_no = :kaiin_no
								AND 
									ceu_id = :ceu_id
								AND
									sakujo_flg = 0");
			$sth->execute([
				':kaiin_no' => $param['kaiin_no'],
				':ceu_id'   => $param['ceu_id'],
			]);
			$tb_ceu_joho = $sth->fetchAll();
		} catch (\PDOException $e) {
			error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
			$tb_ceu_joho = [];
		}

		return $tb_ceu_joho;
	}

	public function findByCEUShutoku($db, $param)
	{
		try {$sth = $db->prepare("SELECT 
									shutokubi, 
									ceusu,
									event_kbn,
									level_2_point
								FROM
									tb_ceu_joho
								WHERE
									ceu_id = :ceu_id
								");
			$sth->execute([
				':ceu_id'   => $param['ceu_id'],
			]);
			$tb_ceu_joho = $sth->fetch();
		} catch (\PDOException $e) {
			error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
			$tb_ceu_joho = [];
		}

		return $tb_ceu_joho;
	}

	public function updateRecCEUJoho($db, $param, $shutokubi)
    {
        try {
            $sth = $db->prepare("UPDATE tb_ceu_joho_meisai
								SET
									ceu_id            				= :ceu_id
									, kaiin_no            			= :kaiin_no
									, moushikomibi              	= DATE_FORMAT(NOW(), '%Y%m%d')
									, ceu_shutokubi              	= '$shutokubi'
									, nonyubi                       = NULL
									, nonyu_hoho_kbn                = NULL
									, nonyu_kingaku                 = NULL
									, ceusu    						= :ceusu
									, keijo_kbn                		= :keijo_kbn
								WHERE
									ceu_id = :ceu_id
								AND
									kaiin_no = :kaiin_no
								");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':ceu_id'                   		=> $param['ceu_id'],
				':keijo_kbn'                        => $param['keijo_kbn'],
				':ceusu'                        	=> $param['ceusu'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
    }

    public function insertRecCEUJoho($db, $param, $shutokubi, $sankasha_kbn)
    {
        try {
            $sth = $db->prepare("INSERT 
								INTO tb_ceu_joho_meisai(
								ceu_id
								, sankasha_kbn
								, kaiin_no
								, moushikomibi
								, ceu_shutokubi
								, category_kbn
								, staff_kbn
								, ceusu
								, nonyubi
								, nonyu_hoho_kbn
								, nonyu_kingaku
								, level_2_point
								, biko
								, keijo_kbn
								)
								VALUES (
								:ceu_id
								, $sankasha_kbn
								, :kaiin_no
								, DATE_FORMAT(NOW(), '%Y%m%d')
								, '$shutokubi'
								, 0
								, 0
								, :ceusu
								, NULL
								, NULL
								, NULL
								, :level_2_point
								, NULL
								, :keijo_kbn
								)");
            $sth->execute([
                ':kaiin_no'                         => $param['kaiin_no'],
                ':ceu_id'                   		=> $param['ceu_id'],
				':keijo_kbn'                        => $param['keijo_kbn'],
				':ceusu'                        	=> $param['ceusu'],
				':level_2_point'					=> $param['level_2_point'],
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log.txt');
            $db->rollBack();
            return FALSE;
        }
        return TRUE;
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
            UPDATE tb_ceu_joho_meisai
               SET kaiin_no = :kaiin_no
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :old_kaiin_no;
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
