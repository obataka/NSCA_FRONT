<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>商品詳細確認</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/productMovie.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/productMovie.js"></script>
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap">  
		<h2>商品詳細確認</h2>
		<div class="content_wrap">	
			<div class="top_btn clearfix">
				<button class="button" type="button" onclick="location.href='../shoppingBasket/'"><span>買い物かご</span></button>
			</div>
			<h3>商品購入</h3>
			<form>
				<div class="movie_wrap">
					<div class="bg_gray">
						<p class="movie_title"><span id="product_title">セミナー動画タイトル</span></p>
						<input type="hidden" name="hambai_id" id="hambai_id" value="<?php echo $_POST['hambai_doga_id'] ?>">
						<input type="hidden" name="doga_id" id="doga_id" value="<?php echo $_POST['doga_id'] ?>">
					<section>
						<div class="movie">
							<!----<video src=""></video>----->
							<img id="product_img" src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						</section>
						<section>
							<p>価格：<span id="price_kaiin" class="price">0000円</span><span class="zei">(税込み・送料別)</span></p>
						</section>
						<section>
							<span id="tsuiki">法人・学校様は<a href="#">こちら</a></span>
					</section>
				</div>
			</div>
		</form>
			<h3>詳細説明</h3>
			<div class="setsumei">
				<span id="gaiyo">概要は〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</span>
				<br>
				<span><img id="setsumei_gazo_1" src="https://placehold.jp/949494/ffffff/150x200.png"></span>
				<span><img id="setsumei_gazo_2" src="https://placehold.jp/949494/ffffff/150x200.png"></span>
				<span><img id="setsumei_gazo_3" src="https://placehold.jp/949494/ffffff/150x200.png"></span>
				<span><img id="setsumei_gazo_4" src="https://placehold.jp/949494/ffffff/150x200.png"></span>
				<br>
				<span id="setsumei">説明は〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇</span>
			</div><br><br>
			<p class="kome">※理由の如何に関わらず、お支払い後の購入のキャンセルはお受け致しかねます。</p>
			<p class="kome">※動画配信期間は、購入から１年間です。予告なく配信を停止する可能性がございますので、あらかじめご了承ください</p>
			<p class="kome"></p>
			<p>@nsca-japan.or.jpからのメールを受信できるように設定をお願いします</p>
			<section class="btn_wrap">
				<button class="button btn_gray" id="go_salesList_button" type="button" value=""  onclick="location.href='../salesList/'"><span>商品一覧へ</span></button>
				<button class="button" type="button" id="buy_button">かごに入れる</button>
			</section>

		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>
</html>
