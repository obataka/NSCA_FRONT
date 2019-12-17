(function($){
    $(document).ready(function(){
        /********************************
        * 送信ボタン押下時のエラーチェック
        ********************************/
        $("#send_button").click(function() {
            console.log(11111);
            //エラーメッセージエリア初期化
            $("#err_mail").html("");
            var wk_focus_done = 0;
            var wk_err_msg = "";
            //メールアドレス未入力チェック
            if ($("#mail").val() == "") {
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレス(PCまたは携帯)を入力してください。";
                    $("#err_mail").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
            }
            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                console.log(111); 
                return false;
             }
            /************************************************************
            *アドレスとトークンと有効期限をDBに登録し、入会案内メールを送信する 
            *************************************************************/
             jQuery.ajax({
                url:  '../../classes/sendMail.php',
                type: 'POST',
                data:
                {
                    //メールアドレス
                    mail: $("#mail").val(),
                },
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        console.log(774);
                        return false;
                    } else {
                        console.log(777);
                        //エラーがない場合送信完了画面に画面遷移
                        location.href = '../registMailComplete/';       
                    }
                },
                fail: function(rtn) {
                    return false;
                },
                error: function(rtn) {
                    return false;
                }
            });
            //  //エラーがない場合送信完了画面に画面遷移
            //  url = '../registMailComplete/';
            // $('form').attr('action', url);
            // $('form').submit();
        });
    });
})(jQuery);
