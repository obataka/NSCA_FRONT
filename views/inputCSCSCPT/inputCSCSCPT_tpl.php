<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name='format-detection' content='telephone=no' />
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<title>資格認定試験出願フォーム</title>
	<!-- favicon -->
	<link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
	<link rel="stylesheet" href="../../viewIncludeFiles/css/shikaku_shiken_form.css">
	<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

	<script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
	<script type="text/javascript" src="../../viewIncludeFiles/js/inputCSCSCPT.js"></script>
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
		<h2>資格認定試験出願</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_6ver sp_no">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li class="active"><span><small>登録情報・ポリシー・<br class="sp_no">倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<div class="spb_arrows spb_arrows_6ver_sp sp_bl">
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>試験選択</small></span></li>
					<li class="active"><span><small>登録情報・ポリシー・<br>倫理確認</small></span></li>
					<li><span><small>必要書類の確認</small></span></li>
				</ul>
				<ul class="nav nav-tabs step-anchor">
					<li><span><small>出願最終確認</small></span></li>
					<li><span><small>決済方法選択</small></span></li>
					<li><span><small>支払<br>(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<p class="h2_text">テキストテキストテキストテキストテキストテキスト</p>
			<form action="?" method="post" autocomplete="off" id="inputCSCSCPTForm">
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
				<input type="hidden" name="wk_kakunin" id="wk_kakunin" value="<?php echo $wk_kakunin; ?>">
				<input type="hidden" name="wk_shiken_policy_doi" id="wk_shiken_policy_doi" value="<?php echo $wk_shiken_policy_doi; ?>">
				<input type="hidden" name="wk_cancel_policy_doi" id="wk_cancel_policy_doi" value="<?php echo $wk_cancel_policy_doi; ?>">
				<input type="hidden" name="wk_rinri_doi" id="wk_rinri_doi" value="<?php echo $wk_rinri_doi; ?>">
				<input type="hidden" name="sel_job" id="sel_job" value="<?php echo $job; ?>">
				<input type="hidden" name="wk_sel_job" id="wk_sel_job" value="<?php echo $wk_sel_job; ?>">

				<div class="bg_gray shiken">
					<p><span>試験名</span><?php echo $shikenmei; ?></p>
					<p><span>受験料</span><?php echo $jukenryo; ?>円</p>
				</div>
				<div class="kihon_joho">
					<h3>資格認定試験出願フォーム</h3>
					<p class="text">表示されている情報が最新でない場合は先に<a class="td_under" id="changeMember" href="#">登録情報</a>より変更をお願いします。<br>
						マイページで登録情報を修正後に、再度お申し込みをお願いいたします。</p>
					<table>
						<tr>
							<th><span class="required">必須</span>会員番号</th>
							<td id="kaiin_no"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>氏名</th>
							<td id="shimei"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>フリガナ</th>
							<td id="furigana"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>ローマ字表記</th>
							<td id="firstlast"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>電話番号</th>
							<td id="tel"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>住所</th>
							<td id="address"></td>
						</tr>
						<tr>
							<th><span class="required">必須</span>PCメールアドレス</th>
							<td id="pc_address"></td>
						</tr>
						<tr class="job">
							<th><span class="required">必須</span>職種<p class="sub sp_no">※複数選択可<br>※最大3つまで</p>
							</th>
							<td>
								<p>※複数選択可<br>※最大3つまで</p>
								<div id="job">
								</div>
								<ul class="error_ul">
									<li class="error" id="err_job"></li>
								</ul>
							</td>
						</tr>
						<tr class="shikaku">
							<th><span class="required">必須</span>CPR/AED資格</th>
							<td>
								<input id="shikaku_1" type="radio" name="shikaku" value=""><label for="shikaku_1">有効な資格を所持している</label>
								<ul class="error_ul">
									<li class="error" id="err_shikaku_1"></li>
								</ul>
								<div class="bg_gray date" id="shikaku_date">
									<p>認定日(発行日)</p>
									<input id="shikaku_yuko" type="text" name="" value="">年
									<select id="shikaku_yuko_month" name="manth">
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
									<select id="shikaku_yuko_day" name="day">
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
									</select>日
									<ul class="error_ul">
										<li class="error" id="err_shikaku_yuko"></li>
									</ul>
									<p class="mt_1">有効期限</p>
									<input id="yuko_kigen" type="text" name="" value="">年
									<select id="yuko_kigen_month" name="manth">
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
									<select id="yuko_kigen_day" name="day">
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
									</select>日
									<ul class="error_ul">
										<li class="error" id="err_yuko_kigen"></li>
									</ul>
									<p class="mt_1">有効期限が表示された方は、CPR/AED認定証のコピーは提出不要です。<br>
										※有効期限には過去日を入力できません。</p>
								</div>
								<input id="shikaku_2" type="radio" name="shikaku" value=""><label for="shikaku_2">有効な資格を所持していない</label>
								<ul class="error_ul">
									<li class="error" id="err_shikaku_2"></li>
								</ul>
								<div class="text">
									<p>有効なCSS/AED資格を保持せず認定試験を受験した場合は、受験日から1年以内に有効な<br>
										CPR/AEDの認定証のコピーを提出してください。<br>
										合格点に達している場合でも、認定証のコピーをご提示いただくまでは、資格認定いたしません。<br>
										受験日から1年を過ぎると、資格結果は無効となります。<br>
										(NSCAジャパン資格認定試験ハンドブック)
									</p>
								</div>
								<div id="shikaku_kakunin">
								</div>
							</td>
						</tr>
					</table>
			</form>
		</div>
		<div class="policy">
			<p class="text">NSCAの資格認定試験に出願するにあたり、下記の内容に必ず同意してください。</p>
			<p class="title"><span class="required">必須</span>試験ポリシー</p>
			<div class="bg_gray">
				<p><span>試験ポリシー</span><br>
					米国NSCA改訂：2015年4月<br>
					NSCAジャパン施行：2016年4月<br><br>
					NSCA資格認定試験においては、運営方法（キャンセルポリシーを含む）、試験結果報告や資格認定試験と更新についての規定があります。<br>
					受験者は、NSCA資格認定試験に出願するにあたり、『NSCA資格認定試験ハンドブック』に記載されている内容を理解し、以下の規定に同意する必要があります。<br><br>
					1．出願するにあたり、登録情報はすべて真実でなければならない。虚偽の情報が判明した場合、NSCAジャパン認定試験・CEU委員会の権限により、資格認定の取り消しが行われる。<br><br>
					2．受験の際のいかなる反則行為、以下（答案の複写、他者に自分の答案の複写を許可する、試験会場での虚偽の情報提示、他の受験者への成りすまし、学歴や資格の詐称、NSCA資格認定試験の前、試験中、試験後に、試験内容に関する情報を第三者に提供したり、取得したりすることなど）に携わった場合、ただちに試験結果ならびに資格認定の取り消しが行われる。<br><br>
					3．試験問題、資格認定名と略名、ロゴは、米国著作権法の下で保護され、故意に違反した場合は連邦犯罪に問われる。NSCA資格認定試験問題、認定証、NSCA資格認定ロゴ、その略名、その他のNSCA資格認定書類や資料の無許可使用、配布、または入手手段を提供する行為を行った場合、ただちに資格認定が取り消される。<br><br>
					4．資格取得後、資格認定を維持するために継続教育活動を行うことが必要である。<br><br>
					5．NSCAジャパンが発行する『NSCA資格認定試験ハンドブック』は、本部である米国NSCAが定めた規定に基づき作成されたものである。倫理規定、資格認定試験の出願条件、出願手続き、受験有効期間、返金（キャンセルポリシー）、再受験、試験の予約・再予約の方法、テストセンターのルール、資格認定の更新の内容を含む、資格認定の規定や手続き、必要事項が記載されている。NSCA資格認定委員会は、内容の確認と、必要に応じて更新を定期的に行う。<br><br>
					6．受験者は今後、NSCAジャパンが発行する最新のハンドブックに記載された認定ポリシー、手続き、そして条件に対する、いかなる全ての将来的な変更についても同意し、順守しなければならない。
				</p>
			</div>
			<p class="doi">
				<input id="shiken_policy_doi" type="checkbox" name="shiken_policy_doi" value="">
				<label class="checkbox" for="shiken_policy_doi">上記の試験ポリシーに同意します</label>
				<ul class="error_ul">
					<li class="error" id="err_shiken_policy_doi"></li>
				</ul>
			</p>
			<p class="title"><span class="required">必須</span>試験キャンセルポリシー</p>
			<div class="bg_gray cancel">
				<p><span>試験キャンセルポリシー</span><br><br>
					有効な受験期間が切れる1週間までに試験キャンセルを行われた場合は、違約金（受験料の50%）と事務手数料（1,080円）を差し引いて返金いたします。<br>
					有効な受験期間の1週間前を過ぎますと、キャンセルチャージとして受験料の100%を申し受けますので、返金はいたしません。<br>
				</p>
			</div>
			<p class="doi">
				<input id="cancel_policy_doi" type="checkbox" name="cancel_policy_doi" value="">
				<label class="checkbox" for="cancel_policy_doi">上記の試験キャンセルポリシーに同意します</label>
				<ul class="error_ul">
					<li class="error" id="err_cancel_policy_doi"></li>
				</ul>
			</p>
			<p class="title"><span class="required">必須</span>倫理規定・懲戒方針</p>
			<div class="bg_gray">
				<p><span>NSCAジャパンの規定と方針および手続き</span><br>
					米国NSCA制定:：2017年10月<br>
					NSCAジャパン版施行：2018年10月<br><br>
					<span>NSCAジャパンの規定と方針および手続き</span><br>
					専門職の倫理規定<br>
					懲戒手続き<br><br>
					NSCAジャパンは専門職者の非営利団体で、日本におけるストレングス＆コンディショニング専門職の発展に力を尽くしている。<br>
					この目標を推進するために、NSCAジャパンに関わるすべての専門職は、自らの言動に責任をもち、常にプロフェッショナルとしての高潔さと職業意識をもって行動しなければならない。以下の方針の目的は、NSCAジャパンの専門職に求められる行動の原則と基準を定めることであり、NSCAジャパンの名声、評判、高潔さが傷つくことのないように守ること、さらに、職員や理事会がそれらの原則や基準に対する違反の可能性を特定し解決する道筋を定めることである。<br><br>
					NSCAジャパンには、その専門職に対する行動基準を定める固有の権限と責務がある。それは、懲戒の根拠は何かを明確にするためであり、NSCAジャパンの「専門職の倫理規定」を順守できなかった専門職に懲戒処分を科すためである。<br><br>
					<span>適用範囲</span><br>
					1. ここに定義される専門職の倫理規定は、NSCAジャパンのすべての専門職に適用される。<br>
					2. 懲戒手続きは専門職の倫理規定の行動規範の潜在的な違反の解決に用いる。<br><br>
					<span>監督</span><br>
					理事会　NSCAジャパンの理事会は、「専門職の倫理規定」および「懲戒手続き」（これらを合わせて「NSCAジャパンの基準と手続き」という）の監督に責任を負うものとする。<br>
					倫理委員会　倫理委員会は理事会により任命され、理事会により構成される。<br><br>
					倫理委員会の任務には以下が含まれる。<br>
					1. 「NSCAジャパンの基準と手続き」を定期的に見直し、更新の採用と施行を理事会に勧告する。<br>
					2. 「専門職の倫理規定」の違反の疑いを調査し、その解決に関する勧告を行う。<br>
					3. 聴聞委員会の委員として出席が可能な、NSCAジャパンから独立した候補者を予め人選しておく。<br><br>
					聴聞委員会　聴聞委員会は事務局長によって任命され、「専門職の倫理規定」に関わる問題に関して最終的かつ拘束力のある処分を決定する権限を付与される。聴聞委員会は理事会および顧問弁護士で構成される。<br><br>
					事務局長　事務局長またはその指名代理人は、告発を受理し、処理し、また理事会と倫理委員会および／または聴聞委員会による 「NSCAジャパンの基準と手続き」の実行を補佐する。<br><br><br>
					<span>NSCAジャパンの基準と手続きの監督または運営における利益相反</span><br>
					「NSCAジャパンの基準と手続き」のいかなる部分に関しても、運営を指名された個人が（事務局長および理事会、倫理委員会、聴聞委員会の成員を含む）、事案の当事者や争点に関して利害が対立する場合、または「専門職の倫理規定」の違反の疑いで告発されている場合は、かかる当事者の任務は代理人に委任され、調査、制裁、投票を含め、当該事案へのいかなる関与も認められない。倫理委員会は、利益が相反する個人が関与することなく、紛争、解任、委任などに関する決定を行うものとする。<br><br>
					<span>定義</span><br>
					「専門職の倫理規定」「懲戒手続き」で用いられる用語には、常に以下の定義が適用される。<br><br>
					志願者: NSCAジャパン資格認定試験の出願手続き中のすべての人で、すでに出願手続きを完了した者も含む。<br>
					資格認定者: NSCAジャパンの現在有効な認定資格を有するすべての人。<br>
					告発者: NSCAジャパンの専門職を告発する個人。<br>
					告発状: 専門職の行動が、もしそれが真実であれば、「専門職の倫理規定」の違反に相当すると主張する人により提出された書面による陳述。<br>
					会員: NSCAジャパンの現役会員であるすべての人。<br>
					通告書： 告発に応えた倫理委員会または聴聞委員会からの正式な、書面による日付の記載された陳述。<br>
					NSCAジャパン： National Strength and Conditioning Association Japan（特定非営利活動法人NSCAジャパン）<br>
					NSCAジャパンの基準と手続き： 「専門職の倫理規定」および「懲戒手続き」のすべてに言及する場合に使われる用語。<br>
					専門職： NSCAジャパンのすべての会員、志願者または資格認定者。<br>
					被告発者： 告発の対象となった個人。<br><br><br>
					<span>NSCAジャパン専門職の倫理規定</span><br>
					NSCAジャパンはその専門職が順守すべき倫理的行動の原則を忠実に履行する。<br><br>
					「専門職の倫理規定」は、筋力トレーニング、コンディショニングおよびパーソナルトレーニングの専門職の高い基準とプロ意識を確立し維持することを意図している。それは一般市民を擁護し、専門的職業を保護し、NSCAジャパンの基準と原則を維持するためである。 また、我々の組織の使命を支えることにより、その有効性を高めることも意図している。 専門職はこれらの高潔かつ公正であるための基準を順守し、倫理的な行動を奨励し、非倫理的な行動はこれを通報しなければならない。<br><br>
					<span>原則</span><br>
					以下は総則として書かれた原則であり、筋力トレーニング、コンディショニングおよびパーソナルトレーニングの専門職が遭遇するあらゆる状況に漏れなく対応しているわけではない。所定の原則の解釈と適用は、「専門職の倫理規定」と関連づけて、事態の状況に応じて決定される。<br><br>
					1. 専門職は、その専門的職業の実践と関連して、すべての人の権利と福祉と尊厳を尊重しなければならない。 そのために専門職は、<br>
					1.1. 人種、肌の色、宗教、性別、性的指向、性自認または性表現、出身国、障害、婚姻状況、あるいは市民権に基づき差別を行ってはならない。<br>
					1.2. すべての人に有能に、公正かつ平等に対応しなければならない。<br>
					1.3. 説明責任を果たすと同時に、すべての人の個人情報や秘密情報の秘密を守らねばならない。<br>
					1.4. 法的に強制されない限り、また書面による許可を得ることなく、アスリートやクライアントのケアと無関係な第三者に対し、いかなる情報も公開してはならない。<br><br>
					2. 専門職は、その専門的職業の実践と関連して、すべての適用法、政策および規制を順守しなければならない。 そのために専門職は、<br>
					2.1. すべての法令を順守しなればならない。<br>
					2.2. NSCAジャパンの会則および適用されるすべての規定、方針、手順、規則、基準およびガイドラインを熟知し順守しなければならない。<br>
					2.3. すべての著作権法と適用される出版基準を順守しなければならない。<br>
					2.4. 非倫理的な行動を容認したり、自ら携わってはならない。<br>
					2.5. 非倫理的な行動が疑われる場合は、これを通報しなければならない。<br><br>
					3. 専門職は高い基準を維持し推進しなければならない。そのために専門職は、<br>
					3.1. 直接間接を問わず、自らのスキル、訓練、専門資格、身分またはサービスに関して虚偽を述べてはならない。<br>
					3.2. 教育または経験を通して提供する資格のあるサービスや、慣行法や他の関連法規により許可されたサービスだけを提供しなければならない。<br>
					3.3. 適切な場合には、さらに相応しい資格を有するフィットネスや医療保健の専門職にアスリートやクライアントを紹介しなければならない。<br>
					3.4. 研究および教育活動において、倫理的行動を維持し促進しなければならない。<br>
					3.5. 安全で効果的なトレーニング環境を提供し維持しなければならない。<br>
					3.6. クライアントの指導中は、健全な良識を働かせる責任を負わねばならない。<br>
					3.7. アスリートおよび／またはクライアントの健康と福祉と保護に全力を傾注しなければならない。<br>
					3.8. 継続教育活動を通して実践的、理論的な基礎に関する最新の知識を維持する努力を怠ってはならず、アスリートやクライアントを傷害から守るために、知識とスキルおよび技術の継続的な向上に務めなければならない。<br><br>
					4. 専門職はNSCAジャパン に悪影響を及ぼすいかなる行為や行動にも従事してはならない。そのために専門職は、<br>
					4.1. 個人としてもまた専門職としても、専門職の責任を損なうことのない方法で行動しなければならない。<br>
					4.2. NSCAジャパンとアスリートやクライアントの福祉よりも金銭的利益を優先してはならず、いかなる取り決めにおいても、NSCAジャパンおよびアスリートやクライアントを私的目的で利用してはならない。<br>
					4.3. 詐欺や偽造または偽計などの不正な手段により、資格認定証を入手したり、入手しようと企てたりしてはならない。<br>
					4.4. 詐欺や偽造または偽計などの不正な手段と知りながら、資格認定証を入手したり入手しようと企てる者に手を貸してはならない。<br>
					4.5. 資格認定証の非合法的な使用、または資格認定証や他のいかなるNSCAジャパンの書類の偽造にも携わってはならない。<br>
					4.6. NSCAジャパンの商標や名称を無許可で使用してはならない。<br>
					4.7. NSCAジャパンの資格認定試験の素材を、設問や問題の部分的な複製や複写も含め、無許可で所持および／または配布してはならない。<br><br><br>
					<span>NSCAジャパン 懲戒手続き</span><br>
					NSCAジャパン はここに定める懲戒手続きに従って 「NSCAジャパン 専門職の倫理規定」の違反を決定し適切な制裁を科すものとする。<br>
					本規定が問題に対処する具体的な手続きや手順をすべて網羅していない場合は、当該案件の処理において、倫理委員会は追加の資料を用いて適切な手段を決定し適用することができる。本規定は倫理委員会による検討と提言、および理事会の承認により改正できる。<br><br>
					<span>告発</span><br>
					いずれの専門職に対しても、誰でも告発を提出できる。NSCAジャパン は匿名の告発は受理しない。NSCAジャパンの職員も、違反の可能性に気づいた場合は、マスメディアやアンチドーピング機関、または裁判所などのいかなる手段によっても告発を開始できる。<br><br>
					告発は書面によるものとしNSCAジャパン事務局長に宛て、以下のアドレスに提出しなければならない。<br>
					nscajapan@nsca-japan.or.jp.<br><br>
					事務局長はすべての告発を直ちに倫理委員会に転送するものとする。<br><br>
					告発は個別のまたは問題となる事案に関する情報が不十分な場合、または告発された当事者または事案に対する法的権限が無い場合は、倫理委員会によりいつでも却下ないし棄却される。<br><br>
					<span>暫定措置</span><br>
					倫理委員会は、告発を処理するいかなる時点においても、すべての個人の安全およびNSCAジャパンとその仕事やサービスの高潔性を担保するために暫定措置を講ずることができる。<br><br>
					<span>調査の通知と対応</span><br>
					倫理委員会は被告発者本人に対し、調査対象となっていることを直ちに通知するものとする。通知は自宅住所に送付され、NSCAジャパンに登録された電子メールアドレスにもＥメールで送付される。かかる通知には、違反の可能性、告発状の写し、倫理委員会が所持するその他のすべての証拠および被告発者が回答を提出すべき期限が含まれる。<br><br>
					被告発者は調査対象となっている当該状況や行為に関して、文書やその他の証拠、調査の参考となる証人の連絡先などを含め、自らの立場を回答として提出することが奨励される。<br>
					適切に通知されたにもかかわらず、被告発者が通知書に正式に記載された期限までに回答しなかった場合、倫理委員会は懲戒手続きを進めることができる。<br><br>
					<span>調査</span><br>
					告発を受理した倫理委員会は、告発された事案に関する調査を行なうものとする。その調査には、面接、関連文書の検討、事案に関与したすべての個人からの書面による陳述の要請、および電子的に入手可能な資料の検討などが含まれるが、それらに制限されるものではない。<br><br>
					倫理委員会は懲戒手続きを継続する前に、調査結果を被告発者と告発者に提示するものとする。<br><br>
					<span>合意による解決</span><br>
					被告発者が告発された違反の責任を受け入れた場合、倫理委員会はその事案の詳細や前例およびNSCAジャパンの利益に基づいて適切な制裁措置を提案できる。被告発者が提案された制裁措置に同意すれば、被告発者は聴聞委員会の開催を要請する権利を放棄したとみなされ、制裁決議は最終となり拘束力をもつことになる。<br><br>
					被告発者が責任を否定し、また（は）提案された制裁措置を拒否した場合は、次の節で記述されるように、被告発者は聴聞委員会への上訴を求めることができる。聴聞委員会に対する要請はすべても書面でNSCAジャパン事務局長に宛て、以下のアドレスに提出しなければならない。<br>nscajapan@nsca-japan.or.jp.<br><br>
					適切に通知された被告発者が合意手続きを経た解決に従わなかった場合、または適時に回答しなかった場合は、倫理委員会は最終的な制裁を科すことができる。<br><br>
					<span>聴聞</span><br>
					もし被告発者が聴聞による意見聴取を要請する場合は、聴聞委員会が事務局長によって任命される。聴聞委員会は、理事会および顧問弁護士で構成される。 聴聞委員は自ら議長を決定する。<br><br>
					聴聞委員会は被告発者の行動が「専門職の倫理規定」の違反となるかを決定し、違反となる場合には適切な制裁措置を決定する責任を果たす。<br><br>
					通知　議長は通知が必要な個人全員に適切な通知を保証し、手続き上の決定を行い、聴聞委員会を開催し、理由を記載した裁定書を書く責任を負う。<br><br>
					適切な通知を行った後、被告発者が聴聞委員会に出席しない場合には、聴聞委員会は本人が出頭しないまま意見聴取を進めることができる。<br><br>
					手続き 聴聞委員会は裁判ではないため、法廷で通常用いる裁判規則や証拠による制限を受けることはない。NSCAジャパンの聴聞委員会は公正な基準の下で運営され、その基準には、被告発者は告発された事件または聴聞対象となっている方針違反に関して、また意見聴取の機会について、事前に通告される権利が含まれる。さらに、被告発者は、以下の聴聞手続き上の権利を有する。<br>
					1. 事前に聴聞委員会の開催を通知される権利（通知書には、聴聞委員会の開始場所と日時だけでなく、聴聞委員会の委員と証人の氏名も含まれる）。<br>
					2. 利益相反がある場合に、聴聞委員会の委員に対し異議を申し立てる権利。<br>
					3. 聴聞委員会に提出された書面と告発内容を事前に知り検討する権利。<br>
					4. 聴聞委員会に相談者／弁護士を同伴する権利。<br>
					5. 公正で偏らない聴聞に対する権利<br>
					6. 被告発者にとって不利な証人の証言に対して反論を述べ、証人を反対尋問する権利。<br>
					7. 聴聞委員会に証人や情報を提示する権利（だたし、その関連性は聴聞委員会が決定できる）<br><br>
					聴聞委員会での立証責任は告発者にあり、違反を明らかにするための立証基準は証拠の優越による。<br><br>
					聴聞委員会の進行手順は、通常、以下の通りである。冒頭；告発者（該当する場合）の冒頭陳述、被告発者の冒頭陳述、他の重要証人（該当する場合）の証言／質問、聴聞委員からの質問、告発者（該当する場合）からの最終陳述、被告発者のからの最終陳述。<br><br>
					聴聞委員会は進行手順のどの段階においても時間制限を設けることができる。<br><br>
					被告発者が複数いる場合、聴聞委員会は、この事案に関する聴聞委員会を個別に開くか同時に行なうかの決定を行う。被告発者はこの決定に関わる情報を聴聞委員会に予め提出することができる。<br><br>
					すべての聴聞は非公開で行なわれ、聴聞委員会の決定に従って、対面で行う場合も、電話で行う場合も、または電子的手段によって行なう場合もある。<br><br>
					<span>証人</span><br>
					聴聞委員会の委員は、本件に関わる情報をもつ、いかなる証人の出席も要請できる。 証人が氏名を明かさないか、聴聞委員会に出席できない場合は、彼／彼女の証言を責任の有無を決定する唯一の、または本質的な根拠とすることはできない。証人の証言が必要で、証人が氏名を明らかにできないか、聴聞委員会に出席できない場合、聴聞委員会は証言を中止または却下できる。<br><br>
					被告発者は自分に代わり意見を述べる重要参考人を同伴できるが、証人の氏名と証言内容を予め聴聞委員会に文書で通知しなければならない。聴聞委員会は、どの範囲の証人が聴聞委員会で証言が許されるかを、質問の重要性と提供される情報の関連性を考慮して決定できる。<br><br>
					聴聞委員会により考慮される情報： 聴聞委員会は、文書や聴取された意見を含め、関連性があるとみなされるすべての情報を検討できる。 聴聞委員会が開催中、審議対象の事実の検証や鑑定意見など、追加の情報を必要とする場合は、聴聞委員会はかかる情報を要請し、かかる情報が入手できるまでしばらく裁定を見合わせることができる。被告発者は、裁定結果の検討に用いられる追加情報に対しても回答する権利を有する。<br><br>
					裁定結果　聴聞委員会の裁定は多数決による。 聴聞委員会は、被告発者が違反を犯したと判断した場合は、委員は適切な制裁措置を決定し発動できる。聴聞委員会の裁定は最終的であり拘束力を有する。<br><br>
					<span>制裁措置</span><br>
					「専門職の倫理規定」のいかなる違反も、以下のリストから、それらを含むがそれらに限定されない制裁措置（単独または複数）をもたらす。適切な制裁を決定する際には、違反の本質とそれを取り巻く周辺事情、被告発者の責任の引き受け、過去の違反、被告発者に対する制裁の影響、前例、高い基準と高潔性の維持に対するNSCAジャパンの関心、さらに聴聞委員会によって適切であるとみなされた他のあらゆる関連情報が考慮される。<br><br>
					可能な制裁措置には以下が含まれるが以下に限定されない。<br>
					1. 訓戒：　書面による戒告で、NSCAジャパンの個人記録に記録される倫理員会による活動停止（中止）通知に含まれるが、それに限定されない。<br>
					2. 正式な譴責：　議事録に記載される倫理委員会による公式裁定で、当事者の行為また（は）当事者のNSCAジャパンへの対応に対し、倫理委員会が公式に不満を表明する。<br>
					3. 資格停止：　資格認定者の有効な認定資格および／または会員としての権利と特典の一定期間または無期限の停止。 倫理委員会または聴聞委員会の判断により、資格停止となった当事者は、資格回復のための正式な請願を要求される場合がある。<br>
					4. 執行猶予: 　資格停止の代わりに、NSCAジャパン による執行猶予期間が設定され、期間の満了に特定の条件を設けることができる。<br>
					5. 資格取消し： 資格認定者の有効な認定資格および／または会員としての権利と特典の永久的、一定期間または無期限の取消し。取消し期間後に資格が自動的に回復されることはない。倫理委員会または聴聞委員会は、当事者が資格認定に再度出願するための特定の条件を定めることができる。<br>
					6. 資格認定試験のための出願資格の否認：資格認定のための出願資格が一定期間または無期限に除外される。資格の回復には、当事者は事態の再検討を資格認定委員会に請願し、かかる再検討が行われるべき理由を説明しなければならない。<br>
					7. 能力の継続を証明するための強制的な再受験または研修： 研修を満了しない場合や試験に合格しない場合、認定資格は一定期間または無期限に停止される。<br>
					8. 資格剥奪： 再受験により資格を再取得する権利が一定期間または無期限に剥奪される。<br>
					9. 解任： 被告発者が、NSCAジャパンの組織に携わる役職を担っている場合、NSCAジャパンの定款、方針および手続きの適用可能な条項に従い、当事者をその遂行中の職務から解任する。<br><br>
					公式な制裁と関連づけて、NSCAジャパンは罰金や教育的課題の要求、その他必要かつ適切とみなされる条件を課すことができる。<br>
					また上記の制裁措置は、被告発者が規定違反を起こした時点での会員状況および役職における立場を考慮し、決定する。<br><br>
					<span>聴聞委員会の裁定結果の通告および記録</span><br>
					聴聞委員会の議長は、簡単な裁定理由と裁定結果を書面で説明するために聴聞委員会裁定書を作成し、被告発者に送付するものとする。裁定結果は告発者にも通知される。<br><br>
					裁定結果が認定資格の一時停止、解除または取消しとなった違反は、聴聞委員会の判断により、NSCAジャパンのニュースレターおよび／またはNSCAジャパンのウェブサイトで公表される。このような通知には、被告発者の氏名、違反した規則、科された制裁措置が含まれる。制裁はNSCAジャパンの個人履歴に記録され永久に保存される。<br><br>
					<span>他の機関への報告と関連訴訟</span><br>
					調査の過程で、万一、犯罪行為が起きたと疑われる場合は、事務局長またはその指名代理人が、かかる申し立てを適切な法執行機関に通報するものとする。<br><br>
					刑法の違反を明らかにする基準は「専門職の倫理規定」の違反を明らかにする基準とは異なるため、刑事裁判の結果がどのようであるかにかかわらず、刑事訴訟手続きの判決によって、（関連する場合もあるが）NSCAジャパンの規則に対する違反が起きたか否かが決定されることはない。<br><br>
					また通常は、(a) 同一の事件あるいは行為に関して民事または刑事訴訟が起こされた、または(b)告発が棄却されるか取り下げられた、または(c) 訴訟が決着または棄却されたことを根拠として、NSCAジャパンの手続きや裁定が変更または省略されることはない。<br><br>
					しかし、 NSCAジャパンは法的手続きとの対立や妨害を避けるために、調査や裁定手続きを延期する場合がある。また、かかる訴訟手続きをもたした事件や行為に関する刑事責任の調査中に、法執行機関の要請に応じることがある。<br><br>
					被告発者がある犯罪に関して有罪を宜告された場合、または原因となる違反行為に関連して刑事処分を受けた場合は、倫理委員会は聴聞委員会を開くことなく調査を行い、関連するNSCAジャパン規定の違反が起きたと結論することができる。違反が起きたとの結論に達した場合は、聴聞委員会が有罪判決を受けた者または刑事処分の適用を受けた者が実際に被告発者と同一人物であることを確認することを条件に、倫理委員会は制裁措置を発令できる。<br><br>
					同様に、専門職団体、世界アンチドーピング規程加盟国、米国安全スポーツセンター、または正当な法の手続きを実施する同種の専門機関により、被告発者が責任を問われ制裁を受けた場合は、倫理委員会は調査を行い、聴聞委員会を開くことなく、NSCAジャパンの規定違反が起きたと結論できる。規定違反が起きたという結論に達した場合は、倫理委員会は制裁を発令できる。<br><br>
					<span>訴訟手続きの秘密保持</span><br>
					本文書に明記されている場合を除き、違反が疑われる事案に関する調査や意見聴取または裁定の過程で作成または受理されたすべての情報、記録、報告、複写、その他あらゆる種類の文書の秘密はNSCAジャパンにより保持される。<br><br>
					<span class="ta_right">以上</span>
				</p>
			</div>
			<p class="doi">
				<input id="rinri_doi" type="checkbox" name="rinri_doi" value="">
				<label class="checkbox" for="rinri_doi">上記の倫理規定に同意します</label>
				<ul class="error_ul">
					<li class="error" id="err_rinri_doi"></li>
				</ul>
			</p>
		</div>
		<table>
			<tr class="chui_jiko">
				<th><span class="required">必須</span>注意事項</th>
				<td>
					<input id="chui" type="checkbox" name="" value="">
					<label class="checkbox" for="chui">@NSCA.COM ならびに @pearson.com からのメールが届くよう、<br>
						必ず受信設定をしてください。</label>
					<ul class="error_ul">
						<li class="error" id="err_chui"></li>
					</ul>
					<p>エラーによりメールが送れない場合、試験予約等の手続きを行うことができなくなります。</p>
				</td>

			</tr>
		</table>
		<section class="btn_wrap">
			<button class="button back" type="button" value="" id="return_button" onclick="location.href='#'"><span>戻る</span></button>
			<button class="button" type="button" value="" id="next_button" onclick="location.href='#'"><span>次へ</span></button>
		</section>

	</div>
	</div>
	<footer id="footer">
	</footer>
</body>

</html>