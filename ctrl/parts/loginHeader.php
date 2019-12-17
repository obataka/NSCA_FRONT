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

// セッションクリア
unset($_SESSION['loginid']);
unset($_SESSION['time']);
