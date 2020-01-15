<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>継続登録情報｜確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/continueConfirmMember.css" />

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/continueConfirmMember.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

</head>

<body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
	<div class="wrap mh_c btn_b_wrap">
		<h2>継続登録情報　確認</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>入力</small></span></li>
					<li class="active"><span><small>確認</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<p class="h2_text">テキストテキストテキストテキストテキストテキスト</p>
			<h3>継続入力</h3>
			<form action="?" method="post" autocomplete="off" id="confirmForm" enctype="multipart/form-data">
				<input type="hidden" name="kaiinType" id="kaiinType" value="<?php echo $wk_kaiinType; ?>">
				<input type="hidden" name="kaiinSbt" id="kaiinSbt" value="<?php echo $wk_kaiinSbt; ?>">
				<input type="hidden" name="kaihi" id="kaihi" value="<?php echo $wk_kaihi; ?>">
				<input type="hidden" name="sel_option" id="sel_option" value="<?php echo $option; ?>">
				<input type="hidden" name="wk_sel_option" id="wk_sel_option" value="<?php echo $wk_sel_option; ?>">
				<input type="hidden" name="file_front" id="file_front" value="<?php echo $file_front; ?>">
				<input type="hidden" name="file_back" id="file_back" value="<?php echo $file_back; ?>">
				<input type="hidden" name="name_mei" id="name_mei" value="<?php echo $name_mei; ?>">
				<input type="hidden" name="name_sei" id="name_sei" value="<?php echo $name_sei; ?>">
				<input type="hidden" name="name_sei_kana" id="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
				<input type="hidden" name="name_mei_kana" id="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
				<input type="hidden" name="name_last" id="name_last" value="<?php echo $name_last; ?>">
				<input type="hidden" name="name_first" id="name_first" value="<?php echo $name_first; ?>">
				<input type="hidden" name="year" id="year" value="<?php echo $year; ?>">
				<input type="hidden" name="month" id="month" value="<?php echo $month; ?>">
				<input type="hidden" name="day" id="day" value="<?php echo $day; ?>">
				<input type="hidden" name="sel_gender" id="sel_gender" value="<?php echo $gender; ?>">
				<input type="hidden" name="wk_sel_gender" id="wk_sel_gender" value="<?php echo $wk_sel_gender; ?>">
				<input type="hidden" name="sel_nagareyama" id="sel_nagareyama" value="<?php echo $nagareyama; ?>">
				<input type="hidden" name="wk_sel_nagareyama" id="wk_sel_nagareyama" value="<?php echo $wk_sel_nagareyama; ?>">
				<input type="hidden" name="sel_math" id="sel_math" value="<?php echo $sel_math; ?>">
				<input type="hidden" name="yubin_nb_1" id="yubin_nb_1" value="<?php echo $yubin_nb_1; ?>">
				<input type="hidden" name="yubin_nb_2" id="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
				<input type="hidden" name="address_shiku" id="address_shiku" value="<?php echo $address_shiku; ?>">
				<input type="hidden" name="address_tatemono" id="address_tatemono" value="<?php echo $address_tatemono; ?>">
				<input type="hidden" name="address_yomi_shiku" id="address_yomi_shiku" value="<?php echo $address_yomi_shiku; ?>">
				<input type="hidden" name="address_yomi_tatemono" id="address_yomi_tatemono" value="<?php echo $address_yomi_tatemono; ?>">
				<input type="hidden" name="tel" id="tel" value="<?php echo $tel; ?>">
				<input type="hidden" name="keitai_tel" id="keitai_tel" value="<?php echo $keitai_tel; ?>">
				<input type="hidden" name="fax" id="fax" value="<?php echo $fax; ?>">
				<input type="hidden" name="wk_sel_merumaga" id="wk_sel_merumaga" value="<?php echo $wk_sel_merumaga; ?>">
				<input type="hidden" name="sel_merumaga" id="sel_merumaga" value="<?php echo $merumaga; ?>">
				<input type="hidden" name="url" id="url" value="<?php echo $url; ?>">
				<input type="hidden" name="shoku_1" id="shoku_1" value="<?php echo $shoku_1; ?>">
				<input type="hidden" name="shoku_2" id="shoku_2" value="<?php echo $shoku_2; ?>">
				<input type="hidden" name="shoku_3" id="shoku_3" value="<?php echo $shoku_3; ?>">
				<input type="hidden" name="sel_shoku_1" id="sel_shoku_1" value="<?php echo $sel_shoku_1; ?>">
				<input type="hidden" name="sel_shoku_2" id="sel_shoku_2" value="<?php echo $sel_shoku_2; ?>">
				<input type="hidden" name="sel_shoku_3" id="sel_shoku_3" value="<?php echo $sel_shoku_3; ?>">
				<input type="hidden" name="office_name" id="office_name" value="<?php echo $office_name; ?>">
				<input type="hidden" name="office_yubin_nb_1" id="office_yubin_nb_1" value="<?php echo $office_yubin_nb_1; ?>">
				<input type="hidden" name="office_yubin_nb_2" id="office_yubin_nb_2" value="<?php echo $office_yubin_nb_2; ?>">
				<input type="hidden" name="sel_office_math" id="sel_office_math" value="<?php echo $sel_office_math; ?>">
				<input type="hidden" name="office_shiku" id="office_shiku" value="<?php echo $office_shiku; ?>">
				<input type="hidden" name="office_tatemono" id="office_tatemono" value="<?php echo $office_tatemono; ?>">
				<input type="hidden" name="office_tel" id="office_tel" value="<?php echo $office_tel; ?>">
				<input type="hidden" name="office_fax" id="office_fax" value="<?php echo $office_fax; ?>">
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
				<input type="hidden" name="sel_web" id="sel_web" value="<?php echo $web; ?>">
				<input type="hidden" name="wk_sel_web" id="wk_sel_web" value="<?php echo $wk_sel_web; ?>">
				<input type="hidden" name="sel_yubin" id="sel_yubin" value="<?php echo $yubin; ?>">
				<input type="hidden" name="wk_sel_yubin" id="wk_sel_yubin" value="<?php echo $wk_sel_yubin; ?>">
				<input type="hidden" name="sel_qa" id="sel_qa" value="<?php echo $qa; ?>">
				<input type="hidden" name="wk_sel_qa" id="wk_sel_qa" value="<?php echo $wk_sel_qa; ?>">
				<input type="hidden" name="kaiinType" id="kaiinType" value="<?php echo $wk_kaiinType ?>" />
				<input type="hidden" name="sel_chiiki" id="sel_chiiki" value="<?php echo $sel_chiiki; ?>">
				<input type="hidden" name="sel_office_chiiki" id="sel_office_chiiki" value="<?php echo $sel_office_chiiki; ?>">
				<input type="hidden" name="kenmei" id="kenmei" value="<?php echo $kenmei; ?>">
				<input type="hidden" name="office_kenmei" id="office_kenmei" value="<?php echo $office_kenmei; ?>">
				<div class="kaiin_sbt">
					<table>
						<tr>
							<th><span class="any"></span>会員種別</th>
							<td>
								<p><span id="kaiin"><?php echo $wk_kaiinType; ?></span></p>
								<p>英文購読オプション</p>
								<div>
									<?php echo $option; ?>
								</div>
							</td>
						</tr>
						<tr class="kaihi">
							<th><span>会費<?php echo $wk_kaihi; ?></span></th>
						</tr>
					</table>
				</div>
				<div class="kihon_joho">
					<h3>基本情報</h3>
					<table>
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td class="clearfix">
								<div>
									<?php echo $name_sei; ?> <?php echo $name_mei; ?>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>フリガナ</th>
							<td class="clearfix">
								<div>
									<?php echo $name_sei_kana; ?> <?php echo $name_mei_kana; ?>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>ローマ字表記</th>
							<td class="clearfix">
								<div>
									<?php echo $name_last; ?> <?php echo $name_first; ?>
								</div>
							</td>
						</tr>
						<tr class="birthday">
							<th><span class="required">必須</span>生年月日</th>
							<td>
								<?php echo $year; ?>年
								<?php echo $month; ?>月
								<?php echo $day; ?>日
							</td>
						</tr>
						<tr class="gender">
							<th><span class="required">必須</span>性別</th>
							<td>
								<?php echo $gender; ?>
							</td>
						</tr>
						<tr class="address">
							<th><span class="required">必須</span>住所</th>
							<td>
								<?php echo $yubin_nb_1; ?>-<?php echo $yubin_nb_2; ?><br>
								<?php echo $kenmei; ?><?php echo $address_shiku; ?><br>
								<?php echo $address_tatemono; ?>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>住所(ヨミ)</th>
							<td>
								<?php echo $address_yomi_shiku; ?><br>
								<?php echo $address_yomi_tatemono; ?>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>電話番号</th>
							<td>
								<p>TEL：<?php echo $tel; ?></p>
								<p>携帯：<?php echo $keitai_tel; ?></p>
								<p>FAX：<?php echo $fax; ?></p>
							</td>
						</tr>
						<!-- <tr class="mail">
							<th><span class="required">必須</span>メールアドレス</th>
							<td>
								<p>メールアドレス_1：</p>
								<p>メールアドレス_2：</p>
								<p>メール受信希望のメールアドレス：</p>
							</td>
						</tr> -->
						<tr>
							<th><span class="required">必須</span>メルマガ配信の希望</th>
							<td>
								<?php echo $merumaga; ?>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>URL</th>
							<td>
								<?php echo $url; ?>
							</td>
						</tr>
						<tr class="job">
							<th><span class="any"></span>職業</th>
							<td>
								<?php echo $shoku_1; ?><br>
								<?php echo $shoku_2; ?><br>
								<?php echo $shoku_3; ?>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>勤務先／所属先名</th>
							<td>
								<?php echo $office_name; ?>
							</td>
						</tr>
						<tr class="address">
							<th><span class="any"></span>所属先住所</th>
							<td>
								<?php echo $office_yubin_nb_1; ?>-<?php echo $office_yubin_nb_2; ?><br>
								<?php echo $office_kenmei; ?><?php echo $office_shiku; ?><br>
								<?php echo $office_tatemono; ?>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先電話番号</th>
							<td>
								<?php echo $office_tel; ?>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先FAX番号</th>
							<td>
								<?php echo $office_fax; ?>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>NSCA以外の認定資格</th>
							<td class="clearfix">
								<div>
									<?php
									$shikaku = str_replace(",", "<br>", $shikaku);
									echo $shikaku . "<br>" . $shikaku_sonota;
									?>
								</div>
							</td>
						</tr>
					</table>
			</form>
		</div>
		<div class="oshirase">
			<h3>お知らせ／連絡方法／アンケート</h3>
			<table>
				<tr>
					<th><span class="required">必須</span>連絡方法の希望</th>
					<td>
						<?php echo $hoho; ?>
					</td>
				</tr>
				<tr>
					<th><span class="required">必須</span>郵便物配達先の希望</th>
					<td>
						<?php echo $yubin; ?>
					</td>
				</tr>
				<tr class="chiiki">
					<th><span class="any"></span>興味のある地域</th>
					<td>
						<?php
						$k_chiiki = str_replace(",", "<br>", $k_chiiki);
						echo $k_chiiki;
						?>
					</td>
				</tr>
				<tr>
					<th><span class="required">必須</span>ウェブサイト掲載</th>
					<td>
						<?php echo $web; ?>
					</td>
				</tr>
				<tr>
					<th><span class="required">必須</span>アンケート協力</th>
					<td>
						<?php echo $qa; ?>
					</td>
				</tr>
				<tr>
					<th><span class="any"></span>興味のある分野</th>
					<td class="clearfix">
						<div>
							<?php
							$bunya = str_replace(",", "<br>", $bunya);
							echo $bunya . "<br>" . $bunya_sonota;
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<section class="btn_wrap">
			<button class="button btn_gray" id="return_button" type="button" value="" onclick="location.href='#'"><span>内容を修正する</span></button>
			<button class="button" id="next_button" type="button" value="" onclick="location.href='#'"><span>決済方法へ</span></button>
		</section>
	</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>