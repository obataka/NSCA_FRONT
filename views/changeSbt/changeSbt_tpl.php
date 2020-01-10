<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>会員種別の変更｜変更</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/sbt_henko.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/changeSbt.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/iPhone.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h1>会員種別変更</h1>
		<div class="spb_arrows spb_arrows_3ver">
			<ul class="nav nav-tabs step-anchor">
				<li class="active"><span><small>変更後の会員種別選択</small></span></li>
				<li><span class="spb_border"><small>確認</small></span></li>
				<li><span><small>完了</small></span></li>
			</ul>
		</div>
		<p class="top_text">テキストテキストテキストテキストテキストテキスト電話またはメールにて<a href="#">お問い合わせ</a>ください。</p>
		<ul class="error_ul">
			<li class="error" id="err_message"></li>
			<li class="error" id="err_message_sbt"></li>
		</ul>
		<div class="kaiin_sbt">
			<form action="?" method="POST" autocomplete="off" id="changeSbtForm" name="changeSbtForm">
				<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="" />
				<input type="hidden" name="kaihi" id="kaihi" value="" />
				<div class="bg_white">
					<p class="sbt">現在の会員種別</p>
					<p id="kaiin_sbt"></p>
				</div>
				<article>
					<section>
						<div>
							<p class="sbt_title">利用登録(無料)</p>
							<p class="kaihi">会費：無料</p>
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<button class="button sbt_btn" id="__changeRiyo" onclick="location.href='#'"><span>利用登録(無料)への変更</span></button>
					</section>
					<section>
						<div>
							<p class="sbt_title">NSCA正会員</p>
							<p class="kaihi">会費：<span id="seikaiin-kaihi"></span>円</p>
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<button class="button sbt_btn" id="__changeMember" onclick="location.href='#'"><span>NSCA正会員への変更</span></button>
					</section>
					<section>
						<div>
							<p class="sbt_title">学生会員</p>
							<p class="kaihi">会費：<span id="gakusei-kaihi"></span>円</p>
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<button class="button sbt_btn" id="__changeGakusei" onclick="location.href='#'"><span>学生会員への変更</span></button>
					</section>
				</article>
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>