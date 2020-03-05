<?php
namespace Was;

session_start();

require './Config/Config.php';

$kaiin_no = '';

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}

echo $kaiin_no;

die();
