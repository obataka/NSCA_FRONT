<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>継続手続きのお願い</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/continueRequest.css" />

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/continueRequest.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

</head>

<body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
	<div class="wrap mh_c btn_b_wrap">
		<h2>継続手続きのお願い</h2>
		<form action="?" method="post" autocomplete="off" id="continueRequestForm" name="continueRequestForm">
			<input type="hidden" name="kaiinType" id="kaiinType" value="<?php echo $wk_kaiinType; ?>">
			<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="<?php echo $wk_kaiinSbt; ?>">
			<input type="hidden" name="kaihi" id="kaihi" value="<?php echo $wk_kaihi; ?>">
			<div class="content_wrap">
				<section>
					<div class="top">
						<p>会員有効期限が切れています。継続手続きをお願いいたします。</p>
					</div>
					<div class="bottom">
						<button class="button" id="continue" type="button" value="" onclick="location.href='#'"><span>継続手続き</span></button>
					</div>
				</section>
				<button class="button btn_gray" id="unsubscribe" type="button" value="" onclick="location.href='#'"><span>退会手続き</span></button>
			</div>
		</form>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>