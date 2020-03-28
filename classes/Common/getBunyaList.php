<?php
namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Vms_meisho.php';

$meisho_kbn = 24; // NSCA以外の認定資格

// データ取得処理
$result = (new Vms_meisho())->findByMeishoKbn($meisho_kbn);

// 該当データなしの場合
if (empty($result)) {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
