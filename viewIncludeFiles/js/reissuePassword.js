(function($){
    $(document).ready(function(){

// トークン(URLパラメータ)を取得し、hiddenにセット
var param = location.search.substr(7)
$("#token").val(param);

    /********************************
     * トークンが有効かチェック(初期表示)
     ********************************/
    $.ajax({
        url:  '../../classes/checkReissuePassword.php',
        type: 'POST',
        data:
            {
                token: $("#token").val()
            }
 	})
		// Ajaxリクエストが成功した時発動
		.done( (rtn) => {
            // 会員情報、該当なし
                if (rtn == "") {

					if(param){ // トークンがある場合
			            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
					}else{ // トークンがない場合
			            $("#err_pass_1").html("ログアウトされています。ログインしてください。");
					}

                    $("#pass_1").prop("disabled", true);
                    $("#pass_2").prop("disabled", true);
			        $('button[type="submit"]').prop("disabled", true);
                    return false;
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

        /********************************
         * 次へボタン押下時のエラーチェック
         ********************************/
        $("#next_button").click(function() {
         
            //エラーメッセージエリア初期化
            $("#err_pass_1").html("");
            $("#err_pass_2").html("");
            
            var wk_focus_done = 0;

            //パスワード未入力チェック
            if ($("#pass_1").val() == "") {
                $("#err_pass_1").html("パスワードを入力してください");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_1").focus();
                    wk_focus_done = 1;
                }
            }else if($("#pass_1").val().length < 6){
                $("#err_pass_1").html("パスワードは6文字以上で入力してください");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_1").focus();
                    wk_focus_done = 1;
				}
			}
          //パスワード（確認用）未入力チェック
            if ($("#pass_2").val() == "") {
                $("#err_pass_2").html("パスワード（確認用）を入力してください");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_2").focus();
                    wk_focus_done = 1;
                }
            }
            //パスワード一致チェック
            if (wk_focus_done == 0 && $("#pass_1").val() != $("#pass_2").val()) {
                $("#err_pass_1").html("パスワードと確認のパスワードが一致しません");
                $("#err_pass_2").html("パスワードと確認のパスワードが一致しません");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_1").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_focus_done != 0) {
                console.log(111); 
                return false;
             }

        /********************************
         * トークンが有効かチェック
         ********************************/
		$.ajax({
			url:  '../../classes/checkReissuePassword.php',
			type: 'POST',
			data:{
	                token: $("#token").val()
			}
		})

		// Ajaxリクエストが成功した時発動
		.done( (rtn) => {
	                // 会員情報、該当なし
	                if (rtn == "") {

						if(param){ // トークンがある場合
				            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
						}else{ // トークンがない場合
				            $("#err_pass_1").html("ログアウトされています。ログインしてください。");
						}
		                    $("#pass_1").prop("disabled", true);
		                    $("#pass_2").prop("disabled", true);
					        $('button[type="submit"]').prop("disabled", true);
		                    return false;
					}else{

       /********************************
         * 新しいパスワードを登録
         ********************************/

		 //エラーがない場合送信完了画面に画面遷移

						$.ajax({
							url:  '../../classes/registReissuePassword.php',
							type: 'POST',
							data:{
			                    kaiin_no: rtn,
			                    pass: $("#pass_1").val()
							}
						})

						// Ajaxリクエストが成功した時発動
						.done( (rtn2) => {
		                    // rtn2 = 0 の場合は、該当なし
		                    if (rtn2 == 0) {
		                        return false;
		                    } else {
		                        //エラーがない場合送信完了画面に画面遷移
		                        location.href = '../reissuePasswordComplete/'; 
		                    }
						})

						// Ajaxリクエストが失敗した時発動
						.fail( (rtn2) => {
							$('#pass_1').html('システムエラーが発生しました。');
							return false;
						})

						// Ajaxリクエストが成功・失敗どちらでも発動
						.always( (rtn2) => {
						});


					}
		})

		// Ajaxリクエストが失敗した時発動
		.fail( (rtn) => {
			$('#err_pass_1').html('システムエラーが発生しました。');
			return false;
		})

		// Ajaxリクエストが成功・失敗どちらでも発動
		.always( (rtn) => {
		});

        return false;


        });



    });
})(jQuery);
