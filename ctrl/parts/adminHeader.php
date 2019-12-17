<?php 
ini_set('session.cookie_httponly', 1);
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
header("X-FRAME-OPTIONS: DENY");
header("X-Content-Type-Options: nosniff");
header('X-XSS-Protection:1; mode=block');

require '../classes/Config/Config.php';
require '../classes/DBAccess/Db.php';

// セッション有効時間取得
$sessionTimeout = Was\Config::SESSION_TIME_OUT;

//if (isset($_SESSION['loginid']) && $_SESSION['time'] + $sessionTimeout > time()) {
//    
//    // ログインしている
//    $_SESSION['time'] = time();
//
//} else {
//
//    // ログインしていない
//    header('Location: https://www.demo-nls02.work/login/');
//    exit();
//}