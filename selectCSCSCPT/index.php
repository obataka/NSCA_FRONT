<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/selectCSCSCPT/selectCSCSCPT_tpl.php';

// POST‚©‚çƒpƒ‰ƒ[ƒ^‚ðŽæ“¾‚·‚é
$shiken_sbt = (!empty($_POST['shiken_sbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";
$cscs_shikaku = (!empty($_POST['cscs_shikaku'])) ? htmlentities($_POST['cscs_shikaku'], ENT_QUOTES, "UTF-8") : "";
$jukenryo = (!empty($_POST['jukenryo'])) ? htmlentities($_POST['jukenryo'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
