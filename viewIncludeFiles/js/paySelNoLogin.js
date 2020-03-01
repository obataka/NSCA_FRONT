(function ($) {
	$(document).ready(function () {

		/**
		*** 戻るボタン押下時
		**/
		$("#__goBack").click(function () {
			var wk_folder = $("#tranScreen").val();
			url = '../' + wk_folder + '/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/**
		 * カード決済支払い開始ボタン
		 */
		$('#pay_credit_start').click(function() {
			location.href = '../cardInfoInput/'
		})

		/**
		 * コンビニ支払い開始ボタン
		 */
		$('#pay_cvs_start').click(function() {
			location.href = '../cvs/'
		})
	});
})(jQuery);
