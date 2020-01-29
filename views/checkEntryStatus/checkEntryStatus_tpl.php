<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>出願状況確認｜</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/syutsugan_jokyo_kakunin.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/checkEntryStatus.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
		<header id="header">
		</header>
			<div class="wrap">
				<h2>出願状況確認</h2>
				<div class="content_wrap">
					<h3>出願状況確認</h3>
					<div class="content jokyo">
						<table id="jokyo">
							<thead>
								<tr>
								<th>試験名</th>
								<th>状況</th>
								<th>受付日</th>
								<th>支払</th>
								<th>確認事項</th>
								<th>手続き</th>
								</tr>
							</thead>						
						</table>
						<p class="kome">コンビニ及びPay-easyの決済を選択した方は、支払いが完了すると「支払番号表示」ボタンが消えます。</p>
					</div>
						
					<h3>試験ステータス</h3>
					<div class="content shiken">
						<table id="status">
							<thead>
								<tr>
									<th>試験名</th>
									<th>状況</th>
									<th>受付日</th>
									<th>確認事項</th>
									<th>手続き</th>
								</tr>
							</thead>	
						</table>
						<p><span class="blue">PEARSON VUEメンテナンス情報</span>
							メンテナンス中は、オンラインでの試験予約手続きができませんので、ご注意ください。</p>
						<p class="kome">出願手続き完了後の「試験予約」に関する注意点は、<a href="#" class="blue">こちら</a>をご覧ください。</p>
					</div>
						
					<h3>試験期間延長手続き</h3>
					<div class="content encho">
					<p class="text">延長申請があった場合に表示されます</p>
						<table id="encho">
							<thead>
								<tr>
									<th>試験名</th>
									<th>状況</th>
									<th>受付日</th>
									<th>確認事項</th>
									<th>手続き</th>
								</tr>
							</thead>
						</table>
						<ul>
							<li>延長手続きは、延長手続き料の支払いが完了しませんと、受理となりません。</li>
							<li>有効な受験期間が切れる2週間前までに延長手続き料の支払いを行っていただけないと、試験期間の延長はできません。</li>
						</ul>
						<p class="kome">延長手続き料の支払い確認後はこの表示は消えます。</p>
					</div>	
				</div>
			</div>
		<footer id="footer">
		</footer>
	</body>
</html>
