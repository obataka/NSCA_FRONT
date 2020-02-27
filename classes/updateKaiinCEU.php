<?php

namespace Was;

use DateTime;

session_start();


require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_nintei_meisai.php';
require './DBAccess/Cm_hitsuyo_ceu.php';
require './DBAccess/Tb_kaiin_nintei.php';
require './DBAccess/Tb_ceu_joho_sentaku.php';
require './DBAccess/Tb_kaiin_ceu.php';


$ret = '';
$wk_no = 0;

$wk_kaiin_no = "";

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 10251033;

$user_id = "hoge";

//personalDevelopmentConfirmでセットしたPOSTデータを取得する
$category_kbn = (!empty($_POST['category_kbn'])) ? htmlentities($_POST['category_kbn'], ENT_QUOTES, "UTF-8") : "";
$nendo_id = (!empty($_POST['nendo_id'])) ? htmlentities($_POST['nendo_id'], ENT_QUOTES, "UTF-8") : "";
$ceusu = (!empty($_POST['ceusu'])) ? htmlentities($_POST['ceusu'], ENT_QUOTES, "UTF-8") : "";
$shutokubi = (!empty($_POST['shutokubi'])) ? htmlentities($_POST['shutokubi'], ENT_QUOTES, "UTF-8") : "";
$chkCSCS = (!empty($_POST['chkCSCS'])) ? htmlentities($_POST['chkCSCS'], ENT_QUOTES, "UTF-8") : "";
$chkCPT = (!empty($_POST['chkCPT'])) ? htmlentities($_POST['chkCPT'], ENT_QUOTES, "UTF-8") : "";

// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();


// 更新用パラメーター設定
$param = [
    'user_id'                                   => $user_id,
    'kaiin_no'                                  => $wk_kaiin_no,
    'category_kbn'                              => $category_kbn,
    'nendo_id'                                  => $nendo_id,
    'ceusu'                                     => $ceusu,
    'shutokubi'                                 => $shutokubi,
];

// cscs認定日取得処理
$ninteibi_cscs = (new Tb_nintei_meisai())->findBycscsNinteibi($db, $param);

// cpt認定日取得処理
$ninteibi_cpt = (new Tb_nintei_meisai())->findBycptNinteibi($db, $param);

//カテゴリーごとのCEU数の上限取得(CSCS)
$jogen_cscs = (new Cm_hitsuyo_ceu())->findByCEUJogen($db, $param, $ninteibi_cscs);

//カテゴリーごとのCEU数の上限取得(CPT)
$jogen_cpt = (new Cm_hitsuyo_ceu())->findByCEUJogen($db, $param, $ninteibi_cpt);

//TB会員認定のレベル2ポイントの更新
//レコード存在確認
$level2_exists = (new Tb_kaiin_nintei())->chkExistsLevel2($db, $param);

if (!empty($level2_exists) && $level2_exists[0]['level_2_point'] && (strtotime($ninteibi_cscs['ninteibi']) <= strtotime($param['shutokubi']) || strtotime($ninteibi_cpt['ninteibi']) <= strtotime($param['shutokubi']))) {
    $result = (new Tb_kaiin_nintei())->updateLevel2($db, $param, $level2_exists[0]['level_2_point']);
    error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
    if ($result == false) {
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
        // 更新成功の場合
    } else {
        //レベル2テーマの更新

        //レベル2テーマ更新成功フラグ
        //成功の場合true, 失敗の場合false
        $flg = true;
        for ($i = 1; $i <= 6; $i++) {
            //レコード存在確認
            $level2_theme_exists = (new Tb_ceu_joho_sentaku())->chkExistsLevel2Theme($db, $i);
            if (!empty($level2_theme_exists)) {

                // 更新処理
                $result = (new Tb_kaiin_nintei())->updateLevel2Theme($db, $param, $i);
                // 更新失敗の場合
                if ($result == false) {
                    $db->rollBack();

                    // flgにfalse設定
                    $flg = false;
                    break;
                }
            }
        }

        if ($flg) {
            
            if ($chkCSCS == 1 && $chkCPT == 1) {
                //CSCSの更新
                $cscs_exists = (new Tb_kaiin_ceu())->chkExistsCSCSFlg($db, $param);
                if (!empty($cscs_exists) && strtotime($ninteibi_cscs['ninteibi']) <= strtotime($param['shutokubi']) && $jogen_cscs > 0) {
                    $ceusu = (new Tb_kaiin_ceu())->getCSCSCEUsu($db, $param);
                    $koshin_ceusu = $param['ceusu'];
                    switch ($param['category_kbn']) {
                        case '1':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_a_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '2':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_b_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '3':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_c_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '4':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_d_gokei'];
                                break;
                            } else {
                                break;
                            }
                        default:
                            break;
                    }

                    //CEU数の更新
                    $result = (new Tb_kaiin_ceu())->updateCEUsuCSCS($db, $param, $koshin_ceusu);
                    // 更新失敗の場合
                    if ($result == false) {
                        $db->rollBack();

                        // 戻り値に0設定
                        $result = 0;
                        // 更新成功の場合
                    } else {

                        $result = (new Tb_kaiin_ceu())->updateCEUsuZanCSCS($db, $param, $koshin_ceusu);
                        // 更新失敗の場合
                        if ($result == false) {
                            $db->rollBack();

                            // 戻り値に0設定
                            $result = 0;
                            // 更新成功の場合
                        } else {
                            //NSCA_CPTの更新
                            $cpt_exists = (new Tb_kaiin_ceu())->chkExistsCPT($db, $param);
                            if (!empty($cpt_exists) && strtotime($ninteibi_cpt['ninteibi']) <= strtotime($param['shutokubi']) && $jogen_cpt > 0) {
                                $ceusu = (new Tb_kaiin_ceu())->getCPTCEUsu($db, $param);
                                $koshin_ceusu = $param['ceusu'];
                                switch ($param['category_kbn']) {
                                    case '1':
                                        if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                            $koshin_ceusu = $jogen_cpt - $cpt_exists['category_a_gokei'];
                                            break;
                                        } else {
                                            break;
                                        }
                                    case '2':
                                        if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                            $koshin_ceusu = $jogen_cpt - $cpt_exists['category_b_gokei'];
                                            break;
                                        } else {
                                            break;
                                        }
                                    case '3':
                                        if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                            $koshin_ceusu = $jogen_cpt - $cpt_exists['category_c_gokei'];
                                            break;
                                        } else {
                                            break;
                                        }
                                    case '4':
                                        if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                            $koshin_ceusu = $jogen_cpt - $cpt_exists['category_d_gokei'];
                                            break;
                                        } else {
                                            break;
                                        }
                                    default:
                                        break;
                                }

                                //CEU数の更新
                                $result = (new Tb_kaiin_ceu())->updateCEUsuCPT($db, $param, $koshin_ceusu);
                                // 更新失敗の場合
                                if ($result == false) {
                                    $db->rollBack();

                                    // 戻り値に0設定
                                    $result = 0;
                                    // 更新成功の場合
                                } else {

                                    $result = (new Tb_kaiin_ceu())->updateCEUsuZanCPT($db, $param, $koshin_ceusu);
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
                                }
                            }
                        }
                    }
                }
            } else if ($chkCSCS == 1) {
                //CSCSの更新
                $cscs_exists = (new Tb_kaiin_ceu())->chkExistsCSCSFlg($db, $param);
                if (!empty($cscs_exists) && strtotime($ninteibi_cscs['ninteibi']) <= strtotime($param['shutokubi']) && $jogen_cscs > 0) {
                    $ceusu = (new Tb_kaiin_ceu())->getCSCSCEUsu($db, $param);
                    $koshin_ceusu = $param['ceusu'];
                    switch ($param['category_kbn']) {
                        case '1':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_a_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '2':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_b_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '3':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_c_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '4':
                            if (($cscs_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cscs) {
                                $koshin_ceusu = $jogen_cscs - $cscs_exists['category_d_gokei'];
                                break;
                            } else {
                                break;
                            }
                        default:
                            break;
                    }

                    //CEU数の更新
                    $result = (new Tb_kaiin_ceu())->updateCEUsuCSCS($db, $param, $koshin_ceusu);
                    // 更新失敗の場合
                    if ($result == false) {
                        $db->rollBack();

                        // 戻り値に0設定
                        $result = 0;
                        // 更新成功の場合
                    } else {

                        $result = (new Tb_kaiin_ceu())->updateCEUsuZanCSCS($db, $param, $koshin_ceusu);
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
                    }
                }
            } else if ($chkCPT == 1) {
                //NSCA_CPTの更新
                $cpt_exists = (new Tb_kaiin_ceu())->chkExistsCPT($db, $param);
                if (!empty($cpt_exists) && strtotime($ninteibi_cpt['ninteibi']) <= strtotime($param['shutokubi']) && $jogen_cpt > 0) {
                    $ceusu = (new Tb_kaiin_ceu())->getCPTCEUsu($db, $param);
                    $koshin_ceusu = $param['ceusu'];
                    switch ($param['category_kbn']) {
                        case '1':
                            if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                $koshin_ceusu = $jogen_cpt - $cpt_exists['category_a_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '2':
                            if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                $koshin_ceusu = $jogen_cpt - $cpt_exists['category_b_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '3':
                            if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                $koshin_ceusu = $jogen_cpt - $cpt_exists['category_c_gokei'];
                                break;
                            } else {
                                break;
                            }
                        case '4':
                            if (($cpt_exists['category_a_gokei'] + $koshin_ceusu) > $jogen_cpt) {
                                $koshin_ceusu = $jogen_cpt - $cpt_exists['category_d_gokei'];
                                break;
                            } else {
                                break;
                            }
                        default:
                            break;
                    }

                    //CEU数の更新
                    $result = (new Tb_kaiin_ceu())->updateCEUsuCPT($db, $param, $koshin_ceusu);
                    // 更新失敗の場合
                    if ($result == false) {
                        $db->rollBack();

                        // 戻り値に0設定
                        $result = 0;
                        // 更新成功の場合
                    } else {

                        $result = (new Tb_kaiin_ceu())->updateCEUsuZanCPT($db, $param, $koshin_ceusu);
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
                    }
                }
            }
        } else {
            $result = 0;
        }
    }
} else {
    $result = 1;
}

echo $result;
die();
