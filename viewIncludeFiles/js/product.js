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


				}else{
					var price_tani = "円";
                    tbHanbaiJoho = JSON.parse(rtn);
                        $('#product_title').html(tbHanbaiJoho["hambai_title"]);
					var ippan_kakaku = Number(tbHanbaiJoho["ippan_kakaku_zeikomi"]).toLocaleString() + "円";
					var kakaku = Number(tbHanbaiJoho["kakaku_zeikomi"]).toLocaleString() + "円";
					var kaiin_kakaku = Number(tbHanbaiJoho["kaiin_kakaku_zeikomi"]).toLocaleString() + "円";

                    $('#product_img').attr('src', tbHanbaiJoho["gazo_url"]);
                    $('#price_ippan').html(ippan_kakaku);
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
	                    $('#price_ippan').addClass("price");
	                    $('#price_kaiin').removeClass("price");
	                    $('#price_label').html(tbHanbaiJoho["kaiin_kakaku_title"]);
	                    $('#price_kaiin').html(kaiin_kakaku);

					}else{ // ログイン中
						$('#login_button').hide();
						$('#buy_login_button').hide();
						$('#price_ippan').removeClass("price");
						$('#price_kaiin').addClass("price");
	                    $('#price_label').html(tbHanbaiJoho["kakaku_title"]);
	                    $('#price_kaiin').html(kakaku);
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

/************************************************************
	*【かごに入れる】ボタン押下時
*************************************************************/
$('#buy_button').on('click', function() {
//    $("#product_form").attr('action', '/sample.html');
//    $("#product_form").submit();

	alert("かごに入れる");
});

/************************************************************
	*【マイページにログインしてお買い物かごに入れる】ボタン押下時
*************************************************************/

$('#buy_login_button').click(function() {
 
    $("#product_form").attr('action', '../login/');
    $("#product_form").submit();
});



    });
})(jQuery);
