<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>資格認定試験出願｜出願時必要書類の確認</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/entryConfirm.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/entryConfirm.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>

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
		<h2>出願時必要書類の確認</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_6ver sp_no">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br class="sp_no">倫理確認</small></span></li>
					<li class="active"><span><small>必要書類の確認</small></span></li>
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<div class="spb_arrows spb_arrows_6ver_sp sp_bl">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li><span><small>登録情報・ポリシー・<br>倫理確認</small></span></li>
					<li class="active"><span><small>必要書類の確認</small></span></li>
				</ul>
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br>(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<p class="h2_text">テキストテキストテキストテキストテキストテキスト</p>
			<div class="kihon_joho">
				<form action="?" method="post" autocomplete="off" id="entryConfirmForm">
					<h3><?php echo $shikenmei; ?></h3>
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
					<table>
						<tr>
							<th><span class="required">必須</span>取得学位</th>
							<td id="shutoku_gakui">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="yotei">卒業予定日<br class="pc_none">
									<input id="yotei_year" type="text" name="" value="">年
									<select id="yotei_month" name="manth">
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
									<select id="yotei_day" name="day">
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
									</select>日</p>
								<ul class="error_ul">
									<li class="error" id="err_yoteibi"></li>
								</ul>
								<p class="gakui">取得学位分野または卒業見込みの学位分野<br>
									<select id="gakui_bunya" name="">
										<option value=""></option>
									</select>
									<textarea id="gakui_sonota" placeholder="その他を選択した場合は必須入力となります"></textarea>
								</p>
								<ul class="error_ul">
									<li class="error" id="err_gakui"></li>
								</ul>
							</td>
						</tr>
						<tr class="hitsuyo">
							<th><span class="required">必須</span>必要書類の提出</th>
							<td>
								<input id="hitsuyo" type="checkbox" name="hitsuyo" value=""><label class="checkbox" for="hitsuyo">下記①～③のいずれか1点を提出してください。</label>
								<ul class="error_ul">
									<li class="error" id="err_hitsuyo"></li>
								</ul>
								<ul>
									<li>①学校教育法が定める4年制もしくは6年制大学の卒業証明書または卒業見込み卒業証明書の原本</li>
									<li>②学位取得を証する証明書(学位授与証明書、修了証明書、transcriptなど)の原本</li>
									<li>③高度専門士の称号を証する証明書(高度専門士の称号取得が明記されている卒業証明書、高度専門士称号取得証明書など)または取得見込みを証する証明書の原本</li>
								</ul>
							</td>
						</tr>
						<tr class="caution">
							<th><span class="required">必須</span>注意事項</th>
							<td>
								<p>※読んだら必ずチェックを入れてください</p>
								<input id="caution_1" type="checkbox" name="caution_1" value=""><label class="checkbox" for="caution_1">証明書は、発行から１年以内のものを提出してください。</label>
								<ul class="error_ul">
									<li class="error" id="err_caution_1"></li>
								</ul>
								<input id="caution_2" type="checkbox" name="caution_2" value=""><label class="checkbox" for="caution_2">証明書のコピーは、出願書類として認められません。<br>
									また、卒業証書や学位記の原本は、出願書類として認められません。</label>
								<ul class="error_ul">
									<li class="error" id="err_caution_2"></li>
								</ul>
								<input id="caution_3" type="checkbox" name="caution_3" value=""><label class="checkbox" for="caution_3">改姓・改名により、登録情報と証明書の氏名が異なる場合は、<br>
									改姓あるいは改名を証明する公的証明書(戸籍抄本、戸籍謄本など)の原本をあわせて提出してください。</label>
								<ul class="error_ul">
									<li class="error" id="err_caution_3"></li>
								</ul>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<section class="btn_wrap">
				<button class="button back" type="button" id="return_button" value="" onclick="location.href='#'"><span>戻る</span></button>
				<button class="button" type="button" id="next_button" value="" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>