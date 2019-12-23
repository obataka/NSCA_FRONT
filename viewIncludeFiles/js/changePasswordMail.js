(function($){
    $(document).ready(function(){

        /********************************
         * 送信ボタン押下時のエラーチェック
         ********************************/
        $("#send_button").click(function() {
         
            //エラーメッセージエリア初期化
            $("#err_kaiin_no").html("");
            $("#err_mail_address").html("");
            
            var wk_focus_done = 0;

            //会員番号未入力チェック
            if ($("#kaiin_no").val() == "") {
                $("#err_kaiin_no").html("会員番号を入力してください");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#kaiin_no").focus();
                    wk_focus_done = 1;
                }
            }
            //メールアドレス未入力チェック
            if ($("#mail_address").val() == "") {
                $("#err_mail_address").html("メールアドレス(PCまたは携帯)を入力してください");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#mail_address").focus();
                    wk_focus_done = 1;
                }
            }
 
            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_focus_done != 0) {
                console.log(111); 
                return false;
             }


            // 会員番号、メールアドレスがDBと一致するか確認する

        jQuery.ajax({
            url:  '../../classes/checkChangePasswordMail.php',
            type: 'POST',
            data:
	            {
	                kaiin_no: $("#kaiin_no").val(),
	                mail_address: $("#mail_address").val()
	            },
            
            success: function(rtn) {
                // 会員情報、該当なし
                if (rtn == 0) {
		            $("#err_kaiin_no").html("会員番号かメールアドレスのどちらかまたは両方が一致しません。会員番号とメールアドレスをご確認下さい。");
		            $("#err_mail_address").html("会員番号かメールアドレスのどちらかまたは両方が一致しません。会員番号とメールアドレスをご確認下さい。");
                    $("#kaiin_no").focus();
                    return false;
                } else {
            /************************************************************
            *トークンと有効期限をDBに登録し、メールを送信する 
            *************************************************************/

		             jQuery.ajax({
		                url:  '../../classes/sendChangePasswordMail.php',
		                type: 'POST',
		                data:
		                {
		                    kaiin_no: $("#kaiin_no").val(),
		                    mail_address: $("#mail_address").val()
		                },
		                success: function(rtn) {
		                    // rtn = 0 の場合は、該当なし
		                    if (rtn == 0) {
		                        return false;
		                    } else {
		                        //エラーがない場合送信完了画面に画面遷移
		                        location.href = '../changePasswordMailComplete/';       
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

        });
    });
})(jQuery);
