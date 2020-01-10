(function($){
    $(document).ready(function(){
        
        /****************
        * 退会ボタン押下時
        *****************/
        $("#leave_button").click(function() {
            
            //現在ログインしている会員の有効期限を取得する
            jQuery.ajax({
                url:  '../../classes/getTbkaiinjotai.php',
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        //※正常に情報を取得できた時入力フォームに表示する
                        getTbkaiinJotai = JSON.parse(rtn);
                        var yuko_hizuke1 = getTbkaiinJotai[0];
                        console.log(yuko_hizuke1);
                        
                        //退会書類受理日、退会理由区分、退会理由備考を更新
                        jQuery.ajax({
                            url:  '../../classes/updatekaiinjotai.php',
                            type: 'POST',
                            data:
                                {
                                    //会員情報のテーブル項目
                                    taikai_riyu_kbn: $("#sel_riyu").val(),
                                    taikai_riyu_biko: $("#textarea").val(),
                                    taikaigono_oshirase_kbn: $("#sel_annai").val(),
                                    yuko_hizuke: yuko_hizuke1,
                                },
                                success: function(rtn) {
                                    // rtn = 0 の場合は、該当なし
                                    if (rtn == 0) {
                                        return false;
                                    } else {
                                        console.log(5050);
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
            
        
 
            
            
            
            //メールアドレスを取得
            // jQuery.ajax({
            //     url:  '../../classes/getTbkaiinJoho2.php',
            //     success: function(rtn) {
            //         // rtn = 0 の場合は、該当なし
            //         if (rtn == 0) {
            //             return false;
            //         } else {
            //             //※正常に情報を取得できた時入力フォームに表示する
            //             getTbkaiinJoho = JSON.parse(rtn);
            //             //メールアドレス1受取希望
            //             $mail1 = getTbkaiinJoho[124];
            //             //メールアドレス2受取希望
            //             $mail2 = getTbkaiinJoho[126];
            //             //メールアドレス1
            //             $mail1_address = getTbkaiinJoho[27];
            //             //メールアドレス2
            //             $mail2_address = getTbkaiinJoho[28];

            //             //お知らせ受取に選択したメールアドレスに退会完了のメールを送信
            //             if ($mail1  == "") {
            //                 jQuery.ajax({
            //                     url:  '../../classes/leaveMail.php',
            //                     type: 'POST',
            //                     data:
            //                     {
            //                         //メールアドレスセット
            //                         mail: $mail1_address,
            //                     },
            //                     success: function(rtn) {
            //                         location.href = '../unsubscrideComplete/';
            //                     },
            //                     fail: function(rtn) {
            //                         return false;
            //                     },
            //                     error: function(rtn) {
            //                         return false;
            //                     }
            //                 });
            //             }
            //             if ($mail2 == "") {
            //                 jQuery.ajax({
            //                     url:  '../../classes/leaveMail.php',
            //                     type: 'POST',
            //                     data:
            //                     {
            //                         //メールアドレスセット
            //                         mail: $mail2_address,
            //                     },
            //                     success: function(rtn) {
            //                         location.href = '../unsubscrideComplete/';
            //                     },
            //                     fail: function(rtn) {
            //                         return false;
            //                     },
            //                     error: function(rtn) {
            //                         return false;
            //                     }
            //                 });
            //             }                                                       
            //         }
            //     },
            //     fail: function(rtn) {
            //         return false;
            //     },
            //     error: function(rtn) {
            //         return false;
            //     }
            // });
        });
        
        
        
        /*******************************************
        * 入力内容を修正するボタン押下時のエラーチェック
        ********************************************/
        $(".btn_gray").click(function() {
            url = '../unsubscride/';
            $('form').attr('action', url);
            $('form').submit();
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        // /********************************
        // * 次へボタン押下時のエラーチェック
        // ********************************/
        // $(".button").click(function() {  
        //     $("#error1").html("");
        //     $("#error2").html("");
        //     $("#error3").html("");
        //     var wk_err_msg = "";
        //     //退会理由のラジオボタンが選択されているかチェック
        //     if (!$("input:radio[name='riyu']:checked").val()) {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "退会理由を選択してください。";
        //         $("#error1").html(wk_err_msg);
        //     }
        //     //退会理由が入力されているかチェック
        //     var riyu = $('#taikai_riyu').val();  
        //     if (riyu == "") {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "退会の理由をお聞かせください";
        //         $("#error2").html(wk_err_msg);
        //     }
        //     //ご案内希望のラジオボタンが選択されているかチェック
        //     if (!$("input:radio[name='annai']:checked").val()) {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "ご案内希望を選択してください。";
        //         $("#error3").html(wk_err_msg);
        //     }
        //     //エラーがある場合、処理を中断する
        //     if (wk_err_msg != "") {
        //         return false;
        //     }
        //     //退会理由のvalueとtextセット
        //     if ($("input:radio[name='riyu']:checked").val()) {        
        //         var riyu = $("input:radio[name='riyu']:checked").val();
        //         $("#sel_riyu").val(riyu);
        //         var test1 = $('[name="riyu"]:checked').attr('id');
        //         var test2 = $('label[for="' + test1 + '"]').text();
        //         $('#sel_riyu_txt').val(test2);
        //     }
        //     //案内希望のvalueとtextセット
        //     if ($("input:radio[name='annai']:checked").val()) {        
        //         var annai = $("input:radio[name='annai']:checked").val();
        //         $("#sel_annai").val(annai);
        //         var test1 = $('[name="annai"]:checked').attr('id');
        //         var test2 = $('label[for="' + test1 + '"]').text();
        //         $('#sel_annai_txt').val(test2);  
        //     }        
        // });

        // /***************************************
        // * クリアボタン押下時、フォーム内をクリアする
        // ****************************************/
        // $(".btn_gray").bind("click", function(){
        //     $('textarea').val("");
        //     $('input:radio').prop("checked", false);
        // });

    });
})(jQuery);
