<?php
namespace Was;

class Config
{
    const DB_HOST = 'mysql7049.xserver.jp';
    const DB_PORT = '5432';
    const DB_NAME = 'nls001_nscademo';
    const DB_USER = 'nls001_nscaadmin';
    const DB_PASS = 'Nsca8355';
    const DB_CHARSET = 'utf8mb4';

    const MAIL_FROM_ADDRESS = 'sugai@luxor-system.jp';
    const MAIL_FROM_NAME = 'My Page';

    const HEADER_TITLE = 'マイページ';
    const SESSION_TIME_OUT = 3600;
//
//    const AREA_ID_FUKUOKA = 1;
//    const AREA_ID_KITAKYU = 2;
//    const AREA_ID_KUMAMOTO = 3;
//    const AREA_ID_NAGASAKI = 4;
//
//    const RESERVE_PROP_OK = 1;
//    const RESERVE_PROP_NO = 0;
//    const RESERVE_TYPE_KOJIN = 0;
//    const RESERVE_TYPE_DANTAI = 1;
//    const RESERVE_TIME_FROM_1 = '10:00';
//    const RESERVE_TIME_TO_1 = '11:30';
//    const RESERVE_TIME_FROM_2 = '12:00';
//    const RESERVE_TIME_TO_2 = '13:30';
//    const RESERVE_TIME_FROM_3 = '14:00';
//    const RESERVE_TIME_TO_3 = '15:30';
//    const RESERVE_TIME_FROM_4 = '16:00';
//    const RESERVE_TIME_TO_4 = '17:30';
//    const RESERVE_TIME_FROM_5 = '18:00';
//    const RESERVE_TIME_TO_5 = '19:30';
//    const RESERVE_TIME_NONE = '--:--';
//    const RESERVE_LIMIT_KOJIN = 2;
//    const RESERVE_LIMIT_DANTAI = 2;
//    const BATCH_INS_USER = 'DailyBatchIns';
//    const BATCH_UPD_USER = 'DailyBatchUpd';

    /************************************************************************
    * 納入方法区分
    *************************************************************************/
    // クレジット
    const GEUM_PAY_CARD = 1;
    // コンビニ
    const GEUM_PAY_CONVENIENCE = 2;
    // Pay-easy
    const GEUM_PAY_PAYEASY = 4;

    /************************************************************************
    * セミナールーム予約
    *************************************************************************/
    //利用人数
    const CAPACITIES = [
        '1-10' => '1〜10',
        '11-20' => '11〜20',
        '21-30' => '21〜30',
        '31-40' => '31〜40',
        '41-50' => '41〜50',
        '51-60' => '51〜60',
    ];
}
