<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>登録情報修正｜</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/toroku_syusei.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/changeMember.js"></script>
	
	<script>
		$(function() {
			$("select").wrap("<span class='select_wrap'></span>");
		});
	</script>
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
			<form action="../changeConfirmMember/changeConfirmMember_tpl.php" method="post">
				<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="<?php echo $kaiinSbt ?>">
				<input type="hidden" name="kaihi" id="kaihi" value="<?php echo $wk_kaihi ?>">
				<input type="hidden" name="sel_option" id="sel_option" value="<?php echo $option; ?>">
				<input type="hidden" name="wk_sel_option" id="wk_sel_option" value="<?php echo $wk_sel_option; ?>">
				<input type="hidden" name="kenmei" id="kenmei" value="<?php echo $kenmei; ?>">
				<input type="hidden" name="sel_math" id="sel_math" value="<?php echo $sel_math; ?>">
				<input type="hidden" name="sel_chiiki" id="sel_chiiki" value="<?php echo $sel_chiiki; ?>">
				<input type="hidden" name="office_kenmei" id="office_kenmei" value="<?php echo $office_kenmei; ?>">
				<input type="hidden" name="sel_office_math" id="sel_office_math" value="<?php echo $sel_office_math; ?>">
				<input type="hidden" name="sel_office_chiiki" id="sel_office_chiiki" value="<?php echo $sel_office_chiiki; ?>">
				<input type="hidden" name="sel_nagareyama" id="sel_nagareyama" value="<?php echo $nagareyama; ?>">
				<input type="hidden" name="wk_sel_nagareyama" id="wk_sel_nagareyama" value="<?php echo $wk_sel_nagareyama; ?>">
				<input type="hidden" name="sel_gender" id="sel_gender" value="<?php echo $gender; ?>">
				<input type="hidden" name="wk_sel_gender" id="wk_sel_gender" value="<?php echo $wk_sel_gender; ?>">
				<input type="hidden" name="sel_mail" id="sel_mail" value="<?php echo $mail; ?>">
				<input type="hidden" name="wk_sel_mail" id="wk_sel_mail" value="<?php echo $wk_sel_mail; ?>">
				<input type="hidden" name="wk_sel_merumaga" id="wk_sel_merumaga" value="<?php echo $wk_sel_merumaga; ?>">
				<input type="hidden" name="sel_merumaga" id="sel_merumaga" value="<?php echo $merumaga; ?>">
				<input type="hidden" name="shoku_1" id="shoku_1" value="<?php echo $shoku_1; ?>">
				<input type="hidden" name="shoku_2" id="shoku_2" value="<?php echo $shoku_2; ?>">
				<input type="hidden" name="shoku_3" id="shoku_3" value="<?php echo $shoku_3; ?>">
				<input type="hidden" name="sel_shoku_1" id="sel_shoku_1" value="<?php echo $sel_shoku_1; ?>">
				<input type="hidden" name="sel_shoku_2" id="sel_shoku_2" value="<?php echo $sel_shoku_2; ?>">
				<input type="hidden" name="sel_shoku_3" id="sel_shoku_3" value="<?php echo $sel_shoku_3; ?>">
				<input type="hidden" name="sel_shikaku" id="sel_shikaku" value="<?php echo $shikaku; ?>">
				<input type="hidden" name="wk_sel_shikaku" id="wk_sel_shikaku" value="<?php echo $wk_sel_shikaku; ?>">
				<input type="hidden" name="sel_shikaku_sonota" id="sel_shikaku_sonota" value="<?php echo $shikaku_sonota; ?>">
				<input type="hidden" name="sel_bunya" id="sel_bunya" value="<?php echo $bunya; ?>">
				<input type="hidden" name="wk_sel_bunya" id="wk_sel_bunya" value="<?php echo $wk_sel_bunya; ?>">
				<input type="hidden" name="sel_bunya_sonota" id="sel_bunya_sonota" value="<?php echo $bunya_sonota; ?>">
				<input type="hidden" name="sel_k_chiiki" id="sel_k_chiiki" value="<?php echo $k_chiiki; ?>">
				<input type="hidden" name="wk_sel_k_chiiki" id="wk_sel_k_chiiki" value="<?php echo $wk_sel_k_chiiki; ?>">
				<input type="hidden" name="sel_hoho" id="sel_hoho" value="<?php echo $hoho; ?>">
				<input type="hidden" name="wk_sel_hoho" id="wk_sel_hoho" value="<?php echo $wk_sel_hoho; ?>">
				<input type="hidden" name="sel_yubin" id="sel_yubin" value="<?php echo $yubin; ?>">
				<input type="hidden" name="wk_sel_yubin" id="wk_sel_yubin" value="<?php echo $wk_sel_yubin; ?>">
				<input type="hidden" name="sel_web" id="sel_web" value="<?php echo $web; ?>">
				<input type="hidden" name="wk_sel_web" id="wk_sel_web" value="<?php echo $wk_sel_web; ?>">
				<input type="hidden" name="sel_qa" id="sel_qa" value="<?php echo $qa; ?>">
				<input type="hidden" name="wk_sel_qa" id="wk_sel_qa" value="<?php echo $wk_sel_qa; ?>">
				<input type="hidden" name="sel_month" id="sel_month" value="<?php echo $month; ?>">
				<input type="hidden" name="sel_day" id="sel_day" value="<?php echo $day; ?>">
				<div class="kihon_joho">
					<div class="kaiin_sbt">
						<table>
							<tr>
								<th><span class="any"></span>会員種別</th>
								<td>
									<p id="kaiinType" name="kaiinType"><?php echo $wk_kaiinType ?></p>
									<input id="option" type="checkbox" name="option">
									<label class="checkbox" for="option">英文購読オプション</label>
									<p class="ti">正会員と学生会員にオプションとしてつけることができます。詳しくは<a href="https://www.nsca-japan.or.jp/02_admis/category.html" target="_blank">こちら</a>をご覧ください。</p>
								</td>
							</tr>
						</table>
					</div>
					<h3>基本情報</h3>
					<table>
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td class="clearfix">
								<div>
									<p>姓</p><input id="name_sei" type="text" name="name_sei" value="<?php echo $name_sei; ?>">
									<ul class="error_ul">
										<li class="error" id="err_name_sei"></li>
									</ul>
								</div>
								<div>
									<p>名</p><input id="name_mei" type="text" name="name_mei" value="<?php echo $name_mei; ?>">
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
									<p>セイ</p><input id="name_sei_kana" type="text" name="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
									<ul class="error_ul">
										<li class="error" id="err_name_sei_kana"></li>
									</ul>
								</div>
								<div>
									<p>メイ</p><input id="name_mei_kana" type="text" name="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
									<ul class="error_ul">
										<li class="error" id="err_name_mei_kana"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>ローマ字表記</th>
							<td class="clearfix">
								<div>
									<p>Last(姓)</p><input id="name_last" type="text" name="name_last" value="<?php echo $name_last; ?>">
									<ul class="error_ul">
										<li class="error" id="err_name_last"></li>
									</ul>
								</div>
								<div>
									<p>First(名)</p><input id="name_first" type="text" name="name_first" value="<?php echo $name_first; ?>">
									<ul class="error_ul">
										<li class="error" id="err_name_first"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="birthday">
							<th><span class="required">必須</span>生年月日</th>
							<td>
								<p>西暦</p><input id="year" type="text" name="year" value="<?php echo $year; ?>">年
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
								<input id="gender_1" type="radio" name="gender" value="1">
								<label for="gender_1">男性</label>
								<input id="gender_2" type="radio" name="gender" value="2">
								<label for="gender_2">女性</label>
								<ul class="error_ul">
									<li class="error" id="err_gender"></li>
								</ul>
							</td>
						</tr>
						<tr class="address">
							<th><span class="required">必須</span>住所</th>
							<td>
								<p>郵便番号</p><input id="yubin_nb_1" class="yubin_1" type="text" name="yubin_nb_1" value="<?php echo $yubin_nb_1; ?>">-<input id="yubin_nb_2" class="yubin_2" type="text" name="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
								<button id="street_address_search" class="button" type="button">住所検索</button>
								<ul class="error_ul">
									<li class="error" id="err_address_yubin_nb_1"></li>
								</ul>

								<p class="mt_1">都道府県</p><select id="address_todohuken" name="math">
									<option value=""></option>
								</select>
								<ul class="error_ul">
									<li class="error" id="err_address_todohuken"></li>
								</ul>
								<p class="mt_1">市区町村／番地</p><input id="address_shiku" class="w_80" type="text" name="address_shiku" value="<?php echo $address_shiku; ?>">
								<ul class="error_ul">
									<li class="error" id="err_address_shiku"></li>
								</ul>
								<p class="mt_1">建物／部屋番号</p><input id="address_tatemono" class="w_80" type="text" name="address_tatemono" value="<?php echo $address_tatemono; ?>"><br>
								<ul class="error_ul">
									<li class="error" id="err_address_tatemono"></li>
								</ul>
								<input id="nagareyama" type="checkbox" name="nagareyama" value="nagareyama">
								<label class="checkbox" for="nagareyama">流山市民の方はチェックしてください</label>
							</td>
						</tr>
						<tr>
							<th>住所(ヨミ)</th>
							<td>
								<p>市区町村／番地</p><input id="address_yomi_shiku" class="w_80" type="text" name="address_yomi_shiku" value="<?php echo $address_yomi_shiku; ?>">
								<ul class="error_ul">
									<li class="error" id="err_address_yomi_shiku"></li>
								</ul>
								<p class="mt_1">建物／部屋番号</p><input id="address_yomi_tatemono" class="w_80" type="text" name="address_yomi_tatemono" value="<?php echo $address_yomi_tatemono; ?>">
								<ul class="error_ul">
									<li class="error" id="err_address_yomi_tatemono"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>電話番号</th>
							<td>
								<p>TELまたは携帯のどちらかをご入力ください</p>
								<p class="mt_1">TEL</p><input id="tel" class="w_50" type="tel" name="tel" value="<?php echo $tel; ?>">
								<ul class="error_ul">
									<li class="error" id="err_tel"></li>
								</ul>
								<p class="mt_1">携帯</p><input id="keitai_tel" class="w_50" type="tel" name="keitai_tel" value="<?php echo $keitai_tel; ?>">
								<ul class="error_ul">
									<li class="error" id="err_keitai_tel"></li>
								</ul>
								<p class="mt_1">FAX</p><input id="fax" class="w_50" type="tel" name="fax" value="<?php echo $fax; ?>">
								<ul class="error_ul">
									<li class="error" id="err_fax"></li>
								</ul>
							</td>
						</tr>
						<tr class="mail">
							<th><span class="required">必須</span>メールアドレス</th>
							<td>
								<p>メールアドレス_1</p><input id="mail_address_1" class="w_80" type="email" name="mail_address_1" value="<?php echo $mail_address_1; ?>">
								<ul class="error_ul">
									<li class="error" id="err_mail_address_1"></li>
								</ul>
								<p class="mt_1">メールアドレス_2</p><input id="mail_address_2" class="w_80" type="email" name="mail_address_2" value="<?php echo $mail_address_2; ?>">
								<ul class="error_ul">
									<li class="error" id="err_mail_address_2"></li>
								</ul>
								<p class="mt_1">メール受信希望のメールアドレス</p>
								<input id="mail_1" type="radio" name="mail" value="1">
								<label for="mail_1">メールアドレス_1</label><br class="sp_bl">
								<input id="mail_2" type="radio" name="mail" value="2">
								<label for="mail_2">メールアドレス_2</label>
								<ul class="error_ul">
									<li class="error" id="err_mail"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>メルマガ配信の希望</th>
							<td>
								<input id="merumaga_1" type="radio" name="merumaga" value="1">
								<label for="merumaga_1">希望する</label>
								<input id="merumaga_2" type="radio" name="merumaga" value="2">
								<label for="merumaga_2">希望しない</label>
								<ul class="error_ul">
									<li class="error" id="err_merumaga"></li>
								</ul>
							</td>
						</tr>
						<tr class="pass">
							<th><span class="required">必須</span>パスワード</th>
							<td>
								<input id="pass_1" class="w_50" type="password" name="pass_1" value="">
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
						<tr>
							<th><span class="any"></span>URL</th>
							<td>
								<input id="url" class="w_80" type="text" name="url" value="<?php echo $url; ?>">
							</td>
						</tr>
						<tr class="job">
							<th><span class="any"></span>職業</th>
							<td>
								<p><select id="job_1" class="w_70" name="job_1">
										<option value=""></option>
									</select></p>
								<p class="mt_1"><select id="job_2" class="w_70" name="job_2">
										<option value=""></option>
									</select></p>
								<p class="mt_1"><select id="job_3" class="w_70" name="job_3">
										<option value=""></option>
									</select></p>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>勤務先／所属先名</th>
							<td>
								<input id="office" class="" type="text" name="office_name" value="<?php echo $office_name; ?>">
							</td>
						</tr>
						<tr class="address">
							<th><span class="any"></span>所属先住所</th>
							<td>
								<p>郵便番号</p><input id="office_yubin_nb_1" class="yubin_1" type="text" name="office_yubin_nb_1" value="<?php echo $office_yubin_nb_1; ?>">-<input id="office_yubin_nb_2" class="yubin_2" type="text" name="office_yubin_nb_2" value="<?php echo $office_yubin_nb_2; ?>">
								<button id="job_address_search" class="button" type="button">住所検索</button>
								<ul class="error_ul">
									<li class="error" id="err_address_yubin_nb_2"></li>
								</ul>
								<p class="mt_1">都道府県</p><select id="office_todohuken" name="office_math">
									<option value=""></option>
								</select>
								<p class="mt_1">市区町村／番地</p><input id="office_shiku" class="w_80" type="text" name="office_shiku" value="<?php echo $office_shiku; ?>">
								<p class="mt_1">建物／部屋番号</p><input id="office_tatemono" class="w_80" type="text" name="office_tatemono" value="<?php echo $office_tatemono; ?>">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先電話番号</th>
							<td>
								<input id="office_tel" class="w_50" type="tel" name="office_tel" value="<?php echo $office_tel ?>">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先FAX番号</th>
							<td>
								<input id="office_fax" class="w_50" type="tel" name="office_fax" value="<?php echo $office_fax ?>">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>NSCA以外の認定資格</th>
							<td class="clearfix">
								<div id="nintei-shikaku-left">
								</div>
								<div id="nintei-shikaku-right">
								</div>
								<textarea id="shikaku_sonota" name="shikaku_sonota" placeholder="その他を選択した場合は必須入力となります"><?php echo $shikaku_sonota; ?></textarea>
								<ul class="error_ul">
									<li class="error" id="err_shikaku"></li>
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
								<input id="hoho_1" type="radio" name="hoho" value="1"><label for="hoho_1">メールでお知らせ</label>
								<input id="hoho_2" type="radio" name="hoho" value="2"><label for="hoho_2">郵便でお知らせ</label>
								<ul class="error_ul">
									<li class="error" id="err_renraku_hoho"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>郵便物配達先の希望</th>
							<td>
								<input id="yubin_1" type="radio" name="yubin" value="0"><label for="yubin_1">自宅</label>
								<input id="yubin_2" type="radio" name="yubin" value="1"><label for="yubin_2">勤務先／所属先</label>
								<ul class="error_ul">
									<li class="error" id="err_yubin"></li>
								</ul>
							</td>
						</tr>
						<tr class="chiiki">
							<th><span class="any"></span>興味のある地域</th>
							<td>
								<p>居住地域以外でセミナー開催の情報を知りたい地域<br>
									(マイページトップにおすすめセミナーとして表示されます)</p>
								<div id="Area">
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>ウェブサイト掲載</th>
							<td>
								<input id="web_1" type="radio" name="web" value="1"><label for="web_1">希望する</label>
								<input id="web_2" type="radio" name="web" value="0"><label for="web_2">希望しない</label>
								<ul class="error_ul">
									<li class="error" id="err_web"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>アンケート協力</th>
							<td>
								<input id="qa_1" type="radio" name="qa" value="1"><label for="qa_1">協力する</label>
								<input id="qa_2" type="radio" name="qa" value="0"><label for="qa_2">協力しない</label>
								<ul class="error_ul">
									<li class="error" id="err_qa"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>興味のある分野</th>
							<td class="clearfix">
								<div id="Bunya">
								</div>
								<textarea id="bunya_sonota" name="bunya_sonota" placeholder="その他を選択した場合は必須入力となります"><?php echo $bunya_sonota; ?></textarea>
								<ul class="error_ul">
									<li class="error" id="err_bunya"></li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
			</form>
			<section class="btn_wrap">
				<button class="button btn_gray" type="button" value="" onclick="location.href='#'"><span>クリア</span></button>
				<button class="button" type="submit" id="next_button" value="" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>