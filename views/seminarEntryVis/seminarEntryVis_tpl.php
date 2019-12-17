<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>イベント申込｜入力</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/event_nyuryoku.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script>
			$(function(){
				$("select").wrap("<span class='select_wrap'></span>");
			});
		</script>
    </head>
   <body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>イベント申込</h2>
		<div class="content_wrap">
			<p class="h2_text">テキストテキストテキストテキストテキストテキスト</p>
			<div class="kihon_joho">
				<h3>基本情報</h3>
				<form>
					<table>
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td class="clearfix">
								<div>
									<p>姓</p><input id="name_sei" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error" id="err_name_sei"></li>
									</ul>
								</div>
								<div>
									<p class="sp_mt_1">名</p><input id="name_mei" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error" id="err_name_mei"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>フリガナ</th>
							<td class="clearfix">
								<div>
									<p>セイ</p><input id="name_sei_kana" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error" id="err_name_sei_kana"></li>
									</ul>
								</div>
								<div>
									<p class="sp_mt_1">メイ</p><input id="name_mei_kana" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error" id="err_name_mei_kana"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="mail">
							<th><span class="required">必須</span>メールアドレス</th>
							<td>
								<input id="mail_address_1" class="w_80" type="email" name="" value="">
								<ul class="error_ul">
									<li class="error" id="err_mail_address_1"></li>
								</ul>
								<p class="mt_1">※確認のためもう一度入力してください(コピー不可)</p>
								<input id="mail_address_2" class="w_80" type="email" name="" value="">
								<ul class="error_ul">
									<li class="error" id="err_mail_address_2"></li>
								</ul>

							</td>
						</tr>
						<tr>
							<th><span class="any"></span>米国会員</th>
							<td>
								<input id="bei_kaiin" type="checkbox" name="bei_kaiin" value="">
								<label class="checkbox" for="bei_kaiin">米国会員番号</label><br class="sp_bl">
								<input id="bei_kaiin_no" type="text" name="" value="">
								<select id="shikaku_kbn" name="math"><option>資格無</option></select>
								<p class="mt_1">テキストテキストテキストテキストテキスト</p>
							</td>
						</tr>
						<tr class="address">
							<th><span class="required">必須</span>住所</th>
							<td>
								<p>郵便番号</p><input id="address_yubin_nb_1" class="yubin_1" type="text" name="" value="">-<input id="yubin_nb_2" class="yubin_2" type="text" name="" value="">
								<button id="street_address_search" class="button" type="button"><span>住所検索</span></button>
								<ul class="error_ul">
									<li class="error" id="err_address_yubin_nb_1"></li>
								</ul>
								<p class="mt_1">都道府県</p><select id="address_todohuken" name="math"></select>
								<ul class="error_ul">
									<li class="error" id="err_address_todohuken"></li>
								</ul>
								<p class="mt_1">市区町村／番地</p><input id="address_shiku" class="w_80" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error" id="err_address_shiku"></li>
								</ul>
								<p class="mt_1">建物／部屋番号</p><input id="address_tatemono" class="w_80" type="text" name="" value=""><br>
								<input id="nagareyama" type="checkbox" name="" value="">
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>TEL</th>
							<td>
								<input id="tel_1" class="w_20" type="tel" name="" value="">-<input id="tel_2" class="w_20" type="tel" name="" value="">-<input id="tel_3" class="w_20" type="tel" name="" value="">
								<ul class="error_ul">
									<li class="error" id="err_tel"></li>
								</ul>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<h3>申込イベント</h3>
			<div class="bg_gray">
				<p class="sbt">イベント種別</p>
				<p class="event_name"><span>イベント名</span>テキストテキストテキストテキスト</p>
				<div>
					<p><span>開催日</span>0000/00/00</p>
					<p><span>参加費</span>0000円</p>
				</div>
			</div>
			<button class="button btn_gray clear" type="submit" value="" onclick="location.href='#'"><span>クリア</span></button>
			<section class="btn_wrap btn_b_2">
				<button class="button btn_gray" type="submit" value="" onclick="location.href='#'"><span>NSCA TOPへ</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
