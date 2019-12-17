<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>クレジットカード情報｜</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/credit_joho_nyuryoku.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
	<header id="header">
	</header>
		<div class="wrap mh_c btn_b_wrap">
			<h2 class="mb_10">クレジットカード情報</h2>
			<div class="content_wrap">
				<p>テキストテキストテキストテキストテキストテキスト</p>
				<div>
					<table>
						<tr>
							<th><span class="required">必須</span>カード番号</th>
							<td>
								<div>
									<input id="card_nb" class="w_250" type="text">
									<ul class="error_ul">
										<li class="error" id="err_card_nb"></li>
									</ul>
									<p>例）000000000000000<br>
									テキストテキストテキストテキスト</p>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td>
								<div>
									<input id="neme" class="w_250" type="text">
									<ul class="error_ul">
										<li class="error" id="err_name"></li>
									</ul>
									<p>例）テキストテキスト<br>
										テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								</div>
							</td>
						</tr>
						<tr class="card_date">
							<th><span class="required">必須</span>カード有効期限</th>
							<td>
								<div>
									<input id="cade_1" class="w_75" type="text"><span>／</span><input id="card_2" class="w_75" type="text">
									<ul class="error_ul">
										<li class="error" id="err_card_date"></li>
									</ul>
									<p>例）00／00</p>
								</div>
							</td>
						</tr>
						<tr class="code">
							<th><span class="required">必須</span>セキュリティーコード</th>
							<td>
								<input id="code" type="text">
								<ul class="error_ul">
									<li class="error" id="err_code"></li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<section class="btn_wrap btn_b_2">
					<button class="button back" type="button" value="" onclick="location.href='nyukai_riyo.html'"><span>決済方法選択画面へ</span></button>
					<button class="button" type="submit" value="" onclick="location.href='nyukai_toroku_kanryo.html'"><span>次へ</span></button>
				</section>
			</div>
		</div>
	<footer id="footer">
	</footer>
</body>
</html>
