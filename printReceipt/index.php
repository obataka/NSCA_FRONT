<?php
require_once('tcpdf/tcpdf.php');
require_once('fpdi/src/autoload.php');

use setasign\Fpdi\TcpdfFpdi;
 
$pdf = new TcpdfFpdi();
$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);    
$pdf->setPrintFooter(false);
// テンプレート読み込み
$pdf->setSourceFile('resume_template.pdf');
// 用紙サイズ
$pdf->AddPage('L', 'A3');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - MSゴシック
$tcpdf_fonts = new TCPDF_FONTS();
$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/msgothic.ttc');

//セッションから値を取得する
$shimei = (isset($_SESSION['shimei'])) ? $_SESSION['shimei'] : "";
$uchiwake = (isset($_SESSION['uchiwake'])) ? $_SESSION['uchiwake'] : "";
$hizuke = (isset($_SESSION['hizuke'])) ? $_SESSION['hizuke'] : "";
$kingaku = (isset($_SESSION['kingaku'])) ? $_SESSION['kingaku'] : "";

// 
// *********************************************************************
// 
// 各項目の座標値、文字サイズ設定
// 
// *********************************************************************
 
$item = array();
 
$item["ryoshusho"]                  = array("x" => 50.0,  "y" => 750.0, "size" => 25);  // 領収書
$item["hakkobi"]                    = array("x" => 400.0, "y" => 780.0, "size" => 14);  // 発行日
$item["shimei"]                     = array("x" => 200.0, "y" => 720.0, "size" => 20);  // 氏名
$item["keisen"]                     = array("x" => 150.0, "y" => 710.0, "size" => 20);  // 罫線
$item["kingaku"]                    = array("x" => 150.0, "y" => 680.0, "size" => 18);  // 金額
$item["shohizei"]                   = array("x" => 250.0, "y" => 680.0, "size" => 18);  // 消費税
$item["tadashigaki"]                = array("x" => 150.0, "y" => 650.0, "size" => 14);  // 但し書き
$item["tadashigaki_naiyo"]          = array("x" => 150.0, "y" => 605.0, "size" => 14);  // 但し書き(内容)
$item["uchiwake"]                   = array("x" => 35.5,  "y" => 52.9, "size" => 9);    // 内訳

// 
// *********************************************************************
// 
// ファイル名生成
// 
// *********************************************************************
 

//乱数を生成する関数
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

//ファイル名生成
$file_name = date("ymd").substr(GUID(), 0, 8).'.pdf';

// 
// *********************************************************************
// 
// 出力処理
// 
// *********************************************************************
$pdf->SetFont($font, '', $item["ryoshusho"]["size"]);
$pdf->Text($item["ryoshusho"]["x"], $item["ryoshusho"]["y"], "領収書");

$pdf->SetFont($font, '', $item["ryoshusho"]["size"]);
$pdf->Text($item["hakkobi"]["x"], $item["hakkobi"]["y"], "発行日：".$hizuke);

