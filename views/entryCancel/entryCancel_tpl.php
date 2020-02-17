<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>申請キャンセル</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/entryCancel.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/entryCancel.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h2>申請キャンセル</h2>
		<div class="content_wrap">
			<div class="bg_gray h2_text">
				<p>確認事項</p>
				<ul>
					<li>有効な受験期間が切れる1週間前までに申込の取り消しを行われた場合は、違約金(50％)、事務手数料(1,080円)を差し引いて返金いたします。<br>
						→お支払い済みの方は、下記の本文に返金先情報をご記入いただけるようお願いいたします。</li>
					<li>有効な受験期間の1週間をすぎますと、キャンセルチャージとして受験料の100％を申し受けますので、返金はいたしません。</li>
					<li>本メール送信後、1週間以内に事務局から返信メールをお送りします。メールが届かない場合は、NSCAジャパン事務局までご連絡ください。
					</li>
				</ul>
				<p>※@nsca-japan.or.jp からのメールが届くよう、必ず受信設定をしてください。</p>
			</div>
			<form method="post" name="entryCancelForm">
				<input type="hidden" name="shiken_meisai_id" id="shiken_meisai_id" value="<?php echo $shiken_meisai_id; ?>">
				<table>
					<thead>
						<tr>
							<th></th>
							<th>有効な受験期間が切れている1週間前まで</th>
							<th>有効な受験期間が切れる<br class="br_block">6日前以降</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>返金内容</td>
							<td data-label="有効な受験期間が切れている1週間前まで">違約金50％と事務手数料1,080円を<br class="br_block">引いて返金いたします</td>
							<td data-label="有効な受験期間が切れる6日前以降">返金いたしません</td>
						</tr>
						<tr>
							<td id="shiken_sbt"></td>
							<td data-label="有効な受験期間が切れている1週間前まで" id="henkin"></td>
							<td data-label="有効な受験期間が切れる6日前以降">0円</td>
						</tr>
					</tbody>
				</table>



				<h3>宛先</h3>
				<table>
					<tr>
						<th>件名</th>
						<td>認定試験出願取消</td>
					</tr>
					<tr>
						<th>受付</th>
						<td>特定非営利活動法人 NSCAジャパン 事務局<br>
							f-rezi-test@nls.co.jp</td>
					</tr>
					<tr>
						<th>氏名</th>
						<td id="name"></td>
					</tr>
					<tr>
						<th>メールアドレス</th>
						<td id="address"></td>
					</tr>
				</table>

				<h3>本文</h3>
				<article>
					<textarea id="text"></textarea>
					<section>
						<p>「送信」ボタンを押しますと、事務局へメールが送信されると同時に、ご自身へも控えとしてメールが送信されます。<br>
							<span class="kome">※事務局から受験キャンセルを受け付ける返信があるまで、マイページの表示は変更されません。</span>
						</p>
						<ul class="error_ul">
							<li class="error" id="err_mail"></li>
						</ul>
					</section>
				</article>
				<section class="btn_wrap">
					<button class="button btn_gray" type="button" id="return" value="" onclick="location.href='#'"><span>出願状況確認画面へ</span></button>
					<button class="button" type="button" id="send" value="" onclick="location.href='#'"><span>送信</span></button>
				</section>
			</form>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>