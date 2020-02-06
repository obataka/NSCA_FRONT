<?php

include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/seminarList/seminarList_tpl.php';
if (isset($_SESSION['kaiinNo'])) {
   // ƒƒOƒCƒ“‚µ‚Ä‚¢‚é
   $wk_kaiin_no = $_SESSION['kaiinNo'];

} else {

    $wk_kaiin_no = "";
}

$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
$tb_name = (!empty($_POST['tb_name'])) ? htmlentities($_POST['tb_name'], ENT_QUOTES, "UTF-8") : "";
$screen_name = 'seminarList';
include_once $includeView;
