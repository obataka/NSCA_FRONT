<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>お買い物こごの商品一覧</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/shoppingBasket.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap">  
		<h2>お買い物かごの商品一覧</h2>
		<div class="content_wrap">	
			<article class="clearfix">
				<div class="top_btn clearfix">
					<button class="button" type="button" onclick="location.href='#'"><span>再計算</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span>かごの中を空にする</span></button>
				</div>
			</article>
			<h3>購入商品一覧</h3>
			<div class="product">
				<p class="product_title">NSCA決定場　ストレングストレーニング＆コンディショニング第4版</p>
				<form>
					<section>
						<p class="product_img"><img src="https://placehold.jp/949494/ffffff/200x250.png"><button class="button delete" type="button" value=""><span>削除</span></button></p>
						<table>
							<tr>
								<th>税込み単価(円)<span>：</span></th>
								<td>0000円</td>
							</tr>
							<tr>
								<th>数量<span>：</span></th>
								<td><input id="number" type="number" name="number" value="1" min="0"></td>
							</tr>
							<tr>
								<th>小計(円)<span>：</span></th>
								<td>000円</td>
							</tr>
						</table>
					</section>
					<div class="total">
						<p>
							発送手数料<span>円</span><br>
							商品合計(税込み)<span>円</span>
						</p>
					</div>
				</form>
			</div>
			<section class="btn_wrap">
				<button class="button btn_gray" type="button" value="" onclick="location.href='#'"><span>他の商品を見る</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>買い物を確定</span></button>
			</section>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>
</html>
