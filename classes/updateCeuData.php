<?php

namespace Was;

session_start();


require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_ceu.php';
require './DBAccess/Cm_control.php';

$ret = '';
$wk_no = 0;


// POSTデータを取得
// ceuReportConfirm.jsでセットしたPOSTデータを取得する
$kaiin_no = (!empty($_POST['kaiin_no'])) ? htmlentities($_POST['kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$user_id = (!empty($_POST['user_id'])) ? htmlentities($_POST['user_id'], ENT_QUOTES, "UTF-8") : "";
$cscs_koushinryo_nofu_kbn = (!empty($_POST['cscs_koushinryo_nofu_kbn'])) ? htmlentities($_POST['cscs_koushinryo_nofu_kbn'], ENT_QUOTES, "UTF-8") : "";
$cpt_koushinryo_nofu_kbn = (!empty($_POST['cpt_koushinryo_nofu_kbn'])) ? htmlentities($_POST['cpt_koushinryo_nofu_kbn'], ENT_QUOTES, "UTF-8") : "";

$nonyubi = date("Y/m/d H:i:s");
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//年度ID取得
$nendo_id = (new Cm_control())->findByNendoId($db);


// 更新用パラメーター設定
$param = [
    'kaiin_no'                                  => $kaiin_no,
    'nonyubi'                                   => $nonyubi,
    'user_id'                                   => $user_id,
    'nendo_id'                                  => $nendo_id['nendo_id'],
];

error_log(print_r($param, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//CSCSレコード存在確認
$cscs_exists = (new Tb_kaiin_ceu())->chkExistsCSCS($db, $param);
error_log(print_r($cscs_exists, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//CPTレコード存在確認
$cpt_exists = (new Tb_kaiin_ceu())->chkExistsCPT($db, $param);
error_log(print_r($cpt_exists, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');


if ($cscs_koushinryo_nofu_kbn == 1) {
    if (!empty($cscs_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCSCS($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            NULL;
            // 更新成功の場合
        } else {
            NULL;
        }
    } else {
        // 追加処理
        $result = (new Tb_kaiin_ceu())->insertRecCSCS($db, $param);
        error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
        // 追加失敗の場合
        if ($result == false) {
            NULL;
            // 追加成功の場合
        } else {
            NULL;
        }
    }
}

if ($cpt_koushinryo_nofu_kbn == 1) {
    if (!empty($cpt_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCPT($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            NULL;
            // 更新成功の場合
        } else {
            NULL;
        }
    } else {
        // 追加処理
        $result = (new Tb_kaiin_ceu())->insertRecCPT($db, $param);
        error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
        // 追加失敗の場合
        if ($result == false) {
            NULL;
            // 追加成功の場合
        } else {
            NULL;
        }
    }
}


echo $result;
die();
