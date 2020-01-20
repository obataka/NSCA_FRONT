<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>試験選択</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/shiken_sentaku.css">
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
	<div class="wrap">
		<h2>試験選択</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_6ver sp_no">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br class="sp_no">倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<div class="spb_arrows spb_arrows_6ver_sp sp_bl">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br>倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
				</ul>
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br>(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<div class="shiken_joho">
				<p><span class="title">試験情報</span>2016年4月より開始いたしますコンピュータベース試験では、受験日時ならびにテストセンターをご自身で決めていただきます。<br>
					NSCAジャパンにて行う出願手続きは、試験の選択と受験料のお支払いのみです。<br>
					出願手続完了後、試験代行会社 ピアソン VUE にて試験予約を行っていただきます。<br>
					WEBサイトの資格認定試験のページをご確認の上、出願手続きを行ってください。<br>
					リンク→http://www.nsca-japan.or.jp/04_certif/top.html<br>
					<span class="kome">試験を申込む場合は、PCメールアドレスをこちらから登録してください。<br>
						PCメールアドレスをお持ちでない場合は、スマートフォンのメールアドレスを、 PCメールアドレスの欄に登録してください。</span><br>
					========出願書類の郵送先========<br>
					〒270-0152　千葉県流山市前平井85<br>
					NSCAジャパン試験担当宛<br>
					TEL：04-7197-2064<br>
					============================<br>
					<span class="kome">ピアソンVUE試験予約サイトで表示される登録情報の内、住所はNSCAジャパン事務局のものが表示されます。<br>
						問題はございませんので、そのまま予約手続きを行ってください。</span></p>
			</div>
			<h3>テキストテキスト</h3>
			<form action="../inputCSCSCPT/inputCSCSCPT_tpl.php" method="post" autocomplete="off" id="selectCSCSCPTForm">
				<input type="hidden" name="shikaku_sbt" id="shikaku_sbt" value="">
				<input type="hidden" name="cscs_shikaku" id="cscs_shikaku" value="">
				
				<div class="flex_wrap">
					<div class="bg_blue">
						<p class="title">CSCS 認定試験</p>
						<div class="bg_white">
							<p class="text">CSCS認定試験を受験される場合、<br>
								初回は基礎科学、実践／応用の両方を受験します。<br><br>
								基礎科学のみ、または実践／応用のみ受験できるのは、<br>
								どちらかのセクションに合格された方に限ります。</p>
							<p class="comment" id="comment_cscs">【両方(基礎科学、実践／応用)】出願へ</p>
							<button class="button" type="button" id="cscs" onclick="location.href='#'"><span>出願する</span></button>
						</div>
					</div>
					<div class="bg_blue">
						<p class="title">NSCA-CPT 認定試験</p>
						<div class="bg_white">
							<p class="text">テキストテキストテキストテキスト<br>
								テキストテキストテキストテキストテキストテキスト<br><br>
								テキストテキストテキストテキスト<br>
								テキストテキストテキストテキストテキストテキスト</p>
							<p class="comment" id="comment_nsca_cpt">【受験】出願へ</p>
							<button class="button" type="button" id="nsca_cpt" onclick="location.href='#'"><span>出願する</span></button>
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>
	<footer id="footer">
	</footer>
</body>

</html>