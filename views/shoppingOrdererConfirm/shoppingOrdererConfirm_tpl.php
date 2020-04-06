<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>物販注文情報確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/form.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/spb_arrows.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/shop.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
</head>

<body class="shoppingOrdererConfirm">
	<?php

		//条件分岐して読み込んでください
		//ログインしていないときは以下
		include('../views/templates/header_logo.php');
		echo '<div class="wrap not_login">';

		//ログイン中は以下
		//include('../views/templates/header_logo.php');
		//echo '<div class="wrap">';
	?>

		<h1>ご注文者情報</h1>
		<div class="spb_arrows">
			<ul class="nav nav-tabs step-anchor step_3">
				<li><span><small>物販注文者情報</small></span></li>
				<li class="active"><span><small>物販注文情報確認</small></span></li>
				<li><span><small>決済方法選択</small></span></li>
			</ul>
		</div>
		<p class="top_text">下記の内容で処理を進めてよろしければ「決済方法選択へ」ボタンを押してください。</p>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="name_mei" id="name_mei" value="<?php echo $name_mei; ?>">
			<input type="hidden" name="name_sei" id="name_sei" value="<?php echo $name_sei; ?>">
			<input type="hidden" name="name_sei_kana" id="name_sei_kana" value="<?php echo $name_sei_kana; ?>">
			<input type="hidden" name="name_mei_kana" id="name_mei_kana" value="<?php echo $name_mei_kana; ?>">
			<input type="hidden" name="yubin_nb_1" id="yubin_nb_1" value="<?php echo $yubin_nb_1; ?>">
			<input type="hidden" name="yubin_nb_2" id="yubin_nb_2" value="<?php echo $yubin_nb_2; ?>">
			<input type="hidden" name="kenmei" id="kenmei" value="<?php echo $kenmei; ?>">
			<input type="hidden" name="address_shiku" id="address_shiku" value="<?php echo $address_shiku; ?>">
			<input type="hidden" name="address_tatemono" id="address_tatemono" value="<?php echo $address_tatemono; ?>">
			<input type="hidden" name="address_yomi_shiku" id="address_yomi_shiku" value="<?php echo $address_yomi_shiku; ?>">
			<input type="hidden" name="address_yomi_tatemono" id="address_yomi_tatemono" value="<?php echo $address_yomi_tatemono; ?>">
			<input type="hidden" name="tel" id="tel" value="<?php echo $tel; ?>">
			<input type="hidden" name="keitai_tel" id="keitai_tel" value="<?php echo $keitai_tel; ?>">
			<input type="hidden" name="mail_address" id="mail_address" value="<?php echo $mail_address; ?>">
			<input type="hidden" name="otodoke_change" id="otodoke_change" value="<?php echo $otodoke_change; ?>">

			<input type="hidden" name="otodoke_name_mei" id="otodoke_name_mei" value="<?php echo $otodoke_name_mei; ?>">
			<input type="hidden" name="otodoke_name_sei" id="otodoke_name_sei" value="<?php echo $otodoke_name_sei; ?>">
			<input type="hidden" name="otodoke_name_sei_kana" id="otodoke_name_sei_kana" value="<?php echo $otodoke_name_sei_kana; ?>">
			<input type="hidden" name="otodoke_name_mei_kana" id="otodoke_name_mei_kana" value="<?php echo $otodoke_name_mei_kana; ?>">
			<input type="hidden" name="otodoke_mail_address" id="otodoke_mail_address" value="<?php echo $otodoke_mail_address; ?>">
			<input type="hidden" name="otodoke_yubin_nb_1" id="otodoke_yubin_nb_1" value="<?php echo $otodoke_yubin_nb_1; ?>">
			<input type="hidden" name="otodoke_yubin_nb_2" id="otodoke_yubin_nb_2" value="<?php echo $otodoke_yubin_nb_2; ?>">
			<input type="hidden" name="otodoke_kenmei" id="otodoke_kenmei" value="<?php echo $otodoke_kenmei; ?>">
			<input type="hidden" name="otodoke_shiku" id="otodoke_shiku" value="<?php echo $otodoke_shiku; ?>">
			<input type="hidden" name="otodoke_tel_1" id="otodoke_tel_1" value="<?php echo $otodoke_tel_1; ?>">
			<input type="hidden" name="otodoke_tel_2" id="otodoke_tel_2" value="<?php echo $otodoke_tel_2; ?>">

			<div>
				<h2>お買い物かご</h2>
				<div class="shop_table_wrap">
					<table class="shop_table">
						<thead>
							<tr>
								<th>商品</th>
								<!--th>商品番号</th>
								<th>商品名</th-->
								<th>税込単価(円)</th>
								<th>数量</th>
								<th>小計(円)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="syohin_wrap">
										<div class="syohin_img_wrap">
											<img src="https://placehold.jp/600x600.png" alt="">
										</div>
										<div class="syohin_text_wrap">
											<div>
												<div class="midashi">商品番号</div>
												<span>体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集</span>
											</div>
											<div>
												<div class="midashi">商品名</div>
												<span>体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集体力トレーニング検定2級問題集</span>
										</div>
									</div>
								</td>
								<td class="tanka_td">
									<div>
										<div class="midashi sp_only">
											税込単価(円)
										</div>
										<div>
											0,000
										</div>
									</div>
								</td>
								<td class="suryo_td">
									<div>
										<div class="midashi sp_only">
											数量
										</div>
										<div>
											100
										</div>
									</div>
								</td>
								<td class="syokei_td">
									<div>
										<div class="midashi sp_only">
											小計(円)
										</div>
										<div>
											100,980
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="syohin_wrap">
										<div class="syohin_img_wrap">
											<img src="https://placehold.jp/300x400.png" alt="">
										</div>
										<div class="syohin_text_wrap">
											<div>
												<div class="midashi">商品番号</div>
												<span>体力トレーニング検定2級問題集体力トレーニング検定2級問題集</span>
											</div>
											<div>
												<div class="midashi">商品名</div>
												<span>体力トレーニング検定2級問題集体力トレーニング検定2級問題集</span>
											</div>
										</div>
									</div>
								</td>
								<td class="tanka_td">
									<div>
										<div class="midashi sp_only">
											税込単価(円)
										</div>
										<div>
											0,000
										</div>
									</div>
								</td>
								<td class="suryo_td">
									<div>
										<div class="midashi sp_only">
											数量
										</div>
										<div>
											100
										</div>
									</div>
								</td>
								<td class="syokei_td">
									<div>
										<div class="midashi sp_only">
											小計(円)
										</div>
										<div>
											100,980
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="note_kingaku">
						<table>
							<tbody>
								<tr>
									<th>発送手数料</th>
									<td>880円</td>
								</tr>
								<tr>
									<th>商品合計(税込)</th>
									<td>2,860円</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div>
				<h2>ご注文者情報</h2>
				<div class="form_wrap">
					<table class="form_table">
						<tbody>
							<tr class="name">
								<th>氏名</th>
								<td>
									<?php echo $name_sei; ?> <?php echo $name_mei; ?>
								</td>
							</tr>
							<tr class="name">
								<th>フリガナ</th>
								<td>
									<?php echo $name_sei_kana; ?> <?php echo $name_mei_kana; ?>
								</td>
							</tr>
							<tr class="address">
								<th>住所</th>
								<td>
									<?php echo $yubin_nb_1; ?>-<?php echo $yubin_nb_2; ?><br>
									<?php echo $kenmei; ?><?php echo $address_shiku; ?><br>
									<?php echo $address_tatemono; ?>
								</td>
							</tr>
							<tr>
								<th>電話番号</th>
								<td>
									<p>TEL：<?php echo $tel; ?></p>
									<p>携帯：<?php echo $keitai_tel; ?></p>
								</td>
							</tr>
							<tr class="mail">
								<th>メールアドレス</th>
								<td>
									<?php echo $mail_address; ?>
								</td>
							</tr>
							<tr>
								<th>お届け先を変更する</th>
								<td>
									<?php echo $otodoke_change; ?>
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
								<th>氏名</th>
								<td>
									<?php echo $otodoke_name_sei; ?> <?php echo $otodoke_name_mei; ?>
								</td>
							</tr>
							<tr class="name">
								<th>フリガナ</th>
								<td>
									<?php echo $otodoke_name_sei_kana; ?> <?php echo $otodoke_name_mei_kana; ?>
								</td>
							</tr>
							<tr class="mail">
								<th>メールアドレス</th>
								<td>
									<?php echo $otodoke_mail_address; ?>
								</td>
							</tr>
							<tr class="address">
								<th>住所</th>
								<td>
									<?php echo $otodoke_yubin_nb_1; ?>-<?php echo $otodoke_yubin_nb_2; ?><br>
									<?php echo $otodoke_kenmei; ?><?php echo $otodoke_shiku; ?><br>
									<?php echo $otodoke_tatemono; ?>
								</td>
							</tr>
							<tr>
								<th>電話番号</th>
								<td>
									<?php echo $otodoke_tel_1; ?><br>
									<?php echo $otodoke_tel_2; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="btn_wrap">
				<button class="button btn_gray" id="return_button" type="button" value="">戻って修正する</button>
				<button id="next_button" class="button" type="button" value="">決済方法選択へ</button>
			</div>
		</form>
	</div>
	<?php include('../views/templates/footer.php'); ?>
</body>

</html>
