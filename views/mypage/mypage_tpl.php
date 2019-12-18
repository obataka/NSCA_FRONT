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
		<h2 class="mb_10">マイページ</h2>
		<div class="content_wrap">
            <div class="content_top">
                <div class="joho">
                    <p class="title">会員情報</p>
                    <p><span>○○　○○様</span></p>
                    <p>会員番号：<span>00000000正会員</span></p>
                    <p>会員有効期限：<span>0000/00/00</span></p>
                    <p>英文オプション：<span>なし</span></p>
                    <!--<p>健康調査票：<span>未回答</span></p>-->
					<div class="btn_wrap">
					   <!--<button class="button btn_kaito" type="button" onclick="location.href='#'"><span>回答する</span></button>-->
						<button class="button btn_kaiin_sbt" type="button" onclick="location.href='#'"><span>会員種別の変更</span></button>
						<button class="button btn_hoken" type="button" onclick="location.href='#'"><span>保険に入る</span></button>
					</div>
                </div>
                <div class="shiken">
                    <div class="cscs">
                        <p class="title">CSCS</p>
                        <p>認定番号：<span>00000000</span></p>
                        <p>認定日：<span>0000/00/00</span></p>
                        <p>資格有効期限：<span>0000/00/00</span></p>
                    </div>
                    <div class="nsca">
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
                <div class="ceu clearfix">
                    <p class="title">CEU</p>
					<div class="clearfix">
						<button class="button btn_ceu" type="button" onclick="location.href='#'"><span>CEU報告はこちらから</span></button>
					</div>
					<p class="cscs">CSCS</p>
					<img src="https://placehold.jp/280x30.png">
					<p>「CEU報告」の手続きを行って資格を更新してください</p>
					<p class="nsca">NSCA-CAP</p>
					<img src="https://placehold.jp/280x30.png">
                    <div class="btn_wrap">
                        <button class="button" type="button" onclick="location.href='#'"><span>CEUクイズ</span></button>
                    	<button class="button" type="button" onclick="location.href='#'"><span>内訳詳細を見る</span></button>
                    </div>         
                </div>
            </div>
			<div class="news bg_blue">
				<p class="title">お知らせ</p>
				<div class="bg_white">
					<ul class="news_1 clearfix">
						<li class="clearfix">体力トレーニング検定&reg;(トレ検&reg;)随時、検定を実施しております。<button class="button mp_btn" type="button" onclick="location.href='#'"><span>お申込</span></button></li>
						<li class="clearfix">郵便物が戻って生きています。ご住所の確認をお願いいたします。<button class="button mp_btn" type="button" onclick="location.href='#'"><span>登録情報</span></button></li>
						<li class="clearfix">テキストテキストテキストテキストテキストテキストテキストテキスト<button class="button mp_btn" type="button" onclick="location.href='#'"><span>継続手続き</span></button></li>
					</ul>
				</div>
				<div class="page">
					<ol>
						<li class="page_1">1</li>
						<li class="page_2">2</li>
						<li class="page_3">3</li>
					</ol>
					<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
				</div>
			</div>
			<div class="event">
				<p class="title">イベント</p>
				<div class="content_ bg_gray">
					<div class="event_wrap">
						<div class="sub">
							<p class="sub_1">セミナー</p>
							<p class="sub_2">残りわずか</p>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>お申込</span></button>
							</div>
						</div>
					</div>
					<div class="event_wrap">
						<div class="sub">
							<p class="sub_1">トレ検</p>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>お申込</span></button>
							</div>
						</div>
					</div>
				</div>
				<div class="page">
					<p>もっと見る</p>
					<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
				</div>
			</div>
			<div class="bg_blue">
				<p class="title">テキストテキスト</p>
				<section>
					<div class="moshikomi bg_white">
						<p class="title">申込状況</p>
						<div class="list">
							<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
							<div class="sub btn_2">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>支払</span></button>
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>詳細</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
							<div class="sub btn_2">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>詳細</span></button>
								<button class="button mp_btn shiharai_nmb" type="button" onclick="location.href='#'"><span>支払番号表示</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>詳細</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>詳細</span></button>
							</div>
						</div>
					</div><!--moshikomi bg_white ↑-->
					<div class="shiharai bg_white">
						<p class="title">支払情報</p>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>領収書</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>領収書</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>領収書</span></button>
							</div>
						</div>
						<div class="list">
							<p>テキストテキストテキストテキスト</p>
							<div class="sub">
								<button class="button mp_btn" type="button" onclick="location.href='#'"><span>領収書</span></button>
							</div>
						</div>
					</div>
				</section>
				
				<p class="title">テキストテキスト</p>
				<section class="content_5">
					<div class="kaiin bg_white">
						<p class="title">会員限定コンテンツ</p>
						<div class="kaiin_btn">
							<button class="button mp_btn" onclick="location.href='#'"><span>パーソナルトレーナーサポートツール</span></button>
							<button class="button mp_btn" onclick="location.href='#'"><span>S&amp;C資料集</span></button>
							<button class="button mp_btn" onclick="location.href='#'"><span>HPC施設利用申込手続きへ</span></button>
						</div>						
					</div>
					<div class="denshi bg_white">
						<p class="title">電子ブック</p>
						<div class="flex_wrap">
							<figure>
								<img src="https://placehold.jp/265x150.png">
								<figcaption>テキストテキストテキスト</figcaption>
							</figure>
						</div>
						
						<button class="button mp_btn" onclick="location.href='#'"><span>もっと見る</span></button>
					</div>
					<div class="buppan bg_white">
						<p class="title">物販</p>
						<div class="flex_wrap">
							
							<figure>
								<img src="https://placehold.jp/265x150.png">
								<figcaption>テキストテキストテキストテキスト<p class="price">00,000</p></figcaption>
							</figure>
							
							<!--
							<table>
								<tr>
									<th><img src="https://placehold.jp/250x150.png"></th>
									<td>テキストテキストテキストテキスト<p class="price">00,000</p></td>
								</tr>
							</table>

-->
						</div>
						<button class="button mp_btn" onclick="location.href='#'"><span>もっと見る</span></button>
					</div>
				</section>
			</div><!--bg_blue-->
			<div class="kyujin">
				<p class="title">求人情報</p>
				<div class="bg_gray">
					<ul>
						<li>
							<div class="sub">
								<p class="sub_1">テキスト</p>
							</div>
							テキストテキストテキストテキストテキストテキストテキストテキスト
						</li>
						<li class="clearfix">
							<div class="sub">
								<p class="sub_1">テキスト</p>
							</div>
							テキストテキストテキストテキスト
						</li>
					</ul>
				</div>
				<div class="page">
					<ol>
						<li class="page_1">1</li>
						<li class="page_2">2</li>
						<li class="page_3">3</li>
					</ol>
					<span class="page_icon"><i class="fas fa-chevron-right"></i></span>
				</div>
			</div>
			
			
		</div>
	</div>
	<footer id="footer">
	</footer>
</body>
</html>
