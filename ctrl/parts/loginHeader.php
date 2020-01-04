<?php
ini_set('session.cookie_httponly', 1);
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires:-1");
header("X-FRAME-OPTIONS: DENY");
header("X-Content-Type-Options: nosniff");
header('X-XSS-Protection:1; mode=block');

// セッションクリア
unset($_SESSION['kaiinNo']);
unset($_SESSION['time']);

error_log(print_r($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]. " ". date("Y/m/d H:i:s"), true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log'. date("Ymd"). '.txt');
