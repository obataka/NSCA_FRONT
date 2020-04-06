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
		<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">

		<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/security_code.css" />

		<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/securityCode.js"></script>
	</head>
	<body>
		<?php include('../views/templates/header_logo.php'); ?>
		<form method="POST" autocomplete="off" id="" name="">
			<div class="wrap before_login">
				<h1>セキュリティコード入力</h1>
				<p class="h2_text">ログイン利用として登録されているメールアドレス宛に送信された、セキュリティコードを入力して下さい。<br />
					※セキュリティコードの有効時間は、10分間です。
				</p>
				<div class="content_wrap">
					<div class="content">
						<input type="text" placeholder="セキュリティーコード" name="security_code_id" id="security_code_id" class="input_w_300" maxlength="10">
						<ul class="error_ul">
							<li class="error"></li>
						</ul>
						<div class="to_login">
							<a href="../login/">
								ログインページはこちら
								<i class="fas fa-angle-right"></i>
							</a>
						</div>
						<button class="button mt_30 btn_left" type="button" name="__send" id="__send" value="">
							<span>確認</span>
						</button>
					</div>
				</div>
			</div>
		</form>
		<?php include('../views/templates/footer.php'); ?>
	</body>
</html>
