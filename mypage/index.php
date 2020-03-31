<?php
include_once '../ctrl/parts/inputHeader.php';

$shimei = (isset($_SESSION['shimei'])) ? $_SESSION['shimei'] : "";

$includeView = '../views/mypage/mypage_tpl.php';

include_once $includeView;
