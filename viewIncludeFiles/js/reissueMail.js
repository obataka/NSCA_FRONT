(function($){
    $(document).ready(function(){
        jQuery.ajax({
            url:  '../../classes/getTbkaiinJoho2.php',
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に情報を取得できた時入力フォームに表示する
                    getTbkaiinJoho = JSON.parse(rtn);
                    console.log(getTbkaiinJoho);
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
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
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
                console.log(0);
                // 全角チェック
                if ( $("#mail").val().match( /[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/ ) ) { 
                    console.log(1);
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
                    console.log(2);
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
                console.log(3);
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
                console.log(020202);
                return false;
            }


            //メールアドレス1の時、登録済みのメールアドレスかどうかチェックする
            if ($mail1 == "") {
                console.log(01010101010101);
                
                jQuery.ajax({
                    url:  '../../classes/searchMailAddress1.php',
                    type: 'POST',
                    data:
                    {
                        //メールアドレスセット
                        mail: $("#mail").val(),
                    },
                    success: function(rtn) {
                        if (rtn == 0) {
                            //未登録の場合メールアドレス更新                    
                            jQuery.ajax({
                                url:  '../../classes/reissueMailAddress1.php',
                                type: 'POST',
                                data:
                                {
                                    //メールアドレスセット
                                    mail: $("#mail").val(),
                                },
                                success: function(rtn) {
                                    console.log(rtn);
                                    if (rtn == 0) {   
                                        console.log(44444);                 
                                        return false;
                                    } else {
                                        //変更後、変更完了メールを変更したメールアドレスに送信           
                                        jQuery.ajax({
                                            url:  '../../classes/reissueMailCompleteSendMail.php',
                                            type: 'POST',
                                            data:
                                            {
                                                //メールアドレスセット
                                                mail: $("#mail").val(),
                                            },
                                            success: function(rtn) {
                                                location.href = '../reissueMailComplete/';
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
                    },
                    fail: function(rtn) {
                        return false;
                    },
                    error: function(rtn) {
                        return false;
                    }
                });
            }


            //メールアドレス2の時、登録済みのメールアドレスかどうかチェックする
            if ($mail2 == "") {
                console.log(02020202020202);
                
                jQuery.ajax({
                    url:  '../../classes/searchMailAddress2.php',
                    type: 'POST',
                    data:
                    {
                        //メールアドレスセット
                        mail: $("#mail").val(),
                    },
                    success: function(rtn) {
                        //登録済みの場合エラーメッセージを表示
                        console.log(rtn);
                        if (rtn == 0) {                    
                            //未登録の場合メールアドレス更新                    
                            jQuery.ajax({
                                url:  '../../classes/reissueMailAddress2.php',
                                type: 'POST',
                                data:
                                {
                                    //メールアドレスセット
                                    mail: $("#mail").val(),
                                },
                                success: function(rtn) {
                                    console.log(rtn);
                                    if (rtn == 0) {   
                                        console.log(44444);                 
                                        return false;
                                    } else {
                                        //変更後、変更完了メールを変更したメールアドレスに送信           
                                        jQuery.ajax({
                                            url:  '../../classes/reissueMailCompleteSendMail.php',
                                            type: 'POST',
                                            data:
                                            {
                                                //メールアドレスセット
                                                mail: $("#mail").val(),
                                            },
                                            success: function(rtn) {
                                                location.href = '../reissueMailComplete/';
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
                        } else {
                            //入力フォームが空白の場合エラーメッセージを表示する
                            wk_err_msg == "";
                            wk_err_msg = "すでにご登録頂いているメールアドレスです。";
                            $(".error_ul").html(wk_err_msg);
                            //エラー箇所にフォーカスを当てる
                            if (wk_focus_done == 0) {
                                $("#mail").focus();
                                wk_focus_done = 1;
                            }
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
            
        });





            // if ($("#mail").val() == "") {
            //         wk_err_msg == "";
            //         wk_err_msg = "メールアドレスを入力してください。";
            //         $("#err_mail").html(wk_err_msg);
            //         //エラー箇所にフォーカスを当てる
            //         if (wk_focus_done == 0) {
            //             $("#mail").focus();
            //             wk_focus_done = 1;
            //         }
            // }

            
        //     /************************************************************
        //     *アドレスとトークンと有効期限をDBに登録し、入会案内メールを送信する 
        //     *************************************************************/
        //      jQuery.ajax({
        //         url:  '../../classes/sendMail.php',
        //         type: 'POST',
        //         data:
        //         {
        //             //メールアドレス
        //             mail: $("#mail").val(),
        //         },
        //         success: function(rtn) {
        //             // rtn = 0 の場合は、該当なし
        //             if (rtn == 0) {
        //                 console.log(774);
        //                 return false;
        //             } else {
        //                 console.log(777);
        //                 //エラーがない場合送信完了画面に画面遷移
        //                 location.href = '../registMailComplete/';       
        //             }
        //         },
        //         fail: function(rtn) {
        //             return false;
        //         },
        //         error: function(rtn) {
        //             return false;
        //         }
        //     });
        //     //  //エラーがない場合送信完了画面に画面遷移
        //     //  url = '../registMailComplete/';
        //     // $('form').attr('action', url);
        //     // $('form').submit();
        // });
    });
})(jQuery);
