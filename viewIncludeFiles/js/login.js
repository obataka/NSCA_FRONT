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

            // パスワード未入力チェック
            if ($("#password").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "パスワードが未入力です。";
                } else {
                    wk_err_msg = wk_err_msg + "<br>" + "パスワードが未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#password").focus();
                    wk_focus_done = 1;
                }
            }

            if (wk_err_msg != "") {
                $(".error").html(wk_err_msg);
                return false;
            }

            var wk_sts = 0;

            // ログイン処理
            jQuery.ajax({
                url:  '../../classes/loginCtrl.php',
                type: 'POST',
                async:false,
                data:
                {
                    loginId: $("#login_id").val(),
                    loginPswd: $("#password").val()
                },
                success: function(rtn) {
                    // rtn = 0 の場合は、該当者なし
                    if (rtn == 0) {
                        $(".error").text("ログイン情報が無効です");
                        wk_sts = 1;
                        return false;
                    }
                },
                fail: function(rtn) {
                    $(".error").text("ログイン情報が無効です");
                    wk_sts = 1;
                    return false;
                },
                error: function(rtn) {
                    $(".error").text("ログイン情報が無効です");
                    wk_sts = 1;
                    return false;
                }
            });

            if (wk_sts == 1) {
                return false;
            }
        });
    });
})(jQuery);
