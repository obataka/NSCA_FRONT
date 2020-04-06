<?php

namespace Was;

class Dtb_timezone_place_detail
{
    public function __construct()
    {
    }

    public function findTimeZone($targetDay) {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("
SELECT
  D02.*
 ,CLOSE.*
 ,PLACE_STS.*,
CASE
 WHEN close_start IS NULL THEN FALSE -- 休館日NG
 WHEN start IS NOT NULL THEN FALSE -- 予約NG
 ELSE TRUE
END JUDGE
FROM dtb_timezone_place_detail D02
INNER JOIN dtb_timezone_place D01
ON D01.place_time_id = D02.place_time_id
/*
INNER JOIN vms_meisho A01
ON A01.meisho_cd = D01.place_type_id
AND A01.meisho_kbn = 249
AND A01.meisho_cd = 2
AND D01.del_flg = 0
*/
LEFT JOIN (
SELECT
  TIME(start_date) close_start
 ,TIME(end_date) close_end
FROM dtb_date_holiday
WHERE DATE(start_date) >= :targetDay
AND DATE(start_date) <= :targetDay
AND del_flg = 0 ) CLOSE
ON (close_start >= end_time OR close_end <= start_time)
LEFT JOIN (
SELECT
  TIME(place_start_date) start
 ,TIME(place_end_date) end
FROM dtb_place_status
WHERE place_type_id = 2
AND del_flg = 0
AND DATE(place_start_date) = :targetDay
) PLACE_STS
ON (end > start_time and start < end_time)
ORDER BY D02.timezone_place_detail_id
            ");
            $sth->execute([':targetDay' => $targetDay]);
            $holidayList = $sth->fetchAll();
        } catch (\PDOException $e) {
            $holidayList = [];
        }
        return $holidayList;
    }
}