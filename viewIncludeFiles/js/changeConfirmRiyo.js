(function($){
    $(document).ready(function(){ 
    //旧区分更新
    jQuery.ajax({
        url:  '../../classes/updateTbkaiinJoho.php',
        success: function(rtn) {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に情報を取得できた時入力フォームに表示する
                getTbkaiinJoho = JSON.parse(rtn);
                $kaiin_no = getTbkaiinJoho[0];
                $shimei = getTbkaiinJoho[7] + getTbkaiinJoho[8];
                $furigana = getTbkaiinJoho[10] + getTbkaiinJoho[11];           
                $seinengappi = getTbkaiinJoho[13];
                $seibetsu_kbn = getTbkaiinJoho[14];
                $yubin_no = getTbkaiinJoho[15];
                $ken_no = getTbkaiinJoho[16];
                $chiiki_id = getTbkaiinJoho[17];
                $kemmei = getTbkaiinJoho[18];
                $jusho_1 = getTbkaiinJoho[19];
                $jusho_2 = getTbkaiinJoho[20];
                $kana_jusho_1 = getTbkaiinJoho[21];
                $kana_jusho_2 = getTbkaiinJoho[22];
                $tel = getTbkaiinJoho[23];
                $keitai_denwa = getTbkaiinJoho[24];
                $email = getTbkaiinJoho[27];
                $keitai_email = getTbkaiinJoho[28];
                $merumaga_haishin_pc_email = getTbkaiinJoho[87];
                $merumaga_haishin_keitai_email = getTbkaiinJoho[88];
                $renraku_hoho_yuso = getTbkaiinJoho[86];
                $renraku_hoho_denshi_email = getTbkaiinJoho[87];
            }
        },
        fail: function(rtn) {
            return false;
        },
        error: function(rtn) {
            return false;
        }
    });      
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
        //旧区分更新処理
        jQuery.ajax({
            url:  '../../classes/updateMyPage.php',
            type: 'POST',
            data:
            {
                kaiin_no: $kaiin_no,
                shimei: $shimei,
                furigana: $furigana,
                seinengappi: $seinengappi,
                seibetsu_kbn: $seibetsu_kbn,
                yubin_no: $yubin_no,
                ken_no: $ken_no,
                chiiki_id: $chiiki_id,
                kemmei: $kemmei,
                jusho_1: $jusho_1,
                jusho_2: $jusho_2,
                kana_jusho_1: $kana_jusho_1,
                kana_jusho_2: $kana_jusho_2,
                tel: $tel,
                keitai_denwa: $keitai_denwa,
                email: $email,
                keitai_email: $keitai_email,
                merumaga_haishin_pc_email: $merumaga_haishin_pc_email,
                merumaga_haishin_keitai_email: $merumaga_haishin_keitai_email,
                renraku_hoho_yuso: $renraku_hoho_yuso,
                renraku_hoho_denshi_email: $renraku_hoho_denshi_email,
            },
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                
                if (rtn == 0) {
                    return false;
                } else {
                    //登録成功の場合、登録完了メールを送信する 
                    // if ($("#mail").val() == 1) {
                       
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
                console.log(1313131313);
                
                return false;
            },
            error: function(rtn) {
                console.log(090909090909);
                
                return false;
            }
            
        });
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
                return false;
            },
            error: function(rtn) {
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
