<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>支払金額確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/shiharai_kingaku_kakunin.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/unpaidConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap mh_c">
		<h2 class="mb_10">支払金額確認</h2>
		<form action="?" method="post" autocomplete="off" id="unpaidConfirmForm">
			<input type="hidden" name="item_title" id="item_title" value="<?php echo $item_title; ?>">
			<input type="hidden" name="pay" id="pay" value="<?php echo $pay; ?>">
			<input type="hidden" name="name_mei" id="name_mei" value="<?php echo $name_mei; ?>">
			<input type="hidden" name="name_sei" id="name_sei" value="<?php echo $name_sei; ?>">
			<input type="hidden" name="name_sei_kana" id="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
			<input type="hidden" name="name_mei_kana" id="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
			<input type="hidden" name="tel" id="tel" value="<?php echo $tel; ?>">
			<input type="hidden" name="keitai_tel" id="keitai_tel" value="<?php echo $keitai_tel; ?>">
			
			<div class="content_wrap">
				<p class="mt_1em">金額をご確認の上、決済をお願いいたします。</p>
				<table id="kessai">
				</table>
				<section class="btn_b">
					<p class="text_center">※ブラウザの「戻る」ボタンは使用しないでください</p>
					<button class="button" type="button" id="payment" value="" onclick="location.href='#'"><span>支払方法選択へ</span></button>
				</section>

			</div>
		</form>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>