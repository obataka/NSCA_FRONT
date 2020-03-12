<?php
require_once('tcpdf/tcpdf.php');
require_once('fpdi/fpdi/autoload.php');

$pdf = new setasign\Fpdi\TcpdfFpdi;

$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// テンプレート読み込み
$pdf->setSourceFile('template.pdf');
// 用紙サイズ
$pdf->AddPage('L', 'A3');
$pdf->useTemplate($pdf->importPage(1));

//セッションから値を取得する
$shimei = (isset($_SESSION['shimei'])) ? $_SESSION['shimei'] : "";
$uchiwake = (isset($_SESSION['uchiwake'])) ? $_SESSION['uchiwake'] : "";
$hizuke = (isset($_SESSION['hizuke'])) ? $_SESSION['hizuke'] : "";
$kingaku = (isset($_SESSION['kingaku'])) ? $_SESSION['kingaku'] : "";

$shimei = '柴田千里';
$uchiwake = 'テキストテキストテキストテキストテキストテキストテキストテキスト';
$hizuke = date('y/m/d');
$kingaku = 10000;

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
$file_name = '/home/nls001/demo-nls02.work/public_html/printReceipt/Receipt/' . date("ymd") . substr(GUID(), 0, 8) . '.pdf';

// 
// *********************************************************************
// 
// 出力処理
// 
// *********************************************************************
$pdf->SetFont('msgothic', '', $item["ryoshusho"]["size"]);
$pdf->Text($item["ryoshusho"]["x"], $item["ryoshusho"]["y"], "領収書");

$pdf->SetFont('msgothic', '', $item["hakkobi"]["size"]);
$pdf->Text($item["hakkobi"]["x"], $item["hakkobi"]["y"], "発行日：" . $hizuke);

$pdf->SetFont('msgothic', '', $item["shimei"]["size"]);
$pdf->Text($item["shimei"]["x"], $item["shimei"]["y"], $shimei . "様");

$pdf->SetFont('msgothic', '', $item["keisen"]["size"]);
$pdf->Text($item["keisen"]["x"], $item["keisen"]["y"], "_______________________________");

$pdf->SetFont('msgothic', '', $item["kingaku"]["size"]);
$pdf->Text($item["kingaku"]["x"], $item["kingaku"]["y"], "金額");

$pdf->SetFont('msgothic', '', $item["shohizei"]["size"]);
$pdf->Text($item["shohizei"]["x"], $item["shohizei"]["y"], "￥" . $kingaku);

$pdf->SetFont('msgothic', '', 14);
$pdf->Text($item["shohizei"]["x"], $item["shohizei"]["y"], " ※(消費税込)");

$pdf->SetFont('msgothic', '', $item["tadashigaki"]["size"]);
$pdf->Text($item["tadashigaki"]["x"], $item["tadashigaki"]["y"], " 但し：　");

if (strlen($uchiwake) > 25) {
    $pdf->SetFont('msgothic', '', 18);
    $pdf->Text($item["tadashigaki"]["x"], $item["tadashigaki"]["y"], substr($uchiwake, 0, 25));

    $pdf->SetFont('msgothic', '', 18);
    $pdf->Text(210, 620, substr($uchiwake, 25));
} else {
    $pdf->SetFont('msgothic', '', 18);
    $pdf->Text($item["tadashigaki"]["x"], $item["tadashigaki"]["y"], $uchiwake);
}

$pdf->SetFont('msgothic', '', $item["tadashigaki_naiyo"]["size"]);
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
$pdf->Line(10, 830, 10, 450, array("width" => 0.1, "color" => array(0, 0, 0)));
$pdf->Line(10, 450, 585, 450, array("width" => 0.1, "color" => array(0, 0, 0)));
$pdf->Line(585, 450, 585, 830, array("width" => 0.1, "color" => array(0, 0, 0)));
$pdf->Line(585, 830, 10, 830, array("width" => 0.1, "color" => array(0, 0, 0)));

//フォルダにファイルを保存する
$pdf->Output($file_name, 'F');

//ファイルをブラウザに表示させる
$pdf->Output($file_name, 'I');