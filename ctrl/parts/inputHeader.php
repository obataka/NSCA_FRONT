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

// 暗号学的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換します
 $toke_byte = openssl_random_pseudo_bytes(16);
 $csrf_token = bin2hex($toke_byte);
 
 // 生成したトークンをセッションに保存します
unset($_SESSION['csrf_token']);
$_SESSION['csrf_token'] = $csrf_token;
