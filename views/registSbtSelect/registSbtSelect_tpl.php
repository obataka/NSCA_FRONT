<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>入会申込｜会員種別選択</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/nyukai_sbt.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/registSbtSelect.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

    </head>
    <body>
	<header class="header_logo">
		<div>
			<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
		</div>
	</header>
	<div class="wrap mh_c">
		<h1>新規登録 会員種別選択</h1>
		<div class="spb_arrows">
			<ul class="nav nav-tabs step-anchor">
				<li class="active"><span><small>会員種別選択</small></span></li>
				<li><span class="spb_border"><small>入力</small></span></li>
				<li><span class="spb_border"><small>確認</small></span></li>
				<li><span><small>完了</small></span></li>
			</ul>
		</div>
		<ul class="error_ul">
			<li class="error" id="err_message"></li>
		</ul>
		<div class="kaiin_sbt">
			<form action="?" method="POST" autocomplete="off" id="registSbtSleForm" name="registSbtSleForm">
				<section>
					<div>
						<p class="sbt_title">利用登録(無料)</p>
						<p class="kaihi">会費：無料</p>
					</div>
					<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<button class="button" id="__registRiyo"><span>利用登録(無料)の<br>登録はこちら</span></button>
				</section>
				<section>
					<div>
						<p class="sbt_title">NSCA正会員</p>
						<p class="kaihi">会費：<span id="seikaiin-kaihi"></span>円</p>
					</div>
					<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<button class="button" id="__registMember"><span>NSCA正会員の<br>登録はこちら</span></button>
				</section>
				<section>
					<div>
						<p class="sbt_title">学生会員</p>
						<p class="kaihi">会費：<span id="gakusei-kaihi"></span>円</p>
					</div>
					<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<button class="button" id="__registGakusei"><span>学生会員の<br>登録はこちら</span></button>
				</section>
				<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="" />
				<input type="hidden" name="kaihi" id="kaihi" value="" />
				<input type="hidden" name="mailAdress" id="mailAdress" value="<?php echo $wk_mail_address;?>" />
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
