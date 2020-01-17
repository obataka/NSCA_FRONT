<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name='format-detection' content='telephone=no' />
		<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
		<title>決済方法選択</title>
		<!-- favicon -->
		<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
		<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
		<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
		<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
		<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/shiharai_hoho_sentaku.css">

		<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/paySelNoLogin.js"></script>
	</head>
	<body>
		<header class="header_logo">
			<div>
				<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
			</div>
		</header>
		<div class="wrap mh_c">
			<h1>決済方法選択</h1>
			<div class="content_wrap">
				<p class="seikyu">請求内容</p>
				<form action="?" method="post" autocomplete="off" id="confirmForm" enctype="multipart/form-data">
					<input type="hidden" name="tranScreen" id="tranScreen" value="<?php echo $wk_tranScreen; ?>">
					<div class="bg_gray">
						<p style="font-weight: bold; color: red; padding-bottom: 0.5em;">※確認事項</p>
							<ul class="kakunin_jiko">
								<li>・請求内容をご確認いただき、決済方法をお選びください。<br>　→支払いを開始しますと申込み内容の変更はできません。</li>
								<li>・クレジットカード決済の場合、手続き完了後事務局から返信メールをお送りします。</li>
								<li>・コンビ二決済の場合、手続き完了後とコンビ二でのお支払い後、返信メールをお送りします。</li>
							</ul>
						<p style="padding-top: 10px;">メールが届かない場合は、NSCA ジャパン事務局までご連絡ください。<br>(@nsca-japan.or.jp からのメールが届くよう、必ず受信設定をしてください。)</p>
					</div>
					<div class="shiharai_naiyo">
						<table>
							<thead>
								<tr>
									<th>お客様名</th>
									<th>お支払い内容</th>
									<th>お支払い金額</th>
								</tr>
							</thead>
							<tr>
								<td id="pay_customer_name">○○　○○　様</td>
								<td id="pay_title">CSCS認定試験【両方（基礎科学、実践／応用）】</td>
								<td id="pay_money">49,300円</td>
							</tr>
						</table>
					</div>
					<p class="seikyu">決済方法選択</p>
					<div class="bg_gray">
						<p style="font-weight: bold; color: red; padding-bottom: 0.5em;">※決済処理での注意事項</p>
							<ul class="kakunin_jiko">
								<li>・決済中はブラウザの戻るボタンは使用しないでください。</li>
								<li>・各決済の画面が表示されるまで時間がかかる場合がございます。</li>
								<li>・お問合せの際、確認させて頂くことがございますので、決済画面最終ページは印刷して保管をお願い致します。</li>
							</ul>
						<p style="padding-top: 10px;">メールが届かない場合は、NSCA ジャパン事務局までご連絡ください。<br>(@nsca-japan.or.jp からのメールが届くよう、必ず受信設定をしてください。)</p>
					</div>
					<div class="text_content_3 left">
						<div class="bg_white">
							<p class="title">カード決済</p>
							<div class="img img_1">
								<img src="../../viewIncludeFiles/image/jcb60px.gif">
								<img src="../../viewIncludeFiles/image/visa60px.gif">
								<img src="../../viewIncludeFiles/image/master60px.gif">
							</div>
							<ul>
								<li>・3Dセキュア（本人認証決済サービス）を導入しています。 詳しくは<a href="https://www.f-regi.com/service/3d.html" target="_blank">こちら&gt;&gt;</a></li>
							</ul>
							<button class="button" type="button" id="pay_credit_start"><span>支払い開始</span></button>
						</div>
					</div>
					<div class="text_content_3">
						<div class="bg_white">
							<p class="title">コンビニ支払い</p>
							<div class="img img_2">
								<img src="../../viewIncludeFiles/image/fregi-convenience.gif">
							</div>
							<ul>
								<li>・コンビ二エンスストアでお支払い ⇒ 決済完了後に決済確認画面は表示されません。</li>
							</ul>
							<button class="button" type="button" id="pay_cvs_start"><span>支払い開始</span></button>
						</div>
					</div>
					<button class="button" type="button" value="" id="__goBack"  style="width: 20%;"><span>戻る</span></button>
				</form>
			</div>
		</div>
		<footer id="footer">
		</footer>
	</body>
</html>
