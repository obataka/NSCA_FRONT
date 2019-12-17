<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>セミナールーム予約</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/seminar_room_yoyaku.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
		<script type="text/javascript" src="../../viewIncludeFiles/https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
		
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
		<h2>セミナールーム予約</h2>
		<div class="content_wrap">
			<div class="spb_arrows height_62">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>セミナールーム<br class="sp_bl">予約</small></span></li>
					<li><span><small>セミナールーム<br class="sp_bl">予約確認</small></span></li>
					<li><span><small>決済方法選択へ</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<form>
				<dl>
					<dt>使用するセミナールーム</dt>
					<dd>
						<p>ご利用になるルームを選択してください。</p>
						<ul class="text">
							<li>・セミナールーム1…約58平方メートル（最大36席）</li>
							<li>・セミナールーム2…約30平方メートル（最大18席）</li>
						</ul>
						<span class="required">必須</span>
						<div>
							<input id="seminar_1" type="radio" name="parking">
							<label for="seminar_1">セミナールーム1</label><br>
							<input id="seminar_2" type="radio" name="parking">
							<label for="seminar_2">セミナールーム2</label><br>
							<input id="seminar_1_2" type="radio" name="parking">
							<label for="seminar_1_2">セミナールーム1+2</label>
							<ul class="error_ul">
								<li class="error" id="err_seminar"></li>
							</ul>
						</div>
					</dd>
					<dt>利用人数</dt>
					<dd>ご利用人数を選択してください<br>
						<span class="required">必須</span>
						<select id="number_of_people"></select>名
						<ul class="error_ul">
							<li class="error" id="err_number_of_people"></li>
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
						<p class="mt_1">選択した日付：<span class="use_day"></span><br>
							利用時間：<span class="use_month"></span>
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
