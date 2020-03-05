(function ($) {
	$(document).ready(function () {

		/************************************************************
		*商品詳細情報取得
		*************************************************************/
		var tbHanbaiJoho = [];
		jQuery.ajax({
			url: '../../classes/product.php',
			type: 'POST',
			data: { hambai_id: $("#hambai_id").val() },
			success: function (rtn) {
				// 商品詳細情報、該当なし
				if (rtn == 0) {

				} else {
					var price_tani = "円";
					tbHanbaiJoho = JSON.parse(rtn);
					console.log(tbHanbaiJoho);
					$('#product_title').html(tbHanbaiJoho["hambai_title"]);
					var ippan_kakaku = Number(tbHanbaiJoho["ippan_kakaku_zeikomi"]).toLocaleString() + "円";
					var kakaku = Number(tbHanbaiJoho["kakaku_zeikomi"]).toLocaleString() + "円";
					var kaiin_kakaku = Number(tbHanbaiJoho["kaiin_kakaku_zeikomi"]).toLocaleString() + "円";

					$('#product_img').attr('src', tbHanbaiJoho["gazo_url"]);
					$('#price_ippan').html(ippan_kakaku);
					$('#tsuiki').html(tbHanbaiJoho["hambai_title_tsuiki"]);
					$('#gaiyo').html(tbHanbaiJoho["gaiyo"]);
					$('#setsumei').html(tbHanbaiJoho["setsumei"]);

					for (var i = 1; i <= 4; i++) {

						if (tbHanbaiJoho["setsumei_gazo_url_" + i] != "") {
							$('#setsumei_gazo_' + i).attr('src', tbHanbaiJoho["setsumei_gazo_url_" + i]);
							$('#setsumei_gazo_' + i).show();
						} else {
							$('#setsumei_gazo_' + i).hide();
						}
					}

					if (tbHanbaiJoho["kaiin_no"] == "") { // 未ログイン
						$('#login_button').show();
						$('#buy_login_button').show();
						$('#price_ippan').addClass("price");
						$('#price_kaiin').removeClass("price");
						$('#price_label').html(tbHanbaiJoho["kaiin_kakaku_title"]);
						$('#price_kaiin').html(kaiin_kakaku);

					} else { // ログイン中
						$('#login_button').hide();
						$('#buy_login_button').hide();
						$('#price_ippan').removeClass("price");
						$('#price_kaiin').addClass("price");
						$('#price_label').html(tbHanbaiJoho["kakaku_title"]);
						$('#price_kaiin').html(kakaku);
					}

				}
			},
			fail: function (rtn) {
				return false;
			},
			error: function (rtn) {
				return false;
			}
		});

		/************************************************************
			*【買い物かご】ボタン押下時
		*************************************************************/
		$('#go_basket').on('click', function () {

			window.location.href = '../shoppingBasket/'

		});

		/************************************************************
			*【かごに入れる】ボタン押下時
		*************************************************************/
		$('#buy_button').on('click', function () {
			//商品を追加（データベースお買い物かごへ登録）※会員のみ
			if (tbHanbaiJoho["kaiin_no"] ) {
				jQuery.ajax({
					url: '../../classes/insertSalesCartData.php',
					type: 'POST',
					data: {
						konyu_id: $('#konyu_id').val(),
						kaiin_no: tbHanbaiJoho["kaiin_no"],
						hambai_id: tbHanbaiJoho["hambai_id"],
						color_kbn: 0,
						size_kbn: 0,
						kakaku: tbHanbaiJoho["kaiin_kakaku_zeikomi"],
						suryo: $('#buy_number').val(),
						user_id: 'chisato',
	
					}
				}).done((rtn) => {
					if (rtn == 1) {
						console.log(1);
						url = '../shoppingBasket/';
						$('form').attr('action', url);
						$('form').submit();
					} else {
						console.log(0);
						return false;
					}
				}).fail((rtn) => {
					console.log(011);
					return false;
				});
			} else {
				//セッションに値をセットして画面遷移
			}
			

			//alert("かごに入れる");
		});

		/************************************************************
			*【マイページにログインしてお買い物かごに入れる】ボタン押下時
		*************************************************************/

		$('#buy_login_button').click(function () {

			$("#product_form").attr('action', '../login/');
			$("#product_form").submit();
		});

		/************************************************************
			*【商品一覧へ】ボタン押下時
		*************************************************************/
		$('#go_salesList_button').on('click', function () {

			window.location.href = '../salesList/'

		});


	});
})(jQuery);
