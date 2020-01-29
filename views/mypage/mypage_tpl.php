<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>マイページ</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/my_page.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/iPhone.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/mypage.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/jquery.matchHeight.js"></script>
		<script>
			$(function(){
				$('a[href^="#"]').click(function(){
					var speed = 500;
					var href= $(this).attr("href");
					var target = $(href == "#" || href == "" ? 'html' : href);
					var position = target.offset().top;
					$("html, body").animate({scrollTop:position}, speed, "swing");
					return false;
				});
				
				$(window).on('resize load', function(){
					var winW = $(window).width();
					if (winW > 800) {
						$('.match_height_1').matchHeight();
						$('.match_height_2').matchHeight();
						$('.match_height_3').matchHeight();
					}
				});
				
			});
		</script>
		
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap">
		<div class="link">
			<ul>
				<li><a href="#">お問い合わせ</a></li>
				<li><a href="#">ログアウト</a></li>
			</ul>
		</div>
		<h1>マイページ</h1>
		<ul class="page_link">
			<li><a href="#kaiin_joho">会員情報</a></li>
			<li><a href="#shiken">試験</a></li>
			<li><a href="#ceu">CEU</a></li>
			<li><a href="#news">お知らせ</a></li>
			<li><a href="#event">イベント</a></li>
			<li><a href="#moshikomi">申込状況</a></li>
			<li><a href="#shiharai">支払情報</a></li>
			<li><a href="#kaiin_contents">会員コンテンツ</a></li>
			<li><a href="#denshi_book">電子ブック</a></li>
			<li><a href="#buppan">物販</a></li>
			<li><a href="#kyujin_joho">求人情報</a></li>
		</ul>
		<div class="content_wrap">
			<div id="kaiin_joho">
				<h2>会員情報</h2>
				<div class="bg_white">
					<p class="user_name"><span id="kaiin_name"></span>様</p>
					<table>
						<tr>
							<th>会員番号</th>
							<td><span id="kaiin_no"></span></td>
						</tr>
						<tr>
							<th>会員種別</th>
							<td>
								<span id="kaiin_sbt"></span><br>
								<p class="sbt_change"><a>会員種別の変更</a></p>
							</td>
						</tr>
						<tr>
							<th>会員有効期限</th>
							<td><span id="yuko_hizuke"></span></td>
						</tr>
						<tr>
							<th>英文オプション</th>
							<td><span id="eibun_option"></span></td>
						</tr>
						<!--<tr>
							<th>健康調査票</th>
							<td>
								未回答<br>
								<p><a>回答する</a></p>
							</td>
						</tr>-->
					</table>
					<div class="btn_wrap">
						<button class="button" type="button" onclick="location.href='#'"><span>パスワード再発行</span></button>
						<button class="button" type="button" onclick="location.href='#'"><span>登録情報修正</span></button>
						<button class="button" type="button" onclick="location.href='#'"><span>メールアドレスの変更</span></button>
						<button class="button" type="button" onclick="location.href='#'"><span>保険に入る</span></button>
					</div>
				</div>
			</div>
			<section>
				<div id="shiken">
					<h2>試験</h2>
					<div class="bg_white match_height_1">
						<div class="cscs">
							<p class="title">CSCS</p>
							<p>認定番号：<span id="nintei_no_c">00000000</span></p>
							<p>認定日：<span id="ninteibi_c">0000/00/00</span></p>
							<p>資格有効期限：<span id="yuko_kigen_c">0000/00/00</span></p>
						</div>
						<div class="nsca">
							<p class="title">NSCA-CAP</p>
							<p>認定番号：<span id="nintei_no_n">00000000</span></p>
							<p>認定日：<span id="ninteibi_n">0000/00/00</span></p>
							<p>資格有効期限：<span id="yuko_kigen_n">0000/00/00</span></p>
						</div>
						<div class="btn_wrap">
							<button class="button" type="button" onclick="location.href='#'"><span>試験申込</span></button>
							<button class="button" type="button" onclick="location.href='#'"><span>試験申込内容状況</span></button>
						</div>
					</div>
				</div>
				<div id="ceu">
					<h2>CEU</h2>
					<div class="bg_white match_height_1">
						<div class="clearfix">
							<p class="right">CEU報告は<a>こちら</a>から</p>
						</div>
						<div class="cscs">
							<p class="cscs">CSCS</p>
							<img src="https://placehold.jp/280x30.png">
							<p>「CEU報告」の手続きを行って資格を更新してください</p>
						</div>
						<div class="nsca">
							<p class="nsca">NSCA-CAP</p>
							<img src="https://placehold.jp/280x30.png">
						</div>						
						<div class="btn_wrap">
							<button class="button" type="button" onclick="location.href='#'"><span>CEUクイズ</span></button>
							<button class="button" type="button" onclick="location.href='#'"><span>内訳詳細を見る</span></button>
						</div>         
					</div>
				</div>
			</section>
			<div id="news">
				<h2>お知らせ</h2>
				<div class="bg_white">
					<ul>
						<li class="list" id="info_list1"><div class="sub">
							<span class="list_text" id="info_naiyo1">体力トレーニング検定&reg;(トレ検&reg;)随時、検定を実施しております。</span >
							<button class="button" type="button" id="info_button1" onclick="location.href='#'"><span>お申込</span></button>
						</li>
						<li class="list" id="info_list2"><div class="sub">
							<span class="list_text" id="info_naiyo2">郵便物が戻ってきています。ご住所の確認をお願いいたします。</span >
							<button class="button" type="button" id="info_button2" onclick="location.href='#'"><span>登録情報</span></button>
						</li>
						<li class="list" id="info_list3"><div class="sub">
							<span class="list_text" id="info_naiyo3">テキストテキストテキストテキストテキストテキストテキストテキスト</span >
							<button class="button" type="button" id="info_button3" onclick="location.href='#'"><span>継続手続き</span></button>
						</li>
					</ul>
				</div>
				<div class="page">
					<button class="button" type="button" onclick="location.href='#'"><span>1</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span>2</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span>3</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span><i class="fas fa-angle-right"></i></span></button>
				</div>
			</div>
			<div id="event">
				<h2>イベント</h2>
				<div class="bg_white">
					<ul>
						<li class="list" id="event_list1"><div class="sub">
								<p class="sub_1" id="event_meisho1">セミナー</p>
								<p class="sub_2" id="event_nokori1">残りわずか</p>
							</div>
							<span class="list_text" id="event_naiyo1">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</span>
							<button class="button" type="button" id="event_button1" onclick="location.href='#'"><span>お申込</span></button>
						</li>
						<li class="list" id="event_list2">
							<div class="sub">
								<p class="sub_1" id="event_meisho2">トレ件</p>
								<p class="sub_2" id="event_nokori2">残りわずか</p>
							</div>
							<span class="list_text" id="event_naiyo2">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</span>
							<button class="button" type="button" id="event_button2" onclick="location.href='#'"><span>お申込</span></button>
						</li>
					</ul>
				</div>
				<div class="page">
					<p><a>もっと見る</a></p>
				</div>
			</div>
			<section>
				<div id="moshikomi">
					<h2>申込状況</h2>
					<div class="bg_white match_height_2">
						<ul>
							<li class="list" id="apply_list1">
								<span class="list_text" id="apply_naiyo1"><a>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</a></span>
								<button class="button" type="button" id="apply_button1" onclick="location.href='#'"><span>支払</span></button>
							</li>
							<li class="list" id="apply_list2">
								<span class="list_text" id="apply_naiyo2"><a>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</a></span>
								<button class="button" type="button" id="apply_button2" onclick="location.href='#'"><span>支払番号表示</span></button>
							</li>
							<li class="list" id="apply_list3">
								<span class="list_text" id="apply_naiyo3"><a>テキストテキストテキストテキスト</a></span>
								<button class="button" type="button" id="apply_button3" onclick="location.href='#'"><span>支払</span></button>
							</li>
							<li class="list" id="apply_list4">
								<span class="list_text" id="apply_naiyo4"><a>テキストテキストテキストテキスト</a></span>
								<button class="button" type="button" id="apply_button4" onclick="location.href='#'"><span>支払</span></button>
							</li>
						</ul>
					</div>
				</div>
				<div id="shiharai">
					<h2>支払情報</h2>
					<div class="bg_white match_height_2">
						<ul>
							<li class="list" id="payment_list1">
								<span class="list_text" id="payment_naiyo1">テキストテキストテキストテキスト</span>
								<button class="button" type="button" id="payment_button1" onclick="location.href='#'"><span>領収書</span></button>
							</li>
							<li class="list" id="payment_list2">
								<span class="list_text" id="payment_naiyo2">テキストテキストテキストテキスト</span>
								<button class="button" type="button" id="payment_button2" onclick="location.href='#'"><span>領収書</span></button>
							</li>
							<li class="list" id="payment_list3">
								<span class="list_text" id="payment_naiyo3">テキストテキストテキストテキスト</span>
								<button class="button" type="button" id="payment_button3" onclick="location.href='#'"><span>領収書</span></button>
							</li>
							<li class="list" id="payment_list4">
								<span class="list_text" id="payment_naiyo4">テキストテキストテキストテキスト</span>
								<button class="button" type="button" id="payment_button4" onclick="location.href='#'"><span>領収書</span></button>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<section>
				<div id="kaiin_contents">
					<h2>会員コンテンツ</h2>
					<div class="bg_white match_height_3">
						<div class="kaiin_btn">
							<button class="button" onclick="location.href='#'"><span>パーソナルトレーナーサポートツール</span></button>
							<button class="button" onclick="location.href='#'"><span>S&amp;C資料集</span></button>
							<button class="button" onclick="location.href='#'"><span>HPC施設利用申込手続きへ</span></button>
						</div>	
					</div>
				</div>
				<div id="denshi_book">
					<h2>電子ブック</h2>
					<div class="bg_white match_height_3">
						<figure>
							<img src="https://placehold.jp/265x150.png">
							<figcaption>テキストテキストテキストテキストテキスト</figcaption>
						</figure>
						<div class="btn_wrap">
						<button class="button" onclick="location.href='#'"><span>もっと見る</span></button></div>
					</div>
				</div>
				<div id="buppan">
					<h2>物販</h2>
					<div class="bg_white match_height_3">
						<figure>
							<img src="https://placehold.jp/265x150.png">
							<figcaption>テキストテキストテキストテキストテキストテキスト<p class="price">\00,000</p></figcaption>
						</figure>
						<div class="btn_wrap">
							<button class="button" onclick="location.href='#'"><span>もっと見る</span></button>
						</div>
					</div>
				</div>
			</section>
			<div id="kyujin_joho">
				<h2>求人情報</h2>
				<div class="bg_white">
					<ul>
						<li class="list">
							<div class="sub">
								<p class="sub_1">テキスト</p>
							</div>
							<span class="list_text"><a>テキストテキストテキストテキストテキストテキストテキストテキスト</a></span>
						</li>
						<li class="list">
							<div class="sub">
								<p class="sub_1">テキスト</p>
							</div>
							<span class="list_text"><a>テキストテキストテキストテキスト</a></span>
						</li>
					</ul>
				</div>
				<div class="page">
					<button class="button" type="button" onclick="location.href='#'"><span>1</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span>2</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span>3</span></button>
					<button class="button" type="button" onclick="location.href='#'"><span><i class="fas fa-angle-right"></i></span></button>
				</div>
			</div>
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
