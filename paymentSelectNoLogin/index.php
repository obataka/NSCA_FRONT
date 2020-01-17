<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/paymentSelect/paymentSelectNoLogin_tpl.php';

$wk_tranScreen = (isset($_SESSION['tranScreen'])) ? $_SESSION['tranScreen'] : "";

include_once $includeView;
