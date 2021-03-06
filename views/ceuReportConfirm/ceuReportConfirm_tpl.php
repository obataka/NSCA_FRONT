<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>CEU報告｜確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/ceuReportConfirm.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/ceuReportConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>CEU報告　確認</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>CEU報告</small></span></li>
					<li class="active"><span><small>CEU報告　確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
				</ul>
			</div>
			<article>
				<h3>登録情報</h3>
				<table>
					<tr>
						<th><span class="required">必須</span>会員番号</th>
						<td class="clearfix" id="kaiin_no"></td>
					</tr>
					<tr>
						<th><span class="required">必須</span>氏名</th>
						<td class="clearfix" id="shimei"></td>
					</tr>
					<tr>
						<th><span class="required">必須</span>フリガナ</th>
						<td id="furigana"></td>
					</tr>
					<tr>
						<th><span class="required">必須</span>電話番号</th>
						<td id="tel"></td>
					</tr>
					<tr>
						<th><span class="required">必須</span>メールアドレス</th>
						<td id="address"></td>
					</tr>
					<tr>
						<th><span class="any"></span>CSCS</th>
						<td id="cscs"></td>
					</tr>
					<tr>
						<th><span class="any"></span>CPT</th>
						<td id="cpt"></td>
					</tr>
					<tr>
						<th><span class="any"></span>更新料</th>
						<td id="koushinryo"></td>
					</tr>
				</table>
				<div class="bg_gray">
					<p>このCEU報告フォームの内容が私の継続教育単位取得のための活動を正確に記録したのもであることを確認しました。<br>
						また、現在有効なCPR・AEDの認定を保持していることを確約します。<br>
						継続教育単位のための活動を不正確に報告多場合、認定資格が失効になる可能性があることを承諾します。
					</p>
				</div>
			</article>
			<form>
				<input type="hidden" id="chkCSCS" name="chkCSCS" value="<?php echo $chkCSCS;?>">
				<input type="hidden" id="chkCPT" name="chkCPT" value="<?php echo $chkCPT;?>">
				<input type="hidden" id="wk_kaiin_no" name="wk_kaiin_no" value="">
				<input type="hidden" id="wk_shimei_sei" name="wk_shimei_sei" value="">
				<input type="hidden" id="wk_shimei_mei" name="wk_shimei_mei" value="">
				<input type="hidden" id="wk_furigana_sei" name="wk_furigana_sei" value="">
				<input type="hidden" id="wk_furigana_mei" name="wk_furigana_mei" value="">
				<input type="hidden" id="wk_tel" name="wk_tel" value="">
				<input type="hidden" id="wk_koushinryo" name="wk_koushinryo" value="">
				<section class="btn_wrap">
					<button class="button btn_gray" type="button" value="" id="return" onclick="location.href='#'"><span>内容を修正する</span></button>
					<button class="button" type="button" value="" id="next" onclick="location.href='#'"><span>決済方法選択へ</span></button>
					<button class="button" type="button" value="" id="end" onclick="location.href='#'"><span>完了</span></button>
				</section>
			</form>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>

</html>