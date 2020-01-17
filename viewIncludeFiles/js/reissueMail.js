(function($){
    $(document).ready(function(){

        $.ajax({
            url:  '../../classes/getTbkaiinJoho2.php',
            
        })

        // Ajaxリクエストが成功した時発動
        .done( (rtn) => {
        
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
        
                //※正常に情報を取得できた時入力フォームに表示する
                getTbkaiinJoho = JSON.parse(rtn);
                
                //メールアドレス1受取
                $mail1 = getTbkaiinJoho[124];
        
                //メールアドレス2受取
                $mail2 = getTbkaiinJoho[126];
        
                //お知らせ受取、ログイン時に選択したメールアドレスを表示
                if ($mail1  == "") {
                    $('#mail_address').html(getTbkaiinJoho[27]);
                }
                if ($mail2 == "") {
                    $('#mail_address').html(getTbkaiinJoho[28]);
                }
                                                                         
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
        /********************************
        * 登録情報の変更ボタン押下時のエラーチェック
        ********************************/
        $(".btn_b").click(function() {

            //エラーメッセージエリア初期化
            $(".error_ul").html("");
            var wk_focus_done = 0;
            var wk_err_msg = "";

            //メールアドレス未入力チェック
            var mail_regex1 = new RegExp( '(?:[-!#-\'*+/-9=?A-Z^-~]+\.?(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*|"(?:[!#-\[\]-~]|\\\\[\x09 -~])*")@[-!#-\'*+/-9=?A-Z^-~]+(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*' );
            var mail_regex2 = new RegExp( '^[^\@]+\@[^\@]+$' );
            if ($("#mail").val().match(mail_regex1) && $("#mail").val().match( mail_regex2)) {

                // 全角チェック
                if ( $("#mail").val().match( /[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/ ) ) { 
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                    $(".error_ul").html(wk_err_msg);

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
                    $(".error_ul").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail").focus();
                        wk_focus_done = 1;
                    }
                    return false; 
                }
            } else {

                //入力フォームが空白の場合エラーメッセージを表示する
                wk_err_msg == "";
                wk_err_msg = "メールアドレスが入力されていません。";
                $(".error_ul").html(wk_err_msg);

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#mail").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            }


            //メールアドレス1の時、登録済みのメールアドレスかどうかチェックする
            if ($mail1 == "") {
                
                $.ajax({
                    url:  '../../classes/searchMailAddress1.php',
                    type: 'POST',
                    data:
                    {
                        //メールアドレスセット
                        mail: $("#mail").val(),
                    }
                })
                // Ajaxリクエストが成功した時発動
                .done( (rtn) => {
                    if (rtn == 0) {
                        //未登録の場合、メールアドレス更新                    
                        $.ajax({
                            url:  '../../classes/reissueMailAddress1.php',
                            type: 'POST',
                            data:
                            {
                                //メールアドレスセット
                                mail: $("#mail").val(),
                            }
                        })
                        // Ajaxリクエストが成功した時発動
                        .done( (rtn) => {
                            if (rtn == 0) {                   
                                return false;
                            } else {
                                //変更後、変更完了メールを変更したメールアドレスに送信           
                                $.ajax({
                                    url:  '../../classes/reissueMailCompleteSendMail.php',
                                    type: 'POST',
                                    data:
                                    {
                                        //メールアドレスセット
                                        mail: $("#mail").val(),
                                    }
                                })
                                // Ajaxリクエストが成功した時発動
                                .done( (rtn) => {
                                    location.href = '../reissueMailComplete/';
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
                        .fail( (data) => {
                            $('#err_msg').html('システムエラーが発生しました。');
                            return false;
                        })

                        // Ajaxリクエストが成功・失敗どちらでも発動
                        .always( (data) => {
                        });

                    } else {
                        //登録済みの場合エラーメッセージを表示
                        wk_err_msg == "";
                        wk_err_msg = "すでにご登録頂いているメールアドレスです。";
                        $(".error_ul").html(wk_err_msg);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail").focus();
                             wk_focus_done = 1;
                        }
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
            }


            //メールアドレス2の時、登録済みのメールアドレスかどうかチェックする
            if ($mail2 == "") {
                
                $.ajax({
                    url:  '../../classes/searchMailAddress2.php',
                    type: 'POST',
                    data:
                    {
                        //メールアドレスセット
                        mail: $("#mail").val(),
                    }
                })
                // Ajaxリクエストが成功した時発動
                .done( (rtn) => {
                    if (rtn == 0) {
                        //未登録の場合、メールアドレス更新                    
                        $.ajax({
                            url:  '../../classes/reissueMailAddress2.php',
                            type: 'POST',
                            data:
                            {
                                //メールアドレスセット
                                mail: $("#mail").val(),
                            }
                        })
                        // Ajaxリクエストが成功した時発動
                        .done( (rtn) => {
                            if (rtn == 0) {                   
                                return false;
                            } else {
                                //変更後、変更完了メールを変更したメールアドレスに送信           
                                $.ajax({
                                    url:  '../../classes/reissueMailCompleteSendMail.php',
                                    type: 'POST',
                                    data:
                                    {
                                        //メールアドレスセット
                                        mail: $("#mail").val(),
                                    }
                                })
                                // Ajaxリクエストが成功した時発動
                                .done( (rtn) => {
                                    location.href = '../reissueMailComplete/';
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
                        .fail( (data) => {
                            $('#err_msg').html('システムエラーが発生しました。');
                            return false;
                        })

                        // Ajaxリクエストが成功・失敗どちらでも発動
                        .always( (data) => {
                        });

                    } else {
                        //登録済みの場合エラーメッセージを表示
                        wk_err_msg == "";
                        wk_err_msg = "すでにご登録頂いているメールアドレスです。";
                        $(".error_ul").html(wk_err_msg);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail").focus();
                             wk_focus_done = 1;
                        }
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
            } 
            
        });
    });
})(jQuery);
