<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>電子ブック検索</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/eBookSearch.css" />
		<link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.3.1.min.js"></script>
			<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
    </head>
    <body>
	<header id="header">
	</header>
	<div class="wrap mh_c">  
		<h2>電子ブック検索</h2>
		<div class="content_wrap">	
			<article>
				<div class="new_img">
					<img src="https://placehold.jp/949494/ffffff/200x250.png">
					<p>○○月○○日号</p>
				</div>
				<div class="bg_gray">
					<p class="title">検索</p>
					<section>
						<input id="search_1" type="radio" name="search" value=""><label for="search_1">キーワード検索</label><input id="search_2" type="radio" name="search" value=""><label for="search_2">全文検索</label><br>
						<input id="search" type="text" name="search" value="">
						<p class="kikan">
							期間　：　<span></span>～<span></span>
						</p>
					</section>
					
					<button class="button search" type="submit" value="" onclick="location.href='#'"><span>検索</span></button>
				</div>
			</article>
		</div>
	</div>
	<footer>
		<p><small>&copy; Copyright &copy; 2016 NSCA JAPAN. All Rights Reserved.</small></p>
	</footer>
</body>
</html>
