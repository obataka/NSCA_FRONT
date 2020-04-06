(function ($) {
	$(document).ready(function () {

		/************************************************************
		*商品詳細情報取得
		*************************************************************/
		var tbHanbaiJoho = [];
		$.ajax({
			url: '../../classes/product.php',
			type: 'POST',
			data: { hambai_id: $("#hambai_id").val() }
		})
		.done( (rtn) => {
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
					$('#hambai_kbn').val(tbHanbaiJoho["hambai_kbn"]);

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
						$('#price').val(tbHanbaiJoho["ippan_kakaku_zeikomi"]);

					} else { // ログイン中
						$('#login_button').hide();
						$('#buy_login_button').hide();
						$('#price_ippan').removeClass("price");
						$('#price_kaiin').addClass("price");
						$('#price_label').html(tbHanbaiJoho["kakaku_title"]);
						$('#price_kaiin').html(kakaku);
						$('#price').val(tbHanbaiJoho["kaiin_kakaku_zeikomi"]);
					}

				}
			})
			.fail( (rtn) => {
	//						$('#pass_1').html('システムエラーが発生しました。');
				return false;
			})
			.always( (rtn) => {
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

			// 会員の場合、DB、セッションに購入商品データを登録
			if (tbHanbaiJoho["kaiin_no"] != "") { 
				$.ajax({
					url: '../../classes/Common/setCartDataForKaiin.php',
					type: 'POST',
					data: {
						hambai_id: tbHanbaiJoho["hambai_id"],
						hambai_kbn: tbHanbaiJoho["hambai_kbn"],
						color_kbn: 0,
						size_kbn: 0,
						hambai_sentakushi_kbn: 0,
						kakaku: $('#price').val(),
						suryo: $('#buy_number').val()
					}
				}).done((rtn) => {
alert(rtn);
					// お買い物かご画面に遷移
//					window.location.href = '../shoppingBasket/'


				}).fail( (rtn) => {
					return false;
				});

			// 一般の場合はセッションに購入商品データを登録
			}else{

				$.ajax({
					url: '../../classes/setCartDataForIppan.php',
					type: 'POST',
					data: {
						hambai_id: $('#hambai_id').val(),
						hambai_kbn: $('#hambai_kbn').val(),
						color_kbn: 0,
						size_kbn: 0,
						hambai_sentakushi_kbn: 0,
						kakaku: $('#price').val(),
						suryo: $('#buy_number').val()
					}
				}).done((rtn) => {

					// お買い物かご画面に遷移
					window.location.href = '../shoppingBasket/'

				}).fail( (rtn) => {
					return false;
				});

			}

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
