<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>物販注文者情報</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/form.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/spb_arrows.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
</head>

<body class="shoppingOrderer">
	<?php

		//条件分岐して読み込んでください
		//ログインしていないときは以下
		include('../views/templates/header_logo.php');
		echo '<div class="wrap before_login">';

		//ログイン中は以下
		//include('../views/templates/header_logo.php');
		//echo '<div class="wrap">';
	?>

		<h1>ご注文者情報</h1>
		<div class="spb_arrows">
			<ul class="nav nav-tabs step-anchor step_3">
				<li class="active"><span><small>物販注文者情報</small></span></li>
				<li><span><small>物販注文情報確認</small></span></li>
				<li><span><small>決済方法選択</small></span></li>
			</ul>
		</div>
		<p class="top_text">下記の必要事項を入力してください。</p>
		<form method="post" enctype="multipart/form-data">
			<div>
				<h2>ご注文者情報</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tbody>
							<tr class="name">
								<th><span class="required">必須</span>氏名</th>
								<td>
									<section class="clearfix">
										<div>
											<p>姓</p><input id="name_sei" type="text" name="name_sei" value="<?php echo $name_sei; ?>" placeholder="例）日本">
										</div>
										<div>
											<p>名</p><input id="name_mei" type="text" name="name_mei" value="<?php echo $name_mei; ?>" placeholder="例）太郎">
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
											<p>セイ</p><input id="name_sei_kana" type="text" name="name_sei_kana" value="<?php echo $name_sei_kana; ?>" placeholder="例）ニホン">
										</div>
										<div>
											<p>メイ</p><input id="name_mei_kana" type="text" name="name_mei_kana" value="<?php echo $name_mei_kana; ?>" placeholder="例）タロウ">
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
							<tr class="address">
								<th><span class="required">必須</span>住所</th>
								<td>
									<div>
										<p>郵便番号</p>
										<div class="">
											<input id="yubin_nb_1" class="yubin_1" type="text" name="yubin_nb_1" value="<?php echo $yubin_nb_1; ?>">-<input id="yubin_nb_2" class="yubin_2" type="text" name="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
											<button id="street_address_search" class="button" type="button">住所検索</button>
										</div>
										<ul class="error_ul">
											<li class="error" id="err_address_yubin_nb_1"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">都道府県</p>
										<span class='select_wrap'>
											<select id="address_todohuken" name="math">
												<option value=""></option>
											</select>
										</span>
										<ul class="error_ul">
											<li class="error" id="err_address_todohuken"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">市区町村／番地</p>
										<input id="address_shiku" class="w_80" type="text" name="address_shiku" value="<?php echo $address_shiku; ?>" placeholder="例）港区芝浦1-13-16 ※英数字は半角">
										<p class="text_blue">住所は番地の最後までご入力ください。</p>
										<ul class="error_ul">
											<li class="error" id="err_address_shiku"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">建物／部屋番号</p>
										<input id="address_tatemono" class="w_80" type="text" name="address_tatemono" value="<?php echo $address_tatemono; ?>" placeholder=" 例）芝浦ビル2階 ※英数字は半角">
										<ul class="error_ul">
											<li class="error" id="err_address_tatemono"></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>電話番号</th>
								<td>
									<p>TELまたは携帯のどちらかをご入力ください。</p>
									<div class="">
										<p class="mt_1">TEL</p><input id="tel" class="w_50" type="tel" name="tel" value="<?php echo $tel; ?>">
										<ul class="error_ul">
											<li class="error" id="err_tel"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">携帯</p><input id="keitai_tel" class="w_50" type="tel" name="keitai_tel" value="<?php echo $keitai_tel; ?>">
										<ul class="error_ul">
											<li class="error" id="err_keitai_tel"></li>
										</ul>
										<ul class="error_ul">
											<li class="error" id="err_fax"></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr class="mail">
								<th><span class="required">必須</span>メールアドレス</th>
								<td>
									<div class="">
										<p>メールアドレス</p>
										<input id="mail_address" class="w_80" type="email" name="mail_address" value="<?php echo $mail_address; ?>" placeholder="例) mail@example.jp"><br>
										<ul class="error_ul">
											<li class="error" id="err_mail_address"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">（確認）</p>
										<input id="mail_address_re" class="w_80" type="email" name="mail_address_re" value="<?php echo $mail_address_re; ?>" placeholder="例) mail@example.jp">
										<p class="text_blue kome">確認のためもう一度入力してください。（コピー不可）</p>
										<ul class="error_ul">
											<li class="error" id="err_mail_address_re"></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<th><span class="any"></span>お届け先を変更する</th>
								<td>
									<input id="otodoke_change" type="checkbox" name="otodoke_change">
									<label class="checkbox" for="otodoke_change">変更する</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="otodokesaki">
				<h2>お届け先情報</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tbody>
							<tr class="name">
								<th><span class="required">必須</span>氏名</th>
								<td>
									<section class="clearfix">
										<div>
											<p>姓</p><input id="otodoke_name_sei" type="text" name="otodoke_name_sei" value="<?php echo $otodoke_name_sei; ?>" placeholder="例）日本">
										</div>
										<div>
											<p>名</p><input id="otodoke_name_mei" type="text" name="otodoke_name_mei" value="<?php echo $otodoke_name_mei; ?>" placeholder="例）太郎">
										</div>
									</section>
									<ul class="error_ul">
										<li class="error" id="err_otodoke_name_sei"></li>
									</ul>
									<ul class="error_ul">
										<li class="error" id="err_otodoke_name_mei"></li>
									</ul>
								</td>
							</tr>
							<tr class="name">
								<th><span class="required">必須</span>フリガナ</th>
								<td>
									<section class="clearfix">
										<div>
											<p>セイ</p><input id="otodoke_name_sei_kana" type="text" name="otodoke_name_sei_kana" value="<?php echo $otodoke_name_sei_kana; ?>" placeholder="例) ニホン">
										</div>
										<div>
											<p>メイ</p><input id="otodoke_name_mei_kana" type="text" name="otodoke_name_mei_kana" value="<?php echo $otodoke_name_mei_kana; ?>" placeholder="例) タロウ">
										</div>
									</section>
									<ul class="error_ul">
										<li class="error" id="err_otodoke_name_sei_kana"></li>
									</ul>
									<ul class="error_ul">
										<li class="error" id="err_otodoke_name_mei_kana"></li>
									</ul>
								</td>
							</tr>
							<tr class="mail">
								<th><span class="required">必須</span>メールアドレス</th>
								<td>
									<div class="">
										<p>メールアドレス</p>
										<input id="otodoke_mail_address" class="w_80" type="email" name="otodoke_mail_address" value="<?php echo $otodoke_mail_address; ?>" placeholder="例) mail@example.jp">
										<ul class="error_ul">
											<li class="error" id="err_otodoke_mail_address"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">（確認）</p>
										<input id="otodoke_mail_address_re" class="w_80" type="email" name="otodoke_mail_address_re" value="<?php echo $otodoke_mail_address_re; ?>" placeholder="例) mail@example.jp"><br>
										<p class="text_blue kome">確認のためもう一度入力してください。（コピー不可）</p>
										<ul class="error_ul">
											<li class="error" id="err_otodoke_mail_address_re"></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr class="address">
								<th><span class="required">必須</span>住所</th>
								<td>
									<div class="">
										<p>郵便番号</p>
										<div class="">
											<input id="otodoke_yubin_nb_1" class="yubin_1" type="text" name="otodoke_yubin_nb_1" value="<?php echo $otodoke_yubin_nb_1; ?>">-<input id="otodoke_yubin_nb_2" class="yubin_2" type="text" name="otodoke_yubin_nb_2" value="<?php echo $otodoke_yubin_nb_2; ?>">
											<button id="otodoke_address_search" class="button zip_btn" type="button">住所検索</button>
										</div>
										<ul class="error_ul">
											<li class="error" id="err_otodoke_yubin_nb_1"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">都道府県</p>
										<span class='select_wrap'>
											<select id="otodoke_todohuken" name="math">
												<option value=""></option>
											</select>
										</span>
										<ul class="error_ul">
											<li class="error" id="err_otodoke_todohuken"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">市区町村／番地</p>
										<input id="otodoke_shiku" class="w_80" type="text" name="otodoke_shiku" value="<?php echo $otodoke_shiku; ?>" placeholder="例）港区芝浦1-13-16 ※英数字は半角">
										<p class="text_blue">住所は番地の最後までご入力ください。</p>
										<ul class="error_ul">
											<li class="error" id="err_otodoke_shiku"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">建物／部屋番号</p>
										<input id="otodoke_tatemono" class="w_80" type="text" name="otodoke_tatemono" value="<?php echo $address_tatemono; ?>" placeholder=" 例）芝浦ビル2階 ※英数字は半角">
										<ul class="error_ul">
											<li class="error" id="err_otodoke_tatemono"></li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<th><span class="required">必須</span>電話番号</th>
								<td>
									<div class="">
										<p class="mt_1"><span class="required">必須</span>TEL</p>
										<input id="otodoke_tel_1" class="w_50" type="tel" name="otodoke_tel_1" value="<?php echo $otodoke_tel_1; ?>">
										<ul class="error_ul">
											<li class="error" id="err_otodoke_tel_1"></li>
										</ul>
									</div>
									<div class="">
										<p class="mt_1">TEL</p>
										<input id="otodoke_tel_2" class="w_50" type="tel" name="otodoke_tel_2" value="<?php echo $otodoke_tel_2; ?>">
										<ul class="error_ul">
											<li class="error" id="err_otodoke_tel_2"></li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="btn_wrap">
				<button class="button btn_gray" id="return_button" type="button" value="">戻る</button>
				<button class="button clear_btn" type="button" value="" >クリア</button>
				<button id="next_button" class="button" type="button" value="">次へ</button>
			</div>
		</form>
	</div>
	<?php include('../views/templates/footer.php'); ?>
</body>

</html>
