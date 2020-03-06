(function($){
    $(document).ready(function(){


    /********************************
     * ログイン中かチェック(初期表示)
     ********************************/
		$.ajax({
	        url:  '../../classes/reissuePasswordComplete.php',
	        type: 'POST'
		})

		.done( (rtn) => {
        // 会員情報、該当なし
            if (rtn == "") {  // 未ログイン
				$('#goLogin').show();
				$('#goMypage').hide();
			}else{ // ログイン中
				$('#goLogin').hide();
				$('#goMypage').show();
			}
		})
		.fail( (rtn) => {
//			$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		.always( (rtn) => {
		});


/************************************************************
	*【ログインページへ】ボタン押下時
*************************************************************/
$('#goLogin').on('click', function() {

	window.location.href = '../login/'

});

/************************************************************
	*【マイページへ】ボタン押下時
*************************************************************/
$('#goMypage').on('click', function() {

	window.location.href = '../mypage/'

});

    });
})(jQuery);
