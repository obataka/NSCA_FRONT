<?php
include_once '../ctrl/parts/inputHeader.php';

$includeView = '../views/videoPlayBack/videoPlayBack_tpl.php';

$doga_id = (!empty($_POST['doga_id'])) ? htmlentities($_POST['doga_id'], ENT_QUOTES, "UTF-8") : "";

include_once $includeView;
