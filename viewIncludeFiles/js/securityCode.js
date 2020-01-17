(function($){

	$(document).ready(function(){

		// エラーメッセージエリア初期化
		$(".error").text("");

		// ログインへリンク非表示
		$(".to_login").hide();

		/**
		 ** 確認ボタン押下処理
		 **/
		$("#__send").click(function() {

			// エラーメッセージエリア初期化
			$(".error").text("");

			// ログインへリンク非表示
			$(".to_login").hide();

			var wk_focus_done = 0;
			var wk_err_msg = "";

			// セキュリティコード未入力チェック
			if ($("#security_code_id").val() == "") {
				if (wk_err_msg == "") {
					wk_err_msg = "セキュリティコードが未入力です。";
				} else {
					wk_err_msg = wk_err_msg + "<br>" + "セキュリティコードが未入力です。";
				}
				if (wk_focus_done == 0) {
					$("#security_code_id").focus();
					wk_focus_done = 1;
				}
			}

			// エラーがあった場合はメッセージを設定し処理終了
			if (wk_err_msg != "") {
				$(".error").html(wk_err_msg);
				return false;
			}

			// ログイン認証処理
			$.ajax({
				url:  '../../classes/loginAuth.php',
				type: 'POST',
				data:{
					securityCodeId: $("#security_code_id").val()
				}
			})

			// Ajaxリクエストが成功した時発動
			.done( (rtn) => {
				// rtn = 0 の場合、ログイン認証に失敗
				if (rtn == 0) {
					$(".error").text("ログイン認証に失敗しました。ログインをやり直して下さい。");
					$(".to_login").show();
					return false;
				// rtn = 1 の場合は、有効期限超過
				} else if (rtn == 1) {
					$(".error").text("セキュリティコードの有効期限が切れています。ログインをやり直して下さい。");
					$(".to_login").show();
					return false;
				// rtn = 2 の場合は、セキュリティコードミス
				} else if (rtn == 2) {
					$(".error").text("セキュリティコードが間違っています。ログインをやり直して下さい。");
					$(".to_login").show();
					return false;
				// rtn = 99 の場合は、ログイン認証成功 → マイページへ
				} else if (rtn == 99) {
					location.href = '../mypage/';
				}
			})

			// Ajaxリクエストが失敗した時発動
			.fail( (rtn) => {
				$(".error").text("ログイン情報が無効です。");
				return false;
			})

			// Ajaxリクエストが成功・失敗どちらでも発動
			.always( (rtn) => {
			});
		});
	});
})(jQuery);
