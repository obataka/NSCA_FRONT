<?php
namespace Was;

class Tb_kaiin_pick_up
{
    public function __construct()
    {
    }


    /*
     * 会員番号から有効データを取得する
     * @param varchar $kaiinNo
     * @return array
     */
    public function findByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
FROM tb_kaiin_pick_up
WHERE sakujo_flg = 0
;
            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinPickup  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinPickup = [];
        }
        return $kaiinPickup;
    }








}
