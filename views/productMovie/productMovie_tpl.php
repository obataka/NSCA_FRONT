<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>商品詳細確認</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/productMovie.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script>
			$(function(){
				
				$('.cscs_accordion').hide();
				$('.cscs_btn').click(function(){
					$('.cscs_accordion').slideToggle();
					$(this).toggleClass("active");
				});
				
				$('.nsca_accordion').hide();
				$('.nsca_btn').click(function(){
					$('.nsca_accordion').slideToggle();
					$(this).toggleClass("active");
				});
				$('.conference_accordion').hide();
				$('.conference_btn').click(function(){
					$('.conference_accordion').slideToggle();
					$(this).toggleClass("active");
				});
				
			});
		</script>
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap">  
		<h2>商品詳細確認</h2>
		<div class="content_wrap">	
			<div class="top_btn clearfix">
				<button class="button price" type="button" onclick="location.href='#'"><span>買い物かご</span></button>
			</div>
			<h3>CSCS動画</h3>
			<form>
				<div class="movie_wrap">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="cscs_1" type="checkbox" name="cscs" value=""><label class="checkbox" for="cscs_1">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="cscs_2" type="checkbox" name="cscs" value=""><label class="checkbox" for="cscs_2">購入する</label>
						</div>
					</div>
				</div>
				<div class="movie_wrap cscs_accordion">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="cscs_3" type="checkbox" name="cscs" value=""><label class="checkbox" for="cscs_3">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="cscs_4" type="checkbox" name="cscs" value=""><label class="checkbox" for="cscs_4">購入する</label>
						</div>
					</div>
				</div>
				<button class="button cscs_btn" type="button" value="">CSCS動画をすべて見る</button>
				
				<h3>NSCA-CPT動画</h3>
				<div class="movie_wrap">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="nsca_1" type="checkbox" name="nsca" value=""><label class="checkbox" for="nsca_1">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="nsca_2" type="checkbox" name="nsca" value=""><label class="checkbox" for="nsca_2">購入する</label>
						</div>
					</div>
				</div>
				<div class="movie_wrap nsca_accordion">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="nsca_3" type="checkbox" name="nsca" value=""><label class="checkbox" for="nsca_3">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="nsca_4" type="checkbox" name="nsca" value=""><label class="checkbox" for="nsca_4">購入する</label>
						</div>
					</div>
				</div>
				<button class="button nsca_btn" type="button" value="">NSCA-CPT動画をすべて見る</button>
				
				<h3>カンファレンス動画</h3>
				<div class="movie_wrap">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="conference_1" type="checkbox" name="conference" value=""><label class="checkbox" for="conference_1">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="conference_2" type="checkbox" name="conference" value=""><label class="checkbox" for="conference_2">購入する</label>
						</div>
					</div>
				</div>
				<div class="movie_wrap conference_accordion">
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="conference_3" type="checkbox" name="conference" value=""><label class="checkbox" for="conference_3">購入する</label>
						</div>
					</div>
					<div class="bg_gray">
						<p class="movie_title">セミナー動画タイトル</p>
						<div class="movie">
							<!----<video src=""></video>----->
							<img src="https://placehold.jp/949494/ffffff/350x220.png">
						</div>
						<p class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<section>
							<p>一般価格：00000円<span class="zei">(税込み)</span></p>
							<p>会員価格：00000円<span class="zei">(税込み)</span></p>
						</section>
						<div class="bg_white">
							<input id="conference_4" type="checkbox" name="conference" value=""><label class="checkbox" for="conference_4">購入する</label>
						</div>
					</div>
				</div>
				<button class="button conference_btn" type="button" value="">カンファレンス動画をすべて見る</button>

				
			</form>
			<p>法人・学校様は<a href="#">こちら</a><br>
				@nsca-japan.or.jpからのメールを受信できるように設定をお願いします</p>
			<section class="btn_wrap">
				<button class="button btn_gray" type="button" value="" onclick="location.href='#'"><span>商品一覧へ</span></button>
				<button class="button" type="submit" value="" onclick="location.href='#'"><span>かごに入れる</span></button>
			</section>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>
</html>
