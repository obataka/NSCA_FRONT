<?php
namespace Was;

class Cm_hitsuyo_ceu
{
    public function __construct()
    {
    }

    public function findByceuKanrihi($db, $ninteibi, $nendo_id)
    {
        try {
            $sth = $db->prepare("SELECT ceu_kanrihi
            FROM   cm_hitsuyo_ceu
            WHERE  nendo_id = $nendo_id
            AND    ninteibi_from <= '$ninteibi'
            AND    ninteibi_to >= '$ninteibi'
            GROUP BY ceu_kanrihi
            ");
            $sth->execute();
            $kanrihi = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $kanrihi = [];
        }

        return $kanrihi;
    }

    public function findByCEUJogen($db, $param, $ninteibi)
    {
        try {
            $sth = $db->prepare("SELECT jogen_ceusu
            FROM   cm_hitsuyo_ceu
            WHERE  nendo_id = :nendo_id
            AND    category_kbn = :category_kbn
            AND    ninteibi_from <= '$ninteibi'
            AND    ninteibi_to >= '$ninteibi'
            ");
            $sth->execute([
                ':nendo_id'      => $param['nendo_id'],
                ':category_kbn'  => $param['category_kbn'],
            ]);
            $kanrihi = $sth->fetchAll();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', 'error_log.txt');
            $kanrihi = [];
        }

        return $kanrihi;
    }

}
