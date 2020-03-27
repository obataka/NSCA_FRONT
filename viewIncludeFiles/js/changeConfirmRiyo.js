(function ($) {
    $(document).ready(function () {

        //会員情報取得
        $.ajax({
            url: '../../classes/updateTbkaiinJoho2.php',
        })

            // Ajaxリクエストが成功した時発動
            .done((rtn) => {

                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {

                    //※正常に情報を取得できた時、変数に入れる
                    getTbkaiinJoho = JSON.parse(rtn);

                    $kaiin_no = getTbkaiinJoho[0];
                    $shimei = getTbkaiinJoho['shimei_sei'] + getTbkaiinJoho['shimei_mei'];
                    $furigana = getTbkaiinJoho['furigana_sei'] + getTbkaiinJoho['furigana_mei'];
                    $seinengappi = getTbkaiinJoho['seinengappi'];
                    $seibetsu_kbn = getTbkaiinJoho['seibetsu_kbn'];
                    $yubin_no = getTbkaiinJoho['yubin_no'];
                    $ken_no = getTbkaiinJoho['ken_no'];
                    $chiiki_id = getTbkaiinJoho['chiiki_id'];
                    $kemmei = getTbkaiinJoho['kemmei'];
                    $jusho_1 = getTbkaiinJoho['jusho_1'];
                    $jusho_2 = getTbkaiinJoho['jusho_2'];
                    $kana_jusho_1 = getTbkaiinJoho['kana_jusho_1'];
                    $kana_jusho_2 = getTbkaiinJoho['kana_jusho_2'];
                    $tel = getTbkaiinJoho['tel'];
                    $keitai_denwa = getTbkaiinJoho['keitai_denwa'];
                    $email = getTbkaiinJoho['email_1'];
                    $keitai_email = getTbkaiinJoho['email_2'];
                    $merumaga_haishin_pc_email = getTbkaiinJoho['email_1_merumaga_haishin'];
                    $merumaga_haishin_keitai_email = getTbkaiinJoho['email_2_merumaga_haishin'];
                    $renraku_hoho_yuso = getTbkaiinJoho['renraku_hoho_yuso'];
                    $renraku_hoho_denshi_email = getTbkaiinJoho['renraku_hoho_denshi_email'];
                }
            });

        /*************************************************
        * 内容を修正するボタン押下時に値を保持して画面遷移する
        **************************************************/
        $("#return_button").click(function () {
            url = '../changeRiyo/';
            $('form').attr('action', url);
            $('form').submit();
        });
        /******************************************
        * 次へボタン押下時にDBに修正入力した値をUPDATEする
        *******************************************/
        $("#next_button").click(function () {

            //旧区分更新処理
            $.ajax({
                url: '../../classes/updateTb_kaiin_my_page_koshin_rireki.php',
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
                }
            })
                .done((rtn) => {

                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    $('#err_msg').html('システムエラーが発生しました。');
                    return false;
                })

                // Ajaxリクエストが成功・失敗どちらでも発動
                .always((data) => {

                });

            //修正した会員情報をUPDATE
            $.ajax({
                url: '../../classes/changeRiyoPost.php',
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
                    hoho: $("#hoho").val(),
                }
            })

                // Ajaxリクエストが成功した時発動
                .done((rtn) => {

                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    $('#err_msg').html('システムエラーが発生しました。');
                    return false;
                })

                // Ajaxリクエストが成功・失敗どちらでも発動
                .always((data) => {

                });

            //修正後の会員情報を登録
            $.ajax({
                url: '../../classes/updateTb_kaiin_my_page_koshin_rirekiNew.php',
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
                    merumaga: $("#merumaga").val(),
                    hoho: $("#hoho").val(),
                    mail: $("#mail").val(),
                }
            })
                // Ajaxリクエストが成功した時発動
                .done((rtn) => {

                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    $('#err_msg').html('システムエラーが発生しました。');
                    return false;
                })

                // Ajaxリクエストが成功・失敗どちらでも発動
                .always((data) => {

                });

            // //エラーがない場合確認画面に画面遷移
            // url = '../changeComplete/';
            // $('form').attr('action', url);
            // $('form').submit();
        });
    });

})(jQuery);
