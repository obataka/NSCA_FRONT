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
        <link rel="stylesheet" href="../../viewIncludeFiles/css/product.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/product.js"></script>
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap">  
		<h2>商品詳細確認</h2>
		<div class="content_wrap">	
			<div class="top_btn clearfix">
				<button class="button" type="button" onclick="location.href='#'"><span>買い物かご</span></button>
			</div>
			<h3>商品購入</h3>
			<div class="product">
				<p class="product_title"><span id="product_title">体力トレーニング検定1級問題集</span></p>
				<form>
					<section>
						<p class="product_img"><img id="product_img" src="https://placehold.jp/949494/ffffff/200x250.png"></p>
						<table>
							<tr>
								<th>一般価格</th>
								<td><span id="price_ippan">0000円</span><span class="zei">(税込み・送料別)</span></td>
							</tr>
							<tr>
								<th><span id="price_label">会員価格</span></th>
								<td><span id="price_kaiin" class="blue">0000円</span><span class="zei">(税込み・送料別)</span></td>
							</tr>
							<tr>
								<th>購入数</th>
								<td><input id="number" type="number" name="number" value="1" min="0">法人・学校様は<a href="#">こちら</a></td>
							</tr>
							<tr>
								<th>選択事項</th>
								<td>商品オプションなし</td>
							</tr>
						</table>
					</section>
				</form>
			</div>
			<h3>詳細説明</h3>
			<div class="setsumei">
				<img src="https://placehold.jp/949494/ffffff/150x200.png">
			</div>
			<p class="kome">※理由の如何に関わらず、お支払い後の購入のキャンセルはお受け致しかねます。</p>
			<p>@nsca-japan.or.jpからのメールを受信できるように設定をお願いします</p>
			<section class="btn_wrap">
				<button class="button btn_gray" type="button" value="" onclick="location.href='#'"><span>商品一覧へ</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>かごに入れる</span></button>
			</section>
		</div>
	</div>
		<input type="text" name="hambai_id" id="hambai_id" value="<?php echo $_POST['hambai_id'] ?>">
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>
</html>
