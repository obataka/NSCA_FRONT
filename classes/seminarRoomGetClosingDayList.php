<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Dtb_date_holiday.php';

// POSTデータを取得
$startDay = (!empty($_POST['startDay'])) ? htmlentities($_POST['startDay'], ENT_QUOTES, "UTF-8") : "";
$endMonth = (!empty($_POST['endMonth'])) ? htmlentities($_POST['endMonth'], ENT_QUOTES, "UTF-8") : "";

// データ取得処理
$result = (new Dtb_date_holiday())->findBetweenDate($startDay, $endMonth);

if ($result == '') {
    echo 0;
} else {
    $closingDayList = [];

    foreach ($result as $row) {
        $calcStartDate = NULL;
        $calcEndDate = NULL;

        $startDate = new \DateTime($row['start_date']);
        $endDate = new \DateTime($row['end_date']);

        if (($startDate->format('H:i:s') == '00:00:00') && ($endDate->format('H:i:s') == '23:59:59')) {
            // パターン1
            // start_dateの日付部分～end_dateの日付部分を選択不可とする
            $calcStartDate = $startDate->format('Y-m-d');
            $calcEndDate = $endDate->format('Y-m-d');
        } else {
            if ($startDate->format('Y-m-d') != $endDate->format('Y-m-d')) {
                if ($startDate->format('H:i:s') == '00:00:00') {
                    // パターン2
                    //start_dateの日付部分 から start_dateの日付部分 - 1 を選択不可とする
                    $calcStartDate = $startDate->format('Y-m-d');
                    $calcEndDate = $endDate->modify('-1 days')->format('Y-m-d');
                } else {
                    if ($endDate->format('H:i:s') == '23:59:59') {
                        // パターン3
                        //start_dateの日付部分 + 1 から end_dateの日付部分 を選択不可とする
                        $calcStartDate = $startDate->modify('+1 days')->format('Y-m-d');
                        $calcEndDate = $endDate->format('Y-m-d');
                    } else {
                        // パターン4
                        //start_dateの日付部分 + 1 から end_dateの日付部分 - 1 を選択不可とする
                        $calcStartDate = $startDate->modify('+1 days')->format('Y-m-d');
                        $calcEndDate = $endDate->modify('-1 days')->format('Y-m-d');
                    }
                }
            }
        }

        if (!is_null($calcStartDate) && !is_null($calcEndDate)) {
            for ($i = $calcStartDate; $i <= $calcEndDate; $i = date('Y-m-d', strtotime($i . '+1 day'))) {
                $closingDayList[] = $i;
            }
        }
    }
    echo json_encode($closingDayList);
}

die();
