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
			let payMode = checkFregiSettle();

			switch (payMode) {
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



})(jQuery);
