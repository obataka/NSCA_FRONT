(function ($) {
	$(document).ready(function () {

		/**
		 * 顧客情報を使用するチェックボックスイベント
		 */
		$('#usagePaymentInfo').change(function() {

			// エラーをクリアする
			$('.error').html('');

			if ($(this).prop('checked')) {

				// 顧客情報取得CGI呼び出し
				$.ajax({
					url: '../../classes/getPaymentMemberJoho.php',
					type: 'POST',
					data: {}
				})
	
				// Ajaxリクエストが成功した時発動
				.done((data) => {
					userInfo = JSON.parse(data);

					// 正常の場合
					if (userInfo['0'] == 'OK') {

						// カード番号disabled・入力設定
						$('#card_nb').val(userInfo['1']);
						$('#card_nb').prop('disabled', true);

						// 氏名disabled・入力設定
						$('#neme').val(userInfo['4']);
						$('#neme').prop('disabled', true);

						// 有効期限（月）disabled・入力設定
						$('#card_1').val(userInfo['2']);
						$('#card_1').prop('disabled', true);

						// 有効期限（年）disabled・入力設定
						$('#card_2').val(userInfo['3']);
						$('#card_2').prop('disabled', true);

						// セキュリティコードdisabled
						$('#code').prop('disabled', true);

						// 決済情報登録行非表示
						$('.registPaymentInfo').css('visibility', 'hidden');
					}

					// 異常の場合
					else {
						swal('エラー発生', '決済顧客情報取得が存在しません', 'error');
					}
				})

				// Ajaxリクエストが失敗した時発動
				.fail((data) => {
					swal('エラー発生', '決済顧客情報取得に失敗しました', 'error');
				})
			}
			else {

				// カード番号enable・空欄設定
				$('#card_nb').val('');
				$('#card_nb').prop('disabled', false);

				// 氏名enable・空欄設定
				$('#neme').val('');
				$('#neme').prop('disabled', false);

				// 有効期限（月）enable・空欄設定
				$('#card_1').val('');
				$('#card_1').prop('disabled', false);

				// 有効期限（年）enable・空欄設定
				$('#card_2').val('');
				$('#card_2').prop('disabled', false);

				// セキュリティコードenable
				$('#code').prop('disabled', false);

				// 決済情報登録行表示
				$('.registPaymentInfo').css('visibility', '');
			}
		});

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

			let wk_focus_done = 0;

			// エラーをクリアする
			$('.error').html('');

			// 顧客情報を使うのチェックボックスがon出ない場合、入力チェック
			if (!$('#usagePaymentInfo').prop('checked')) {

				// カード番号入力チェック
				if (!$("#card_nb").val()) {
					let wk_err_msg = "カード番号を入力してください";
					$("#err_card_nb").html(wk_err_msg);
	
					//エラー箇所にフォーカスを当てる
					if (wk_focus_done == 0) {
						$("#card_nb").focus();
						wk_focus_done = 1;
					}
				}
				else {

					// カード番号書式チェック
					var card_regex = new RegExp( '^[0-9]{16}$' );
					if (!$("#card_nb").val().match(card_regex)) {
						let wk_err_msg = "カード番号は数値16桁で入力してください";
						$("#err_card_nb").html(wk_err_msg);
		
						//エラー箇所にフォーカスを当てる
						if (wk_focus_done == 0) {
							$("#card_nb").focus();
							wk_focus_done = 1;
						}
					}
				}

				// 氏名未入力チェック
				if (!$("#neme").val()) {
					let wk_err_msg = "氏名を入力してください";
					$("#err_name").html(wk_err_msg);
	
					//エラー箇所にフォーカスを当てる
					if (wk_focus_done == 0) {
						$("#neme").focus();
						wk_focus_done = 1;
					}
				}

				// カード有効期限未入力チェックチェック
				if (!$("#card_1").val() || !$("#card_2").val()) {
					let wk_err_msg = "カード有効期限を入力してください";
					$("#err_card_date").html(wk_err_msg);
	
					//エラー箇所にフォーカスを当てる
					if (wk_focus_done == 0) {
						$("#card_1").focus();
						wk_focus_done = 1;
					}
				}
				else {

					// カード有効期限書式チェック
					var month_regex = new RegExp( '^(0[1-9]|1[0-2])$' );
					var year_regex = new RegExp( '^([0-9]{2})$' );
					if (!$("#card_1").val().match(month_regex) || !$("#card_2").val().match(year_regex)) {

						let wk_err_msg = "カード有効期限を正しく入力してください";
						$("#err_card_date").html(wk_err_msg);
		
						//エラー箇所にフォーカスを当てる
						if (wk_focus_done == 0) {
							$("#card_1").focus();
							wk_focus_done = 1;
						}
					}
				}

				// セキュリティコード未入力チェックチェック
				if (!$("#code").val()) {
					let wk_err_msg = "セキュリティコードを入力してください";
					$("#err_code").html(wk_err_msg);
	
					//エラー箇所にフォーカスを当てる
					if (wk_focus_done == 0) {
						$("#code").focus();
						wk_focus_done = 1;
					}
				}
			}

			// エラーが存在しない場合、トークンを発行してsubmit
			if (wk_focus_done == 0) {

				FRToken.getToken(
				  $('#shop_id').val(),
				  $('#token_key').val(),
				  {
					pan:          $('#card_nb').val(),
					expiry_mm:    $('#card_1').val(),
					expiry_yy:    $('#card_2').val(),
					cardname:     $("#neme").val(),
					scode:        $("#code").val()
				  }, receiveCallback
				);
			}
		})
	});
})(jQuery);

function receiveCallback(response) {

	// トークン処理結果が正常の場合
	if (response.result == '000') {

		// トークンを設定
		$('#token').val(response.cardobject.token)

		// 承認処理CGI呼び出し
		$.ajax({
			url: '../../classes/getPaymentAuthorizationJoho.php',
			type: 'POST',
			data: {
				token: $('#token').val(),
				pay: $('#pay').val(),
				usagePaymentInfo: $('#usagePaymentInfo').prop('checked'),
				registPaymentInfo: $('#registPaymentInfo').prop('checked'),
			}
		})

		// Ajaxリクエストが成功した時発動
		.done((data) => {
			result = JSON.parse(data);

			if (result[0] == 'OK' || result[0] == 'OUTPUT') {

				if (result[0] == 'OK') {
					$('#authCode').val(result[1])
					$('#seqNo').val(result[2])
				}

				$('#paymentCardForm').submit();
			}
			else {
				swal('エラー発生', '承認処理に失敗しました', 'error');
			}
		})

		// Ajaxリクエストが失敗した時発動
		.fail((data) => {
			swal('エラー発生', '承認処理に失敗しました', 'error');
		})
	}
	// トークン処理結果が異常の場合
	else {
		swal('エラー発生', '決済処理中にエラーが発生しました', 'error');
	}
}