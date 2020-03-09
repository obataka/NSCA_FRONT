<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>お買い物内容確定</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/shoppingConfirm.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/shoppingConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap mh_c btn_b_wrap">
		<h2>お買い物内容確定</h2>
		<form name="shoppingConfirmForm" method="post" action="">
			<input type="hidden" name="kaiin_no" id="kaiin_no" value="<?php echo $wk_kaiin_no; ?>">
			<input type="hidden" name="konyu_id" id="konyu_id" value="<?php echo $konyu_id; ?>">
			<input type="hidden" name="gokei_kingaku" id="gokei_kingaku" value="<?php echo $gokei_kingaku; ?>">
			<input type="hidden" name="hambai_id" id="hambai_id" value="<?php echo $hambai_id; ?>">
			<input type="hidden" name="wk_hambai_id" id="wk_hambai_id" value="<?php echo $wk_hambai_id; ?>">
			<input type="hidden" name="hambai_title" id="hambai_title" value="<?php echo $hambai_title; ?>">
			<input type="hidden" name="hambai_title_chuigaki" id="hambai_title_chuigaki" value="<?php echo $hambai_title_chuigaki; ?>">
			<input type="hidden" name="gazo_url" id="gazo_url" value="<?php echo $gazo_url; ?>">
			<input type="hidden" name="kaiin_kakaku" id="kaiin_kakaku" value="<?php echo $kaiin_kakaku; ?>">
			<input type="hidden" name="kaiin_zeikomi_kakaku" id="kaiin_zeikomi_kakaku" value="<?php echo $kaiin_zeikomi_kakaku; ?>">
			<input type="hidden" name="ippan_kakaku" id="ippan_kakaku" value="<?php echo $ippan_kakaku; ?>">
			<input type="hidden" name="ippan_zeikomi_kakaku" id="ippan_zeikomi_kakaku" value="<?php echo $ippan_zeikomi_kakaku; ?>">
			<input type="hidden" name="wk_gaiyo" id="wk_gaiyo" value="<?php echo $gaiyo; ?>">
			<input type="hidden" name="hambai_kbn" id="hambai_kbn" value="<?php echo $hambai_kbn; ?>">
			<input type="hidden" name="hambai_settei_kbn" id="hambai_settei_kbn" value="<?php echo $hambai_settei_kbn; ?>">
			<input type="hidden" name="hambai_settei_meisho" id="hambai_settei_meisho" value="<?php echo $hambai_settei_meisho; ?>">
			<input type="hidden" name="setsumei" id="setsumei" value="<?php echo $setsumei; ?>">
			<input type="hidden" name="kakaku" id="kakaku" value="<?php echo $kakaku; ?>">
			<input type="hidden" name="konyusu" id="konyusu" value="<?php echo $konyusu; ?>">
			<input type="hidden" name="zeikomi_kakaku" id="zeikomi_kakaku" value="<?php echo $zeikomi_kakaku; ?>">
			<input type="hidden" name="color_kbn" id="color_kbn" value="<?php echo $color_kbn; ?>">
			<input type="hidden" name="color_meisho" id="color_meisho" value="<?php echo $color_meisho; ?>">
			<input type="hidden" name="size_kbn" id="size_kbn" value="<?php echo $size_kbn; ?>">
			<input type="hidden" name="size_meisho" id="size_meisho" value="<?php echo $size_meisho; ?>">
			<input type="hidden" name="shikaku_kbn" id="shikaku_kbn" value="<?php echo $shikaku_kbn; ?>">
			<div class="content_wrap">
				<div class="product">
					<table>
						<thead>
							<tr>
								<th>商品名</th>
								<th>数量</th>
								<th>税込み単価</th>
							</tr>
						</thead>
						<tbody id="product_list">
						</tbody>
					</table>
					<div class="total">
						<p>
							発送手数料<span id="tesuryo"></span><br>
							商品合計(税込み)<span id="sum"></span>
						</p>
					</div>
				</div>
				<section class="btn_wrap btn_b btn_b_2">
					<button class="button btn_gray" type="button" id="return" value="" onclick="location.href='#'"><span>カート画面へ</span></button>
					<button class="button" type="button" value="" id="next" onclick="location.href='#'"><span>決済方法選択へ</span></button>
				</section>
			</div>
		</form>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>

</html>