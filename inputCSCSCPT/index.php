<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/inputCSCSCPT/inputCSCSCPT_tpl.php';

// POSTからパラメータを取得する
$shiken_sbt = (!empty($_POST['shiken_sbt'])) ? htmlentities($_POST['shiken_sbt'], ENT_QUOTES, "UTF-8") : "";
$cscs_shikaku = (!empty($_POST['cscs_shikaku'])) ? htmlentities($_POST['cscs_shikaku'], ENT_QUOTES, "UTF-8") : "";
$jukenryo = (!empty($_POST['jukenryo'])) ? htmlentities($_POST['jukenryo'], ENT_QUOTES, "UTF-8") : "";

//試験名を格納する変数
$shikenmei = "";

//試験種別や合否区分で表示させる試験名を変える
if ($shiken_sbt == 1) {
    if ($cscs_shikaku == "両方") {
        $shikenmei = "CSCS 認定試験【両方(基礎化学、実践／応用)】";
    } else if ($cscs_shikaku == "基礎のみ") {
        $shikenmei = "CSCS 認定試験【基礎化学】";
    } else if ($cscs_shikaku == "実践のみ") {
        $shikenmei = "CSCS 認定試験【実践／応用】";
    }
} else {
    $shikenmei = "NSCA_CPT 認定試験";
}

include_once $includeView;
