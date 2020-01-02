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

require '../classes/Config/Config.php';
require '../classes/DBAccess/Db.php';

// セッションクリア
unset($_SESSION['loginid']);
unset($_SESSION['time']);
