(function($){
    $(document).ready(function(){

	/************************************************************
	*商品詳細情報取得
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/product.php',
        type: 'POST',
        data:{hambai_id: $("#hambai_id").val()},
        success: function(rtn) {
           // 商品詳細情報、該当なし
                if (rtn == 0) {
//		            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
//                    $("#pass_1").prop("disabled", true);
//                    return false;
				}else{

                    tbHanbaiJoho = JSON.parse(rtn);
                        $('#product_title').html(tbHanbaiJoho["hambai_title"]);
					var ippan_kakaku = Number(tbHanbaiJoho["ippan_kakaku_zeikomi"]).toLocaleString();
					var kakaku = Number(tbHanbaiJoho["kakaku_zeikomi"]).toLocaleString();
					var kaiin_kakaku = Number(tbHanbaiJoho["kaiin_kakaku_zeikomi"]).toLocaleString();

                    $('#product_img').attr('src', tbHanbaiJoho["gazo_url"]);
                    $('#price_ippan').html(ippan_kakaku);
                    $('#price_kaiin').html(kakaku);
                    $('#price_label').html(tbHanbaiJoho["kakaku_title"]);
                    $('#tsuiki').html(tbHanbaiJoho["hambai_title_tsuiki"]);
                    $('#gaiyo').html(tbHanbaiJoho["gaiyo"]);
                    $('#setsumei').html(tbHanbaiJoho["setsumei"]);

					for(var i = 1; i <= 4 ; i++) {

						if(tbHanbaiJoho["setsumei_gazo_url_" + i] != ""){
		                    $('#setsumei_gazo_' + i).attr('src', tbHanbaiJoho["setsumei_gazo_url_" + i]);
		                    $('#setsumei_gazo_' + i).show();
						}else{
		                    $('#setsumei_gazo_' + i).hide();
						}
					}

					if(tbHanbaiJoho["kaiin_no"] == ""){ // 未ログイン
						$('#login_button').show();
						$('#buy_login_button').show();
					}else{ // ログイン中
						$('#login_button').hide();
						$('#buy_login_button').hide();
					}

				}
        },
        fail: function(rtn) {
            return false;
        },
        error: function(rtn) {
            return false;
        }
    });


    });
})(jQuery);
