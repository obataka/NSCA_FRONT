<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>資格認定試験出願｜出願最終確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/entryFinalConfirm.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/entryFinalConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
</head>

<body>
	<header id="header">
	</header>
	<div class="wrap">
		<h1>出願最終確認</h1>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_6ver sp_no">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br class="sp_no">倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
					<li class="active"><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<div class="spb_arrows spb_arrows_6ver_sp sp_bl">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br>倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
				</ul>
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br>(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<p class="h2_text">下記、登録情報をすべて確認してください。<br>
				修正が必要な場合は、戻るボタンから行ってください。</p>
			<form action="?" method="post" autocomplete="off" id="entryFinalConfirmForm">
				<input type="hidden" name="shiken_sbt" id="shiken_sbt" value="<?php echo $shiken_sbt; ?>">
				<input type="hidden" name="cscs_shikaku" id="cscs_shikaku" value="<?php echo $cscs_shikaku; ?>">
				<input type="hidden" name="jukenryo" id="jukenryo" value="<?php echo $jukenryo; ?>">
				<input type="hidden" name="wk_kaiin_no" id="wk_kaiin_no" value="<?php echo $wk_kaiin_no; ?>">
				<input type="hidden" name="wk_shimei" id="wk_shimei" value="<?php echo $wk_shimei; ?>">
				<input type="hidden" name="wk_furigana" id="wk_furigana" value="<?php echo $wk_furigana; ?>">
				<input type="hidden" name="wk_firstlast" id="wk_firstlast" value="<?php echo $wk_firstlast; ?>">
				<input type="hidden" name="wk_tel" id="wk_tel" value="<?php echo $wk_tel; ?>">
				<input type="hidden" name="wk_address" id="wk_address" value="<?php echo $wk_address; ?>">
				<input type="hidden" name="wk_pc_address" id="wk_pc_address" value="<?php echo $wk_pc_address; ?>">
				<input type="hidden" name="wk_shikaku_yuko" id="wk_shikaku_yuko" value="<?php echo $wk_shikaku_yuko; ?>">
				<input type="hidden" name="wk_yuko_kigen" id="wk_yuko_kigen" value="<?php echo $wk_yuko_kigen; ?>">
				<input type="hidden" name="sel_job" id="sel_job" value="<?php echo $job; ?>">
				<input type="hidden" name="wk_sel_job" id="wk_sel_job" value="<?php echo $wk_sel_job; ?>">
				<input type="hidden" name="wk_kakunin" id="wk_kakunin" value="<?php echo $wk_kakunin; ?>">
				<input type="hidden" name="wk_shiken_policy_doi" id="wk_shiken_policy_doi" value="<?php echo $wk_shiken_policy_doi; ?>">
				<input type="hidden" name="wk_cancel_policy_doi" id="wk_cancel_policy_doi" value="<?php echo $wk_cancel_policy_doi; ?>">
				<input type="hidden" name="wk_rinri_doi" id="wk_rinri_doi" value="<?php echo $wk_rinri_doi; ?>">
				<input type="hidden" name="wk_gakui" id="wk_gakui" value="<?php echo $wk_gakui; ?>">
				<input type="hidden" name="wk_txt_gakui" id="wk_txt_gakui" value="<?php echo $wk_txt_gakui; ?>">
				<input type="hidden" name="wk_bunya" id="wk_bunya" value="<?php echo $wk_bunya; ?>">
				<input type="hidden" name="wk_txt_bunya" id="wk_txt_bunya" value="<?php echo $wk_txt_bunya; ?>">
				<input type="hidden" name="wk_bunya_sonota" id="wk_bunya_sonota" value="<?php echo $wk_bunya_sonota; ?>">
				<input type="hidden" name="wk_hitsuyo" id="wk_hitsuyo" value="<?php echo $wk_hitsuyo; ?>">
				<input type="hidden" name="wk_caution_1" id="wk_caution_1" value="<?php echo $wk_caution_1; ?>">
				<input type="hidden" name="wk_caution_2" id="wk_caution_2" value="<?php echo $wk_caution_2; ?>">
				<input type="hidden" name="wk_caution_3" id="wk_caution_3" value="<?php echo $wk_caution_3; ?>">
				<div class="bg_gray shiken">
					<p><span>試験名</span><?php echo $shikenmei; ?></p>
					<p><span>受験料</span><?php echo $jukenryo; ?>円</p>
				</div>
				<article>
					<h2>会員情報</h2>
					<table>
						<tr>
							<th>会員番号</th>
							<td class="clearfix"><?php echo $wk_kaiin_no; ?></td>
						</tr>
						<tr>
							<th>氏名</th>
							<td class="clearfix"><?php echo $wk_shimei; ?></td>
						</tr>
						<tr>
							<th>フリガナ</th>
							<td><?php echo $wk_furigana; ?></td>
						</tr>
						<tr>
							<th>ローマ字表記</th>
							<td><?php echo $wk_firstlast; ?></td>
						</tr>
						<tr>
							<th>電話番号</th>
							<td><?php echo $wk_tel; ?></td>
						</tr>
						<tr>
							<th>住所</th>
							<td><?php echo $wk_address; ?></td>
						</tr>
						<tr>
							<th>PCメールアドレス</th>
							<td><?php echo $wk_pc_address; ?></td>
						</tr>
					</table>
				</article>
				<article>
					<h2>受験資格・職種・CPR/AED資格</h2>
					<table>
						<tr>
							<th>試験名</th>
							<td><?php echo $shikenmei; ?></td>
						</tr>
						<tr>
							<th>受験料</th>
							<td><?php echo $jukenryo; ?></td>
						</tr>
						<tr>
							<th>職種</th>
							<td><?php echo str_replace(",", "<br>", $job); ?></td>
						</tr>
						<tr>
							<th>CPR/AED資格</th>
							<td>
								<div class="bg_gray">
									<input id="shikaku_1" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_1">有効なCPR/AED資格を保持せず受験した場合、<br class="sp_none">
										その試験結果の有効期限は受験日から1年間であることを確認しました。</label>
									<input id="shikaku_2" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_2">有効なCPR/AED資格の認定証のコピーを提出するまでには、<br class="sp_none">
										試験に合格しても資格認定されないことを確認しました。</label>
								</div>
							</td>
						</tr>
					</table>
				</article>
				<article>
					<h2>取得学位・必要書類</h2>
					<table>
						<tr>
							<th>取得学位</th>
							<td><?php echo $wk_txt_gakui; ?></td>
						</tr>
						<tr>
							<th>学位分野</th>
							<td><?php echo $wk_txt_bunya; ?></td>
						</tr>
						<tr>
							<th>必要書類</th>
							<td>
								<p class="hituyo_text">下記①～③のいずれかの1点の提出に同意した</p>
								<ul>
									<li>①学校教育法が定める4年制もしくは6年制大学の卒業証明書または卒業見込み卒業証明書の原本</li>
									<li>②学位取得を証する証明書(学位授与証明書、修了証明書、transcriptなど)の原本</li>
									<li>③高度専門士の称号を証する証明書(高度専門士の称号取得が明記されている卒業証明書、高度専門士称号取得証明書など)または取得見込みを証する証明書の原本</li>
								</ul>
							</td>
						</tr>
					</table>
				</article>
				<article>
					<h2>取得学位・必要書類</h2>
					<table>
						<tr>
							<th>出願書類への注意事項</th>
							<td>同意した</td>
						</tr>
						<tr>
							<th>試験ポリシー</th>
							<td>同意した</td>
						</tr>
						<tr>
							<th>試験キャンセルポリシー</th>
							<td>同意した</td>
						</tr>
						<tr>
							<th>倫理規定</th>
							<td>同意した</td>
						</tr>
					</table>
				</article>
				<article class="syorui_kakunin">
					<div class="bg_gray">
						<p class="title"><?php echo $wk_shimei; ?>様の出願時書類確認</p>
						<p>提出書類</p>
						<div class="bg_white">
							<p>学歴証明の書類</p>
						</div>
						<input id="syorui_1" type="checkbox" name="syorui" value=""><label class="checkbox" for="syorui_1">必要書類は、融資王にてご提出ください。<br class="pc_none">（※必ず、会員番号が分かる書類を同封してください）</label>
						<ul class="error_ul">
							<li class="error" id="err_syorui_1"></li>
						</ul>
						<input id="syorui_2" type="checkbox" name="syorui" value=""><label class="checkbox" for="syorui_2">郵送による必要書類の提出、受験料の入会が確認できるまでは、出願手続きは完了しません。</label>
						<ul class="error_ul">
							<li class="error" id="err_syorui_2"></li>
						</ul>
					</div>
				</article>
			</form>
			<article class="kojin_joho">
				<p class="title">個人情報の取り扱いについて</p>
				<div>
					<p>ご登録いただいた個人情報は、当協会の認定試験に関する手続き、ファイル作成に使用いたします。<br>
						個人情報を当該業務の委託に必要な範囲で委託に提供する場合と関係法令により認められた場合等を除き、<br class="sp_none">
						受験者の事前の承知なしに第三者に提供することはありません。</p>
				</div>
			</article>

			<section class="btn_wrap">
				<button class="button back" type="button" value="" id="return_button" onclick="location.href='#'"><span>戻る</span></button>
				<button class="button" type="button" value="" id="next_button" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>

</html>