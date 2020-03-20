<?php
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF;

$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// 用紙サイズ
$pdf->AddPage('L', 'B5');

// フォント設定 - MSゴシック
$tcpdf_fonts = new TCPDF_FONTS();
$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/MS-Gothic-01.ttf');

//セッションから値を取得する
$shimei = (isset($_SESSION['shimei'])) ? $_SESSION['shimei'] : "";
$uchiwake = (isset($_SESSION['uchiwake'])) ? $_SESSION['uchiwake'] : "";
$kingaku = (isset($_SESSION['kingaku'])) ? $_SESSION['kingaku'] : "";

$shimei = '柴田千里';
$uchiwake = 'テキストテキストテキストテキストテキストテキストテキストテキスト';
$kingaku = 10000;

// 
// *********************************************************************
// 
// 各項目の座標値、文字サイズ設定
// 
// *********************************************************************

$item = array();

$item["ryoshusho"]                  = array("x" => 100.0, "y" => 15.0, "size" => 40);  // 領収書
$item["shimei"]                     = array("x" => 103.0, "y" => 45.0, "size" => 20);  // 氏名
$item["keisen"]                     = array("x" => 55.0, "y" => 55.0, "size" => 20);  // 罫線
$item["kingaku"]                    = array("x" => 115.0, "y" => 68.0, "size" => 18);  // 金額
$item["shohizei"]                   = array("x" => 90.0, "y" => 78.0, "size" => 18);  // 消費税
$item["tadashigaki"]                = array("x" => 115.0, "y" => 90.0, "size" => 14);  // 但し書き
$item["tadashigaki_naiyo"]          = array("x" => 40.0, "y" => 130.0, "size" => 14);  // 但し書き(内容)


// 
// *********************************************************************
// 
// ファイル名生成
// 
// *********************************************************************


//乱数を生成する関数
function GUID()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

//ファイルパス作成
$file_name = '/home/nls001/demo-nls02.work/public_html/printReceipt/Receipt/' . date("Ymd") . substr(GUID(), 0, 8) . '.pdf';

// 
// *********************************************************************
// 
// 出力処理
// 
// *********************************************************************
$pdf->SetFont($font, '', $item["ryoshusho"]["size"]);
$pdf->Text($item["ryoshusho"]["x"], $item["ryoshusho"]["y"], "領収書");

$pdf->SetFont($font, '', $item["shimei"]["size"]);
$pdf->Text($item["shimei"]["x"], $item["shimei"]["y"], $shimei . "様");

$pdf->SetFont($font, '', $item["keisen"]["size"]);
$pdf->Text($item["keisen"]["x"], $item["keisen"]["y"], "_______________________________________");

$pdf->SetFont($font, '', $item["kingaku"]["size"]);
$pdf->Text($item["kingaku"]["x"], $item["kingaku"]["y"], "金額");

$pdf->SetFont($font, '', $item["shohizei"]["size"]);
$pdf->Text($item["shohizei"]["x"], $item["shohizei"]["y"], "￥" . number_format($kingaku) . "-");

$pdf->SetFont($font, '', 14);
$pdf->Text($item["shohizei"]["x"] + strlen($kingaku) + 30, $item["shohizei"]["y"] + 0.8, " ※(消費税込)");

$pdf->SetFont($font, '', $item["tadashigaki"]["size"]);
$pdf->Text($item["tadashigaki"]["x"], $item["tadashigaki"]["y"], " 但し：　");

if (mb_strlen($uchiwake) > 25) {
    $pdf->SetFont($font, '', 18);
    $pdf->Text($item["tadashigaki"]["x"] - 70, $item["tadashigaki"]["y"] + 10, mb_substr($uchiwake, 0, 25, "utf-8"));

    $pdf->SetFont($font, '', 18);
    $pdf->Text($item["tadashigaki"]["x"] - 70, $item["tadashigaki"]["y"] + 20, mb_substr($uchiwake, 25, null, "utf-8"));
} else {
    $pdf->SetFont($font, '', 18);
    $pdf->Text($item["tadashigaki"]["x"] - 70, $item["tadashigaki"]["y"] + 10, $uchiwake);
}

$pdf->SetFont($font, '', $item["tadashigaki_naiyo"]["size"]);
$pdf->Text($item["tadashigaki_naiyo"]["x"], $item["tadashigaki_naiyo"]["y"], " の代金として、上記金額正に領収いたしました。");

//画像
$photo_extension = array("jpg", "JPG", "jpeg", "png", "PNG");
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
    $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    if (in_array($file_extension, $photo_extension)) {
        $photofile = sprintf("./tmp/%s_%s.%s", time(), uniqid(), $file_extension);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photofile)) {
            $pdf->Image($photofile, 350, 500, 208, 75);
            unlink($photofile);
        }
    }
}

//罫線を引く
$pdf->Rect(10, 10, 230, 155, 'D');

//フォルダにファイルを保存する
$pdf->Output($file_name, 'F');

//ファイルをブラウザに表示させる
$pdf->Output($file_name, 'I');
