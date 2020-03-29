<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>クレジットカード情報｜</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/credit_joho_nyuryoku.css">
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">
		<link rel="stylesheet" href="../../viewIncludeFiles/plugins/sweetalert2.min.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/plugins/sweetalert2.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/paymentCard.js"></script>
		<script type="text/javascript" src="https://ssl.f-regi.com/tokentest/static/base.js" charset="UTF-8"></script>
		<!-- 本番は-> <script type="text/javascript" src="https://ssl.f-regi.com/token/static/base.js" charset="UTF-8"></script> -->
    </head>
    <body>
	<header id="header">
	</header>
		<div class="wrap mh_c btn_b_wrap">
			<h2 class="mb_10">クレジットカード情報</h2>
			<form method="post" id="paymentCardForm" name="paymentCardForm" action="../../paymentComplete/">
				<input type="hidden" id="pay" name="pay" value="<?php echo $pay; ?>">
				<input type="hidden" id="token" name="token" value="">
				<input type="hidden" id="authCode" name="authCode" value="">
				<input type="hidden" id="seqNo" name="seqNo" value="">
				<input type="hidden" id="shop_id" name="shop_id" value="<?php echo $shop_id; ?>">
				<input type="hidden" id="token_key" name="token_key" value="<?php echo $token_key; ?>">

				<div class="content_wrap">
					<p>テキストテキストテキストテキストテキストテキスト</p>
					<div>
						<table>
							<tr>
								<th><span class="required">必須</span>カード番号
									<input id="usagePaymentInfo" type="checkbox" name="usagePaymentInfo">
									<label class="checkbox" for="usagePaymentInfo">登録決済情報を使用する</label>
								</th>
								<td>
									<div>
										<input id="card_nb" class="w_250" type="text">
										<ul class="error_ul">
											<li class="error" id="err_card_nb"></li>
										</ul>
										<p>例）000000000000000<br>
										テキストテキストテキストテキスト</p>
									</div>
								</td>
							</tr>
							<tr class="name">
								<th><span class="required">必須</span>氏名</th>
								<td>
									<div>
										<input id="neme" class="w_250" type="text">
										<ul class="error_ul">
											<li class="error" id="err_name"></li>
										</ul>
										<p>例）テキストテキスト<br>
											テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
									</div>
								</td>
							</tr>
							<tr class="card_date">
								<th><span class="required">必須</span>カード有効期限</th>
								<td>
									<div>
										<input id="card_1" class="w_75" type="text"><span>／</span><input id="card_2" class="w_75" type="text">
										<ul class="error_ul">
											<li class="error" id="err_card_date"></li>
										</ul>
										<p>例）00／00</p>
									</div>
								</td>
							</tr>
							<tr class="code">
								<th><span class="required">必須</span>セキュリティーコード</th>
								<td>
									<input id="code" type="text">
									<ul class="error_ul">
										<li class="error" id="err_code"></li>
									</ul>
								</td>
							</tr>
							<tr class="registPaymentInfo">
								<th>決済情報登録</th>
								<td>
									<input id="registPaymentInfo" type="checkbox" name="registPaymentInfo">
									<label class="checkbox" for="registPaymentInfo">登録決済情報を登録する</label>
									<ul class="error_ul">
										<li class="error" id="err_code"></li>
									</ul>
									<p>例）テキストテキスト<br>
											テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>
			<section class="btn_wrap btn_b_2">
				<button class="button back" type="button" value="" id="back"><span>決済方法選択画面へ</span></button>
				<button class="button" type="button" value="" id="next"><span>次へ</span></button>
			</section>
		</div>
	<footer id="footer">
	</footer>
</body>
</html>
