<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>継続登録情報</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/inputContinueMember.css" />

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
		<script>
			$(function(){
				$("select").wrap("<span class='select_wrap'></span>");
			});
		</script>
    </head>
    <body>
	<header class="header_logo">
		<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="ロゴ">
	</header>
	<div class="wrap mh_c btn_b_wrap">  
		<h2>継続登録情報</h2>
		<div class="content_wrap">
			<div class="spb_arrows spb_arrows_3ver">
				<ul class="nav nav-tabs step-anchor">
					<li class="active"><span><small>入力</small></span></li>
					<li><span><small>確認</small></span></li>
					<li><span><small>支払<br class="sp_no">(決済専用サイトへ)</small></span></li>
				</ul>
			</div>
			<form>
				<h3>継続入力</h3>					
				<div class="shinki_toroku">
					<table>
						<tr class="kaiin">
							<th><span class="any"></span>会員種別</th>
							<td>
								<p>学生会員</p>
								<input id="option" type="checkbox" name="option">
								<label class="checkbox" for="option">英文購読オプション</label>
								<p class="ti">正会員と学生会員にオプションとしてつけることができます。詳しくは<a href="#" class="td_under">こちら</a>をご覧ください。</p>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>学生証</th>
							<td class="file">
								<label for="file_front">アップロード（表面）</label>
								<input id="file_front" type="file" accept="image/*">
								<p>学生証（表）アップロード：</p>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<label for="file_back">アップロード（裏面）</label>
								<input id="file_back" type="file" accept="image/*">
								<p>学生証（裏）アップロード：</p>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<ul class="up_text">
									<li>アップロードできるファイル形式は、JPG(jpg/jpeg)、PNG(png)、GIF(gif)となります。</li>
									<li>学生会員の方は必ずアップロードしてください。</li>
									<li>不鮮明なデータをお送り頂いた場合は、無効になります。</li>
									<li>有効期限、顔写真が明瞭で、学生証と認識できるかを事前にご確認ください。</li>
									<li>学生証の裏面に有効期限等がある場合は、裏面もアップロードしてください。</li>
									<li>NSCAジャパンにて学生証を確認するまでは、お手続きは完了いたしません。<br>
									学生証の確認には1週間程度かかる場合があります。</li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<div class="kihon_joho">
					<h3>基本情報</h3>
					<table>
						<tr class="name">
							<th><span class="required">必須</span>氏名</th>
							<td class="clearfix">
								<div>
									<p>姓</p><input id="name_sei" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
								<div>
									<p class="sp_mt_1">名</p><input id="name_mei" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>フリガナ</th>
							<td class="clearfix">
								<div>
									<p>セイ</p><input id="name_sei_kana" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
								<div>
									<p class="sp_mt_1">メイ</p><input id="name_mei_kana" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="name">
							<th><span class="required">必須</span>ローマ字表記</th>
							<td class="clearfix">
								<div>
									<p>Last(姓)</p><input id="name_last" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
								<div>
									<p class="sp_mt_1">First(名)</p><input id="name_first" type="text" name="name" value="">
									<ul class="error_ul">
										<li class="error"></li>
									</ul>
								</div>
							</td>
						</tr>
						<tr class="birthday">
							<th><span class="required">必須</span>生年月日</th>
							<td>
								<p>西暦</p><input id="year" type="text" name="name" value="">年
								<select id="month" name="manth"></select>月
								<select id="day" name="day"></select>日
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr class="gender">
							<th><span class="required">必須</span>性別</th>
							<td>
								<input id="gender_1" type="radio" name="gender">
								<label for="gender_1">男性</label>
								<input id="gender_2" type="radio" name="gender">
								<label for="gender_2">女性</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr class="address">
							<th><span class="required">必須</span>住所</th>
							<td>
								<p>郵便番号</p><input id="address_yubin_nb_1" class="yubin_1" type="text" name="" value="">-<input id="yubin_nb_2" class="yubin_2" type="text" name="" value="">
								<button id="street_address_search" class="button" type="button"><span>住所検索</span></button>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">都道府県</p><select id="address_todohuken" name="math"></select>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">市区町村／番地</p><input id="address_shiku" class="w_80" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">建物／部屋番号</p><input id="address_tatemono" class="w_80" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<input id="nagareyama" type="checkbox" name="" value="">
								<label class="checkbox" for="nagareyama">流山市民の方はチェックしてください</label>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>住所(ヨミ)</th>
							<td>
								<p>市区町村／番地</p><input id="address_yomi_shiku" class="w_80" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">建物／部屋番号</p><input id="address_yomi_tatemono" class="w_80" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>電話番号</th>
							<td>
								<p>TELまたは携帯のどちらかをご入力ください</p>
								<p class="mt_1">TEL</p><input id="tel" class="w_50" type="tel" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">携帯</p><input id="keitai_tel" class="w_50" type="tel" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
								<p class="mt_1">FAX</p><input id="fax" class="w_50" type="tel" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr class="mail">
							<th><span class="required">必須</span>メールアドレス</th>
							<td>
								<p>メールアドレス_1：</p>
								<p class="mt_1">メールアドレス_2：</p>
								<p class="mt_1">メール受信希望のメールアドレス</p>
								<input id="mail_1" type="radio" name="mail" value="">
								<label for="mail_1">メールアドレス_1</label><br class="sp_bl">
								<input id="mail_2" type="radio" name="mail" value="">
								<label for="mail_2">メールアドレス_2</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>メルマガ配信の希望</th>
							<td>
								<input id="merumaga_1" type="radio" name="merumaga" value="">
								<label for="merumaga_1">希望する</label>
								<input id="merumaga_2" type="radio" name="merumaga" value="">
								<label for="merumaga_2">希望しない</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr class="pass">
							<th><span class="required">必須</span>パスワード</th>
							<td>
								<input id="pass_1" class="w_50" type="text" name="" value="">
								<p class="mt_1">確認用</p>
								<input id="pass_2" class="w_50" type="text" name="" value="">
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>URL</th>
							<td>
								<input id="url" class="w_80" type="text" name="" value="">
							</td>
						</tr>
						<tr class="job">
							<th><span class="any"></span>職業</th>
							<td>
								<p><select id="job_1" class="w_70" type="text" name="" value=""></select></p>
								<p class="mt_1"><select id="job_2" class="w_70" type="text" name="" value=""></select></p>
								<p class="mt_1"><select id="job_3" class="w_70" type="text" name="" value=""></select></p>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>勤務先／所属先名</th>
							<td>
								<input id="office" class="" type="text" name="" value="">
							</td>
						</tr>
						<tr class="address">
							<th><span class="any"></span>所属先住所</th>
							<td>
								<p>郵便番号</p><input id="office_yubin nb_1" class="yubin_1" type="text" name="" value="">-<input id="office_yubin_nb_2" class="yubin_2" type="text" name="" value="">
								<button id="job_address_search" class="button" type="button"><span>住所検索</span></button>
								<p class="mt_1">都道府県</p><select id="office_todohuken" name="math"></select>
								<p class="mt_1">市区町村／番地</p><input id="office_shiku" class="w_80" type="text" name="" value="">
								<p class="mt_1">建物／部屋番号</p><input id="office_tatemono" class="w_80" type="text" name="" value="">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先電話番号</th>
							<td>
								<input id="office_tel" class="w_50" type="tel" name="" value="">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>所属先FAX番号</th>
							<td>
								<input id="office_fax" class="w_50" type="tel" name="" value="">
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>NSCA以外の認定資格</th>
							<td class="clearfix">
								<div>
									<input id="shikaku_1" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_1">健康運動指導士</label><br>
									<input id="shikaku_2" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_2">健康運動実践指導者</label><br>
									<input id="shikaku_3" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_3">ADI／JAFA AQUA</label><br>
									<input id="shikaku_4" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_4">ACSM／HFS</label><br>
									<input id="shikaku_5" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_5">AFAA各種資格</label><br>
									<input id="shikaku_6" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_6">高齢者体力つくり支援士</label><br>
									<input id="shikaku_7" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_7">JATI認定資格</label><br>
									<input id="shikaku_8" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_8">NESTA-PFT</label><br>
									<input id="shikaku_9" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_9">加圧インストラクター</label><br>
									<input id="shikaku_10" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_10">ヘルスケアトレーナー</label><br>
									<input id="shikaku_11" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_11">健康管理士一般指導員</label><br>
									<input id="shikaku_12" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_12">SAQインストラクター</label><br>
									<input id="shikaku_13" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_13">日本スポーツ協会アスレティックトレーナー</label><br>
									<input id="shikaku_14" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_14">NATA-ATC</label><br>
									<input id="shikaku_15" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_15">JATAC-ATC</label><br>
									<input id="shikaku_16" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_16">栄養士／管理栄養士</label><br>
									<input id="shikaku_17" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_17">日本スポーツ協会スポーツ栄養士</label>
								</div>
								<div>
									<input id="shikaku_18" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_18">日本スポーツ協会スポーツプログラマー</label><br>
									<input id="shikaku_19" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_19">トレーニング指導士</label><br>
									<input id="shikaku_20" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_20">介護支援専門員（ケアマネージャー）</label><br>
									<input id="shikaku_21" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_21">介護福祉士（ケアワーカー）</label><br>
									<input id="shikaku_22" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_22">社会福祉士</label><br>
									<input id="shikaku_23" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_23">保育士</label><br>
									<input id="shikaku_24" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_24">障害スポーツ指導員</label><br>
									<input id="shikaku_25" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_25">医師</label><br>
									<input id="shikaku_26" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_26">看護師</label><br>
									<input id="shikaku_27" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_27">保健師</label><br>
									<input id="shikaku_28" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_28">理学療法士</label><br>
									<input id="shikaku_29" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_29">作業療法士</label><br>
									<input id="shikaku_30" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_30">救命救急士</label><br>
									<input id="shikaku_31" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_31">鍼、灸、あん摩マッサージ指圧師</label><br>
									<input id="shikaku_32" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_32">柔道整復師</label><br>
									<input id="shikaku_33" type="checkbox" name="shikaku" value=""><label class="checkbox" for="shikaku_33">その他（記述）</label><br>
								</div>
								<textarea placeholder="その他を選択した場合は必須入力となります"></textarea>
							</td>
						</tr>
					</table>
				</div>
				<div class="oshirase">
					<h3>お知らせ／連絡方法／アンケート</h3>
					<table>
						<tr>
							<th><span class="required">必須</span>連絡方法の希望</th>
							<td>
								<input id="hoho_1" type="radio" name="hoho" value=""><label for="hoho_1">メールでお知らせ</label>
								<input id="hoho_2" type="radio" name="hoho" value=""><label for="hoho_2">郵便でお知らせ</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>郵便物配達先の希望</th>
							<td>
								<input id="yubin_1" type="radio" name="yubin" value=""><label for="yubin_1">自宅</label>
								<input id="yubin_2" type="radio" name="yubin" value=""><label for="yubin_2">勤務先／所属先</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr class="chiiki">
							<th><span class="any"></span>興味のある地域</th>
							<td>
								<p>居住地域以外でセミナー開催の情報を知りたい地域<br>
								(マイページトップにおすすめセミナーとして表示されます)</p>
								<input id="chiiki_1" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_1">北海道</label>
								<input id="chiiki_2" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_2">東北</label>
								<input id="chiiki_3" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_3">北関東</label>
								<input id="chiiki_4" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_4">西関東</label>
								<input id="chiiki_5" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_5">甲信越</label>
								<input id="chiiki_6" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_6">北陸</label><br class="sp_no">
								<input id="chiiki_7" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_7">東海</label>
								<input id="chiiki_8" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_8">関西</label>
								<input id="chiiki_9" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_9">中四国</label>
								<input id="chiiki_10" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_10">九州</label>
								<input id="chiiki_11" type="checkbox" name="chiiki" value=""><label class="checkbox" for="chiiki_11">沖縄</label>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>ウェブサイト掲載</th>
							<td>
								<input id="web_1" type="radio" name="web" value=""><label for="web_1">希望する</label>
								<input id="web_2" type="radio" name="web" value=""><label for="web_2">希望しない</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="required">必須</span>アンケート協力</th>
							<td>
								<input id="qa_1" type="radio" name="qa" value=""><label for="qa_1">協力する</label>
								<input id="qa_2" type="radio" name="qa" value=""><label for="qa_2">協力しない</label>
								<ul class="error_ul">
									<li class="error"></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span class="any"></span>興味のある分野</th>
							<td class="clearfix">
								<div>
									<input id="bunya_1" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_1">子ども</label><br>
									<input id="bunya_2" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_2">女性</label><br>
									<input id="bunya_3" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_3">球技（コンタクト）系：サッカー、<br>ラグビー、バスケットボールなど</label><br>
									<input id="bunya_4" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_4">格闘技系：柔道、レスリング、<br>ボクシングなど</label><br>
									<input id="bunya_5" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_5">採点系：体操、フィギュアスケート、<br>ボディビルディングなど</label><br>
									<input id="bunya_6" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_6">オリンピックリフティング</label><br>
									<input id="bunya_7" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_7">有酸素トレーニング</label><br>
									<input id="bunya_8" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_8">スピード＆アジリティ</label><br>
									<input id="bunya_9" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_9">コーディネーショントレーニング</label><br>
									<input id="bunya_10" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_10">測定と評価</label><br>
									<input id="bunya_11" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_11">パーソナル指導テクニック</label><br>
									<input id="bunya_12" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_12">メンタル／コミュニケーションスキル</label><br>
									<input id="bunya_13" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_13">その他（記述）</label>
								</div>
								<div>
									<input id="bunya_14" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_14">一般成人</label><br>
									<input id="bunya_15" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_15">高齢者（介護予防含む）</label><br>
									<input id="bunya_16" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_16">球技（ノンコンタクト）系：<br>野球、バレーボール、テニスなど</label><br>
									<input id="bunya_17" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_17">競争系：陸上、水泳、スキーなど</label><br>
									<input id="bunya_18" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_18">レジスタンストレーニング</label><br>
									<input id="bunya_19" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_19">器具を用いないトレーニング</label><br>
									<input id="bunya_20" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_20">プライオメトリックス</label><br>
									<input id="bunya_21" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_21">柔軟性トレーニング</label><br>
									<input id="bunya_22" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_22">リハビリテーション／<br>リコンディショニング</label><br>
									<input id="bunya_23" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_23">プログラムデザイン</label><br>
									<input id="bunya_24" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_24">栄養</label><br>
									<input id="bunya_25" type="checkbox" name="bunya" value=""><label class="checkbox" for="bunya_25">ビジネス／法的諸問題</label>
								</div>
								<textarea placeholder="その他を選択した場合は必須入力となります"></textarea>
							</td>
						</tr>
					</table>
				</div>
			</form>
			<button class="button btn_gray" type="submit" value="" onclick="location.href='#'"><span>退会をご希望の方はこちら</span></button>
			<section class="btn_wrap">
				<button class="button btn_gray" type="submit" value="" onclick="location.href='#'"><span>クリア</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>次へ</span></button>
			</section>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
