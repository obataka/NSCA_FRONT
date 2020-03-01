(function ($) {
	$(document).ready(function () {

		/**
		 * 決済方法選択画面へボタン
		 */
		$('#back').click(function() {
			history.back();
		})

		/**
		 * 次へボタン
		 */
		$('#next').click(function() {
			location.href = '../cardComplete/';
		})
	});
})(jQuery);
