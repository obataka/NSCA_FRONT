<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>CEUクイズ｜回答入力</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/ceu_kaito_nyuryoku.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
		<header id="header">
		</header>
			<div class="wrap">
				<h2>CEUクイズ　回答入力</h2>
				<p class="h2_text">テキストテキスト(0000年00月号)</p>
				<div class="content_wrap">
					<div class="spb_arrows height_62">
						<ul class="nav nav-tabs step-anchor">
							<li class="active"><span><small>回答入力</small></span></li>
							<li><span><small>回答内容確認</small></span></li>
							<li><span><small>決済方法選択</small></span></li>
							<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
						</ul>
					</div>
					<p class="text">選択肢から解答を選んでください。</p>
					<div class="content">
						<p class="dai">問題</p>
						<ul>
							<li><input id="q1_1" type="radio" name="q_1" value="1"><label class="radio" for="q1_1">テキストテキスト</label><br></li>
							<li><input id="q1_2" type="radio" name="q_1" value="1"><label class="radio" for="q1_2">テキストテキスト</label><br></li>
							<li><input id="q1_3" type="radio" name="q_1" value="1"><label class="radio" for="q1_3">テキストテキスト</label><br></li>
						</ul>
						<ul class="error_ul">
							<li class="error" id="err_question_1"></li>
						</ul>
					</div>
					<div class="content">
						<p class="dai">問題</p>
						<ul>
							<li><input id="q2_1" type="radio" name="q_2" value="1"><label class="radio" for="q2_1">テキストテキスト</label><br></li>
							<li><input id="q2_2" type="radio" name="q_2" value="1"><label class="radio" for="q2_2">テキストテキスト</label><br></li>
							<li><input id="q2_3" type="radio" name="q_2" value="1"><label class="radio" for="q2_3">テキストテキスト</label><br></li>
							
						</ul>
						<ul class="error_ul">
							<li class="error" id="err_question_2"></li>
						</ul>
					</div>
					<div class="content">
						<p class="dai">問題</p>
						<ul>
							<li><input id="q3_1" type="radio" name="q_3" value="1"><label class="radio" for="q3_1">テキストテキスト</label><br></li>
							<li><input id="q3_2" type="radio" name="q_3" value="1"><label class="radio" for="q3_2">テキストテキスト</label><br></li>
							<li><input id="q3_3" type="radio" name="q_3" value="1"><label class="radio" for="q3_3">テキストテキスト</label><br></li>
						</ul>
						<ul class="error_ul">
							<li class="error" id="err_question_3"></li>
						</ul>
					</div>
					<div class="content">
						<p class="dai">問題</p>
						<ul>
							<li><input id="q4_1" type="radio" name="q_4" value="1"><label class="radio" for="q4_1">テキストテキスト</label><br></li>
							<li><input id="q4_2" type="radio" name="q_4" value="1"><label class="radio" for="q4_2">テキストテキスト</label><br></li>
							<li><input id="q4_3" type="radio" name="q_4" value="1"><label class="radio" for="q4_3">テキストテキスト</label><br></li>
						</ul>
						<ul class="error_ul">
							<li class="error" id="err_question_4"></li>
						</ul>
					</div>
					<section class="btn_wrap">
						<button class="button back" type="button" value="" onclick="location.href='#'"><span>CEUクイズ一覧へ</span></button>
						<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
					</section>
				</div>
			</div>
		<footer id="footer">
		</footer>
	</body>
</html>
