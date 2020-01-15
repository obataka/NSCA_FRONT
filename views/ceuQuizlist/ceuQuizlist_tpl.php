<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>CEUクイズ｜</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/ceu_quiz.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/ceuQuizlist.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
		<header id="header">
		</header>
		<form action="../inputAnswer/inputAnswer_tpl.php" method="post">
				<input type="hidden" name="ceu_id1" id="ceu_id1" value="<?php echo $ceu_id1; ?>">
				<input type="hidden" name="ceu_id2" id="ceu_id2" value="<?php echo $ceu_id2; ?>">
			<div class="wrap mh_c">
				<h2>CEUクイズ</h2>
				<div class="content_wrap">
					<h3>CEUクイズ</h3>
					
					<table>
						<tr>
							<th id="txt1">テキストテキストテキスト(0000年00月号)</th>
							<td>
								<div class="btn">
									<button class="button kaito1" onclick="location.href='#'"><span>解答</span></button>
									<button class="button kiji1" onclick="location.href='#'"><span>関連記事</span></button>
								</div>
							</td>
						</tr>
						<tr>
							<th id="txt2">テキストテキストテキスト(0000年00月号)</th>
							<td>
								<div class="btn">
									<button class="button kaito2" onclick="location.href='#'"><span>解答</span></button>
									<button class="button kiji2" onclick="location.href='#'"><span>関連記事</span></button>
								</div>
							</td>
						</tr>
						<tr>
							<th id="txt3">テキストテキストテキスト(0000年00月号)</th>
							<td>
								<div class="btn">
									<button class="button kaito3" onclick="location.href='#'"><span>解答</span></button>
									<button class="button kiji3" onclick="location.href='#'"><span>関連記事</span></button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<footer id="footer">
		</footer>
	</body>
</html>
