(function($){
    $(document).ready(function(){


    /********************************
     * 販売情報取得(初期表示)
     ********************************/
     jQuery.ajax({
		url:  '../../classes/salesList.php',
	    type: 'POST',
	    success: function(rtn) {

	        // 該当なし
	        if (rtn == 0) {
	//		            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
	//                    $("#pass_1").prop("disabled", true);
	//                    $("#pass_2").prop("disabled", true);
	//			        $('button[type="submit"]').prop("disabled", true);
	            return false;
			}else{
	            tbHanbaiJoho = JSON.parse(rtn);

				for(var i = 0; i < tbHanbaiJoho.length ; i++) {
					// データがある場合はデータをセットする
	//				if(i < tbHanbaiJoho.length){
	//					$("#apply_list"+(i+1)).show();
	//		            $("#apply_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
	//		            $("#apply_button"+(i+1)).text(tbEventJoho[i]["button_text"]);
	//				// データがない場合は非表示にする
	//				}else{
	//					$("#apply_list"+(i+1)).hide();
	//				}
				}

			}
	    },
		fail: function(rtn) {
//		$('#err_pass_1').html('システムエラーが発生しました。');
			return false;
	    },
	    error: function(rtn) {
	        return false;
	    }
	 });



    });
})(jQuery);
