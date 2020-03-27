(function ($) {
	$(document).ready(function () {

		/**
		*** 戻るボタン押下時
		**/
		$("#__goBack").click(function () {
			let folderName = $("#tranScreen").val();
			url = '../' + folderName + '/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/**
		 * カード決済支払い開始ボタンクリック処理
		 */
		$('#pay_credit_start').click(function() {

			// 決済種別を取得
			let payType = checkFregiSettle();

			switch (payType) {
				case 1:

					break;

				// *************************************************************************
				//
				// ※新規以外の決済種別の際の処理も実装すること
				//
				// *************************************************************************

				default:

			}

			location.href = '../cardInfoInput/'
		})

		/**
		 * コンビニ支払い開始ボタンクリック処理
		 */
		$('#pay_cvs_start').click(function() {
			location.href = '../cvs/'
		})

	});

	/**
	 * 決済状況のチェック処理
	 * <return>
	 * 		1 初回支払い / 2 再支払い（一度コンビニで決済後成功） / 3 再支払い（一度コンビニで決済後キャンセルか失敗） / 4 延長手続き決済
	 * 		9 ２重出願中 / 20 管理システム申込
	 * </return>
	 */
	function checkFregiSettle() {

		$.ajax({
			url: '../../classes/paymentSelect_checkFregiSettle.php',
			type: 'POST'
		})
		.done( (result) => {
			return result;
		})
		.fail( () => {
			$('#err_msg').html('システムエラーが発生しました。');
			return 0;
		});
	};

	/**
	 * 決済発行処理
	 * <return>
	 * 		成功 : true / 失敗 : false
	 * </return>
	 */
	function applyFregiCompSettle(selectMode) {

		let fregiId = getFregiId();
		if(fregiId == 0) return false;


		// F-regiデータ登録

	};

	/**
	 * Fregiデータの登録処理
	 * <return>
	 * 		成功 : true / 失敗 : false
	 * </return>
	 */
	function insertFregiData(fregiId, ) {

		$.ajax({
			url: '../../classes/paymentSelect_insertFregiData.php',
			type: 'POST',
			data: {
				shop_id: 17612,
				id: fregiId,
				pay: $('pay').val,
				username1: $('user_name_1').val,
				username2: $('user_name_2').val,
				user_name_kana_1: $('user_name_kana_1').val,
				user_name_kana_2: $('user_name_kana_2').val,
				user_tel: $('user_tel').val,
				user_id: $('user_id').val,
				auth_key: $('auth_key').val,
				item_title: $('item_title').val,
				item_name: $('item_name').val,
				item_name_kana: $('item_name_kana').val,
				expire: 14,
				char_code: 'euc',
				pay_type_specify: $('pay_type_specify').val,
				pay_mode_specify: $('pay_mode_specify').val,
				ceu_id: $('ceu_id').val,
				ceu_meisai_id: $('ceu_meisai_id').val,
				shiken_meisai_id: $('shiken_meisai_id').val,
				zenshiken_meisai_id: $('zenshiken_meisai_id').val,
				etc_id: $('etc_id').val,
				etc_meisai_id: $('etc_meisai_id').val,
				keiri_shumoku_cd_1: $('keiri_shumoku_cd_1').val,
				keiri_shumoku_cd_2: $('keiri_shumoku_cd_2').val,
				keiri_shumoku_cd_3: $('keiri_shumoku_cd_3').val,
				kaiin_no: $('kaiin_no').val,
				sakujo_flg: $('sakujo_flg').val,
				sakusei_user_id: $('sakusei_user_id').val,
				koshin_user_id: $('koshin_user_id').val
			}
		})
		.done( () => {
			return true;
		})
		.fail( () => {
			$('#err_msg').html('システムエラーが発生しました。');
			return false;
		});

	};

})(jQuery);
