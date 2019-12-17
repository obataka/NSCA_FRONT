<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>HPC施設利用申込</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/hpc_riyo_moshikomi.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
    	<script>
			$(function(){
				$("select").wrap("<span class='select_wrap'></span>");
				
				$('#datepicker').datepicker();
			});
		</script>
    </head>
    <body>
		<header id="header">
		</header>
		<div class="wrap">
			<h2>HPC施設利用申込</h2>
			<div class="content_wrap">
				<div class="spb_arrows height_62">
					<ul class="nav nav-tabs step-anchor">
						<li class="active"><span><small>HPC施設利用申込</small></span></li>
						<li><span><small>HPC施設利用申込確認</small></span></li>
						<li><span><small>決済方法選択へ</small></span></li>
						<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
					</ul>
				</div>
				<form>
					<dl>
						<dt>施設利用案内</dt>
						<dd>テキストテキストテキストテキスト</dd>
						<dt>駐車場利用</dt>
						<dd>テキストテキストテキストテキスト<br>
							<span class="required">必須</span>
							<input id="not_use" type="radio" name="parking">
							<label for="not_use">利用しない</label>
							<input id="use" type="radio" name="parking">
							<label for="use">利用する</label>
							<ul class="error_ul">
								<li class="error" id="err_parking"></li>
							</ul>
						</dd>
						<dt>測定機能の希望(有料)</dt>
						<dd>テキストテキストテキストテキスト<br>
							<span class="required">必須</span>
							<input id="sokutei" class="checkbox" type="checkbox" name="sokutei">
							<label class="checkbox" for="sokutei">体組成計</label>
							<ul class="error_ul">
								<li class="error" id="err_sokutei"></li>
							</ul>
						</dd>
						<dt>利用時間帯</dt>
						<dd>テキストテキストテキストテキスト<br>
							<span class="required">必須</span>
							<input id="am" class="checkbox" type="checkbox" name="use_time">
							<label class="checkbox" for="am">午前</label>
							<input id="pm" class="checkbox" type="checkbox" name="use_time">
							<label class="checkbox" for="pm">午後</label>
							<input id="night" class="checkbox" type="checkbox" name="use_time">
							<label class="checkbox" for="night">夕方・夜</label>
							<ul class="error_ul">
								<li class="error" id="err_time_zone"></li>
							</ul>
						</dd>
						<dt>利用月</dt>
						<dd><span class="required">必須</span>
							<select id="use_month"></select>
							<ul class="error_ul">
								<li class="error" id="err_use_month"></li>
							</ul>
						</dd>
						<dt>利用日</dt>
						<dd>テキストテキストテキストテキスト<br>
							<span class="required">必須</span>
							<!---カレンダー--->
							<div id="datepicker"></div>
							<ul class="error_ul">
								<li class="error" id="err_use_day"></li>
							</ul>
							<p class="mt_1">選択した日付：<br>
								利用時間：
							</p>
						</dd>
					</dl>
				</form>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
			</div>
		</div>
		<footer id="footer">
		</footer>
	</body>
</html>
