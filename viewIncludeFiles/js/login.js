(function($){

    $(document).ready(function(){

        /********************************
         * ログインボタン押下処理
         ********************************/
        $("#__send").click(function() {

            // エラーメッセージエリア初期化
            $(".error").text("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            // ID未入力チェック
            if ($("#login_id").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "ログインIDが未入力です。";
                } else {
                    wk_err_msg = wk_err_msg + "<br>" + "ログインIDが未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#login_id").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがあった場合はメッセージを設定し処理終了
            if (wk_err_msg != "") {
                $(".error").html(wk_err_msg);
                return false;
            }

            // ログイン処理
            jQuery.ajax({
                url:  '../../classes/loginCtrl.php',
//                async:false,
                type: 'POST',
                data:
                {
                    loginId: $("#login_id").val(),
                    loginPswd: $("#password").val()
                },
                success: function(rtn) {
                    // rtn = 0 の場合は、該当者なし
                    if (rtn == 0) {
                        $(".error").text("ログイン情報が無効です。");
                        return false;
                    // rtn = 1 の場合は、パスワード未入力エラー
                    } else if (rtn == 1) {
                        $(".error").text("パスワードが未入力です。");
                        return false;
                    // rtn = 2 の場合は、パスワードをお忘れですか？の画面に遷移する
                    } else if (rtn == 2) {
                        location.href = '../changePasswordMail/';
                    // rtn = 3 の場合は、ログイン用のメールアドレス未設定エラー
                    } else if (rtn == 3) {
                        $(".error").text("メールアドレスの登録が必要です。事務局へお問い合わせください。");
                        return false;
                    // rtn = 4 の場合は、ログイン失敗
	                } else if (rtn == 4) {
	                    $(".error").text("ログインに失敗しました。");
	                    return false;
                    // rtn = 99 の場合は、ログイン成功で、セキュリティコード画面に画面遷移する
	                } else if (rtn == 99) {
	                    $(".error").text("ログインに成功しました。");
	                    return false;
	                }
                },
                fail: function(rtn) {
                    $(".error").text("ログイン情報が無効です。");
                    return false;
                },
                error: function(rtn) {
                    $(".error").text("ログイン情報が無効です。");
                    return false;
                }
            });
        });
    });
})(jQuery);
