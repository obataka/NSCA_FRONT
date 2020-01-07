<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>退会申請</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/unsubscride.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/unsubscride.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap mh_c btn_b_wrap">  
		<h2>退会申請</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>事由入力</small></span></li>
					<li><span><small>入力内容確認</small></span></li>
					<li><span><small>完了</small></span></li>
				</ul>
			</div>	
			<h3>退会申請入力</h3>
			<form action="../unsubscride/unsubscride_tpl.php" method="post">
				<input type="hidden" name="sel_riyu" id="sel_riyu" value="<?php echo $sel_riyu; ?>">
				<input type="hidden" name="sel_riyu_txt" id="sel_riyu_txt" value="<?php echo $sel_riyu_txt; ?>">
				<input type="hidden" name="sel_annai" id="sel_annai" value="<?php echo $sel_annai; ?>">
				<input type="hidden" name="sel_annai_txt" id="sel_annai_txt" value="<?php echo $sel_annai_txt; ?>">
				<input type="hidden" name="textarea" id="textarea" value="<?php echo $textarea; ?>">
				<table>
					<tr>
						<th><span class="required">必須</span>退会理由</th>
						<td>
							<input id="riyu_1" type="radio" name="riyu" value="1">
							<label class="radio" for="riyu_1">年会費関係</label>
							<input id="riyu_2" type="radio" name="riyu" value="2">
							<label class="radio" for="riyu_2">資格関係</label>
							<input id="riyu_3" type="radio" name="riyu" value="3">
							<label class="radio" for="riyu_3">認定試験関係</label><br>
							<input id="riyu_4" type="radio" name="riyu" value="4">
							<label class="radio" for="riyu_4">会員サービス関係</label>
							<input id="riyu_5" type="radio" name="riyu" value="99">
							<label class="radio" for="riyu_5">その他</label>
							<ul class="error_ul">
								<li id="error1" class="error"></li>
							</ul>
							<p class="text">具体的にご記入ください</p>
							<textarea id="taikai_riyu">
								<?php echo $textarea; ?>
							</textarea>
							<ul class="error_ul">
								<li id="error2" class="error"></li>
							</ul>
						</td>
					</tr>
					<tr>
						<th><span class="required">必須</span>ご案内希望欄</th>
						<td><p>今後、NSCA認定資格に関する情報や、セミナー等のご案内を<br class="sp_no">お送りすることがあれば、受け取りを希望されますか？</p>
							<input id="annai_1" type="radio" name="annai" value="1">
							<label class="radio" for="annai_1">希望する</label>
							<input id="annai_2" type="radio" name="annai" value="0">
							<label class="radio" for="annai_2">希望しない</label>
							<ul class="error_ul">
								<li id="error3" class="error"></li>
							</ul>
						</td>
					</tr>
				</table>
			</form>
			<section class="btn_wrap btn_b btn_b_2">
				<button class="button btn_gray" type="button" value="" onclick="location.href='#'"><span>クリア</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer class="footer">
	</footer>
</body>
</html>
