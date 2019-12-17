<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Ms_yubin_no.php';

$ret = '';

// POSTデータを取得
$postNo1 = (!empty($_POST['postNo1'])) ? htmlentities($_POST['postNo1'], ENT_QUOTES, "UTF-8") : "";
$postNo2 = (!empty($_POST['postNo2'])) ? htmlentities($_POST['postNo2'], ENT_QUOTES, "UTF-8") : "";

// データ取得処理
$result = (new Ms_yubin_no())->findByYubinno($postNo1 . $postNo2);

// 該当データなしの場合
if ($result == '') {
    echo 0;
// 該当データありの場合
} else {
    echo json_encode($result);
}

die();
