<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>メールアドレスの変更</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/reissueMail.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/reissueMail.js"></script>
    </head>
    <body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
	<div class="wrap mh_c btn_b_wrap">  
		<h2>メールアドレスの変更</h2>
		<div class="content_wrap">
			<form>
				<table>
					<tr>
						<th><span class="any"></span>登録されたメールアドレス</th>
						<td><p id="mail_address" value=""></p></td>
					</tr>
					<tr>
						<th><span class="required">必須</span>新しいメールアドレス</th>
						<td>
							<input id="mail" class="w_80" type="email" name="mail" value="">
							<ul class="error_ul">
								<li class="error"></li>
							</ul>
						</td>
					</tr>
				</table>
			</form>
			<section>
				<button class="button btn_b btn_b_1" type="submit" value="" onclick="location.href='#'"><span>登録情報の変更</span></button>
			</section>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
