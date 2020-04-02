<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title></title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/form.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>

	<script type="text/javascript" src="../../viewIncludeFiles/js/registMember.js"></script>

	<script>
		$(function() {

			$("#file_front").on('change', function() {
				var file = $(this).prop('files')[0];

				if (!($(".filename_front").length)) {
					$("#upload_front").append('<span class="filename_front"></span>');
				}

				$("#input_label_front").addClass('changed');
				$(".filename_front").html(file.name);

			});
			$("#file_back").on('change', function() {
				var file = $(this).prop('files')[0];

				if (!($(".filename_back").length)) {
					$("#upload_back").append('<span class="filename_back"></span>');
				}

				$("#input_label_back").addClass('changed');
				$(".filename_back").html(file.name);
			});

		});
	</script>
</head>

<body class="registMember">
	<?php include('../views/templates/header_logo.php'); ?>
	<div class="wrap before_login">
		<h1>入会申込 登録情報入力</h1>
		<div class="spb_arrows">
			<ul class="nav nav-tabs step-anchor">
				<li><span><small>会員種別選択</small></span></li>
				<li class="active"><span><small>入力</small></span></li>
				<li><span class="spb_border"><small>確認</small></span></li>
				<li><span><small>完了</small></span></li>
			</ul>
		</div>
		<p class="top_text exclamation">18歳未満の方は、入会申込フォームからお申込みいただくことはできません。電話またはメールにて<a href="https://www.nsca-japan.or.jp/06_qanda/top.html#contact" target="_blank">お問い合わせ</a>ください。</p>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="kaiinType" id="kaiinType" value="<?php echo $wk_kaiinType; ?>">
			<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="<?php echo $wk_kaiinSbt; ?>">
			<input type="hidden" name="kaihi" id="kaihi" value="<?php echo $wk_kaihi; ?>">
			<input type="hidden" name="file_front" id="file_front" value="<?php echo $file_front; ?>">
			<input type="hidden" name="file_back" id="file_back" value="<?php echo $file_back; ?>">
			<input type="hidden" name="filepath_front" id="filepath_front" value="<?php echo $filePath_front; ?>">
			<input type="hidden" name="filepath_back" id="filepath_back" value="<?php echo $filePath_back; ?>">
			<input type="hidden" name="sel_option" id="sel_option" value="<?php echo $option; ?>">
			<input type="hidden" name="wk_sel_option" id="wk_sel_option" value="<?php echo $wk_sel_option; ?>">
			<input type="hidden" name="kaihi_eibun_option" id="kaihi_eibun_option" value="<?php echo $kaihi_eibun_option; ?>">
			<input type="hidden" name="sel_hoji" id="sel_hoji" value="<?php echo $nsca_hoji; ?>">
			<input type="hidden" name="wk_sel_hoji" id="wk_sel_hoji" value="<?php echo $wk_sel_hoji; ?>">
			<input type="hidden" name="sel_riyu" id="sel_riyu" value="<?php echo $riyu; ?>">
			<input type="hidden" name="wk_sel_riyu" id="wk_sel_riyu" value="<?php echo $wk_sel_riyu; ?>">
			<input type="hidden" name="sel_riyu_sonota" id="sel_riyu_sonota" value="<?php echo $riyu_sonota; ?>">
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
			<input type="hidden" name="sel_mail_login" id="sel_mail_login" value="<?php echo $mail_login; ?>">
			<input type="hidden" name="wk_sel_mail_login" id="wk_sel_mail_login" value="<?php echo $wk_sel_mail_login; ?>">
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

			<div class="shinki_toroku">
				<h2>新規登録</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tbody>
							<tr class="kaiin">
								<th><span class="any"></span>会員種別</th>
								<td>
									<p class="mb_10"><?php echo $wk_kaiinType ?></p>
									<input id="option" type="checkbox" name="option">
									<label class="checkbox" for="option">英文購読オプション</label>
									<p class="ti">正会員と学生会員にオプションとしてつけることができます。詳しくは<a href="https://www.nsca-japan.or.jp/02_admis/category.html" target="_blank">こちら</a>をご覧ください。</p>
								</td>
							</tr>
							<?php if ($wk_kaiinType == "学生会員") {
								print '<tr>
										<th><span class="required">必須</span>学生証</th>
										<td class="file">
											<div id="upload_front">
												<label for="file_front_up" id="input_label_front" class="button">アップロード（表面）</label>
												<input type="file" id="file_front_up" name="file_front" accept="image/*">
												<p id="file_front_thumb"></p>
												<ul class="error_ul">
													<li class="error" id="err_file_front"></li>
												</ul>
											</div>
											<div id="upload_back">
												<label for="file_back_up" id="input_label_back" class="button">アップロード（裏面）</label>
												<input type="file" id="file_back_up" name="file_back" accept="image/*">
												<p id="file_back_thumb"></p>
												<ul class="error_ul">
													<li class="error" id="err_file_back"></li>
												</ul>
											</div>
											<ul class="up_text">
												<li>アップロードできるファイル形式は、JPG(jpg/jpeg)、PNG(png)、GIF(gif)となります。</li>
												<li>学生会員の方は必ずアップロードしてください。</li>
												<li>不鮮明なデータをお送り頂いた場合は、無効になります。</li>
												<li>有効期限、顔写真が明瞭で、学生証と認識できるかを事前にご確認ください。</li>
												<li>学生証の裏面に有効期限等がある場合は、裏面もアップロードしてください。</li>
												<li>NSCAジャパンにて学生証を確認するまでは、お手続きは完了いたしません。<br>
													学生証の確認には1週間程度かかる場合があります。</li>
											</ul>
										</td>
									</tr>';
							} ?>
							<tr class="riyu">
								<th><span class="required">必須</span>入会理由</th>
								<td>
									<input id="riyu_1" type="radio" name="riyu" value="0">
									<label class="radio" for="riyu_1">ストレングス＆コンディショニングの知識・指導技術向上のため</label><br>
									<input id="riyu_2" type="radio" name="riyu" value="1">
									<label class="radio" for="riyu_2">資格認定試験受験および認定保持のため</label><br>
									<input id="riyu_3" type="radio" name="riyu" value="2">
									<label class="radio" for="riyu_3">ネットワーク・人脈作りのため</label><br>
									<input id="riyu_4" type="radio" name="riyu" value="99">
									<label class="radio" for="riyu_4">その他（記述）</label>
									<p><textarea id="riyu_sonota" name="riyu_sonota" placeholder="その他を選択した場合は必須入力となります。"><?php echo $riyu_sonota; ?></textarea></p>
									<ul class="error_ul">
										<li class="error" id="err_riyu"></li>
									</ul>
								</td>
							</tr>
							<tr class="nsca_hoji">
								<th><span class="any"></span>NSCA認定資格の保持</th>
								<td>
									<input id="nsca_hoji" type="checkbox" name="nsca_hoji"><label class="checkbox" for="nsca_hoji">CSCS、NSCA-CPTの資格をすでに保持している方は<br class="pc_only">チェックしてください。</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="kihon_joho">
				<h2>基本情報</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td>
								<section class="clearfix">
									<div>
										<p>姓</p><input id="name_sei" type="text" name="name_sei" value="<?php echo $name_sei; ?>">
									</div>
									<div>
										<p>名</p><input id="name_mei" type="text" name="name_mei" value="<?php echo $name_mei; ?>">
									</div>
								</section>
								<ul class="error_ul">
									<li class="error" id="err_name_sei"></li>
								</ul>
								<ul class="error_ul">
									<li class="error" id="err_name_mei"></li>
								</ul>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>フリガナ</th>
							<td>
								<section class="clearfix">
									<div>
										<p>セイ</p><input id="name_sei_kana" type="text" name="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
									</div>
									<div>
										<p>メイ</p><input id="name_mei_kana" type="text" name="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
									</div>
								</section>
								<ul class="error_ul">
									<li class="error" id="err_name_sei_kana"></li>
								</ul>
								<ul class="error_ul">
									<li class="error" id="err_name_mei_kana"></li>
								</ul>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>ローマ字表記</th>
							<td>
								<section class="clearfix">
									<div>
										<p>Last(姓)</p><input id="name_last" type="text" name="name_last" value="<?php echo $name_last; ?>">

									</div>
									<div>
										<p>First(名)</p><input id="name_first" type="text" name="name_first" value="<?php echo $name_first; ?>">

									</div>
								</section>
								<ul class="error_ul">
									<li class="error" id="err_name_last"></li>
								</ul>
								<ul class="error_ul">
									<li class="error" id="err_name_first"></li>
								</ul>
							</td>
						</tr>
						<tr class="birthday">
							<th><span class="required">必須</span>生年月日</th>
							<td>
								<p>西暦</p><input id="year" type="text" name="year" value="<?php echo $year; ?>">年
								<span class='select_wrap'>
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
									</select>
								</span>月
								<span class='select_wrap'>
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
									</select>
								</span>日
								<ul class="error_ul">
									<li class="error" id="err_birthday"></li>
								</ul>
							</td>
						</tr>
						<tr class="gender">
							<th><span class="required">必須</span>性別</th>
							<td>
								<input id="gender_1" type="radio" name="gender" value="1">
								<label for="gender_1">男性</label><br>
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

								<p class="mt_1">都道府県</p>
								<span class='select_wrap'>
									<select id="address_todohuken" name="math">
										<option value=""></option>
									</select>
								</span>
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
							<th><span class="required">必須</span>住所(ヨミ)</th>
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
								<p>メールアドレス1</p><input id="mail_address_1" class="w_80" type="email" name="mail_address_1" value="<?php echo $mail_address_1; ?>"><br>
								<ul class="error_ul">
									<li class="error" id="err_mail_address_1"></li>
								</ul>
								<input id="mail_login_1" type="radio" name="mail_login" value="1">
								<label for="mail_login_1">このメールアドレスでログインする</label><br>
								<input id="mail_1" type="radio" name="mail" value="1">
								<label for="mail_1">このメールアドレスでメールを受信する</label>

								<p class="mt_1">メールアドレス2</p><input id="mail_address_2" class="w_80" type="email" name="mail_address_2" value="<?php echo $mail_address_2; ?>"><br>
								<ul class="error_ul">
									<li class="error" id="err_mail_address_2"></li>
								</ul>
								<input id="mail_login_2" type="radio" name="mail_login" value="2">
								<label for="mail_login_2">このメールアドレスでログインする</label><br>
								<input id="mail_2" type="radio" name="mail" value="2">
								<label for="mail_2">このメールアドレスでメールを受信する</label>

								<ul class="error_ul">
									<li class="error" id="err_mail"></li>
									<li class="error" id="err_mail_login"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>メルマガ配信の希望</th>
							<td>
								<input id="merumaga_1" type="radio" name="merumaga" value="1">
								<label for="merumaga_1">希望する</label><br>
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
								<p class="pass_text">大文字と小文字のアルファベットおよび数字を1文字以上含む、8桁以上のパスワードをご入力ください</p>
								<input id="pass_1" class="w_80" type="password" name="pass_1" value="">
								<ul class="error_ul">
									<li class="error" id="err_pass_1"></li>
								</ul>
								<p class="mt_1">確認用</p>
								<input id="pass_2" class="w_80" type="password" name="" value="">
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
								<p>
									<span class='select_wrap'>
										<select id="job_1" class="w_70" name="job_1">
											<option value=""></option>
										</select>
									</span>
								</p>
								<p class="mt_1">
									<span class='select_wrap'>
										<select id="job_2" class="w_70" name="job_2">
											<option value=""></option>
										</select>
									</span>
								</p>
								<p class="mt_1">
									<span class='select_wrap'>
										<select id="job_3" class="w_70" name="job_3">
											<option value=""></option>
										</select>
									</span>
								</p>
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
								<p class="mt_1">都道府県</p>
								<span class='select_wrap'>
									<select id="office_todohuken" name="office_math">
										<option value=""></option>
									</select>
								</span>
								<p class="mt_1">市区町村／番地</p>
								<input id="office_shiku" class="w_80" type="text" name="office_shiku" value="<?php echo $office_shiku; ?>">
								<p class="mt_1">建物／部屋番号</p>
								<input id="office_tatemono" class="w_80" type="text" name="office_tatemono" value="<?php echo $office_tatemono; ?>">
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
							<td>
								<div id="nintei-shikaku-wrap">
								</div>
								<textarea id="shikaku_sonota" name="shikaku_sonota" placeholder="その他を選択した場合は必須入力となります"><?php echo $shikaku_sonota; ?></textarea>
								<ul class="error_ul">
									<li class="error" id="err_shikaku"></li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="oshirase">
				<h2>お知らせ／連絡方法／アンケート</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tr>
							<th><span class="required">必須</span>連絡方法の希望</th>
							<td>
								<input id="hoho_1" type="radio" name="hoho" value="1"><label for="hoho_1">メールでお知らせ</label><br>
								<input id="hoho_2" type="radio" name="hoho" value="2"><label for="hoho_2">郵便でお知らせ</label>
								<ul class="error_ul">
									<li class="error" id="err_renraku_hoho"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>郵便物配達先の希望</th>
							<td>
								<input id="yubin_1" type="radio" name="yubin" value="0"><label for="yubin_1">自宅</label><br>
								<input id="yubin_2" type="radio" name="yubin" value="1"><label for="yubin_2">勤務先／所属先</label>
								<ul class="error_ul">
									<li class="error" id="err_yubin"></li>
								</ul>
							</td>
						</tr>
						<tr class="chiiki">
							<th><span class="any"></span>興味のある地域</th>
							<td class="clearfix">
								<p>居住地域以外でセミナー開催の情報を知りたい地域<br>
									(マイページトップにおすすめセミナーとして表示されます)</p>
								<div id="Area">
								</div>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>ウェブサイト掲載</th>
							<td>
								<input id="web_1" type="radio" name="web" value="1"><label for="web_1">希望する</label><br>
								<input id="web_2" type="radio" name="web" value="0"><label for="web_2">希望しない</label>
								<ul class="error_ul">
									<li class="error" id="err_web"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>アンケート協力</th>
							<td>
								<input id="qa_1" type="radio" name="qa" value="1"><label for="qa_1">協力する</label><br>
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
			</div>
			<div class="agreement_wrap">
				<h2>定款・規約・規程</h2>
				<p class="agreement_text">以下の「定款」「会員規約」「会員倫理規程」「個人情報保護規程」に同意したうえでのご入会をお願い致します。</p>
				<div class="agreement">
					<div class="teikan">
						<p class="title">特定非営利活動法人NSCAジャパン<br>定款</p>
						<p class="chapter">第１章 総則</p>
						<dl>
							<dt>（名称）<br>
								第１条 この法人は、特定非営利活動法人NSCA ジャパンという。また、英文表記は、National Strength and Conditioning Association Japan とする。</dt>
							<dt>（事務所）<br>
								第２条 この法人は、事務所を千葉県流山市前平井８５番地（運B１３３街区１）に置く。</dt>
							<dt>（目的）<br>
								第３条 この法人は、会員及び一般の人々に対して、ストレングス＆コンディショニングに関する事業を行い、国民の健康とスポーツの競技力向上と傷害の予防に寄与することを目的とする。</dt>
							<dd>
								（２） NSCAジャパンをストレングス＆コンディショニングの権威として、その地位の確立を図ること。<br>
								（３） ストレングス＆コンディショニングの専門職を育成するために教育及び訓練を継続的に行うこと。<br>
								（４） ストレングス＆コンディショニングの専門職の地位の向上と一般の人々のストレングス＆コンディショニングに関する認知を向上させること。
							</dd>
							<dt>（特定非営利活動の種類）<br>
								第４条 この法人は、前条の目的を達成するため、次の種類の特定非営利活動を行う。</dt>
							<dd>
								（１） 保健、医療又は福祉の増進を図る活動<br>
								（２） 学術、文化、芸術又はスポーツの振興を図る活動<br>
								（３） 子どもの健全育成を図る活動<br>
								（４） 上記の活動を行う団体の運営又は活動に関する連絡、助言又は援助の活動
							</dd>
							<dt>（事業の種類）<br>
								第５条 この法人は、前３条の目的を達成するため、特定非営利活動に係る事業として、次の事業を行う。</dt>
							<dd>
								（１） NSCAジャパン・ジャーナル（機関誌）等の発行<br>
								（２） ウェブサイトによる情報の配信<br>
								（３） 教育イベントやセミナーの開催（カンファレンス、研修会、教育講座等を含む）<br>
								（４） 教材の作成及び配布<br>
								（５） 資格認定試験の実施<br>
								（６） その他、この法人の目的を達成するために必要な事業
							</dd>
						</dl>
						<p class="chapter">第２章 会員</p>
						<dl>
							<dt>（種別）<br>
								第６条 この法人の会員は、次の４種とし、正会員をもって特定非営利活動促進法（以下「法」という。）上の社員とする。</dt>
							<dd>
								（１） 正会員 　この法人の目的に賛同して入会した個人<br>
								（２） 学生会員 　この法人の目的に賛同して入会した学生<br>
								（３） 賛助会員 　この法人の事業を援助するための目的に賛同して入会した団体<br>
								（４） 英文会員 　この法人の目的に賛同して入会し英文機関誌を希望する個人
							</dd>
							<dt>（入会）<br>
								第７条 会員として入会しようとする者は、理事長が別に定める入会申込書により、理事長に申し込むものとする。</dt>
							<dd>
								２ 理事長は、前項の申し込みがあったとき、正当な理由がない限り、入会を認めなければならない。<br>
								３ 理事長は、前２項の者の入会を認めないときは、速やかに、理由を付した書面をもって本人にその旨を通知しなければならない。
							</dd>
							<dt>（会費）<br>
								第８条 会員は、総会において別に定める会費を納入しなければならない。</dt>
							<dt>（会員の資格の喪失）<br>
								第９条 会員が次の各号のーに該当する場合には、その資格を喪失する。</dt>
							<dd>
								（１） 退会届を提出したとき<br>
								（２） 本人が死亡し、若しくは失そう宣告を受けたとき<br>
								（３） 継続して半年以上会費を滞納したとき<br>
								（４） 除名されたとき
							</dd>
							<dt>（退会）<br>
								第１０条 会員は、理事長が別に定める退会届を理事長に提出して、任意に退会することができる。</dt>
							<dt>（除名）<br>
								第１１条 会員が次の各号のーに該当する場合には、総会の議決により、これを除名することができる。</dt>
							<dd>
								（１） この定款等に違反したとき<br>
								（２） この法人の名誉を傷つけ、又は目的に反する行為をしたとき<br>
								２ 前項の規定により会員を除名しようとする場合は、議決の前に当該会員に弁明の機会を与えなければならない。
							</dd>
							<dt>（賞）<br>
								第１２条 この法人に多大な貢献をした会員に対し、理事会がこれを推薦し、理事長が表彰する。</dt>
							<dd>２ 表彰内規は別に定める。</dd>
							<dt>（拠出金品の不返還）<br>
								第１３条 既に納入した会費その他の拠出金品は、返還しない。</dt>
						</dl>
						<p class="chapter">第３章 役員</p>
						<dl>
							<dt>
								（種類及び定数）<br>
								第１４条 この法人に、次の役員を置く。
							</dt>
							<dd>
								（１） 理事　３人以上７人以内<br>
								（２） 監事　１人以上２人以内<br>
								２ 理事のうち１人を理事長、１人を副理事長とする。<br>
								３ 理事は、次の各号の１つ以上の担当に就かなければならない。<br>
								（１） 広報担当<br>
								（２） 教育・研究担当<br>
								（３） 認定試験・資格継続教育単位担当<br>
								（４） 総務担当<br>
								（５） 地域ディレクター担当
							</dd>
							<dt>
								（選任等）<br>
								第１５条 理事及び監事は、理事会が候補者として、この法人の内外より適任者を推薦し、総会において選任する。
							</dt>
							<dd>
								２ 理事長及び副理事長は、理事の互選とする<br>
								３ 役員のうちには、それぞれの役員について、その配偶者若しくは三親等以内の親族が１人を超えて含まれ、又は当該役員並びにその配偶者及び三親等以内の親族が役員の総数の３分の１を超えて含まれることになってはならない。<br>
								４ 法第２０条各号のいずれかに該当する者は、この法人の役員になることができない。<br>
								５ 監事は、理事又はこの法人の職員を兼ねてはならない。
							</dd>
							<dt>
								（職務）<br>
								第１６条 理事長は、この法人を代表し、その業務を総理する
							</dt>
							<dd>
								２ 理事長以外の理事は、法人の業務について、この法人を代表しない<br>
								３ 副理事長は、理事長を補佐し、理事長に事故があるとき又は理事長が欠けたときは、その職務を代行する。<br>
								４ 理事は、理事会を構成し、この定款の定め及び理事会の議決に基づき、この法人の業務を執行する。<br>
								５ 監事は、次に掲げる職務を行う。<br>
								（１） 理事の業務執行の状況を監査すること<br>
								（２） この法人の財産の状況を監査すること<br>
								（３） 前２号の規定による監査の結果、この法人の業務又は財産に関し不正の行為又は法令若しくは定款に違反する重大な事実があることを発見した場合には、これを総会又は所轄庁に報告すること<br>
								（４） 前号の報告をするために必要がある場合には、総会を招集すること<br>
								（５） 理事の業務執行の状況又はこの法人の財産の状況について理事に意見を述べること
							</dd>
							<dt>
								（任期等）<br>
								第１７条 役員の任期は、２年とする。ただし、再任を妨げない。
							</dt>
							<dd>
								２ 役員の任期は連続して最長3期（6年）までとする。<br>
								３．役員の任期の定めにかかわらず、後任の役員が選任されていない場合には、現任者の任期の末日後最初の総会が終結するまでその任期を伸長する。<br>
								４．補欠のため、又は増員により就任した役員の任期は、それぞれの前任者又は現任者の任期の残存期間とする。<br>
								５．役員は、辞任又は任期満了後においても、後任者が就任するまでは、その職務を行わなければならない。
							</dd>
							<dt>
								第１８条 理事又は監事のうち、その定数の３分の１を超える者が欠けたときは、遅滞なくこれを補充しなければならない。
							</dt>
							<dt>
								（解任）<br>
								第１９条 役員が次の各号の一に該当する場合には、総会の議決により、これを解任することができる。
							</dt>
							（１） 心身の故障のため、職務の遂行に堪えないと認められるとき<br>
							（２） 職務上の義務違反その他役員としてふさわしくない行為があったとき<br>
							２ 前項の規定により役員を解任しようとする場合は、議決の前に当該役員に弁明の機会を与えなければならない。
							<dt>
								（報酬等）<br>
								第２０条 役員には、報酬は支払われない。
							</dt>
							<dd>
								２ 役員には、その職務を遂行するために要した費用を弁償することができる。<br>
								３ 前２項に関し必要な事項は、総会の議決を経て理事長が別に定める。
							</dd>
						</dl>
						<p class="chapter">第４章 会議</p>
						<dl>
							<dt>（種別）<br>
								第２１条 この法人の会議は、総会及び理事会の２種とする。
							</dt>
							<dd>２ 総会は、通常総会及び臨時総会とする。</dd>
							<dt>（総会の構成）<br>
								第２２条 総会は、正会員をもって構成する。</dt>
							<dt>（総会の権能）<br>
								第２３条 総会は、以下の事項について議決する。</dt>
							<dd>（１） 定款の変更<br>
								（２） 解散及び合併<br>
								（３） 事業計画及び予算並びにその変更<br>
								（４） 事業報告及び決算<br>
								（５） 役員の選任又は解任、職務及び報酬<br>
								（６） 会費の額<br>
								（８） その他運営に関する重要事項
							</dd>
							<dt>（総会の開催）<br>
								第２４条 通常総会は、毎年１回開催する。</dt>
							<dd>
								２ 臨時総会は、次に掲げる場合に開催する。<br>
								（１） 理事会が必要と認め、招集の請求をしたとき<br>
								（２） 正会員総数の５分の１以上から会議の目的を記載した書面により招集の請求があったとき<br>
								（３） 監事が第１６条第４項第４号の規定に基づいて招集するとき
							</dd>
							<dt>（総会の招集）<br>
								第２５条 総会は、前条第２項第３号の場合を除いて、理事長が招集する。</dt>
							<dd>
								２ 理事長は、前条第２項第１号及び第２号の規定による請求があったときは、その日から１０日以内に臨時総会を招集しなければならない。<br>
								３ 総会を招集する場合には、会議の日時、場所、目的及び審議事項を記載した書面もしくは電磁的方法により、開催の日の少なくとも５日前までに通知しなければならない。
							</dd>
							<dt>（総会の議長）<br>
								第２６条 総会の議長は、その総会に出席した正会員の中から選出する。</dt>
							<dt>（総会の定足数）<br>
								第２７条 総会は、正会員総数の５分の１以上の出席がなければ開会することはできない。</dt>
							<dt>（総会の議決）<br>
								第２８条 総会における議決事項は、第２５条第３項の規定によってあらかじめ通知した事項とする。</dt>
							<dd>
								２ 総会の議事は、この定款に規定するもののほか、出席した正会員の過半数をもって決し、可否同数のときは、議長の決するところによる。<br>
								３ 理事又は正会員が総会の目的である事項について提案した場合において、正会員の全員が書面により同意の意思表示をした時は、当該提案を可決する旨の社員総会の議決があったものとみなす。
							</dd>
							<dt>（総会での表決権等）<br>
								第２９条 正会員の表決権は平等なものとする。</dt>
							<dd>
								２ やむを得ない理由により総会に出席できない正会員は、あらかじめ通知された事項について書面もしくは電磁的方法をもって表決し、又は他の正会員を代理人として表決を委任することができる。<br>
								３ 前項の規定により表決した正会員は、前２条の規定の適用については出席したものとみなす。<br>
								４ 総会の議決について、特別の利害関係を有する正会員は、その議事の議決に加わることができない。
							</dd>
							<dt>（総会の議事録）<br>
								第３０条 総会の議事については、次の事項を記載した議事録を作成しなければならない。</dt>
							<dd>
								（１） 日時及び場所<br>
								（２） 正会員総数及び出席者数（書面表決者又は表決委任者がある場合にあっては、その数を付記すること）<br>
								（３） 審議事項<br>
								（４） 議事の経過の概要及び議決の結果<br>
								（５） 議事録署名人の選任に関する事項<br>
								２ 議事録には、議長及び総会において選任された議事録署名人２人が、記名押印又は署名しなければならない。<br>
								３ 前２項の規定に関わらず、正会員全員が書面により同意の意思表示をしたことにより、総会の決議があったとみなされた場合においては、次の事項を記載した議事録を作成しなければならない。<br>
								（１） 総会の決議があったとみなされた事項の内容<br>
								（２） 前号の事項の提案をした者の氏名又は名称<br>
								（３） 総会の決議があったとみなされた日及び正会員総数<br>
								（４） 議事録の作成に係る職務を行った者の氏名
							</dd>
							<dt>（理事会の構成）<br>
								第３１条 理事会は、理事をもって構成する。</dt>
							<dt>（理事会の権能）<br>
								第３２条 理事会は、この定款に別に定める事項のほか、次の事項を議決する。</dt>
							<dd>
								（１） 総会に付議すべき事項<br>
								（２） 総会の議決した事項の執行に関する事項<br>
								（３） その他総会の議決を要しない業務の執行に関する事項
							</dd>
							<dt>（理事会の開催）<br>
								第３３条 理事会は、次に掲げる場合に開催する。</dt>
							<dd>
								（１） 理事長が必要と認めたとき<br>
								（２） 理事総数の２分の１以上から理事会の目的である事項を記載した書面により招集の請求があったとき
							</dd>
							<dt>（理事会の招集）<br>
								第３４条 理事会は、理事長が招集する。</dt>
							<dd>
								２ 理事長は、前条第２号の場合にはその日から１０日以内に理事会を招集しなければならない。<br>
								３ 理事会を招集するときは、会議の日時、場所、目的及び審議事項を記載した書面もしくは電磁的方法により、開催の日の少なくとも２０日前までに通知しなければならない。
							</dd>
							<dt>（理事会の定足数）<br>
								第３５条 理事会は理事総数の過半数の出席をもって成立する。</dt>
							<dt>（理事会の議長）<br>
								第３６条 理事会の議長は、理事長がこれにあたる。</dt>
							<dt>（理事会の議決）<br>
								第３７条 理事会における議決事項は、第３４条第３項の規定によってあらかじめ通知した事項とする。</dt>
							<dd>２ 理事会の議事は、出席理事の過半数をもって決し、可否同数のときは、議長の決するところによる。</dd>
							<dt>（理事会の表決権等）<br>
								第３８条 各理事の表決権は、平等なるものとする。</dt>
							<dd>
								２ やむを得ない理由のため理事会に出席できない理事は、あらかじめ通知された事項について書面もしくは電磁的方法をもって表決することができる。<br>
								３ 前項の規定により表決した理事は、前条及び次条第１項の適用については、理事会に出席したものとみなす。<br>
								４ 理事会の議決について、特別の利害関係を有する理事は、その議事の議決に加わることができない。
							</dd>
							<dt>（理事会の議事録）<br>
								第３９条 理事会の議事については、次の事項を記載した議事録を作成しなければならない。</dt>
							<dd>
								（１） 日時及び場所<br>
								（２） 理事総数、出席者数及び出席者氏名（書面表決者にあっては、その旨を付記すること）<br>
								（３） 審議事項<br>
								（４） 議事の経過の概要及び議決の結果<br>
								（５） 議事録署名人の選任に関する事項<br>
								２ 議事録には、議長及びその会議において選任された議事録署名人２人以上が記名押印又は署名しなければならない。
							</dd>
						</dl>
						<p class="chapter">第５章 資産</p>
						<dl>
							<dt>（構成）<br>
								第４０条 この法人の資産は、次の各号に掲げるものもって構成する。</dt>
							<dd>
								（１） 設立当初の財産目録に記載された資産<br>
								（２） 会費<br>
								（３） 寄付金品<br>
								（４） 財産から生じる収入<br>
								（５） 事業に伴う収入<br>
								（６） その他の収入
							</dd>
							<dt>（区分）<br>
								第４１条 この法人の資産は、特定非営利活動に係る事業に関する資産とする。</dt>
							<dt>（管理）<br>
								第４２条 この法人の資産は、理事長が管理し、その方法は、総会の議決を経て、理事長が別に定める。</dt>
						</dl>
						<p class="chapter">第６章 会計</p>
						<dl>
							<dt>（会計の原則）<br>
								第４３条 この法人の会計は、法第２７条各号に掲げる原則に従って行わなければならない。</dt>
							<dt>（会計区分）<br>
								第４４条 この法人の会計は、次のとおりとする。</dt>
							<dd>（１） 特定非営利活動に係る事業会計</dd>
							<dt>（事業年度）<br>
								第４５条 この法人の事業年度は、毎年４月１日に始まり、翌年３月３１日に終わる。</dt>
							<dt>（事業計画及び予算）<br>
								第４６条 この法人の事業計画及びこれに伴う予算は、毎事業年度ごとに理事長が作成し、総会の議決を経なければならない。</dt>
							<dt>（暫定予算）<br>
								第４７条 前条の規定にかかわらず、やむを得ない理由により予算が成立しないときは、理事長は理事会の議決を経て、予算成立の日まで前事業年度の予算に準じ収入支出することができる。</dt>
							<dd>２ 前項の収入支出は、新たに成立した予算の収入支出とみなす。</dd>
							<dt>（予備費）<br>
								第４８条 予算超過又は予算外の支出に充てるため、予算中に予備費を設けることができる。</dt>
							<dd>２ 予備費を使用するときは、理事会の議決を経なければならない。</dd>
							<dt>（予算の追加及び更正）<br>
								第４９条 予算成立後にやむを得ない事由が生じたときは、総会の議決を経て、既定予算の追加又は更正をすることができる。</dt>
							<dt>（事業報告及び決算）<br>
								第５０条 法人の事業報告書、財産目録、貸借対照表及び活動計算書等決算に関する書類は、毎事業年度終了後、速やかに、理事長が作成し、監事の監査を受け、総会の議決を経なければならない。</dt>
							<dd>２ 決算上剰余金を生じたときは、次事業年度に繰り越すものとする。</dd>
							<dt>（臨機の措置）<br>
								第５１条 予算をもって定めるもののほか、借入金の借入れその他新たな義務の負担をし、又は権利の放棄をしようとするときは、総会の議決を経なければならない。</dt>
						</dl>
						<p class="chapter">第７章 定款の変更、解散及び合併</p>
						<dl>
							<dt>（定款の変更）<br>
								第５２条 この法人が定款を変更しようとするときは、総会に出席した正会員の４分の３以上の多数による議決を経、かつ、法第２５条第３項に規定する以下の事項を変更する場合、所轄庁の認証を得なければならない。</dt>
							<dd>
								（１）目的<br>
								（２）名称<br>
								（３）その行う特定非営利活動の種類及び当該特定非営利活動に係る事業の種類<br>
								（４）主たる事務所及びその他の事務所の所在地（所轄庁変更を伴うものに限る）<br>
								（５）正会員の得喪に関する事項<br>
								（６）役員に関する事項（役員の定数に関する事項を除く）<br>
								（７）会議に関する事項<br>
								（８）その他の事業を行う場合における、その種類その当該その他の事業に関する事項<br>
								（９）解散に関する事項（残余財産の帰属すべき事項に限る）<br>
								（１０）定款の変更に関する事項<br>
								２　この法人の定款を変更（前項の規定により所轄庁の認証を得なければならない事項を除く。）したときは、所轄庁に届け出なければならない。
							</dd>
							<dt>（解散）<br>
								第５３条 この法人は、次に掲げる事由により解散する。</dt>
							<dd>
								（１） 総会の決議<br>
								（２） 目的とする特定非営利活動に係る事業の成功の不能<br>
								（３） 正会員の欠亡<br>
								（４） 合併<br>
								（５） 破産手続開始の決定<br>
								（６） 所轄庁による設立の認証の取消し<br>
								２ 前項第１号の事由によりこの法人が解散するときは、正会員総数の４分の３以上の承諾を得なければならない。<br>
								３ 第１項第２号の事由により解散するときは、所轄庁の認定を得なければならない。
							</dd>
							<dt>（残余財産の帰属）<br>
								第５４条 この法人が解散（合併または破産手続開始の決定による解散を除く。）したときに残存する財産は、解散時において法第１１条第３項に掲げる者を総会において議決し、譲渡するものとする。</dt>
							<dt>（合併）<br>
								第５５条 この法人が合併しようとするときは、総会において正会員総数の４分の３以上の議決を経、かつ、所轄庁の認証を得なければならない。</dt>
						</dl>
						<p class="chapter">第８章 公告の方法</p>
						<dl>
							<dt>（公告の方法）<br>
								第５６条 この法人の公告は、この法人の掲示場に掲示するとともに、官報（法令公布紙）に掲載して行う。</dt>
						</dl>
						<p class="chapter">第９章 事務局</p>
						<dl>
							<dt>（事務局の設置）<br>
								第５７条 この法人に、この法人の事務を処理するため、事務局を設置する。</dt>
							<dd>２ 事務局には、事務局長及び必要な職員を置く。</dd>
							<dt>（職員の任免）<br>
								第５８条 事務局長及び職員の任免は、理事長が行う。</dt>
							<dt>（組織及び運営）<br>
								第５９条 事務局の組織及び運営に関し必要な事項は、理事会が別に定める。</dt>
						</dl>
						<p class="chapter">第１０章　雑則</p>
						<dl>
							<dt>（細則）<br>
								第６０条 この定款の施行について必要な細則は、理事会の議決を経て、理事長がこれを定める。</dt>
						</dl>
						<p class="chapter">附則</p>
						<dl>
							<dd>
								１ この定款は、この法人の成立の日から施行する。<br>
								２ この法人の設立当初の役員は、別表のとおりとする。<br>
								３ この法人の、設立当初の役員の任期は、第１７条第１項の規定にかかわらず、この法人の成立の日から平成１４年５月３０日までとする。<br>
								４ この法人の設立当初の事業年度は、第４５条の規定にかかわらず、この法人の成立の日から平成１４年３月３１日までとする。<br>
								５ この法人の設立当初の事業計画及び収支予算は、第４６条の規定にかかわらず、設立総会の定めるところによる。<br>
								６ この法人の設立当初の会費は、第８条の規定にかかわらず、次に掲げる額とする。<br>
								（１） 正会員年会費 １２，０００円<br>
								（２） 学生会員年会費 １０，０００円<br>
								（３） 賛助会員年会費 ５０，０００円<br>
								（４） 英文会員年会費 １７，０００円<br><br>
								この定款は、平成１５年４月２０日から施行する。<br>
								この定款は、平成１６年４月１８日から施行する。<br>
								この定款は、平成１７年４月１７日から施行する。<br>
								この定款は、平成１８年４月１６日から施行する。<br>
								この定款は、平成２０年６月１日から施行する。<br>
								この定款は、平成２２年４月１９日から施行する。<br>
								この定款は、平成２４年１０月１６日から施行する。<br>
								この定款は、平成２５年１０月２９日から施行する。<br>
								この定款は、平成２６年１０月１０日から施行する。<br>
								この定款は、平成２９年９月１５日から施行する。
							</dd>
						</dl>
						<p class="chapter">別表　設立当初の役員</p>
						<table>
							<tbody>
								<tr>
									<th>役職名</th>
									<td>氏名</td>
								</tr>
								<tr>
									<th>理事長</th>
									<td>石井　直方</td>
								</tr>
								<tr>
									<th>副理事長</th>
									<td>矢野　雅知</td>
								</tr>
								<tr>
									<th>理事</th>
									<td>長谷川　裕</td>
								</tr>
								<tr>
									<th>理事</th>
									<td>岡田　純一</td>
								</tr>
								<tr>
									<th>理事</th>
									<td>有賀　誠司</td>
								</tr>
								<tr>
									<th>監事</th>
									<td>尾山　末雄</td>
								</tr>
								<tr>
									<th>監事</th>
									<td>白濱　哲郎</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="kiyaku">
						<p class="title">特定非営利活動法人NSCAジャパン<br>会員規約</p>
						<p>特定非営利活動法人NSCAジャパン（以下「当協会」という）の会員資格ならびに、入退会に関する事項は、特定非営利活動法人NSCAジャパン定款、および本会員規約によります。</p>
						<dl>
							<dt>第１条　入会手続</dt>
							<dd>
								１）正会員：入会申込および年会費の納入<br>
								２）学生会員：入会申込、学生であることを証明する書類*の提出、および年会費の納入<br>
								３）賛助会員：入会申込および年会費の納入<br>
								４）１８歳未満の方が入会する場合は、会員種別にかかわらず、親権者の同意書の提出を入会条件とする<br>
								*学生であることを証明する書類とは、原則として学校教育法で指定された教育機関が発行するもので有効な期限が明記されているものとします。
							</dd>
							<dt>第２条　会員の成立</dt>
							<dd>入会申込書の提出（学生会員の場合は、学生であることを証明する書類の提出を含む）と年会費の納入を、当協会が確認した時点で会員として登録されます。</dd>
							<dt>第３条　会員の有効期限</dt>
							<dd>会員の有効期限は、会員として登録された月の末日から起算して１年間とします。</dd>
							<dt>第４条　会員有効期限の更新</dt>
							<dd>
								会員の有効期限の更新に関しては以下のように定めます。<br>
								（１）第３条に定める有効期限までに、年会費を納入する（学生会員の場合は、学生であることを証明する書類の提出を含む）ことで有効期限を更新することができます。<br>
								（２）有効期限後であっても、有効期限から起算して６ヵ月以内であれば、第４条１）と同等の手続きを行うことで有効期限を更新することができます。なお、この場合の更新後の有効期限は、更新前の有効期限から１年間とします。<br>
								（３）有効期限から起算して６ヵ月を過ぎた場合および退会した場合は、新たに第１条に定める入会手続きをとるものとします。<br>
								（４）ただし、当協会から発行される機関誌等については、会員の有効期限までに更新の意思表示がない場合は、有効期限月をもって一旦送付を停止いたします。
							</dd>
							<dt>第５条　会員種別の変更</dt>
							<dd>
								１）会員は、第４条１）および第４条２）に定める更新手続きの時に限り、事務局に会員種別の変更を申し出ることで、会員種別を変更することができます。なお、有効期限の途中での種別変更はできません。<br>
								２）学生会員に種別変更する時は、学生であることを証明する書類を提出しなければなりません。
							</dd>
							<dt>第６条　退会手続</dt>
							<dd>
								１）会員は、退会届に必要事項を記入のうえ提出することで、任意に退会することができます。ただし、すでに納入した年会費等の払い戻しは受けられません。<br>
								２）会員が退会あるいは死亡した場合には、当該会員の会員資格は失われます。また、会員資格を第三者へ譲渡、または継承することはできません。
							</dd>
							<dt>第７条　登録情報の変更</dt>
							<dd>
								１）当協会に登録中の情報に変更があった場合は、速やかに事務局にその内容を連絡するものとします。<br>
								２）住所、電話番号、またはメールアドレス等の変更の連絡がなく、当協会から会員への機関誌の送付、各種の通知、または各種書類の送付等が、遅延または完了できなかった場合、当協会はその責を負わないものとします。
							</dd>
							<dt>第８条　会員の義務</dt>
							<dd>
								１）会員は、定款第８条に定める会費を納入しなければなりません。<br>
								２）会員は、定款、会員倫理規程、本規約および理事会の定める規則、または法令を遵守しなければなりません。
							</dd>
							<dt>第９条　禁止事項</dt>
							<dd>
								１）会員は、理事会の許可なく、当協会の名称やこれを連想させる名称、ロゴなどを無断で使用して活動することはできません。<br>
								２）会員は、当協会の活動において、理事会の許可なく他の会員に対し、営利を目的とした営業活動、宣伝活動もしくはこれに類似する行為を行うことはできません。
							</dd>
							<dt>第１０条　規約の変更その他</dt>
							<dd>
								１）会員規約条文において、理事会の決定および承認により、その条文を変更・改正・削除できるものとします。<br>
								２）当規約において定めるもののほか、必要な事項については、理事長が理事会の議決を経て別に定めます。
							</dd>
							<dt>附則</dt>
							<dd>
								本会員規約は２０１２年１０月１日より施行する。<br>
								本会員規約は２０１８年１月１５日より施行する。<br>
								本会員規約は２０１９年６月１６日より施行する。
							</dd>
						</dl>
					</div>
					<div class="kitei">
						<p class="title">特定非営利活動法人NSCAジャパン<br>会員倫理規程</p>
						<p>特定非営利活動法人NSCAジャパン（以下、NSCAジャパン）は、研究に裏付けられたストレングス＆コンディショニングに関する知識を普及させ、子どもから高齢者にいたるすべての人の健康増進と、アスリートの競技力向上および傷害予防を支援することを使命とする。すべての会員が高い品格と職業意識を維持・向上させるよう、ここに、会員が遵守すべき倫理規程を定める。<br><br>
							以下にその規則を記載するが、これは、あらゆる状況を網羅しているわけではない。倫理規程の解釈と適用は、個々の事例およびそれに準ずる条例・規則等との間に矛盾がある場合には、後者が優先される。</p>
						<dl>
							<dt>（社会的な責任）<br>
								第１条 会員は、ストレングス＆コンディショニングおよびパーソナルトレーニングに関わる専門職が、研究に裏付けられた知識や技術、そして良識を兼ね備えていることで、社会から信頼され職務を任されているということを認識するものとする。</dt>
							<dd>２ 会員は、すべての人々の健康増進と、アスリートの競技力向上および傷害予防を支援することに努めるとともに、常にクライアントの安全、健康、福祉を優先するものとする。</dd>
							<dt>（公正な活動）<br>
								第２条 会員は、すべての人の権利を尊重するものとする。</dt>
							<dd>
								（１）会員は、すべての人に対し、公平かつ平等に対応するものとする。<br>
								（２）会員は、業務上知り得たクライアントのいかなる情報も、本人の許可なしに漏洩してはならない。<br>
								（３）会員は、初回面談、トレーニング、測定・評価を、公正に実施するものとし、調査・測定・評価データの記録保存や厳正な取り扱いを徹底するとともに、得た情報を不当に利用してはならない。<br>
								（４）会員は、ストレングス＆コンディショニングおよびパーソナルトレーニングに関わる問題に対して、特定の権威・組織・利益によらない中立的・客観的な立場から討議し、適切な方策を計画し、実行するものとする。
							</dd>
							<dt>（法令の遵守）<br>
								第３条 会員は、法令およびそれに準ずる条例・規則等を遵守するものとする。</dt>
							<dd>
								（１）会員は、NSCAジャパンの定款に従うものとする。<br>
								（２）会員は、いかなる不法行為も黙認してはならず、また、関与してはならない。<br>
								（３）会員は、自らの専門的資格、経験、身分等を偽ってはならない。<br>
								（４）会員は、トレーニングの過程またはストレングス＆コンディショニングコーチ、パーソナルトレーナーとしての自分から得られる成果について、故意に欺いたり、不当に主張したりしてはならない。
							</dd>
							<dt>（自己研磨）<br>
								第４条 会員は、自らの向上に努めるものとする。</dt>
							<dd>
								（１）会員は、専門職としての自らの知識・技術、技能等の継続的な向上に努めるとともに、すべての人々が健康で活動的でいられる社会の実現に貢献するものとする。<br>
								（２）会員は、クライアントに対し、より良いサービスを提供できるよう、日々向上に努めるものとする。
							</dd>
							<dt>（契約の遵守）<br>
								第５条 会員は、クライアントあるいは雇用主との間で、専門職務を実施する上での取り決めの内容を明確に把握し、成立したすべての取り決めを尊重するものとする。</dt>
							<dt>（専門職相互の協力と尊重）<br>
								第６条 会員は、専門職相互の考えや立場を尊重し、協力し合うものとする。</dt>
							<dd>
								（１）会員は、他者と互いの能力の向上に協力し、専門職務上の意見や指摘には謙虚に耳を傾け、不公正な競争を避けて真摯な態度で職務に取り組むと共に、他者の業績を正当に評価し、尊重するものとする。<br>
								（２）会員は、適切または必要と判断される場合は、クライアントもしくは雇用主を、自分以外のストレングス＆コンディショニングコーチやパーソナルトレーナーに紹介するものとする。<br>
								（３）会員は、適切または必要と判断される場合は、クライアントもしくは雇用者を、より適切な資格を有するフィットネス、医療またはヘルスケア専門職に紹介するものとする。
							</dd>
							<dt>（教育と啓発）<br>
								第７条 会員は、将来を担うストレングス＆コンディショニングおよびパーソナルトレーニングの専門職の教育・育成に努めるものとする。また、自己の専門知識と経験を生かし、研究に裏付けられたストレングス＆コンディショニングに関する知識・技術を人々に広めるよう努めるものとする。</dt>
							<dt>（情報倫理の遵守）<br>
								第８条　 会員は、インターネットの利用において、ホームページや、ブログ、SNSが公共の場であることを自覚し、社会的な責任を果たさなければならない。</dt>
							<dd>２ 会員は、インターネット上のホームページや、ブログ、SNSにおいて情報発信する際に、以下のような内容を掲載してはならない。<br>
								（１）法令及びNSCAジャパンの規定に反する情報<br>
								（２）NSCAジャパンの品位を損傷するような表現や内容<br>
								（３）知的財産権を侵害する情報<br>
								（４）個人の権利または利益を侵害する情報<br>
								（５）個人および組織などを誹謗中傷する情報<br>
								（６）公序良俗に反する情報<br>
								（７）虚偽の情報
							</dd>
							<dt>（倫理誓約）<br>
								第９条　 会員は、NSCAジャパンに対し、害を及ぼすような如何なる行為・活動にも関与しないことを誓わなければならない。この倫理規程に違反した場合、会員は、NSCAジャパンが下した処分に従うことを誓わなければならない。</dt>
							<dt>附則</dt>
							<dd>本会員倫理規程は２０１６年１０月１日より施行する。</dd>
						</dl>
						<p class="title">特定非営利活動法人NSCAジャパン<br>個人情報保護規程</p>
						<dl>
							<dt>第１条（目的）</dt>
							<dd>この規程は、特定非営利活動法人NSCAジャパン事務局（以下「事務局」という。）が保有する個人情報の取り扱いについて基本的事項を定め、個人の権利利益の保護を図るとともに、事業の適正な運営に資することを目的とする。</dd>
							<dt>第２条（定義）</dt>
							<dd>この規程において、「個人情報」とは、個人に関する情報であって、当該情報に含まれる氏名、生年月日その他の記述等により特定の個人を識別することができるもの（他の情報と容易に照合することができ、それにより特定の個人を識別することができることとなるものを含む。）をいう。</dd>
							<dt>第３条（責務）</dt>
							<dd>事務局は、個人情報保護に関する法令又は条例（以下「法令等」という。）を遵守するとともに、実施するあらゆる事業を通じて個人情報の保護に努めるものとする。<br>
								２、事務局の職員は、職務上知り得た個人情報をみだりに第三者に知らせ、又は不当な目的に使用してはならない。その職を退いた後も同様とする。</dd>
							<dt>第４条（取扱い業務の範囲）</dt>
							<dd>
								事務局は、個人情報を取り扱うに当たりその利用の範囲は、原則として以下のとおりとする。<br>
								（１）特定非営利活動法人NSCAジャパン（以下「NSCAジャパン」という。）の事業における会員（非会員も含む）の登録や管理に関わる業務、機関誌や郵便物の発送、教育イベント等のお知らせ、NSCAジャパンのその他の活動に関連する情報の告知。<br>
								（２）マイナンバー制度に伴う個人番号については、支払調書の作成のために利用。<br>
								２、対象となる個人情報は、媒体（電子ファイル、紙媒体）、又は情報処理の形態を問わず、事務局が取り扱う個人情報全てとする。
							</dd>
							<dt>第５条（体制の整備）</dt>
							<dd>事務局は、個人情報の適正な取り扱いを行う責任体制の確立に努めなければならない。<br>
								２　個人情報の適正管理のため個人情報管理者、情報管理責任者を定め、事務局における個人情報の適正管理に必要な措置を行わせるものとする。<br>
								３、個人情報等の取扱いに関する最高責任者は事務局長とする。<br>
								４、この規程は、事務局の職務で個人情報に接する全ての者（役員、職員）に適用する。</dd>
							<dt>第６条（取得の制限）</dt>
							<dd>
								事務局は、個人情報を取得するにあたり、利用目的を明示するとともに、適正且つ公正な手段により取得しなければならない。<br>
								２、思想、信条及び宗教に関する個人情報並びに社会的差別の原因となる個人情報については、取得してはならない。ただし、法令等に定めがある場合、及び個人情報を取り扱う事業の目的を達成するために当該個人情報が必要且つ欠くことが出来ない場合には、この限りではない。</dd>
							<dt>第７条（本人からの取得）</dt>
							<dd>
								原則として本人から個人情報を取得するものとする。ただし、次の各号のいずれかに該当する場合は、この限りではない。<br>
								１、本人の同意があるとき。<br>
								２、法令等に定めがあるとき。<br>
								３、出版、報道等により公にされているとき。<br>
								４、個人の生命、身体又は財産の安全を守るため、緊急且つやむを得ないと認められるとき。<br>
								５、所在不明、その他の事由により、本人から取得することができないとき。<br>
								６、争訟、選考、指導、相談等の事業で本人から取得したのではその目的を達成しないと認められるとき、又は事業の性質上本人から取得したのでは事業の適正な執行に支障が生じると認められるとき。
							</dd>
							<dt>第８条（利用及び提供の原則）</dt>
							<dd>事務局は、個人情報を取得した際、あらかじめその利用目的を公表している場合を除き、速やかに、その利用目的を本人に通知し、又は公表しなければならない。</dd>
							<dt>第９条（個人情報の第三者提供）</dt>
							<dd>
								事務局は、個人情報を取得した時の目的の範囲を超えて、個人情報の利用及び第三者に提供をしてはならない。ただし、次の各号のいずれかに該当する場合は、この限りではない。<br>
								１、本人又は法定代理人の同意に基づいて利用し、又は提供するとき。<br>
								２、法令等に基づいて利用し、又は提供するとき。<br>
								３、出版、報道等により公にされているものを利用し、又は提供するとき。<br>
								４、個人の生命、身体又は財産の安全を守るため、緊急且つやむを得ないと認められ利用し、又は提供するとき。
							</dd>
							<dt>第１０条（正確性の確保）</dt>
							<dd>事務局は、個人情報を正確且つ最新の内容に保つよう努めなければならない。</dd>
							<dt>第１１条（安全性の確保）</dt>
							<dd>保有する個人情報は、施錠管理、アクセス権の制限、外部からの不正アクセスの防止等、必要かつ合理的な安全管理対策を行う。<br>
								２、職員は個人情報管理者の承認なく個人情報を事務局外に持ち出し、又は第三者に提供してはならない。<br>
								３、個人情報を取引先、委託先等、外部に開示又は提供する場合は、事前に個人情報管理者の承認を得なければならない。<br>
								４、個人情報管理者は、職員に対して個人情報の内部規程等の周知、教育、訓練の実施をしなければならない。<br>
								５、本規程に違反する事実又は違反するおそれがあることを発見した職員は、その旨を個人情報保護管理者に報告するものとする。</dd>
							<dt>第１２条（個人情報の委託処理に関する措置）</dt>
							<dd>事務局は、情報処理を外部業者等へ委託をすることができる。この場合、業務委託契約書及び覚書等の締結を義務付け、十分な個人情報の保護を図り、組織的・人的・物理的・技術的な安全管理措置が客観的に講じられている企業等でなければ委託をしてはならない。</dd>
							<dt>第１３条（自己個人情報の開示）</dt>
							<dd>事務局は、当該個人情報の本人から開示の申出があった場合は、本人であることを確認の上これに応じなければならない。ただし、次の号いずれかに該当する場合は、この限りではない。<br>
								１、法令等の定めにより、本人に開示をすることができないと認められているとき。<br>
								２、開示をすることにより、第三者の正当な利益を損なうおそれがあると認められるとき。<br>
								３、試験、研修、監査、入札、交渉、協議、争訟等に関し、事務局が独自に付与した個人情報であって、開示しないことが適当であると認められるとき。</dd>
							<dt>第１４条（個人情報の利用又は提供の中止）</dt>
							<dd>本人から自己情報を利用し、又は提供することを拒まれた場合は、原則としてこれに応じなければならない。</dd>
							<dt>第１５条（個人情報の消去又は廃棄）</dt>
							<dd>保有する必要のなくなった個人情報は、確実且つ速やかに廃棄に、又は消去しなければならない。</dd>
							<dt>第１６条（苦情や相談の対応）</dt>
							<dd>個人情報管理者は、個人情報の取り扱いに関する苦情及び相談について必要な体制整備を行い、苦情及び相談があった場合は、適切且つ迅速な対応に努めなければならない。</dd>
							<dt>第１７条（罰則）</dt>
							<dd>この規程に違反した場合、就業規則、契約書又は覚書等に従って、処分の対象となる場合がある。故意又は、重大な過失により事務局に損害を与えた場合は、法的措置が講じられる場合がある。</dd>
							<dt>付　則</dt>
							<dd>この規程は２０１６年１０月１日より施行する。</dd>
						</dl>
					</div>
					<p class="doi"><input id="doi" type="checkbox" name="" value=""><label class="checkbox" for="doi">同意する</label></p>
				</div>
			</div>
			<button id="next_button" class="button btn_center" type="button" value="">次へ</button>
		</form>
	</div>
	<?php include('../views/templates/footer.php'); ?>
</body>

</html>
