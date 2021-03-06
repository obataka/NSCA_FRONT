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
$job = (!empty($_POST['sel_job'])) ? htmlentities($_POST['sel_job'], ENT_QUOTES, "UTF-8") : "";
$wk_sel_job = (!empty($_POST['wk_sel_job'])) ? htmlentities($_POST['wk_sel_job'], ENT_QUOTES, "UTF-8") : "";
$wk_shikaku_yuko = (!empty($_POST['wk_shikaku_yuko'])) ? htmlentities($_POST['wk_shikaku_yuko'], ENT_QUOTES, "UTF-8") : "";
$wk_yuko_kigen = (!empty($_POST['wk_yuko_kigen'])) ? htmlentities($_POST['wk_yuko_kigen'], ENT_QUOTES, "UTF-8") : "";
$wk_kakunin = (!empty($_POST['wk_kakunin'])) ? htmlentities($_POST['wk_kakunin'], ENT_QUOTES, "UTF-8") : "";
$wk_shiken_policy_doi = (!empty($_POST['wk_shiken_policy_doi'])) ? htmlentities($_POST['wk_shiken_policy_doi'], ENT_QUOTES, "UTF-8") : "";
$wk_cancel_policy_doi = (!empty($_POST['wk_cancel_policy_doi'])) ? htmlentities($_POST['wk_cancel_policy_doi'], ENT_QUOTES, "UTF-8") : "";
$wk_rinri_doi = (!empty($_POST['wk_rinri_doi'])) ? htmlentities($_POST['wk_rinri_doi'], ENT_QUOTES, "UTF-8") : "";
$wk_hitsuyo = (!empty($_POST['wk_hitsuyo'])) ? htmlentities($_POST['wk_hitsuyo'], ENT_QUOTES, "UTF-8") : "";
$wk_caution_1 = (!empty($_POST['wk_caution_1'])) ? htmlentities($_POST['wk_caution_1'], ENT_QUOTES, "UTF-8") : "";
$wk_caution_2 = (!empty($_POST['wk_caution_2'])) ? htmlentities($_POST['wk_caution_2'], ENT_QUOTES, "UTF-8") : "";
$wk_caution_3 = (!empty($_POST['wk_caution_3'])) ? htmlentities($_POST['wk_caution_3'], ENT_QUOTES, "UTF-8") : "";
$wk_gakui = (!empty($_POST['wk_gakui'])) ? htmlentities($_POST['wk_gakui'], ENT_QUOTES, "UTF-8") : "";
$wk_txt_gakui = (!empty($_POST['wk_txt_gakui'])) ? htmlentities($_POST['wk_txt_gakui'], ENT_QUOTES, "UTF-8") : "";
$wk_bunya = (!empty($_POST['wk_bunya'])) ? htmlentities($_POST['wk_bunya'], ENT_QUOTES, "UTF-8") : "";
$wk_txt_bunya = (!empty($_POST['wk_txt_bunya'])) ? htmlentities($_POST['wk_txt_bunya'], ENT_QUOTES, "UTF-8") : "";
$wk_bunya_sonota = (!empty($_POST['wk_bunya_sonota'])) ? htmlentities($_POST['wk_bunya_sonota'], ENT_QUOTES, "UTF-8") : "";

//試験名を格納する変数
$shikenmei = "";

//試験種別で表示させる試験名を変える
if ($shiken_sbt == 1) {
    $shikenmei = "CSCS認定試験";
} else {
    $shikenmei = "NSCA_CPT認定試験";
}

include_once $includeView;
