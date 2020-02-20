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

                //hidden項目に値をセット
                $("#wk_kaiin_no").val(getKaiinJoho[0]);
                $("#wk_shimei_mei").val(getKaiinJoho['shimei_mei']);
                $("#wk_shimei_sei").val(getKaiinJoho['shimei_sei']);
                $("#wk_furigana_sei").val(getKaiinJoho['furigana_sei']);
                $("#wk_furigana_mei").val(getKaiinJoho['furigana_mei']);
                $("#wk_tel").val(getKaiinJoho['tel']);

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
        *CEU管理費を取得
        *****************/
        $.ajax({
            url: '../../classes/getCeuKanrihi.php',
        }).done((rtn) => {
            // rtn = 0 の場合
            if (rtn == 0) {
                return false;
            } else {
                getceuKanrihi = JSON.parse(rtn);
                console.log(getceuKanrihi);
                if (getceuKanrihi.length >= 2) {
                    if ($('#chkCSCS').val() == 1 && $('#chkCPT').val() == 1) {
                        $('#cscs').text(parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10) + '円');
                        $('#cpt').text(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10) + '円');
                        $('#koushinryo').text(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10) + parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10) + '円');

                        $('#wk_koushinryo').val(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10) + parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10));
                    } else if ($('#chkCSCS').val() == 1) {
                        $('#cscs').text(parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10) + '円');
                        $('#koushinryo').text(parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10) + '円');

                        $('#wk_koushinryo').val(parseInt(getceuKanrihi[0][0]['ceu_kanrihi'], 10));

                    } else if ($('#chkCPT').val() == 1) {
                        $('#cpt').text(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10) + '円');
                        $('#koushinryo').text(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10) + '円');

                        $('#wk_koushinryo').val(parseInt(getceuKanrihi[1][0]['ceu_kanrihi'], 10));
                    }
                } else {
                    if (getceuKanrihi[0]['shiken_sbt_kbn'] == 'CSCS') {
                        $('#cscs').text(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + '円');

                        if ($('#chkCSCS').val() == 1) {
                            $('#koushinryo').text(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + '円');

                            $('#wk_koushinryo').val(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10));
                        }

                    } else if (getceuKanrihi[0]['shiken_sbt_kbn'] == 'CPT') {
                        $('#cpt').text(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + '円');

                        if ($('#chkCPT').val() == 1) {
                            $('#koushinryo').text(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + '円');

                            $('#wk_koushinryo').val(parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10) + parseInt(getceuKanrihi[0]['ceu_kanrihi'], 10));
                        }
                    }
                }

                //更新する資格すべてにチェックがない場合、支払方法選択ボタンを無効化
                //更新料が0円の場合は完了ボタンを有効とし、決済選択画面へ遷移させない
                if ($('#chkCSCS').val() == 0 && $('#chkCPT').val() == 0) {
                    $('#next').prop("disabled", true);
                    $('#end').prop("disabled", true);
                } else if (!$('#wk_koushinryo').val()) {
                    $('#next').prop("disabled", true);
                    $('#end').prop("disabled", false);
                } else {
                    $('#next').prop("disabled", false);
                    $('#end').prop("disabled", true);
                }

            }

        }).fail((rtn) => {
            return false;
        });


        /********************************
        * 支払方法選択ボタン押下時の処理
        ********************************/
        $("#next").click(function () {
            // HIDDENデータをSESSIONに積込む処理
            $.ajax({
                url: '../../classes/setCeuDataToSess.php',
                type: 'POST',
                data: {

                    //会員情報
                    kaiin_no: $("#wk_kaiin_no").val(),
                    name_mei: $("#wk_shimei_mei").val(),
                    name_sei: $("#wk_shimei_sei").val(),
                    name_sei_kana: $("#wk_furigana_sei").val(),
                    name_mei_kana: $("#wk_furigana_mei").val(),
                    tel: $("#wk_tel").val(),

                    //更新料
                    koushinryo: $('#wk_koushinryo').val(),

                    tranScreen: 'ceuReportConfirm'
                }
            })

                // Ajaxリクエストが成功した時発動
                .done((data) => {
                    url = '../paymentSelectNoLogin/';
                    $('form').attr('action', url);
                    $('form').submit();
                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    return false;
                })

        });

        /********************************
        * 内容を修正するボタン押下時の処理
        ********************************/
        $("#return").click(function () {
            location.href = "../ceuReport/"
        });

        /********************************
        * 完了ボタン押下時の処理
        ********************************/
        $("#end").click(function () {
            console.log($("#wk_kaiin_no").val());
            

            // データを追加する処理
            $.ajax({
                url: '../../classes/updateCeuData.php',
                type: 'POST',
                data: {
                    kaiin_no: $("#wk_kaiin_no").val(),
                    user_id: 'hoge',
                    cscs_koushinryo_nofu_kbn: $('#chkCSCS').val(),
                    cpt_koushinryo_nofu_kbn: $('#chkCPT').val(),

                }
            })

                // Ajaxリクエストが成功した時発動
                .done((data) => {
                    alert('データの更新が完了しました。');
                    return false;
                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    return false;
                })

        });



    });
})(jQuery);
