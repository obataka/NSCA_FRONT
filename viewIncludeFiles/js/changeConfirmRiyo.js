(function($){
    $(document).ready(function(){ 
    //会員情報取得
    jQuery.ajax({
        url:  '../../classes/updateTbkaiinJoho2.php',
        success: function(rtn) {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に情報を取得できた時、変数に入れる
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
                $merumaga_haishin_pc_email = getTbkaiinJoho[88];
                $merumaga_haishin_keitai_email = getTbkaiinJoho[89];
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
            url:  '../../classes/updateTb_kaiin_my_page_koshin_rireki.php',
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
                    
                }
            },
            fail: function(rtn) {        
                return false;
            },
            error: function(rtn) {
                return false;
            }
        });
    
        //修正した会員情報をUPDATE
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
                    hoho : $("#hoho").val(),
                },
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        
                    }
                },
                fail: function(rtn) {
                    return false;
                },
                error: function(rtn) {
                    return false;
                }
        });
    
    
        //修正後の会員情報を登録
        jQuery.ajax({
            url:  '../../classes/updateTb_kaiin_my_page_koshin_rirekiNew.php',
            type: 'POST',
            data:
            {
                kaiin_no: $kaiin_no,
                shimei: $("#name_sei").val() + $("#name_mei").val(),
                furigana: $("#sei_kana_name").val() + $("#sei_mei_name").val(),
                seinengappi: $("#seireki_name").val() + $("#month").val() + $("#day").val(),
                seibetsu_kbn: $("#wk_sel_gender").val(),
                yubin_no: $("#address_yubin_nb_1").val() + $("#yubin_nb_2").val(),
                ken_no: $("#sel_math").val(),
                chiiki_id: $("#sel_chiiki").val(),
                kemmei: $("#kenmei").val(),
                jusho_1: $("#address_shiku").val(),
                jusho_2: $("#address_tatemono").val(),
                kana_jusho_1: $("#address_yomi_shiku").val(),
                kana_jusho_2: $("#address_yomi_tatemono").val(),
                tel: $("#tel").val(),
                keitai_denwa: $("#keitai_tel").val(),
                email: $("#mail_address_1").val(),
                keitai_email: $("#mail_address_2").val(),
                merumaga : $("#merumaga").val(),
                hoho : $("#hoho").val(),
                mail: $("#mail").val(),
            },
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //エラーがない場合完了画面に画面遷移
                    location.href = '../changeComplete/'; // 通常の遷移
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
});

})(jQuery);
