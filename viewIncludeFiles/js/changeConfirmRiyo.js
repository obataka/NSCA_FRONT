(function($){
    $(document).ready(function(){       
    /*************************************************
    * 内容を修正するボタン押下時に値を保持して画面遷移する
    **************************************************/   
        $("#return_button").click(function() {
            url = '../changeRiyo/';
            $('form').attr('action', url);
            $('form').submit();
        });
    /******************************************
    * 次へボタン押下時にDBに修正入力した値をUPDATEする
    *******************************************/
     $("#next_button").click(function() {
        //UPDATE処理
        jQuery.ajax({
            url:  '../../classes/changeRiyoPost.php',
            type: 'POST',
            data:
            {
                //会員情報のテーブル項目
                shimei_sei: $("#name_sei").val(),
                shimei_mei: $("#name_mei").val(),
                furigana_sei: $("#sei_kana_name").val(),
                furigana_mei: $("#sei_mei_name").val(),
                seinengappi: $("#seireki_name").val() + $("#month").val() + $("#day").val(),
                seibetsu_kbn: $("#wk_sel_gender").val(),
                ken_no: $("#sel_math").val(),
                kemmei: $("#kenmei").val(),
                yubin_no: $("#address_yubin_nb_1").val() + $("#yubin_nb_2").val(),
                jusho_1: $("#address_shiku").val(),
                jusho_2: $("#address_tatemono").val(),
                kana_jusho_1: $("#address_yomi_shiku").val(),
                kana_jusho_2: $("#address_yomi_tatemono").val(),
                tel: $("#tel").val(),
                keitai_no: $("#keitai_tel").val(),
                email_1: $("#mail_address_1").val(),
                email_2: $("#mail_address_2").val(),
                nagareyama_shimin: $("#sel_nagareyama").val(),
                chiiki_id: $("#sel_chiiki").val(),
                //会員その他テーブルの項目
                mail: $("#mail").val(),
                merumaga: $("#merumaga").val(),
            },
            
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //登録成功の場合、登録完了メールを送信する 
                    // if ($("#mail").val() == 1) {
                         console.log(12345678);
                    //     jQuery.ajax({
                    //     url:  '../../classes/registCompleteMail.php',
                    //     type: 'POST',
                    //     data:
                    //     {
                    //         //メールアドレス
                    //         email_1: $("#mail_address_1").val(),
                    //     },
                    //     success: function(rtn) {
                    //         location.href = '../completeRegist/';       
                            
                    //     },
                    //     fail: function(rtn) {
                    //         return false;
                    //     },
                    //     error: function(rtn) {
                    //         return false;
                    //     }
                    //     });
                    // } else if ($("#mail").val() == 2) {
                    //         console.log(1234567890000);                 
                    //         jQuery.ajax({
                    //         url:  '../../classes/registCompleteMail.php',
                    //         type: 'POST',
                    //         data:
                    //         {
                    //             //メールアドレス
                    //             email_2: $("#mail_address_2").val(),
                    //         },
                    //         success: function(rtn) {
                    //             location.href = '../changeComplete/';       
                    //         },
                    //         fail: function(rtn) {
                    //             return false;
                    //         },
                    //         error: function(rtn) {
                    //             return false;
                    //         }
                    //         });
                    // }       
                }
            },
            fail: function(rtn) {
                console.log(123456789);
                return false;
            },
            error: function(rtn) {
                console.log(1234567890);
                return false;
            }
            
        });
    });
    //登録完了メール送信処理

    
    
    
    //     //エラーがない場合確認画面に画面遷移
    //     url = '../completeRegist/';
    //     $('form').attr('action', url);
    //     $('form').submit();


        // // 郵便番号下未入力チェック
        //     if ($("#yubin_nb_2").val() == "") {
        //         if (wk_err_msg == "") {
        //             wk_err_msg = "郵便番号が未入力です。";
        //         }
        //         if (wk_focus_done == 0) {
        //             $("#yubin_nb_2").focus();
        //             wk_focus_done = 1;
        //         }
        //     }
        //     //郵便番号正規表現チェック
        //     var postcode = $("#address_yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
        //     var re = /^\d{3}-?\d{4}$/;
        //     var postcode = postcode.match(re);
        //     if (!postcode) {
        //         if (wk_err_msg == "") {
        //             wk_err_msg = "正しい郵便番号を半角数字で入力してください。";
        //         }
        //         if (wk_focus_done == 0) {
        //             $("#address_yubin_nb_1").focus();
        //             wk_focus_done = 1;
        //         }
        //     }

             




            //  //郵便番号検索処理
            // jQuery.ajax({
            //     url:  '../../classes/searchPostNo.php',
            //     type: 'POST',
            //     data:
            //     {
            //         postNo1: $("#address_yubin_nb_1").val(),
            //         postNo2: $("#yubin_nb_2").val()
            //     },
            //     success: function(rtn) {
            //         // rtn = 0 の場合は、該当なし
            //         if (rtn == 0) {
            //             $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //             return false;
            //         } else {
            //             //※正常に住所情報を取得できた時の処理を書く場所
            //             wk_msYubinNo = JSON.parse(rtn);
            //             $("#address_todohuken option").filter(function(index){
            //                 return $(this).text() === wk_msYubinNo[7]; 
            //             }).prop("selected", true);
            //             $("#address_shiku").val(wk_msYubinNo[8]);
            //             $("#address_tatemono").val(wk_msYubinNo[9]);
            //             $("#address_yomi_shiku").val(wk_msYubinNo[5]);
            //             $("#address_yomi_tatemono").val(wk_msYubinNo[6]);  
            //         }
            //     },
            //     fail: function(rtn) {
            //         $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //         return false;
            //     },
            //     error: function(rtn) {
            //         $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //         return false;
            //     }
            // });
        });

})(jQuery);
