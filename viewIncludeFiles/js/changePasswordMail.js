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
                $("#err_kaiin_no").html("会員番号を入力してください。");
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#kaiin_no").focus();
                    wk_focus_done = 1;
                }
            }
            //メールアドレス未入力チェック
            if ($("#mail_address").val() == "") {
                $("#err_mail_address").html("メールアドレスを入力してください。");
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
             //エラーがない場合確認画面に画面遷移
//             url = '../confirmRiyo/';
//            $('form').attr('action', url);
            $('form').submit();

        });
    });
})(jQuery);
