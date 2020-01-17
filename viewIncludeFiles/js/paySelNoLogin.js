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
	});
})(jQuery);
