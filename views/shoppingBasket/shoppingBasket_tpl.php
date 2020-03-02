<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>お買い物かごの商品一覧</title>
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
	<script type="text/javascript" src="../../viewIncludeFiles/js/shoppingBasket.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>お買い物かごの商品一覧</h2>
		<form action="" name="shoppingBasketForm" method="post">
			<input type="hidden" name="konyu_id" id="konyu_id" value="<?php echo $konyu_id; ?>">
			<input type="hidden" name="gokei_kingaku" id="gokei_kingaku" value="<?php echo $gokei_kingaku; ?>">
			<input type="hidden" name="hambai_joho" id="hambai_joho" value="<?php echo $hambai_joho; ?>">
			<input type="hidden" name="hambai_settei_meisho" id="hambai_settei_meisho" value="<?php echo $hambai_settei_meisho; ?>">
			<input type="hidden" name="color_meisho" id="color_meisho" value="<?php echo $color_meisho; ?>">			
			<input type="hidden" name="size_meisho" id="size_meisho" value="<?php echo $size_meisho; ?>">
			<input type="hidden" name="upflag" id="upflag" value="0">

			<div class="content_wrap">
				<article class="clearfix">
					<div class="top_btn clearfix">
						<button class="button" id="keisan" type="button" onclick="location.href='#'"><span>再計算</span></button>
						<button class="button" id="reset" type="button" onclick="location.href='#'"><span>かごの中を空にする</span></button>
					</div>
				</article>
				<h3>購入商品一覧</h3>
				<div class="product">
					<div id="product">
					</div>
					<div class="total">
						<p>
							発送手数料<span id="tesuryo"></span><br>
							商品合計(税込み)<span id="sum"></span>
						</p>
					</div>
				</div>
				<section class="btn_wrap">
					<button class="button btn_gray" type="button" id="back" value="" onclick="location.href='#'"><span>他の商品を見る</span></button>
					<button class="button" type="button" id="next" value="" onclick="location.href='#'"><span>買い物を確定</span></button>
				</section>
			</div>
		</form>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>

</html>