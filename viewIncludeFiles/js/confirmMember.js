(function ($) {
    $(document).ready(function () {
        /*************************************************
        * 内容を修正するボタン押下時に値を保持して画面遷移する
        **************************************************/
        $("#return_button").click(function () {
            url = '../registMember/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /******************************************
        * 次へボタン押下時にDBに入力した値をInsertする
        *******************************************/
        $("#next_button").click(function () {
            //Insert処理
            jQuery.ajax({
                url: '../../classes/registMemberPost.php',
                type: 'POST',
                data:
                {
                    //会員情報のテーブル項目
                    shimei_sei: $("#name_sei").val(),
                    shimei_mei: $("#name_mei").val(),
                    furigana_sei: $("#name_sei_kana").val(),
                    furigana_mei: $("#name_mei_kana").val(),
                    seinengappi: $("#seireki_name").val().$("#month").val().$("#day").val(),
                    seibetsu_kbn: $("#wk_sel_gender").val(),
                    ken_no: $("#sel_math").val(),
                    kemmei: $("#kenmei").val(),
                    yubin_no: $("#address_yubin_nb_1").val().$("#yubin_nb_2").val(),
                    jusho_1: $("#address_shiku").val(),
                    jusho_2: $("#address_tatemono").val(),
                    kana_jusho_1: $("#address_yomi_shiku").val(),
                    kana_jusho_2: $("#address_yomi_tatemono").val(),
                    tel: $("#tel").val(),
                    keitai_no: $("#keitai_tel").val(),
                    email_1: $("#mail_address_1").val(),
                    email_2: $("#mail_address_2").val(),
                    //会員その他テーブルの項目
                    postNo20: $("#mail").val(),
                    postNo21: $("#merumaga").val(),
                    postNo22: $("#pass_1").val(),
                    postNo23: $("#hoho").val()
                },
                success: function (rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        //※正常に会員情報を登録出来たら登録完了メールを送信する

                    }
                },
                fail: function (rtn) {
                    return false;
                },
                error: function (rtn) {
                    return false;
                }
            });
        });


    });


})(jQuery);