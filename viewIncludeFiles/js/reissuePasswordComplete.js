(function($){
    $(document).ready(function(){


    /********************************
     * ログイン中かチェック(初期表示)
     ********************************/
    jQuery.ajax({
        url:  '../../classes/reissuePasswordComplete.php',
        type: 'POST',
    success: function(rtn) {
        // 会員情報、該当なし
            if (rtn == "") {  // 未ログイン
				$('#goLogin').show();
				$('#goMypage').hide();
			}else{ // ログイン中
				$('#goLogin').hide();
				$('#goMypage').show();
			}
    },
    fail: function(rtn) {
        return false;
    },
    error: function(rtn) {
        return false;
    }
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
