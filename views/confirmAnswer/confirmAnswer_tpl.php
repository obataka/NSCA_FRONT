<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>CEUクイズ｜回答確認</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/ceu_kaito_kakunin.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/confirmAnswer.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
		<header id="header">
		</header>
			<div class="wrap mh_c">
			<form action="?" method="post" autocomplete="off" id="inputAnswer">
					<input type="hidden" name="ceu_id1" id="ceu_id1" value="<?php echo $ceu_id1; ?>">				
					

					<?php foreach($sel_q as $key => $value) {
						echo '<input type="hidden" name="sel_q" id="sel_q';
						echo $key;
						echo '" value="';
						echo $value;
						echo '">';
					} ?>
					

					<?php foreach($q_ as $key => $value) {
						echo '<input type="hidden" name="q_[';
						echo $key;
						echo ']" id="q_';
						echo $key;
						echo '" value="';
						echo $value;
						echo '">';
					} ?>



				<h2>CEUクイズ　回答確認</h2>
				<p class="h2_text">テキストテキスト(0000年00月号)</p>
				<div class="content_wrap">
					<div class="spb_arrows height_62">
						<ul class="nav nav-tabs step-anchor">
							<li><span><small>回答入力</small></span></li>
							<li class="active"><span><small>回答内容確認</small></span></li>
							<li><span><small>決済方法選択</small></span></li>
							<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
						</ul>
					</div>
					<p class="text">選択肢から解答を選んでください。</p><br>
					<section class="p_section">
						<!--<div class="content">
							<p class="dai">問題</p>
							<p class="kai"></p>
						</div>
						<div class="content">
							<p class="dai">問題</p>
							<p class="kai"></p>
						</div>
						<div class="content">
							<p class="dai">問題</p>
							<p class="kai"></p>
						</div>
						<div class="content">
							<p class="dai">問題</p>
							<p class="kai"></p>
						</div>-->
					</section>
					
					<section class="btn_wrap">
						<button class="button back" type="button" value="" onclick="location.href='#'"><span>回答を修正する</span></button>
						<button class="button" type="submit" value="" onclick="location.href='#'"><span>決済方法選択へ</span></button>
					</section>
				</div>
			</form>
			</div>
		<footer id="footer">
		</footer>
	</body>
</html>
