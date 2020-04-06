<?php

namespace Was;

class Dtb_date_holiday
{
    public function __construct()
    {
    }

    public function findBetweenDate($startDay, $endMonth) {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
SELECT  *
FROM dtb_date_holiday
WHERE DATE(start_date) >= DATE_ADD(CURRENT_DATE, INTERVAL :startDay DAY)
AND DATE(start_date) <= DATE_ADD(CURRENT_DATE, INTERVAL :endMonth MONTH)
AND del_flg = 0;
            ");
            $sth->execute([':startDay' => $startDay, ':endMonth' => $endMonth]);
            $holidayList = $sth->fetchAll();
        } catch (\PDOException $e) {
            $holidayList = [];
        }
        return $holidayList;
    }
}