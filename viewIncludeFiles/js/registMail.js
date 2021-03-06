(function($){
    $(document).ready(function(){
        /********************************
        * 送信ボタン押下時のエラーチェック
        ********************************/
        $(".button").click(function() {

            //エラーメッセージエリア初期化
            $("#err_mail").html("");
            var wk_focus_done = 0;
            var wk_err_msg = "";

            //メールアドレス未入力チェック
            if ($("#mail").val() == "") {
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレス(PCまたは携帯)を入力してください。";
                    $(".error").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
            }
            var mail_regex1 = new RegExp( '(?:[-!#-\'*+/-9=?A-Z^-~]+\.?(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*|"(?:[!#-\[\]-~]|\\\\[\x09 -~])*")@[-!#-\'*+/-9=?A-Z^-~]+(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*' );
            var mail_regex2 = new RegExp( '^[^\@]+\@[^\@]+$' );
            if ($("#mail").val().match(mail_regex1) && $("#mail").val().match( mail_regex2)) {

                // 全角チェック
                if ( $("#mail").val().match( /[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/ ) ) {
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                    $(".error").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
                    return false;
                }

                // 末尾TLDチェック（〜.co,jpなどの末尾ミスチェック用）
                if ( !$("#mail").val().match( /\.[a-z]+$/ ) ) {

                    //TDLエラー
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレスの形式が不正です。";
                    $(".error").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
                    return false;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
             }
            /************************************************************
            *アドレスとトークンと有効期限をDBに登録し、入会案内メールを送信する
            *************************************************************/
            $.ajax({
                url:  '../../classes/sendMail.php',
                type: 'POST',
                data:
                {

                    //メールアドレスセット
                    mail: $("#mail").val(),
                }
            })

            // Ajaxリクエストが成功した時発動
            .done( (rtn) => {

                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    wk_err_msg == "";
                    wk_err_msg = "入会申込メール送信処理に失敗しました。";
                    $(".error").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
                    return false;
                } else {

                    //エラーがない場合確認画面に画面遷移
                    url = '../registMailComplete/';
                    $('form').attr('action', url);
                    $('form').submit();
                }
            })

            // Ajaxリクエストが失敗した時発動
            .fail( (data) => {
                $('#err_msg').html('システムエラーが発生しました。');
                return false;
            })

            // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {
            });
        });
    });
})(jQuery);
