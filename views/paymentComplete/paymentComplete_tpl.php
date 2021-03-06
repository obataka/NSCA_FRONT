<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>決済完了</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/kessai_kanryo.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/sweetalert2.min.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/sweetalert2.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/paymentComplete.js"></script>
    </head>
   <body>
	<header id="header">
    </header>
    <input type="hidden" id="authCode" name="authCode" value="<?php echo $authCode; ?>">
    <input type="hidden" id="seqNo" name="seqNo" value="<?php echo $seqNo; ?>">
	<div class="wrap mh_c btn_b_wrap">
		<h2 class="mb_10">決済完了</h2>
		<div class="content_wrap">
			<p>テキストテキストテキストテキストテキストテキスト</p>
				<button class="button btn_b btn_b_1" type="button" id="my_page" value=""><span>マイページへ</span></button>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
