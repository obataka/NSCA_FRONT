<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>セキュリティコード入力</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/security_code.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/securityCode.js"></script>

    </head>
    <body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
        <form action="?" method="POST" autocomplete="off" id="" name="">
			<div class="wrap mh_c btn_b_wrap">
				<h2>セキュリティコード入力</h2>
				<div class="content_wrap">
					<p class="h2_text">ログイン利用として登録されているメールアドレス宛に送信された、セキュリティコードを入力して下さい。<br />
					※セキュリティコードの有効時間は、10分間です。</p>
					<div class="content">
						<input type="text" placeholder="セキュリティーコード" name="security_code_id" id="security_code_id" maxlength="10">
						<ul class="error_ul">
							<li class="error"></li>
						</ul>
						<div class="to_login">
							<a href="../login/">ログインへ</a>
						</div>
						<button class="button" type="button" name="__send" id="__send" value=""><span>確認</span></button>
					</div>
				</div>
			</div>
        </form>
        <footer id="footer">
        </footer>
    </body>
</html>
