<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>会員種別変更|確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/sbt_henko_kakunin.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/changeSbtConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap mh_c btn_b_wrap">
		<h2>会員種別変更確認</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>変更後の会員種別選択</small></span></li>
					<li class="active"><span><small>確認</small></span></li>
					<li><span><small>完了</small></span></li>
				</ul>
			</div>
			<form action="?" method="post" autocomplete="off" id="changeSbtConfirmForm" name="changeSbtConfirmForm">
				<input type="hidden" name="kaiinType" id="kaiinType" value="<?php echo $wk_kaiinType ?>">
				<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="<?php echo $wk_kaiinSbt ?>">
				<input type="hidden" name="kaihi" id="kaihi" value="<?php echo $wk_kaihi ?>">
				<div class="current_sbt clearfix">
					<div class="currnt">
						<p><span>現在の会員種別</span></p>
						<p><span id="kaiin_sbt_currnt"></span><br>
							会費：<span id="kaihi_currnt"></span></p>
					</div>
					<div class="chenge">
						<p><span>変更後の会員種別</span></p>
						<p><?php echo $wk_kaiinType; ?><br>
							会費：<?php if ($wk_kaiinSbt == 0) {
								echo $wk_kaihi;
							} else {
								echo $wk_kaihi."円";
							}?></p>
					</div>
				</div>
				<section class="btn_wrap btn_b_2 btn_b">
					<button class="button back" id="back" type="button" value="" onclick="location.href='#'"><span>会員種別選択変更</span></button>
					<button class="button" id="next" type="submit" value="" onclick="location.href='#'"><span>変更</span></button>
				</section>
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>