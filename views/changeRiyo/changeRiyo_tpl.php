<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>登録情報修正｜利用登録 (無料)</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/toroku_syusei_riyo.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/changeRiyo.js"></script>
    </head>
    <body>
		<header id="header">
		</header>
			<div class="wrap">
				<h2>登録情報修正</h2>
				<div class="content_wrap">
					<div class="spb_arrows">
						<ul class="nav nav-tabs step-anchor">
							<li><span><small>会員種別選択</small></span></li>
							<li class="active"><span><small>修正</small></span></li>
							<li><span><small>確認</small></span></li>
							<li><span><small>完了</small></span></li>
						</ul>
					</div>
					<form>			
						<div class="kihon_joho">
							<h3>基本情報</h3>
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
											<p>名</p><input id="name_mei" type="text" name="name" value="">
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
											<p>メイ</p><input id="name_mei_kana" type="text" name="name" value="">
											<ul class="error_ul">
												<li class="error" id="err_name_mei_kana"></li>
											</ul>
										</div>
									</td>
								</tr>
								<tr class="birthday">
									<th><span class="required">必須</span>生年月日</th>
									<td>
										<p>西暦</p><input id="year" type="text" name="name" value="">年
										<select id="month" name="month">
											<option value="00"></option>
											<option value="01">1</option>
											<option value="02">2</option>
											<option value="03">3</option>
											<option value="04">4</option>
											<option value="05">5</option>
											<option value="06">6</option>
											<option value="07">7</option>
											<option value="08">8</option>
											<option value="09">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>月
										<select id="day" name="day">
											<option value="00"></option>
											<option value="01">1</option>
											<option value="02">2</option>
											<option value="03">3</option>
											<option value="04">4</option>
											<option value="05">5</option>
											<option value="06">6</option>
											<option value="07">7</option>
											<option value="08">8</option>
											<option value="09">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
										</select>日
										<ul class="error_ul">
											<li class="error" id="err_birthday"></li>
										</ul>
									</td>
								</tr>
								<tr class="gender">
									<th><span class="required">必須</span>性別</th>
									<td>
										<input id="gender_1" type="radio" name="gender" value="1"><label for="gender_1">男性</label>
										<input id="gender_2" type="radio" name="gender" value="2"><label for="gender_2">女性</label>
										<ul class="error_ul">
											<li class="error" id="err_gender"></li>
										</ul>
									</td>
								</tr>
								<tr class="address">
									<th><span class="required">必須</span>住所</th>
									<td>
										<p>郵便番号</p><input id="address_yubin_nb_1" class="yubin_1" type="text" name="" value="">-<input id="yubin_nb_2" class="yubin_2" type="text" name="" value="">
										<button id="street_address_search" class="button" type="button">住所検索</button>
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
										<ul class="error_ul">
											<li class="error" id="err_address_tatemono"></li>
										</ul>
										<input id="nagareyama" type="checkbox" name="" value=""><label class="checkbox" for="nagareyama">流山市民の方はチェックしてください</label>
									</td>
								</tr>
								<tr>
									<th><span class="required">必須</span>住所(ヨミ)</th>
									<td>
										<p>市区町村／番地</p><input id="address_yomi_shiku" class="w_80" type="text" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_address_yomi_shiku"></li>
										</ul>
										<p class="mt_1">建物／部屋番号</p><input id="address_yomi_tatemono" class="w_80" type="text" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_address_yomi_tatemono"></li>
										</ul>
									</td>
								</tr>
								<tr>
									<th><span class="required">必須</span>電話番号</th>
									<td>
										<p>TELまたは携帯のどちらかをご入力ください</p>
										<p class="mt_1">TEL</p><input id="tel" class="w_50" type="tel" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_tel"></li>
										</ul>
										<p class="mt_1">携帯</p><input id="keitai_tel" class="w_50" type="tel" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_keitai_tel"></li>
										</ul>
									</td>
								</tr>
								<tr class="mail">
									<th><span class="required">必須</span>メールアドレス</th>
									<td>
										<p>メールアドレス_1</p><input id="mail_address_1" class="w_80" type="email" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_mail_address_1"></li>
										</ul>
										<p class="mt_1">メールアドレス_2</p><input id="mail_address_2" class="w_80" type="email" name="" value="">
										<ul class="error_ul">
											<li class="error" id="err_mail_address_2"></li>
										</ul>
										<p class="mt_1">メール受信希望のメールアドレス</p>
										<input id="mail_1" type="radio" name="mail" value="">
										<label for="mail_1">メールアドレス_1</label><br class="sp_bl">
										<input id="mail_2" type="radio" name="mail" value="">
										<label for="mail_2">メールアドレス_2</label>
										<ul class="error_ul">
											<li class="error" id="err_mail"></li>
										</ul>
									</td>
								</tr>
								<tr>
									<th><span class="required">必須</span>メルマガ配信の希望</th>
									<td>
										<input id="merumaga_1" type="radio" name="merumaga" value="">
										<label for="merumaga_1">希望する</label>
										<input id="merumaga_2" type="radio" name="merumaga" value="">
										<label for="merumaga_2">希望しない</label>
										<ul class="error_ul">
											<li class="error" id="err_merumaga"></li>
										</ul>
									</td>
								</tr>
							</table>
						</div>

						<div class="oshirase">
						<h3>お知らせ／連絡方法／アンケート</h3>
							<table>
								<tr>
									<th><span class="required">必須</span>連絡方法の希望</th>
									<td>
										<input id="hoho_1" type="radio" name="hoho" value=""><label for="hoho_1">メールでお知らせ</label>
										<input id="hoho_2" type="radio" name="hoho" value=""><label for="hoho_2">郵便でお知らせ</label>
										<ul class="error_ul">
											<li class="error" id="err_renraku_hoho"></li>
										</ul>
									</td>
								</tr>
							</table>
						</div>
					</form>
					<section class="btn_wrap">
						<button class="button btn_gray" type="button" value="" onclick="location.href='#'">クリア</button>
						<button class="button" type="submit" value="" onclick="location.href='toroku_syusei_kakunin_riyo.html'">次へ</button>
					</section>
					
				</div>
			</div>
		<footer>
			<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
		</footer>
	</body>
</html>
