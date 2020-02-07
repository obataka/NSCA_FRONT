<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>イベント申込｜確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/event_kakunin.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/seminarConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>イベント申込　内容確認</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver height_62">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>イベント申込<br class="sp_no">内容確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<p class="h2_text">表示されている情報が最新でない場合は先に<a class="td_under" id="change" href="#">登録情報</a>より変更をお願いします。</p>
			<form action="" method="post" name="seminarConfirmForm">
				<input type="hidden" name="tb_name" id="tb_name" value="<?php echo $tb_name; ?>">
				<input type="hidden" name="ceu_id" id="ceu_id" value="<?php echo $ceu_id; ?>">
				<input type="hidden" name="sel_event_sbt" id="sel_event_sbt" value="">
				<input type="hidden" name="sel_event_name" id="sel_event_name" value="">
				<input type="hidden" name="sel_event_day" id="sel_event_day" value="">
				<input type="hidden" name="sel_event_hiyo_ippan" id="sel_event_hiyo_ippan" value="">
				<input type="hidden" name="sel_event_hiyo_ryojitsu" id="sel_event_hiyo_ryojitsu" value="">
				<input type="hidden" name="sel_event_hiyo_1" id="sel_event_hiyo_1" value="">
				<input type="hidden" name="sel_event_hiyo_2" id="sel_event_hiyo_2" value="">
				<input type="hidden" name="sel_event_hiyo_konshin" id="sel_event_hiyo_konshin" value="">
				<input type="hidden" name="name_sei" id="name_sei" value="<?php echo $name_sei; ?>">
				<input type="hidden" name="name_mei" id="name_mei" value="<?php echo $name_mei; ?>">
				<input type="hidden" name="name_sei_kana" id="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
				<input type="hidden" name="name_mei_kana" id="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
				<input type="hidden" name="tel_1" id="tel_1" value="<?php echo $tel_1; ?>">
				<input type="hidden" name="tel_2" id="tel_2" value="<?php echo $tel_2; ?>">
				<input type="hidden" name="tel_3" id="tel_3" value="<?php echo $tel_3; ?>">
				<input type="hidden" name="tel" id="tel" value="<?php echo $tel; ?>">
				<input type="hidden" name="kaiin_no" id="kaiin_no" value="<?php echo $wk_kaiin_no; ?>">
				<input type="hidden" name="bei_kaiin_no" id="bei_kaiin_no" value="<?php echo $bei_kaiin_no; ?>">
				<input type="hidden" name="kenmei" id="kenmei" value="<?php echo $kenmei; ?>">
				<input type="hidden" name="sel_math" id="sel_math" value="<?php echo $sel_math; ?>">
				<input type="hidden" name="yubin_nb_1" id="yubin_nb_1" value="<?php echo $yubin_nb_1; ?>">
				<input type="hidden" name="yubin_nb_2" id="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
				<input type="hidden" name="mail_address_1" id="mail_address_1" value="<?php echo $mail_address_1; ?>">
				<input type="hidden" name="mail_address_2" id="mail_address_2" value="<?php echo $mail_address_2; ?>">
				<input type="hidden" name="address_shiku" id="address_shiku" value="<?php echo $address_shiku; ?>">
				<input type="hidden" name="address_tatemono" id="address_tatemono" value="<?php echo $address_tatemono; ?>">
				<input type="hidden" name="shikakumei" id="shikakumei" value="<?php echo $shikakumei; ?>">
				<input type="hidden" name="sel_shikaku" id="sel_shikaku" value="<?php echo $sel_shikaku; ?>">
				<input type="hidden" name="sel_bei_kaiin" id="sel_bei_kaiin" value="<?php echo $bei_kaiin; ?>">
				<input type="hidden" name="screen_name" id="screen_name" value="<?php echo $screen_name; ?>">
				<div class="bg_gray">
					<p class="sbt" id="event_sbt">主催セミナー</p>
					<p class="event_name" id="event_name"><span>イベント名</span></p>
					<div>
						<p id="event_day"><span>開催日</span></p>
						<p id="event_hiyo"><span>参加費</span></p>
					</div>
				</div>
				<div class="kihon_joho">
					<h3>登録情報</h3>
					<form>
						<table>
							<tr class="name">
								<th><span class="required">必須</span>会員番号</th>
								<td>
									<?php echo $wk_kaiin_no; ?>
								</td>
							</tr>
							<tr class="name">
								<th><span class="required">必須</span>氏名</th>
								<td id="shimei">
									<?php echo $name_sei; ?> <?php echo $name_mei; ?>
								</td>
							</tr>
							<tr class="name">
								<th><span class="required">必須</span>フリガナ</th>
								<td id="furigana">
									<?php echo $name_sei_kana; ?> <?php echo $name_mei_kana; ?>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>電話番号</th>
								<td id="denwa_bango">
									<?php echo $tel; ?>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<section class="btn_wrap">
					<button class="button btn_gray" id="return" type="button" value="" onclick="location.href='#'"><span>イベント一覧へ</span></button>
					<button class="button" id="next" type="button" value="" onclick="location.href='#'"><span>決済方法選択へ</span></button>
				</section>
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>