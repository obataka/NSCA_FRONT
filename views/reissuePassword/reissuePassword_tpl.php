<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>パスワード再発行</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/reissuePassword.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/reissuePassword.js"></script>
		
    </head>
    <body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
	<div class="wrap mh_c btn_b_wrap">  
		<h2>パスワード再発行</h2>
		<div class="content_wrap">
			<p class="h2_text">テキストテキストテキストテキスト</p>
			<form>
				<input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
				<table>
					<tr>
						<th>パスワード</th>
						<td>
							<input id="pass_1" class="w_50" type="password" name="" value="">
							<ul class="error_ul">
								<li class="error" id="err_pass_1"></li>
							</ul>
							<p class="mt_1">確認用</p>
							<input id="pass_2" class="w_50" type="password" name="" value="">
							<ul class="error_ul">
								<li class="error" id="err_pass_2"></li>
							</ul>
						</td>
					</tr>
				</table>
			<section>
				<button id="next_button" class="button btn_b btn_b_1" type="submit"><span>次へ</span></button>
			</section>
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
