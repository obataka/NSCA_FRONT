(function ($) {
    $(document).ready(function () {

        /****************
        *会員情報を取得
        *****************/
        $.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            // rtn = 0 の場合
            if (rtn == 0) {
                return false;

            } else {
                getKaiinJoho = JSON.parse(rtn);
                //会員情報を表示する
                $('#kaiin_no').text(getKaiinJoho[0]);
                $('#shimei').text(getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei']);
                $('#furigana').text(getKaiinJoho['furigana_sei'] + ' ' + getKaiinJoho['furigana_mei']);
                $('#tel').text(getKaiinJoho['tel']);

                //アドレスを変数に格納する
                var mail_1 = getKaiinJoho['email_1'];
                var mail_2 = getKaiinJoho['email_2'];

                //TB会員その他取得
                jQuery.ajax({
                    url: '../../classes/getTbkaiinSonota.php',
                }).done((rtn) => {
                    getKaiinSonota = JSON.parse(rtn);

                    //お知らせ受信用のアドレスを表示
                    if (getKaiinSonota['email_1_oshirase_uketori'] != "") {
                        $('#address').text(mail_1);
                    } else if (getKaiinSonota['email_2_oshirase_uketori'] != "") {
                        $('#address').text(mail_2);
                    }

                }).fail((rtn) => {
                    return false;
                });


            }
        }).fail((rtn) => {
            return false;
        });

        /****************
        *CEU取得状況を取得
        *****************/
        $.ajax({
            url: '../../classes/getCeuSyutokuJokyo.php',
        }).done((rtn) => {
            // rtn = 0 の場合
            if (rtn == 0) {
                return false;

            } else {
                getCeuSyutokuJokyo = JSON.parse(rtn);

                //CSCSCEU数
                var cscs_hitsuyo = getCeuSyutokuJokyo[0]['hitsuyo_ceusu'];
                var dig = Number(cscs_hitsuyo);
                var cscs_hitsuyo_num = dig.toFixed(2);
                $('#cscs_hitsuyo').text(cscs_hitsuyo_num);

                //CSCSカテゴリーA合計値
                var cscs_category_a = getCeuSyutokuJokyo[0]['category_a_gokei'];
                var dig = Number(cscs_category_a);
                var cscs_a_num = dig.toFixed(2);
                $('#cscs_category_a').text(cscs_a_num);
                var cscs_category_a_val = $('#cscs_category_a').text();

                //CSCSカテゴリーB合計値
                var cscs_category_b = getCeuSyutokuJokyo[0]['category_b_gokei'];
                var dig = Number(cscs_category_b);
                var cscs_b_num = dig.toFixed(2);
                $('#cscs_category_b').text(cscs_b_num);
                var cscs_category_b_val = $('#cscs_category_b').text();

                //CSCSカテゴリーC合計値
                var cscs_category_c = getCeuSyutokuJokyo[0]['category_c_gokei'];
                var dig = Number(cscs_category_c);
                var cscs_c_num = dig.toFixed(2);
                $('#cscs_category_c').text(cscs_c_num);
                var cscs_category_c_val = $('#cscs_category_c').text();


                //CSCSカテゴリーD合計値
                var cscs_category_d = getCeuSyutokuJokyo[0]['category_d_gokei'];
                var dig = Number(cscs_category_d);
                var cscs_d_num = dig.toFixed(2);
                $('#cscs_category_d').text(cscs_d_num);
                var cscs_category_d_val = $('#cscs_category_d').text();

                //CSCS現在取得CEU
                var cscs_genzai = getCeuSyutokuJokyo[0]['genzai_shutoku_ceusu'];
                var dig = Number(cscs_genzai);
                var cscs_genzai_num = dig.toFixed(2);
                $('#cscs_genzai').text(cscs_genzai_num);

                //CSCS残りCEU計算
                var cscs_zan = getCeuSyutokuJokyo[0]['hitsuyo_ceu_zansu'];
                var dig = Number(cscs_zan);
                var cscs_zan_num = dig.toFixed(2);
                $('#cscs_zan').text(cscs_zan_num);

                //CPTCEU数
                var cpt_hitsuyo = getCeuSyutokuJokyo[1]['hitsuyo_ceusu'];
                var dig = Number(cpt_hitsuyo);
                var cpt_hitsuyo_num = dig.toFixed(2);
                $('#cpt_hitsuyo').text(cpt_hitsuyo_num);


                //CPTカテゴリーA合計値
                var cpt_category_a = getCeuSyutokuJokyo[1]['category_a_gokei'];
                var dig = Number(cpt_category_a);
                var cpt_a_num = dig.toFixed(2);
                $('#cpt_category_a').text(cpt_a_num);
                var cpt_category_a_val = $('#cpt_category_a').text();

                //CPTカテゴリーB合計値
                var cpt_category_b = getCeuSyutokuJokyo[1]['category_b_gokei'];
                var dig = Number(cpt_category_b);
                var cpt_b_num = dig.toFixed(2);
                $('#cpt_category_b').text(cpt_b_num);
                var cpt_category_b_val = $('#cpt_category_b').text();

                //CPTカテゴリーC合計値
                var cpt_category_c = getCeuSyutokuJokyo[1]['category_c_gokei'];
                var dig = Number(cpt_category_c);
                var cpt_c_num = dig.toFixed(2);
                $('#cpt_category_c').text(cpt_c_num);
                var cpt_category_c_val = $('#cpt_category_c').text();

                //CPTカテゴリーD合計値
                var cpt_category_d = getCeuSyutokuJokyo[1]['category_d_gokei'];
                var dig = Number(cpt_category_d);
                var cpt_d_num = dig.toFixed(2);
                $('#cpt_category_d').text(cpt_d_num);
                var cpt_category_d_val = $('#cpt_category_d').text();

                //CPT現在取得CEU
                var cpt_genzai = getCeuSyutokuJokyo[1]['genzai_shutoku_ceusu'];
                var dig = Number(cpt_genzai);
                var cpt_genzai_num = dig.toFixed(2);
                $('#cpt_genzai').text(cpt_genzai_num);

                //CPT残りCEU計算
                var cpt_zan = getCeuSyutokuJokyo[1]['hitsuyo_ceu_zansu'];
                var dig = Number(cpt_zan);
                var cpt_zan_num = dig.toFixed(2);
                $('#cpt_zan').text(cpt_zan_num);

                //カテゴリーA取得ポイントセット
                var category_a_val = Number(cscs_category_a_val) + Number(cpt_category_a_val);
                category_a_val = category_a_val.toFixed(2);
                $('#a_syutoku_p').text(category_a_val);

                //カテゴリーB取得ポイントセット
                var category_b_val = Number(cscs_category_b_val) + Number(cpt_category_b_val);
                category_b_val = category_b_val.toFixed(2);
                $('#b_syutoku_p').text(category_b_val);

                //カテゴリーC取得ポイントセット
                var category_c_val = Number(cscs_category_c_val) + Number(cpt_category_c_val);
                category_c_val = category_c_val.toFixed(2);
                $('#c_syutoku_p').text(category_c_val);

                //カテゴリーD取得ポイントセット
                var category_d_val = Number(cscs_category_d_val) + Number(cpt_category_d_val);
                category_d_val = category_d_val.toFixed(2);
                $('#d_syutoku_p').text(category_d_val);
            }
        }).fail((rtn) => {
            return false;
        });

        /************************
         * 更新ボタンチェンジイベント
         ************************/
        $("input[id='koushin_1']").change(function () {
            if ($("input[id='koushin_1']:checked").val()) {
                $('#chkCSCS').val(1);
            } else {
                $('#chkCSCS').val(0);
            }
        });

        $("input[id='koushin_2']").change(function () {
            if ($("input[id='koushin_2']:checked").val()) {
                $('#chkCPT').val(1);
            } else {
                $('#chkCPT').val(0);
            }
        });

        /********************************
        * 次へボタン押下時のエラーチェック
        ********************************/

        $("#next").click(function () {
            //エラーメッセージエリア初期化
            $("#err_doi_1").html("");
            $("#err_doi_2").html("");

            var wk_err_msg = "";

            //同意未入力チェック
            if (!$('input:radio[name="ceu_doi"]').prop('checked') || $('input:radio[id="ceu_doi_2"]').prop('checked')) {
                wk_err_msg = "同意するにチェックをしてください。";
                $("#err_doi_1").html(wk_err_msg);
            }

            if (!$('input:radio[name="kuyaku_doi"]:checked').prop('checked') || $('input:radio[id="kuyaku_doi_2"]:checked').prop('checked')) {
                wk_err_msg = "同意するにチェックをしてください。";
                $("#err_doi_2").html(wk_err_msg);
            }

            if (wk_err_msg != "") {
                return false;
            }

            //エラーがない場合確認画面に画面遷移
            url = '../ceuReportConfirm/';
            $('form').attr('action', url);
            $('form').submit();

        });

    });
})(jQuery);
