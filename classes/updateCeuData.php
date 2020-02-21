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

// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

//年度ID取得
$nendo_id = (new Cm_control())->findByNendoId($db);


// 更新用パラメーター設定
$param = [
    'kaiin_no'                                  => $kaiin_no,
    'nonyubi'                                   => date("Y/m/d H:i:s"),
    'user_id'                                   => $user_id,
    'nendo_id'                                  => $nendo_id['nendo_id'],
];

//CSCSレコード存在確認
$cscs_exists = (new Tb_kaiin_ceu())->chkExistsCSCS($db, $param);

//CPTレコード存在確認
$cpt_exists = (new Tb_kaiin_ceu())->chkExistsCPT($db, $param);

//CSCSにチェックがある場合
if ($cscs_koushinryo_nofu_kbn == 1 && $cpt_koushinryo_nofu_kbn == 0) {
    //レコードがあれば更新、なければ追加
    if (!empty($cscs_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCSCS($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 更新成功の場合
        } else {
            // commit
            $db->commit();

            // 戻り値に1設定
            $result = 1;
        }
    } else {
        // 追加処理
        $result = (new Tb_kaiin_ceu())->insertRecCSCS($db, $param);
        // 追加失敗の場合
        if ($result == false) {
            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 追加成功の場合
        } else {
            // commit
            $db->commit();

            // 戻り値に1設定
            $result = 1;
        }
    }
    //CPTにチェックがある場合
} else if ($cpt_koushinryo_nofu_kbn == 1 && $cscs_koushinryo_nofu_kbn == 0) {
    //レコードがあれば更新、なければ追加
    if (!empty($cpt_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCPT($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 更新成功の場合
        } else {
            // commit
            $db->commit();

            // 戻り値に1設定
            $result = 1;
        }
    } else {
        // 追加処理
        $result = (new Tb_kaiin_ceu())->insertRecCPT($db, $param);
        // 追加失敗の場合
        if ($result == false) {
            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 追加成功の場合
        } else {
            // commit
            $db->commit();

            // 戻り値に1設定
            $result = 1;
        }
    }
} else {
    //CSCSとCPT両方にチェックがある場合で、
    //CSCSとCPT両方のレコードが存在する場合
    if (!empty($cscs_exists) && !empty($cpt_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCSCS($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 更新成功の場合
        } else {
            // 更新処理
            $result = (new Tb_kaiin_ceu())->updateRecCPT($db, $param);
            // 更新失敗の場合
            if ($result == false) {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
                // 更新成功の場合
            } else {
                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;
            }
        }
        //CSCSのレコードが存在する場合、CSCSのレコードを更新してCPTのレコードを追加
    } else if (!empty($cscs_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCSCS($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 更新成功の場合
        } else {
            // 追加処理
            $result = (new Tb_kaiin_ceu())->insertRecCPT($db, $param);
            // 追加失敗の場合
            if ($result == false) {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
                // 追加成功の場合
            } else {
                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;
            }
        }

        //CPTのレコードが存在する場合、CPTのレコードを更新してCSCSのレコードを追加
    } else if (!empty($cpt_exists)) {
        // 更新処理
        $result = (new Tb_kaiin_ceu())->updateRecCPT($db, $param);
        // 更新失敗の場合
        if ($result == false) {
            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 更新成功の場合
        } else {
            // 追加処理
            $result = (new Tb_kaiin_ceu())->insertRecCSCS($db, $param);
            // 追加失敗の場合
            if ($result == false) {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
                // 追加成功の場合
            } else {
                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;
            }
        }
        //両方とも存在しない場合、両方とも追加
    } else {
        // 追加処理
        $result = (new Tb_kaiin_ceu())->insertRecCPT($db, $param);
        // 追加失敗の場合
        if ($result == false) {
            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
            // 追加成功の場合
        } else {
            // 追加処理
            $result = (new Tb_kaiin_ceu())->insertRecCSCS($db, $param);
            // 追加失敗の場合
            if ($result == false) {
                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
                // 追加成功の場合
            } else {
                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;
            }
        }
    }
}




echo $result;
die();
