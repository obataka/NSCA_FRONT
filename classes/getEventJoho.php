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
    'tb_name'                         => $tb_name,
];

// データ取得処理
$result = (new event_joho_shutoku())->findByEventJoho($param);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
