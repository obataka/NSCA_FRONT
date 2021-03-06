(function($){
    $(document).ready(function(){
        
        /****************
        * 退会ボタン押下時
        *****************/
        $("#leave_button").click(function() {
            
            //現在ログインしている会員の有効期限を取得する
            $.ajax({
                url:  '../../classes/getTbkaiinjotai.php',
            })

            // Ajaxリクエストが成功した時発動
            .done( (rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に情報を取得できた時入力フォームに表示する
                    getTbkaiinJotai = JSON.parse(rtn);
                    var yuko_hizuke1 = getTbkaiinJotai[0];
        
                    //退会書類受理日、退会理由区分、退会理由備考、退会後のお知らせ区分を更新と有効期限のチェック
                    $.ajax({
                        url:  '../../classes/updatekaiinjotai.php',
                        type: 'POST',
                        data:
                            {
                                //会員情報のテーブル項目
                                taikai_riyu_kbn: $("#sel_riyu").val(),
                                taikai_riyu_biko: $("#textarea").val(),
                                taikaigono_oshirase_kbn: $("#sel_annai").val(),
                                yuko_hizuke: yuko_hizuke1,
                            }
                        })

                        // Ajaxリクエストが成功した時発動
                        .done( (rtn) => {
                            // rtn = 0 の場合は、該当なし
                            if (rtn == 0) {
                                return false;
                            } else {
                                location.href = "../unsubscrideComplete/";
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
            })

            // Ajaxリクエストが失敗した時発動
            .fail( (data) => {
                $('#err_msg').html('システムエラーが発生しました。');
                return false;
            })

            // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {
            });

            //     success: function(rtn) {
            //         // rtn = 0 の場合は、該当なし
            //         if (rtn == 0) {
            //             return false;
            //         } else {
            //             //※正常に情報を取得できた時入力フォームに表示する
            //             getTbkaiinJotai = JSON.parse(rtn);
            //             var yuko_hizuke1 = getTbkaiinJotai[0];
                        
            //             //退会書類受理日、退会理由区分、退会理由備考、退会後のお知らせ区分を更新と有効期限のチェック
            //             $.ajax({
            //                 url:  '../../classes/updatekaiinjotai.php',
            //                 type: 'POST',
            //                 data:
            //                     {
            //                         //会員情報のテーブル項目
            //                         taikai_riyu_kbn: $("#sel_riyu").val(),
            //                         taikai_riyu_biko: $("#textarea").val(),
            //                         taikaigono_oshirase_kbn: $("#sel_annai").val(),
            //                         yuko_hizuke: yuko_hizuke1,
            //                     },
            //                     success: function(rtn) {
            //                         // rtn = 0 の場合は、該当なし
            //                         if (rtn == 0) {
            //                             return false;
            //                         } else {
            //                             location.href = "../unsubscrideComplete/";
            //                         }
            //                     },
            //                     fail: function(rtn) {
            //                         return false;
            //                     },
            //                     error: function(rtn) {
            //                         return false;
            //                     }
            //             });                   
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

    });
})(jQuery);
