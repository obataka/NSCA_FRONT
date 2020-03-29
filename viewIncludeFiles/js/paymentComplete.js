(function ($) {
	$(document).ready(function () {

		// 売上処理CGI呼び出し
		$.ajax({
			url: '../../classes/getPaymentSalesJoho.php',
			type: 'POST',
			data: {
				authCode: $('#authCode').val(),
				seqNo: $('#seqNo').val()
			}
		})

		// Ajaxリクエストが成功した時発動
		.done((data) => {
			result = JSON.parse(data);

			if (result[0] == 'OK') {
				swal('売上処理', '正常に売上処理が完了しました(' + result[1] + ')', 'success');
			}
			else {
				swal('エラー発生', '承認処理に失敗しました', 'error');
			}
		})

		/**
		 * マイページボタン
		 */
		$('#my_page').click(function() {
			location.href = '../mypage/';
		})
	});
})(jQuery);
