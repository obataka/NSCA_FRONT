(function($){

	$(document).ready(function(){

		$('#err_msg').html('');

		/**
		*** 内容を修正するボタン押下時に値を保持して画面遷移する
		**/
		$("#return_button").click(function() {
			url = '../registRiyo/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/**
		*** 次へボタン押下時にDBに入力した値をInsertする
		**/
		 $("#next_button").click(function() {

			$('#err_msg').html('');

			// Insert処理
			 $.ajax({
				url:  '../../classes/registRiyoPost.php',
				type: 'POST',
				data:{
					// 会員情報のテーブル項目
					shimei_sei: $("#name_sei").val(),
					shimei_mei: $("#name_mei").val(),
					furigana_sei: $("#sei_kana_name").val(),
					furigana_mei: $("#sei_mei_name").val(),
					seinengappi: $("#seireki_name").val() + $("#month").val() + $("#day").val(),
					seibetsu_kbn: $("#wk_sel_gender").val(),
					ken_no: $("#sel_math").val(),
					kemmei: $("#kenmei").val(),
					yubin_no: $("#address_yubin_nb_1").val() + $("#yubin_nb_2").val(),
					jusho_1: $("#address_shiku").val(),
					jusho_2: $("#address_tatemono").val(),
					kana_jusho_1: $("#address_yomi_shiku").val(),
					kana_jusho_2: $("#address_yomi_tatemono").val(),
					tel: $("#tel").val(),
					keitai_no: $("#keitai_tel").val(),
					email_1: $("#mail_address_1").val(),
					email_2: $("#mail_address_2").val(),
					nagareyama_shimin: $("#sel_nagareyama").val(),
					chiiki_id: $("#sel_chiiki").val(),
					my_page_password: $("#pass_1").val(),
					//会員その他テーブルの項目
					mail: $("#mail").val(),
					merumaga: $("#merumaga").val(),
					wk_sel_mail_login: $("#wk_sel_mail_login").val(),
				}
			})

			// Ajaxリクエストが成功した時発動
			.done( (rtn) => {

				// rtn = 0 の場合は、エラー
				if (rtn == 0) {
					$('#err_msg').html('システムエラーが発生しました。');
					return false;

				// rtn = 0 以外の場合は、処理続行
				} else {

					// 登録成功の場合、登録完了メールを送信する
					var wk_email;
					if ($("#mail").val() == 1) {
						wk_email = $("#mail_address_1").val();
					} else if ($("#mail").val() == 2) {
						wk_email = $("#mail_address_2").val();
					} else {
						$('#err_msg').html('システムエラーが発生しました。');
						return false
					}

					$.ajax({
						url:  '../../classes/registCompleteMail.php',
						type: 'POST',
						data:{
							//メールアドレス
							email: wk_email
						}
					})

					// Ajaxリクエストが成功した時発動
					.done( (data) => {
						location.href = '../completeRegist/';
					})

					// Ajaxリクエストが失敗した時発動
					.fail( (data) => {
						$('#err_msg').html('システムエラーが発生しました。');
						return false;
					})

					// Ajaxリクエストが成功・失敗どちらでも発動
					.always( (data) => {
					});
				}
			})

			// Ajaxリクエストが失敗した時発動
			.fail( (rtn) => {
				$('#err_msg').html('システムエラーが発生しました。');
				return false;
			})

			// Ajaxリクエストが成功・失敗どちらでも発動
			.always( (rtn) => {
			});
		});
	});
})(jQuery);
