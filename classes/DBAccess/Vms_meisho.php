<?php
namespace Was;

class Vms_meisho
{
    public function __construct()
    {
    }

    /*
     * 名称区分から該当する名称コードと名称のリストを取得する
     * @param varchar $meishoKbn
     * @return array|mixed
     */
    public function findByMeishoKbn($meishoKbn)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
	SELECT *
	FROM vms_meisho
	WHERE meisho_kbn = :meishoKbn
;
            ");
            $sth->execute([':meishoKbn' => $meishoKbn]);
            $meishoList  = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $meishoList = [];
        }
        return $meishoList;
    }





}
