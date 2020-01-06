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
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/iPhone.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		
    </head>
    <body>
	<header id="header">
	</header>
	
	<div class="wrap">
		<div class="link">
			<ul>
				<li><a href="#">パスワード再発行</a></li>
				<li><a href="#">登録情報修正</a></li>
				<li><a href="#">メールアドレスの変更</a></li>
				<li><a href="#">お問い合わせ</a></li>
				<li><a href="#">ログアウト</a></li>
			</ul>
		</div>
		<h1>マイページ</h1>
		<div class="joho">
			<div class="kaiin_joho bg_gray">
				<h2>会員情報</h2>
				<div>
					<p class="title"><span>○○　○○様</span></p>
					<p>会員番号：<span>00000000正会員</span></p>
					<p>会員有効期限：<span>0000/00/00</span></p>
					<p>英文オプション：<span>なし</span></p>
					<!--<p>健康調査票：<span>未回答</span></p>-->
				</div>
				<div class="btn_wrap">
					<!--<button class="button btn_kaito" type="button" onclick="location.href='#'"><span>回答する</span></button>-->
					<button class="button btn_kaiin_sbt" type="button" onclick="location.href='#'"><span>会員種別の変更</span></button>
					<button class="button btn_hoken" type="button" onclick="location.href='#'"><span>保険に入る</span></button>
				</div>
			</div>
			<div class="shiken_ceu ">
				<div class="shiken bg_white">
					<h2>試験</h2>
					<div>
						<p class="title">CSCS</p>
						<p>認定番号：<span>00000000</span></p>
						<p>認定日：<span>0000/00/00</span></p>
						<p>資格有効期限：<span>0000/00/00</span></p>
					</div>
					<div>
						<p class="title">NSCA-CAP</p>
						<p>認定番号：<span>00000000</span></p>
						<p>認定日：<span>0000/00/00</span></p>
						<p>資格有効期限：<span>0000/00/00</span></p>
					</div>
					<div class="btn_wrap">
						<button class="button" type="button" onclick="location.href='#'"><span>試験申込</span></button>
						<button class="button" type="button" onclick="location.href='#'"><span>試験申込内容状況</span></button>
					</div>
				</div>
				<div class="ceu bg_white">
					<h2>CEU</h2>
					<p class="right">CEU報告は<a href="#">こちら</a>から</p>
					<section>
						<p class="title">CSCS</p>
						<img src="https://placehold.jp/280x30.png">
						<p>「CEU報告」の手続きを行って資格を更新してください</p>
					</section>
					<section>
						<p class="title">NSCA-CAP</p>
						<img src="https://placehold.jp/280x30.png">
					</section>
					<div class="btn_wrap">
						<button class="button" type="button" onclick="location.href='#'"><span>CEUクイズ</span></button>
						<button class="button" type="button" onclick="location.href='#'"><span>内訳詳細を見る</span></button>
					</div>   
				</div>
			</div>
		</div><!--joho-->
		<section>
			<h2>お知らせ</h2>
			<div class="bg_white news">
				<div class="content">
					<p>体力トレーニング検定&reg;(トレ検&reg;)随時、検定を実施しております。</p>
					<div>
						<button class="button" type="button" onclick="location.href='#'"><span>お申込</span></button>
					</div>
				</div>
				<div class="content">
					<p>郵便物が戻ってきています。ご住所の確認をお願いいたします。</p>
					<div>
						<button class="button" type="button" onclick="location.href='#'"><span>登録情報</span></button>
					</div>
					
				</div>
				<div class="content">
					<p>テキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<div>
						<button class="button" type="button" onclick="location.href='#'"><span>継続手続き</span></button>
					</div>
				</div>
			</div>
			<div class="page">
				<ol>
					<li class="page_1">1</li>
					<li class="page_2">2</li>
					<li class="page_3">3</li>
				</ol>
				<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
			</div>
		</section>
		<section>
			<h2>イベント</h2>
			<div class="bg_white event">
				<div class="event_wrap">
					<div class="sub">
						<p class="sub_1">セミナー</p>
						<p class="sub_2">残りわずか</p>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>お申込</span></button>
						</div>
					</div>
				</div>
				<div class="event_wrap">
					<div class="sub">
						<p class="sub_1">トレ検</p>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>お申込</span></button>
						</div>
					</div>
				</div>
			</div>
			<div class="page">
				<p>もっと見る</p>
				<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
			</div>
		</section>
		
		<section class="clearfix">
			<div class="moshikomi">
				<h2>申込状況</h2>
				<div class="bg_white">
					<div class="content">
						<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<div class="btn_2">
							<button class="button" type="button" onclick="location.href='#'"><span>支払</span></button>
							<button class="button" type="button" onclick="location.href='#'"><span>詳細</span></button>
						</div>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<div class="btn_2">
							<button class="button" type="button" onclick="location.href='#'"><span>詳細</span></button>
							<button class="button shiharai_nmb" type="button" onclick="location.href='#'"><span>支払番号表示</span></button>
						</div>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>詳細</span></button>
						</div>
						
					</div>
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>詳細</span></button>
						</div>
					
					</div>
				</div>
			</div>
		
			<div class="shiharai">
				<h2>支払状況</h2>
				<div class="bg_white">
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>領収書</span></button>
						</div>						
					</div>
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>領収書</span></button>
						</div>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>領収書</span></button>
						</div>
					</div>
					<div class="content">
						<p>テキストテキストテキストテキスト</p>
						<div>
							<button class="button" type="button" onclick="location.href='#'"><span>領収書</span></button>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="clearfix">
			<div class="kaiin_contents">
				<h2>会員コンテンツ</h2>
				<div class="bg_white">
					<button class="button" onclick="location.href='#'"><span>パーソナルトレーナーサポートツール</span></button>
					<button class="button" onclick="location.href='#'"><span>S&amp;C資料集</span></button>
					<button class="button" onclick="location.href='#'"><span>HPC施設利用申込手続きへ</span></button>
				</div>
			</div>
			
			<div class="denshi_book">
				<h2>電子ブック</h2>
				<div class="bg_white">
					<figure>
						<img src="https://placehold.jp/265x150.png">
						<figcaption>テキストテキストテキスト</figcaption>
					</figure>
					<div>
						<button class="button" onclick="location.href='#'"><span>もっと見る</span></button>
					</div>
					
				</div>
				
			</div>
			
			<div class="buppan">
				<h2>物販</h2>
				<div class="bg_white">
					<figure>
						<img src="https://placehold.jp/265x150.png">
						<figcaption>テキストテキストテキストテキスト<p class="price">￥00,000</p></figcaption>
					</figure>
					<div>
						<button class="button" onclick="location.href='#'"><span>もっと見る</span></button>
					</div>
				</div>				
			</div>
		</section>
		
		<h2>求人情報</h2>
		<div class="bg_white kyujin">
			<div class="content">
				<div class="sub">
					<p class="sub_1">テキスト</p>
				</div>
				<p>テキストテキストテキストテキストテキストテキストテキストテキスト</p>
			</div>
			<div class="content">
				<div class="sub">
					<p class="sub_1">テキスト</p>
				</div>
				<p>テキストテキストテキストテキスト</p>
			</div>
		</div>
		<div class="page">
				<ol>
					<li class="page_1">1</li>
					<li class="page_2">2</li>
					<li class="page_3">3</li>
				</ol>
				<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
			</div>
	</div><!--wrap↑-->
	<footer id="footer">
	</footer>
</body>
</html>
