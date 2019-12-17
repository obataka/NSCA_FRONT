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
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
		<script>
			$(function(){
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
					<h3>CSCS認定試験</h3>
					<form>
						<table>
							<tr>
								<th><span class="required">必須</span>取得学位</th>
								<td>
									<input id="gakui_1" type="radio" name="gakui" value=""><label for="gakui_1">博士</label>
									<input id="gakui_2" type="radio" name="gakui" value=""><label for="gakui_2">修士</label>
									<input id="gakui_3" type="radio" name="gakui" value=""><label for="gakui_3">学士</label><br class="sp_br">
									<input id="gakui_4" type="radio" name="gakui" value=""><label for="gakui_4">高度専門士</label>
									<input id="gakui_5" type="radio" name="gakui" value=""><label for="gakui_5">卒業見込み</label>
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
									<p class="yotei">卒業予定日<br class="pc_none"><select id="yotei_year" name="year"></select>年<select id="yotei_month" name="manth"></select>月<select id="yotei_day" name="day"></select>日</p>
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
									<p class="gakui">取得学位分野または卒業見込みの学位分野<br>
										<select id="gakui_bunya" name=""></select><textarea placeholder="その他を選択した場合は必須入力となります"></textarea>
									</p>
								</td>
							</tr>
							<tr class="hitsuyo">
								<th><span class="required">必須</span>必要書類の提出</th>
								<td>
									<input id="hitsuyo" type="checkbox" name="hitsuyo" value=""><label class="checkbox" for="hitsuyo">下記①～③のいずれか1点を提出してください。</label>
									<ul class="error_ul">
										<li class="error"></li>
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
									<input id="caution_1" type="checkbox" name="caution" value=""><label class="checkbox" for="caution_1">証明書は、発行から１年以内のものを提出してください。</label>
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
									<input id="caution_2" type="checkbox" name="caution" value=""><label class="checkbox" for="caution_2">証明書のコピーは、出願書類として認められません。<br>
										また、卒業証書や学位記の原本は、出願書類として認められません。</label>
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
									<input id="caution_3" type="checkbox" name="caution" value=""><label class="checkbox" for="caution_3">改姓・改名により、登録情報と証明書の氏名が異なる場合は、<br>
										改姓あるいは改名を証明する公的証明書(戸籍抄本、戸籍謄本など)の原本をあわせて提出してください。</label>
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<section class="btn_wrap">
					<button class="button back" type="submit" value="" onclick="location.href='#'"><span>戻る</span></button>
					<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
				</section>
			</div>
		</div>
	<footer id="footer">
	</footer>
</body>
</html>
