$(function(){

	/*var header_html = '<div class="logo_img clearfix">'
	+	'<p class="logo"><img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png"></p>'
	+	'<ul class="dropdown sp_none">'
	+		'<li><a href="../mypage/" class="underline"><i class="fas fa-home"></i></a></li>'
	+		'<li><span class="active">試験<i class="fas fa-angle-down fa-fw"></i></span>'
	+			'<ul class="dropdown_list">'
	+				'<li><a href="../selectCSCSCPT/">出願</a></li>'
	+				'<li><a href="../checkEntryStatus/">出願状況</a></li>'
	+			'</ul>'
	+		'</li>'
	+		'<li><span class="active">CEU情報<i class="fas fa-angle-down fa-fw"></i></span>'
	+			'<ul class="dropdown_list">'
	+				'<li><a href="../ceuGetList/">CEU取得状況</a></li>'
	+				'<li><a href="../ceuQuizlist/">CEUクイズ</a></li>'
	+			'</ul>'
	+		'</li>'
	+		'<li><a class="underline" href="../seminarList/">イベント</a></li>'
	+		'<li><a class="underline">会員限定</a></li>'
	+		'<li><a class="underline" href="../salesList/">NCSAショップ</a></li>'
	+		'<li><span class="active"><i class="fas fa-user-circle fa-fw"></i><span class="user_name">〇〇　〇〇</span>様<i class="fas fa-angle-down fa-fw"></i></span>'
	+			'<ul class="dropdown_list">'
	+				'<li><a href="../changeMember/">登録情報変更</a></li>'
	+				'<!--<li><a href="../changeMail/">メールアドレス変更</a></li>-->'
	+				'<li><a href="../changePasswordMail/">パスワード変更</a></li>'
	+				'<li><a href="#">ログアウト</a></li>'
	+			'</ul>'
	+		'</li>'
	+	'</ul>'
	+'</div>'
	+'<div class="inner pc_none">'
    +    '<div id="mobile-head">'
    +        '<div id="nav-toggle">'
	+			'<span></span>'
	+			'<span></span>'
	+			'<span></span>'
	+			'<p>menu</p>'
    +        '</div>'
    +    '</div>'
    +    '<nav id="global-nav">'
	+		'<div class="sp_nav">'
	+			'<p><a href="#"><i class="fas fa-home"></i></a></p>'
	+			'<p class="dropdown"><a href="#">試験<i class="fas fa-angle-down fa-fw"></i></a></p>'
	+			'<div class="dropdown_list_sp">'
	+				'<p><a href="#">出願</a></p>'
	+				'<p><a href="#">出願状況</a></p>'
	+			'</div>'
	+			'<p class="dropdown"><a href="#">CEU情報<i class="fas fa-angle-down fa-fw"></i></a></p>'
	+			'<div class="dropdown_list_sp">'
	+				'<p><a href="#">CEU取得状況</a></p>'
	+				'<p><a href="#">CEUクイズ</a></p>'
	+			'</div>'
	+			'<p><a href="#">イベント</a></li>'
	+			'<p><a href="#">会員限定</a></li>'
	+			'<p><a href="#">NCSAショップ</a></li>'
	+			'<p class="dropdown"><a href="#"><i class="fas fa-user-circle fa-fw"></i><span class="user_name">〇〇　〇〇</span>様<i class="fas fa-angle-down fa-fw"></i></a></p>'
	+			'<div class="dropdown_list_sp">'
	+				'<p><a href="#">登録情報変更</a></p>'
	+				'<!--<p><a href="#">メールアドレス変更</a></p>-->'
	+				'<p><a href="#">パスワード変更</a></p>'
	+				'<p><a href="#">ログアウト</a></p>'
	+			'</div>'
	+		'</div>'
    +   '</nav>'
    '</div>'

	var header_logo_html =
	'<div class="">'
	+	'<img src="../../viewIncludeFiles/image/NSCA_Japan_rev.png" alt="NSCAジャパン">'
	+'</div>';*/

	//$("#header").html(header_html);
	//$(".header_logo").html(header_logo_html);

	$('.dropdown li').mouseover(function() {
		$("ul:not(:animated)", this).slideDown();
	}).mouseout(function() {
		$("ul.dropdown_list",this).slideUp();
	});

	var header = $('#header');
	// Nav Fixed
	$(window).scroll(function() {
		if ($(window).scrollTop() > 350) {
			header.addClass('fixed');
		} else {
			header.removeClass('fixed');
		}
	});
	// Nav Toggle Button
	$('#nav-toggle').click(function(){
		header.toggleClass('open');
		$('#global-nav').slideToggle();
		$('.dropdown_list_sp').hide();
	});

	$('#global-nav').hide();
	$('.open').click(function(){
		$('#global-nav').slideToggle();

	});

	$('.dropdown_list_sp').hide();
	$('.dropdown').click(function(){
		$('.fa-angle-down',this).toggleClass("down");
		$(this).next('.dropdown_list_sp').slideToggle();

		$('.dropdown_list_sp').not($(this).next('.dropdown_list_sp')).slideUp(function(){
			$(this).prev('.dropdown').find('.fa-angle-down').removeClass("down");
		});

	});
		//$(this).not($(this).find(".dropdown_list_sp")).slideUp();





});
