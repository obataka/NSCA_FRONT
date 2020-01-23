<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/entryConfirm/entryConfirm_tpl.php';

// POSTからパラメータを取得する
$shiken_sbt = (!empty($_POST['shiken_sbt'])) ? htmlentities($_POST['shiken_sbt'], ENT_QUOTES, "UTF-8") : "";
$cscs_shikaku = (!empty($_POST['cscs_shikaku'])) ? htmlentities($_POST['cscs_shikaku'], ENT_QUOTES, "UTF-8") : "";
$jukenryo = (!empty($_POST['jukenryo'])) ? htmlentities($_POST['jukenryo'], ENT_QUOTES, "UTF-8") : "";
$wk_kaiin_no = (!empty($_POST['wk_kaiin_no'])) ? htmlentities($_POST['wk_kaiin_no'], ENT_QUOTES, "UTF-8") : "";
$wk_shimei = (!empty($_POST['wk_shimei'])) ? htmlentities($_POST['wk_shimei'], ENT_QUOTES, "UTF-8") : "";
$wk_furigana = (!empty($_POST['wk_furigana'])) ? htmlentities($_POST['wk_furigana'], ENT_QUOTES, "UTF-8") : "";
$wk_firstlast = (!empty($_POST['wk_firstlast'])) ? htmlentities($_POST['wk_firstlast'], ENT_QUOTES, "UTF-8") : "";
$wk_tel = (!empty($_POST['wk_tel'])) ? htmlentities($_POST['wk_tel'], ENT_QUOTES, "UTF-8") : "";
$wk_address = (!empty($_POST['wk_address'])) ? htmlentities($_POST['wk_address'], ENT_QUOTES, "UTF-8") : "";
$wk_pc_address = (!empty($_POST['wk_pc_address'])) ? htmlentities($_POST['wk_pc_address'], ENT_QUOTES, "UTF-8") : "";
$wk_shikaku_yuko = (!empty($_POST['wk_shikaku_yuko'])) ? htmlentities($_POST['wk_shikaku_yuko'], ENT_QUOTES, "UTF-8") : "";
$wk_yuko_kigen = (!empty($_POST['wk_yuko_kigen'])) ? htmlentities($_POST['wk_yuko_kigen'], ENT_QUOTES, "UTF-8") : "";

//試験名を格納する変数
$shikenmei = "";

//試験種別で表示させる試験名を変える
if ($shiken_sbt == 1) {
    $shikenmei = "CSCS認定試験";
} else {
    $shikenmei = "NSCA_CPT認定試験";
}

include_once $includeView;
