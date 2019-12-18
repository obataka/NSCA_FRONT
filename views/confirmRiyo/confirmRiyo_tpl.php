<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>入会申込｜</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/riyo_kakunin.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/confirmRiyo.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
    </head>
    <body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
		<div class="wrap">
			<h2>入会申込　登録情報確認</h2>
			<div class="content_wrap">
				<div class="spb_arrows">
					<ul class="nav nav-tabs step-anchor">
						<li><span><small>会員種別選択</small></span></li>
						<li><span><small>入力</small></span></li>
						<li class="active"><span><small>確認</small></span></li>
						<li><span><small>完了</small></span></li>
					</ul>
				</div>
				<p class="h2_text">テキストテキストテキストテキストテキストテキスト電話またはメールにて<a href="#">お問い合わせ</a>ください。</p>
				<h3>新規登録</h3>
				<div class="shinki_toroku">
					<table>
						<tr class="kaiin">
							<th><span class="any"></span>会員種別</th>
							<td>
								<p>利用登録（無料）</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="kihon_joho">
					<form action="?" method="post" autocomplete="off" id="confirmForm">
						<input type="hidden" name="name_sei" id="name_sei" value="<?php echo $name_sei; ?>">
						<input type="hidden" name="name_mei" id="name_mei" value="<?php echo $name_mei; ?>">
						<input type="hidden" name="sei_kana_name" id="sei_kana_name" value="<?php echo $sei_kana_name; ?>">	
						<input type="hidden" name="sei_mei_name" id="sei_mei_name" value="<?php echo $sei_mei_name; ?>">
						<input type="hidden" name="sei_mei_name" id="sei_mei_name" value="<?php echo $sei_mei_name; ?>">
						<input type="hidden" name="seireki_name" id="seireki_name" value="<?php echo $seireki_name; ?>">	
						<input type="hidden" name="month" id="month" value="<?php echo $month; ?>">
						<input type="hidden" name="day" id="day" value="<?php echo $day; ?>">
						<input type="hidden" name="sel_gender" id="sel_gender" value="<?php echo $gender; ?>">
						<input type="hidden" name="wk_sel_gender" id="wk_sel_gender" value="<?php echo $wk_sel_gender; ?>">
						<input type="hidden" name="sel_math" id="sel_math" value="<?php echo $sel_math; ?>">
						<input type="hidden" name="address_yubin_nb_1" id="address_yubin_nb_1" value="<?php echo $address_yubin_nb_1; ?>">
						<input type="hidden" name="yubin_nb_2" id="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
						<input type="hidden" name="address_shiku" id="address_shiku" value="<?php echo $address_shiku; ?>">
						<input type="hidden" name="address_tatemono" id="address_tatemono" value="<?php echo $address_tatemono; ?>">
						<input type="hidden" name="address_yomi_shiku" id="address_yomi_shiku" value="<?php echo $address_yomi_shiku; ?>">
						<input type="hidden" name="address_yomi_tatemono" id="address_yomi_tatemono" value="<?php echo $address_yomi_tatemono; ?>">
						<input type="hidden" name="tel" id="tel" value="<?php echo $tel; ?>">
						<input type="hidden" name="keitai_tel" id="keitai_tel" value="<?php echo $keitai_tel; ?>">
						<input type="hidden" name="mail_address_1" id="mail_address_1" value="<?php echo $mail_address_1; ?>">
						<input type="hidden" name="mail_address_2" id="mail_address_2" value="<?php echo $mail_address_2; ?>">
						<input type="hidden" name="sel_mail" id="sel_mail" value="<?php echo $sel_mail; ?>">
						<input type="hidden" name="mail" id="mail" value="<?php echo $mail; ?>">
						<input type="hidden" name="sel_mail" id="sel_mail" value="<?php echo $sel_mail; ?>">
						<input type="hidden" name="merumaga" id="merumaga" value="<?php echo $merumaga; ?>">
						<input type="hidden" name="sel_merumaga" id="sel_merumaga" value="<?php echo $sel_merumaga; ?>">
						<input type="hidden" name="pass_1" id="pass_1" value="<?php echo $pass_1; ?>">
						<input type="hidden" name="hoho" id="hoho" value="<?php echo $hoho; ?>">
						<input type="hidden" name="sel_hoho" id="sel_hoho" value="<?php echo $sel_hoho; ?>">
						<input type="hidden" name="sel_nagareyama" id="sel_nagareyama" value="<?php echo $sel_nagareyama; ?>">
						<input type="hidden" name="sel_chiiki" id="sel_chiiki" value="<?php echo $sel_chiiki; ?>">
						<input type="hidden" name="kenmei" id="kenmei" value="<?php echo $kenmei; ?>">
						<input type="hidden" name="pass" id="pass" value="<?php echo $pass; ?>">
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
										<?php echo $sei_kana_name; ?> <?php echo $sei_mei_name; ?>
									</div>	
								</td>
							</tr>
							<tr class="birthday">
								<th><span class="required">必須</span>生年月日</th>
								<td>
									<?php echo $seireki_name; ?>年
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
									<?php echo $kenmei; ?> <?php echo $address_yubin_nb_1; ?>-<?php echo $yubin_nb_2; ?>
									<br>
									<?php echo $address_shiku; ?><?php echo $address_tatemono; ?>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>住所(ヨミ)</th>
								<td>
									<?php echo $address_yomi_shiku; ?> <?php echo $address_yomi_tatemono; ?>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>電話番号</th>
								<td>
									<?php echo $tel; ?><?php echo $keitai_tel; ?>
								</td>
							</tr>
							<tr class="mail">
								<th><span class="required">必須</span>メールアドレス</th>
								<td>
									<p>メールアドレス_1：<?php echo $mail_address_1; ?></p>
									<p>メールアドレス_2：<?php echo $mail_address_2; ?></p>
									<p>メール受信希望のメールアドレス：<?php echo $sel_mail; ?></p>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>メルマガ配信の希望</th>
								<td>
									<?php echo $sel_merumaga; ?>
								</td>
							</tr>
							<tr class="pass">
									<th><span class="required">必須</span>パスワード</th>
									<td>
										<?php echo str_repeat('●', strlen($pass_1)); ?>
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
									<?php echo $sel_hoho; ?>
								</td>
							</tr>
					</table>
				</div>
				<section class="btn_wrap">
					<button id="return_button" class="button btn_gray" type="button" value="" onclick="location.href='#'">内容を修正する</button>
					<button id="next_button" class="button" type="submit" value="" onclick="location.href='#'">次へ</button>
				</section>
			</div>
		</div>
	<footer id="footer">
	</footer>
</body>
</html>
