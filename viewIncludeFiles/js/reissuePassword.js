(function($){
    $(document).ready(function(){

// トークン(URLパラメータ)を取得し、hiddenにセット
var param = location.search.substr(7)
$("#token").val(param);


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
        jQuery.ajax({
            url:  '../../classes/checkReissuePassword.php',
            type: 'POST',
            data:
	            {
	                token: $("#token").val()
	            },
            success: function(rtn) {


                // 会員情報、該当なし
	                if (rtn == 0) {
			            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
	                    $("#pass_1").focus();
	                    return false;
					}else{



        /********************************
         * 新しいパスワードを登録
         ********************************/

		 //エラーがない場合送信完了画面に画面遷移

			             jQuery.ajax({
			                url:  '../../classes/registReissuePassword.php',
			                type: 'POST',
			                data:
			                {
			                    kaiin_no: rtn,
			                    pass: $("#pass_1").val()
			                },
			                success: function(rtn) {
			                    // rtn = 0 の場合は、該当なし
			                    if (rtn == 0) {
			                        return false;
			                    } else {
			                        //エラーがない場合送信完了画面に画面遷移
			                        location.href = '../reissuePasswordComplete/';       
			                    }
			                },
			                fail: function(rtn) {
			                    return false;
			                },
			                error: function(rtn) {
			                    return false;
			                }
			            });

					}

                },
                fail: function(rtn) {
                    return false;
                },
                error: function(rtn) {
                    return false;
                }
            });


	                    return false;


//alert("入力チェックOK");
        });
    });
})(jQuery);
