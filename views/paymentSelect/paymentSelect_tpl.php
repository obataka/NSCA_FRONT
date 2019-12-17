<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>支払方法選択</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/shiharai_hoho_sentaku.css">
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
			<h2>支払方法選択</h2>
			<div class="content_wrap">
				<!--<div class="spb_arrows">
					<ul class="nav nav-tabs step-anchor">
						<li class="active"><span><small>支払方法選択</small></span></li>
						<li><span><small>テキスト</small></span></li>
						<li><span><small>テキスト</small></span></li>
						<li><span><small>テキスト</small></span></li>
					</ul>
				</div>-->
				<p class="h2_text">テキストテキストテキストテキストテキストテキスト</p>
				<h3>決済方法選択</h3>
				<p class="seikyu">請求内容<span>○○　○○　様</span></p>
				<div class="shiharai_naiyo">
					<table>
						<thead>
							<tr>
								<th>お支払い内容</th>
								<th>お支払い金額</th>
							</tr>	
						</thead>
						<tr>
							<td>CSCS認定試験【両方（基礎科学、実践／応用）】</td>
							<td data-label="お支払い金額">49,300円</td>
						</tr>
					</table>
				</div>
			  <div class="bg_gray">
				  <p>※確認事項</p>
					<ul class="kakunin_jiko">
						<li>・請求内容をご確認いただき、決済方法をお選びください。</li>
						<li>→支払いを開始しますと申込み内容の変更はできません。</li>
						<li>・各決済処理は決済代行会社(F-REGI)専用サイトにて行っていただきます。</li>
						<li>→尚、クレジットカード専用サイトにてキャンセルを選択された場合、申込まれた内容は全てクリアされます。</li>
						<li>・クレジットカード決済の場合、手続き完了後事務局から返信メールをお送りします。</li>
						<li>・コンビ二決済の場合、手続き完了後とコンビ二でのお支払い後、返信メールをお送りします。</li>
						<li>・Pay-easy(金融機関決済)の場合、手続き完了後とPay-easy(金融機関決済)でのお支払い後、返信メールをお送りします。</li>
					</ul>
				  <p>メールが届かない場合は、NSCA ジャパン事務局までご連絡ください。<br>(@nsca-japan.or.jp からのメールが届くよう、必ず受信設定をしてください。)</p>
				</div>
				<h3>見出し</h3>
				<ul class="text_content_2">
					<li>※決済処理での注意事項</li>
					<li>・決済中はブラウザの戻るボタンは使用しないでください。</li>
					<li>・各決済の画面が表示されるまで時間がかかる場合がございます。</li>
					<li>・お問合せの際、確認させて頂くことがございますので、決済画面最終ページは印刷して保管をお願い致します。</li>
				</ul>
				<div class="text_content_3">
					<div class="bg_white">
						<p class="title">カード決済</p>
						<div class="img img_1">
							<img src="../../viewIncludeFiles/image/jcb60px.gif">
							<img src="../../viewIncludeFiles/image/visa60px.gif">
							<img src="../../viewIncludeFiles/image/master60px.gif">
						</div>
						
						<ul>
							<li>・3Dセキュア（本人認証決済サービス）を導入しています。 詳しくは<a href="#">こちら&gt;&gt;</a></li>
							<li>・カード情報の登録が可能です。登録しておくと、次回以降のカード番号入力の手間が省くことができ便利です。詳しくは<a href="#">こちら&gt;&gt;</a></li>
						</ul>
						<button class="button" type="button" onclick="location.href='#'"><span>支払い開始</span></button>
					</div>
				</div>
				<div class="text_content_3">
					<div class="bg_white">
						<p class="title">コンビニ支払い</p>
						<div class="img img_2">
							<img src="../../viewIncludeFiles/image/fregi-convenience.gif">
							<img src="../../viewIncludeFiles/image/fregi-payeasy.gif">
						</div>
						<p>コンビ二エンスストア、金融機関(Pay-easy)でお支払い ⇒ 決済完了後に決済確認画面は表示されません。</p>
						<button class="button" type="button" onclick="location.href='#'"><span>注意事項確認</span></button>
					</div>
				</div>
				<button class="button" type="button" value="" onclick="location.href='#'"><span>マイページへ</span></button>
			</div>
		</div>
		<footer id="footer">
		</footer>
	</body>
</html>
