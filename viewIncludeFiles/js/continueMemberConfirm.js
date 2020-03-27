(function ($) {
    $(document).ready(function () {

        /*************************************************
        * 内容を修正するボタン押下時に値を保持して画面遷移する
        **************************************************/
        $("#return_button").click(function () {
            url = '../continueMember/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /******************************************
        * 次へボタン押下時にDBの値を更新して支払方法選択画面に遷移する。
        *******************************************/
        $("#next_button").click(function () {
            jQuery.ajax({
                url: '../../classes/changeMemberPost.php',
                type: 'POST',
                data:
                {
                    //会員情報のテーブル項目
                    kaiin_sbt_kbn: $("#kaiinSbt").val(),
                    shimei_sei: $("#name_sei").val(),
                    shimei_mei: $("#name_mei").val(),
                    furigana_sei: $("#name_sei_kana").val(),
                    furigana_mei: $("#name_mei_kana").val(),
                    seinengappi: $("#year").val() + $("#month").val() + $("#day").val(),
                    seibetsu_kbn: $("#wk_sel_gender").val(),
                    yubin_no: $("#yubin_nb_1").val() + $("#yubin_nb_2").val(),
                    ken_no: $("#sel_math").val(),
                    kemmei: $("#kenmei").val(),
                    jusho_1: $("#address_shiku").val(),
                    jusho_2: $("#address_tatemono").val(),
                    kana_jusho_1: $("#address_yomi_shiku").val(),
                    kana_jusho_2: $("#address_yomi_tatemono").val(),
                    tel: $("#tel").val(),
                    fax: $("#fax").val(),
                    keitai_no: $("#keitai_tel").val(),
                    url_1: $("#url").val(),
                    shokugyo_kbn_1: $("#sel_shoku_1").val(),
                    shokugyo_kbn_2: $("#sel_shoku_2").val(),
                    shokugyo_kbn_3: $("#sel_shoku_3").val(),
                    kimmusakimei: $("#office_name").val(),
                    kimmusaki_yubin_no: $("#office_yubin_nb_1").val() + $("#office_yubin_nb_2").val(),
                    kimmusaki_ken_no: $("#sel_office_math").val(),
                    kimmusaki_kemmei: $("#office_kenmei").val(),
                    kimmusaki_jusho_1: $("#office_shiku").val(),
                    kimmusaki_jusho_2: $("#office_tatemono").val(),
                    kimmusaki_tel: $("#office_tel").val(),
                    kimmusaki_fax: $("#office_fax").val(),
                    gakuseisho_filemei_1: $("#file_front").val(),
                    gakuseisho_filemei_2: $("#file_back").val(),
                    nagareyama_shimin: $("#sel_nagareyama").val(),
                    first: $("#name_first").val(),
                    last: $("#name_last").val(),
                    chiiki_id: $("#sel_chiiki").val(),
                    sel_office_chiiki: $("#sel_office_chiiki").val(),

                    //会員その他テーブルの項目
                    mail: $("#wk_sel_mail").val(),
                    merumaga: $("#wk_sel_merumaga").val(),
                    hoho: $("#wk_sel_hoho").val(),
                    yubin: $("#wk_sel_yubin").val(),
                    web: $("#wk_sel_web").val(),
                    qa: $("#wk_sel_qa").val(),

                    //会員ジャーナルテーブルの項目
                    eibun_option_kbn: $("#wk_sel_option").val(),

                    //会員選択テーブルの項目
                    meisho_cd_shikaku: $("#wk_sel_shikaku").val(),
                    meisho_cd_chiiki: $("#wk_sel_k_chiiki").val(),
                    meisho_cd_bunya: $("#wk_sel_bunya").val(),
                    biko_bunya: $("#sel_bunya_sonota").val(),
                    biko_shikaku: $("#sel_shikaku_sonota").val(),
                },

                success: function (rtn) {
                    //更新成功の場合、支払方法選択画面に遷移する。
                    console.log(1);
                    location.href = '../paymentSelect/';
                },
                fail: function (rtn) {
                    console.log(0);
                    wk_err_msg == "";
                    wk_err_msg = "会員情報の更新に失敗しました。";
                    $("#err_msg").html(wk_err_msg);
                    return false;
                },
                error: function (rtn) {
                    console.log(000);
                    wk_err_msg == "";
                    wk_err_msg = "会員情報の更新に失敗しました。";
                    $("#err_msg").html(wk_err_msg);
                    return false;
                }
            });
        });
    });
})(jQuery);