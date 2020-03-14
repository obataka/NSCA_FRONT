(function($){
    $(document).ready(function(){

	/************************************************************
	*商品詳細情報取得
	*************************************************************/
		$.ajax({
			url: '../../classes/productMovie.php',
	        type: 'POST',
	        data:{
				hambai_id: $("#hambai_doga_id").val()
				,doga_id: $("#doga_id").val()
			}
		})
		.done( (rtn) => {

           // 商品詳細情報、該当なし
                if (rtn == 0) {

				}else{
					var price_tani = "円";
                    tbHanbaiJoho = JSON.parse(rtn);
                        $('#product_title').html(tbHanbaiJoho["hambai_title"]);
					var kakaku = Number(tbHanbaiJoho["kakaku_zeikomi"]).toLocaleString() + "円";

                    $('#product_img').attr('src', tbHanbaiJoho["gazo_url"]);
                    $('#hambai_kikan').html(tbHanbaiJoho["hambai_kikan"]);
                    $('#price_kaiin').html(kakaku);
                    $('#gaiyo').html(tbHanbaiJoho["gaiyo"]);

					for(var i = 1; i <= 4 ; i++) {

						if(tbHanbaiJoho["setsumei_gazo_url_" + i] != ""){
		                    $('#setsumei_gazo_' + i).attr('src', tbHanbaiJoho["setsumei_gazo_url_" + i]);
		                    $('#setsumei_gazo_' + i).show();
						}else{
		                    $('#setsumei_gazo_' + i).hide();
						}
					}

				}
		})
		.fail( (rtn) => {
//			$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		.always( (rtn) => {
		});

/************************************************************
	*【買い物かご】ボタン押下時
*************************************************************/
$('#go_basket').on('click', function() {

	window.location.href = '../shoppingBasket/'

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
	*【商品一覧へ】ボタン押下時
*************************************************************/
$('#go_salesList_button').on('click', function() {

	window.location.href = '../salesList/'

});

    });
})(jQuery);
