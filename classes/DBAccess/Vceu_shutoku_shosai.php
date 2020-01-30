<?php
namespace Was;

class Vceu_shutoku_shosai
{
    public function __construct()
    {
    }

    public function findByMeisai($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT
                                    COUNT(*)
                                 FROM
                                    vceu_shutoku_shosai
                                 LEFT JOIN
                                    cm_control
                                 ON
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                 WHERE
                                    kaiin_no = :kaiin_no
                                 AND
                                    vceu_shutoku_shosai.nendo_id = cm_control.nendo_id
                                ");
            $sth->execute([':kaiin_no' => '10251033',]);
            // $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $Meisai = $sth->fetch();
        } catch (\PDOException $e) {
            $meisai = [];
        }
        return $Meisai;
    }




}
