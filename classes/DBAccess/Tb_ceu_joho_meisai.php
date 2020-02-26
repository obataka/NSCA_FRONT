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


}
