<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>パーソナルディベロップメント申告</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/personalDevelopment.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/personalDevelopment.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>パーソナルディベロップメント申告</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>申告</small></span></li>
					<li><span><small>申告内容確認</small></span></li>
					<li><span><small>完了</small></span></li>
				</ul>
			</div>
			<article>
				<form method="POST" action="" name="personalDevelopmentForm">
					<input type="hidden" id="chkCSCS" name="chkCSCS" value="<?php echo $chkCSCS; ?>">
					<input type="hidden" id="chkCPT" name="chkCPT" value="<?php echo $chkCPT; ?>">
					<input type="hidden" id="sel_year" name="sel_year" value="<?php echo $year; ?>">
					<input type="hidden" id="wk_sel_year" name="wk_sel_year" value="<?php echo $wk_sel_year; ?>">
					<input type="hidden" id="sel_katsudo" name="sel_katsudo" value="<?php echo $katsudo; ?>">
					<input type="hidden" id="wk_sel_katsudo" name="wk_sel_katsudo" value="<?php echo $wk_sel_katsudo; ?>">
					<p>パーソナルディベロップメントで付与されるCEUは1年間で0.5CEUです。同一年内に複数回申告しても、付与されるCEUは0.5CEUまでです。認定年前以前のかつどうには、CEUは付与されません。パーソナルディベロップメントについてのよくあるご質問などは、<a href="#">こちら</a>のページで紹介しています。</p>
					<table>
						<tr>
							<th><span class="required">必須</span>年</th>
							<td>
								<input id="year_1" type="radio" name="year">
								<label for="year_1">2018年</label>
								<input id="year_2" type="radio" name="year">
								<label for="year_2">2019年</label>
								<input id="year_3" type="radio" name="year">
								<label for="year_3">2020年</label>
								<ul class="error_ul">
									<li class="error" id="err_year"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>活動内容<br>
								<span>(いずれか一つを選択)</span>
							</th>
							<td class="katsudou">
								<input id="katsudo_1" type="radio" name="katsudo">
								<label for="katsudo_1">ストレングス＆コンディショニングやパーソナルトレーニングに関連した書籍やウェブサイト等から情報を閲覧し、有益な情報を得た。</label><br>
								<input id="katsudo_2" type="radio" name="katsudo">
								<label for="katsudo_2">運動科学に関連する自己向上のための教育機会に参加した。</label>
								<ul class="error_ul">
									<li class="error" id="err_katsudou"></li>
								</ul>
							</td>
						</tr>
					</table>

					<p>以下のような活動はパーソナルディベロップメントとしては認められません。</p>
					<ul>
						<li>・認定年前年以前の活動には、CEUは付与されません。</li>
						<li>・パーソナルディベロップメントの内容など、詳細は『CEUの手引き』をご覧ください。</li>
					</ul>
					<table>
						<tr>
							<th><span class="required">必須</span>資格</th>
							<td>
								<input id="shikaku_1" type="checkbox" name="shikaku">
								<label class="checkbox" for="shikaku_1">CSCS</label>
								<input id="shikaku_2" type="checkbox" name="shikaku">
								<label class="checkbox" for="shikaku_2">NSCA-CPT</label>
								<ul class="error_ul">
									<li class="error" id="err_shikaku"></li>
								</ul>
							</td>
						</tr>
					</table>
					<div class="bg_gray">
						<p>
							この申告の内容が継続教育単位のための活動であることを誓います。<br>
							虚偽の内容で申告したことが後に判明した場合、CEU取得が取り消されることに同意します。
						</p>
						<p class="doi">
							<input id="doi" type="checkbox" name="doi">
							<label class="checkbox" for="doi">同意する</label>
						</p>
						<ul class="error_ul">
							<li class="error" id="err_doi"></li>
						</ul>
					</div>
					<section>
						<button class="button" type="button" id="next" value="" onclick="location.href='#'"><span>次へ</span></button>
					</section>
				</form>
			</article>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>

</html>