(function ($) {
	$(document).ready(function () {

		// コンビニ画像選択イベント
		$('.chooseConveni').click(function(){

			// コンビニ決済処理CGI呼び出し
			$.ajax({
				url: '../../classes/getPaymentCvsJoho.php',
				type: 'POST',
				data: {
					pay: $('#price').text(),
					slipNo: $('#slipNo').text(),
					customerName: $('#customerName').text(),
					phoneNo: $('#phoneNo').text(),
					conveni: $(this).attr('conveni')
				}
			})

			// Ajaxリクエストが成功した時発動
			.done((data) => {
				result = JSON.parse(data);

				if (result[0] == 'OK') {

					// コンビニを設定
					$('#conveni').val(result[4]);

					// 支払番号 or 払込票番号を設定
					$('#payNo').val(result[1]);

					// 取引番号を設定
					$('#transNo').val(result[2]);

					$('#paymentCvsForm').submit();

				}
				else {
					swal('エラー発生', '承認処理に失敗しました', 'error');
				}
			})
			.fail((data) => {
				swal('エラー発生', '決済顧客情報取得に失敗しました', 'error');
			})
		});

		/**
		 * 決済方法選択画面へボタン
		 */
		$('#back').click(function() {
			history.back();
		})
	});
})(jQuery);
