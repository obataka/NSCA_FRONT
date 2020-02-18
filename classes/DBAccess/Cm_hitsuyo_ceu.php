<?php
namespace Was;

class Cm_hitsuyo_ceu
{
    public function __construct()
    {
    }

    public function findByceuKanrihi($db, $param)
    {
        try {
            $sth = $db->prepare("SELECT cm_hitsuyo_ceu.ceu_kanrihi
            FROM   cm_hitsuyo_ceu, tb_nintei_meisai, cm_control
            WHERE  cm_hitsuyo_ceu.nendo_id = cm_control.nendo_id
            AND    ms_meisho.ninteibi_from <= tb_nintei_meisai.ninteibi
            AND    ms_meisho.ninteibi_to >= tb_nintei_meisai.ninteibi
            GROUP BY ceu_kanrihi
            ");
            $sth->execute([':kaiin_no' => $param['kaiin_no'],]);
            $kanrihi = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $kanrihi = [];
        }

        return $kanrihi;
    }
}
