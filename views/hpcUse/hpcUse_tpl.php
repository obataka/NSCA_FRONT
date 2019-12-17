<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name='format-detection' content='telephone=no' />
        <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />
        <title>HPC施設利用</title>
        <!-- favicon -->
        <link rel="icon" href="../../viewIncludeFiles/image/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.css">
        <link rel="stylesheet" href="../../viewIncludeFiles/css/style.css" />
        <link rel="stylesheet" href="../../viewIncludeFiles/css/hpc_riyo.css">
	    <link rel="stylesheet" href="../../viewIncludeFiles/css/header.css">

        <script type="text/javascript" src="../../viewIncludeFiles/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="../../viewIncludeFiles/plugins/jQueryUI/jquery.ui.datepicker-ja.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/header.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/android.js"></script>
		<script type="text/javascript" src="../../viewIncludeFiles/js/footer.js"></script>
		<script>
	        $(function(){
	            $(".kigyo").css('display','none');
	            $('#sbt_2').click(function(){
	                $(".kigyo").css('display','block');
	                $(".kojin").css('display','none');
	                $(".kojin").css('display','none');
	            });
	            $('#sbt_1').click(function(){
	               $(".kigyo").css('display','none');
	                $(".kojin").css('display','block');
	            });
	        });
	    </script>
    </head>
   <body>
		<header id="header"></header>
		<div class="wrap mh_c">
			<h2 class="mb_10">施設利用</h2>
			<div class="content_wrap">
	            <div class="top_btn">
	                <button class="button price" type="button" onclick="location.href='#'"><span>ご利用金額</span></button>
	                <button class="button guide" type="button" onclick="location.href='#'"><span>ご利用ガイド</span></button>
	            </div>
	            <div class="riyo_title">
	                <input type="radio" name="sbt" id="sbt_1" checked="checked">
	                <label for="sbt_1">個人</label>
	                <input type="radio" name="sbt" id="sbt_2">
	                <label for="sbt_2">企業・団体</label>
	            </div>
	            <div class="kojin">
	                <div class="kojin_content_wrap clearfix">
	                   <img src="https://placehold.jp/150x150.png">
	                    <div class="right">
	                        <p class="title">ストレングスルームの利用</p>
	                        <p class="text">テキストテキストテキストテキスト</p>
	                        <span class="sub">NSCA会員</span>
	                        <div class="btn">
	                            <button class="button" type="button" onclick="location.href='#'"><span>詳しく見る</span></button>
	                            <button class="button" type="button" onclick="location.href='#'"><span>予約する</span></button>
	                        </div>      
	                    </div>                  
	                </div>
	                <div class="kojin_content_wrap clearfix">
	                   <img src="https://placehold.jp/150x150.png">
	                    <div class="right">
	                        <p class="title">セミナールームを利用する</p>
	                        <p class="text">テキストテキストテキストテキスト</p>
	                        <span class="sub">NSCA会員</span>
	                        <span class="sub">一般利用</span>
	                        <div class="btn">
	                            <button class="button" type="button" onclick="location.href='#'"><span>詳しく見る</span></button>
	                            <button class="button" type="button" onclick="location.href='#'"><span>予約する</span></button>
	                        </div> 
	                    </div>                  
	                </div>
	                <div class="kojin_content_wrap clearfix">
	                   <img src="https://placehold.jp/150x150.png">
	                    <div class="right">
	                        <p class="title">テキストテキストテキストテキスト</p>
	                        <p class="text">テキストテキストテキストテキスト</p>
	                        <span class="sub">NSCA会員</span>
	                        <span class="sub">一般利用</span>
	                        <div class="btn">
	                            <button class="button" type="button" onclick="location.href='#'"><span>詳しく見る</span></button>
	                            <button class="button" type="button" onclick="location.href='#'"><span>予約する</span></button>
	                        </div> 
	                    </div>                  
	                </div>
	            </div>
	            <div class="kigyo">
	                <div class="kigyo_content_wrap clearfix">
	                   <img src="https://placehold.jp/150x150.png">
	                    <div class="right">
	                        <p class="title">テキストテキストテキストテキスト</p>
	                        <p class="text">テキストテキストテキストテキスト</p>
	                        <div class="btn">
	                            <button class="button" type="button" onclick="location.href='#'"><span>詳しく見る</span></button>
	                            <button class="button" type="button" onclick="location.href='#'"><span>予約する</span></button>
	                        </div>      
	                    </div>                  
	                </div>
	                <div class="kigyo_content_wrap clearfix">
	                   <img src="https://placehold.jp/150x150.png">
	                    <div class="right">
	                        <p class="title">テキストテキストテキストテキスト</p>
	                        <p class="text">テキストテキストテキストテキスト</p>
	                        <div class="btn">
	                            <button class="button" type="button" onclick="location.href='#'"><span>詳しく見る</span></button>
	                            <button class="button" type="button" onclick="location.href='#'"><span>予約する</span></button>
	                        </div> 
	                    </div>                  
	                </div>
	            </div>
					<!--<a href="#"><button class="button button_b" type="button" value="">マイページへ</button></a>-->
			</div>
		</div>
		<footer id="footer">
		</footer>
	</body>
</html>
