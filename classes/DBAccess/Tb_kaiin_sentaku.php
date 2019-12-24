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
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $Tb_kaiin_sentaku = [];
        }

        return $Tb_kaiin_sentaku;
    }
}