<?php

namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Event_joho_shutoku.php';

// POSTデータを取得
// seminarEntryVis.jsでセットしたPOSTデータを取得する
$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
$tb_name = (!empty($_POST['tb_name'])) ? htmlentities($_POST['tb_name'], ENT_QUOTES, "UTF-8") : "";

$param = [
    'ceu_id'                          => $ceu_id,
];

// データ取得処理
//テーブル名によって呼び出す関数を変える
switch ($tb_name) {
    case 'tb_ceu_conference_joho':
        $result = (new event_joho_shutoku())->findByCeuConferenceJoho($param);
        break;

    case 'tb_ceu_joho':
        $result = (new event_joho_shutoku())->findByCeuJoho($param);
        break;

    case 'tb_ceu_sokai_joho':
        $result = (new event_joho_shutoku())->findByCeuSokaiJoho($param);
        break;

    case 'tb_toreken_joho':
        $result = (new event_joho_shutoku())->findByTorekenJoho($param);
        break;

    default:
        break;
}

// 該当データなしの場合
if ($result == '') {
    echo 0;
    // 該当データありの場合
} else {
    echo json_encode($result);
}

die();
