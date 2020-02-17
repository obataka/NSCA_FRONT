<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/extensionApplication/extensionApplication_tpl.php';

// POST‚©‚çƒpƒ‰ƒ[ƒ^‚ðŽæ“¾‚·‚é
$shiken_meisai_id = (!empty($_POST['shiken_meisai_id'])) ? htmlentities($_POST['shiken_meisai_id'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
