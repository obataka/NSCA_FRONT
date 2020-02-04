(function ($) {
    $(document).ready(function () {

        if ($('#bei_kaiin').is(':checked')) {
            // テキストボックス有効化
            $('#bei_kaiin_no').prop('disabled', false);
        } else {
            // テキストボックス無効化
            $('#bei_kaiin_no').prop('disabled', true);
        }

        /****************
         * //都道府県取得
         ****************/
        jQuery.ajax({
            url: '../../classes/getTodofukenList.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に住所情報を取得できた時の処理を書く場所
                getTodofukenList = JSON.parse(rtn);
                $.each(getTodofukenList, function (i, value) {
                    $('#address_todohuken').append('<option name="' + value['chiiki_id'] + '" value="' + value['ken_no'] + '">' + value['kemmei'] + '</option>');
                });
                // 修正で入力画面に戻ってきた時、都道府県のセレクトボックスの初期表示処理
                var test1 = $('#sel_math').val();
                // 選択済みの都道府県がある場合
                if (test1 != "") {
                    $('#address_todohuken').val(test1);
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /****************
         * //米国会員資格取得
         ****************/
        jQuery.ajax({
            url: '../../classes/getBeikokuShikaku.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に米国会員資格を取得できた時の処理を書く場所
                getBeikokuShikakuList = JSON.parse(rtn);
                $.each(getBeikokuShikakuList, function (i, value) {
                    $('#shikaku_kbn').append('<option value="' + value['meisho_cd'] + '">' + value['meisho'] + '</option>');
                });
                // 修正で入力画面に戻ってきた時、米国会員資格のセレクトボックスの初期表示処理
                var test1 = $('#sel_math').val();
                // 選択済みの米国会員資格がある場合
                if (test1 != "") {
                    $('#shikaku_kbn').val(test1);
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /************************
         * 米国会員番号オプションチェンジイベント
         ************************/
        $("#bei_kaiin").change(function () {
            if ($("input[name='bei_kaiin']").prop('checked')) {
                //チェックありのhidden設定
                $("#sel_bei_kaiin").val(1);
                $('#bei_kaiin_no').prop('disabled', false);
            } else {
                //チェックなしのhidden設定
                $("#sel_bei_kaiin").val(0);
                $('#bei_kaiin_no').prop('disabled', true);
                $('#bei_kaiin_no').val("");
            }
        });

        /************************
         * 流山市民ボタンチェンジイベント
         ************************/
        $("#nagareyama").change(function () {
            if ($("input[name='nagareyama']").prop('checked')) {
                //チェックありのhidden設定
                $("#wk_sel_nagareyama").val(1);
                var test = '流山市民です。';
                $('#sel_nagareyama').val(test);
            } else {
                //チェックなしのhidden設定
                $("#wk_sel_nagareyama").val(0);
                var test = '流山市民ではありません。';
                $('#sel_nagareyama').val(test);
            }
        });

        //米国会員番号のチェック初期表示処理
        var wk_sel_bei_kaiin = $('#sel_bei_kaiin').val();
        if (wk_sel_bei_kaiin != "") {
            $('input[name="bei_kaiin"]').prop("checked", true);
        }

        //流山市民のチェック初期表示処理
        var wk_sel_nagareyama = $('#wk_sel_nagareyama').val();
        if (wk_sel_nagareyama != "") {
            $('input[name="nagareyama"]').prop("checked", true);
        }

        /********************************
        * 住所検索ボタン押下処理
        ********************************/
        $("#street_address_search").click(function () {

            // エラーメッセージエリア初期化
            $("#err_address_yubin_nb_1").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            // 郵便番号上未入力チェック
            if ($("#yubin_nb_1").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "郵便番号が未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }

            // 郵便番号下未入力チェック
            if ($("#yubin_nb_2").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "郵便番号が未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#yubin_nb_2").focus();
                    wk_focus_done = 1;
                }
            }

            //郵便番号正規表現チェック
            var postcode = $("#yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
            var re = /^\d{3}-?\d{4}$/;
            var postcode = postcode.match(re);
            if (!postcode) {
                if (wk_err_msg == "") {
                    wk_err_msg = "正しい郵便番号を半角数字で入力してください。";
                }
                if (wk_focus_done == 0) {
                    $("#yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                $("#err_address_yubin_nb_1").html(wk_err_msg);
                return false;
            }

            //郵便番号検索処理
            jQuery.ajax({
                url: '../../classes/searchPostNo.php',
                type: 'POST',
                data:
                {
                    postNo1: $("#yubin_nb_1").val(),
                    postNo2: $("#yubin_nb_2").val()
                },
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                    return false;
                } else {
                    //※正常に住所情報を取得できた時の処理を書く場所
                    wk_msYubinNo = JSON.parse(rtn);
                    $("#address_todohuken option").filter(function (index) {
                        return $(this).text() === wk_msYubinNo[7];
                    }).prop("selected", true).change();

                    $("#address_shiku").val(wk_msYubinNo[8] + wk_msYubinNo[9]);
                    $("#address_yomi_shiku").val(wk_msYubinNo[5] + wk_msYubinNo[6]);
                }
            }).fail((rtn) => {
                $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                return false;
            });
        });

        /********************************
        * イベント情報表示処理
        ********************************/
        jQuery.ajax({
            url: '../../classes/getEventJoho.php',
            type: 'POST',
            data: {
                tb_name: $('#tb_name').val(),
                ceu_id: $('#ceu_id').val(),
            }
        }).done((rtn) => {
            getEventJoho = JSON.parse(rtn);

            //イベント区分表示
            jQuery.ajax({
                url: '../../classes/getEventSbt.php',
            }).done((rtn) => {
                getEventSbt = JSON.parse(rtn);
                $.each(getEventSbt, function (i, val) {
                    if (val['meisho_cd'] == getEventJoho[0]['event_kbn']) {
                        $('#event_sbt').after(val['meisho']);
                    }
                });
            }).fail((rtn) => {
                return false;
            });

            //イベント名、開催日、参加費
            if ($('#tb_name').val() == 'tb_toreken_joho') {
                $('#event_name').append(getEventJoho[0]['kentei_title']);
                $('#event_day').append(getEventJoho[0]['kaisaibi'].slice(0, 10).split('-').join('/'));
                $('#event_hiyo').append(getEventJoho[0]['ippan_sankaryo'] + '円');
            } else {
                $('#event_name').append(getEventJoho[0]['shutoku_naiyo']);
                $('#event_day').append(getEventJoho[0]['shutokubi'].slice(0, 10).split('-').join('/'));
                $('#event_hiyo').append(Math.floor(getEventJoho[0]['ippan_sankaryo']) + '円');
            }

        }).fail((rtn) => {
            return false;
        });



        /********************************
        * クリアボタン押下処理
        ********************************/
        $("#clear").click(function () {
            //入力内容をクリアする
            document.seminarEntryVisForm.reset();

        });
        /********************************
         * NSCAトップへボタン押下処理
         ********************************/
        $("#top").click(function () {
            //NSCAトップへ画面遷移する
        });
        /********************************
         * 次へボタン押下処理
         ********************************/
        $("#next").click(function () {
            //エラーメッセージエリア初期化
            $("#err_name_sei").html("");
            $("#err_name_mei").html("");
            $("#err_name_sei_kana").html("");
            $("#err_name_mei_kana").html("");
            $("#err_mail_address_1").html("");
            $("#err_mail_address_2").html("");
            $("#err_address_yubin_nb").html("");
            $("#err_address_todohuken").html("");
            $("#err_address_shiku").html("");
            $("#err_address_tatemono").html("");
            $("#err_tel").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            //氏名(姓)未入力チェック
            if ($("#name_sei").val() == "") {
                wk_err_msg = "氏名(姓)を入力してください。";
                $("#err_name_sei").html(wk_err_msg);
                wk_err_msg = "";
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_sei").focus();
                    wk_focus_done = 1;
                }
            }
            //氏名(名)未入力チェック
            if ($("#name_mei").val() == "") {
                wk_err_msg = "";
                wk_err_msg = "氏名(名)を入力してください。";
                $("#err_name_mei").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_mei").focus();
                    wk_focus_done = 1;
                }
            }
            //フリガナ_セイ未入力チェック
            if ($("#name_sei_kana").val() == "") {
                wk_err_msg = "";
                wk_err_msg = "フリガナ(姓)を入力してください。";
                $("#err_name_sei_kana").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_sei_kana").focus();
                    wk_focus_done = 1;
                }
            }
            //フリガナ_セイ全角カナチェック
            if ($("#name_sei_kana").val() !== "") {
                var sei = $("#name_sei_kana").val();
                var re = /^[ァ-ンヴー]*$/;
                var sei = sei.match(re);
                if (!sei) {
                    wk_err_msg == "";
                    wk_err_msg = "フリガナ(姓)は全角カナで入力してください。";
                    $("#err_name_sei_kana").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#name_sei_kana").focus();
                        wk_focus_done = 1;
                    }
                }
            }
            //フリガナ_メイ未入力チェック
            if ($("#name_mei_kana").val() == "") {
                wk_err_msg = "";
                wk_err_msg = "フリガナ(名)を入力してください。";
                $("#err_name_mei_kana").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_mei_kana").focus();
                    wk_focus_done = 1;
                }
            }
            //フリガナ_メイ全角カナチェック
            if ($("#name_mei_kana").val() !== "") {
                var sei = $("#name_mei_kana").val();
                var re = /^[ァ-ンヴー]*$/;
                var sei = sei.match(re);
                if (!sei) {
                    wk_err_msg == "";
                    wk_err_msg = "フリガナ(名)は全角カナで入力してください。";
                    $("#err_name_mei_kana").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#name_mei_kana").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            // 郵便番号上未入力チェック
            if ($("#yubin_nb_1").val() == "") {
                if (wk_err_msg1 == "") {
                    wk_err_msg1 = "郵便番号が未入力です。";
                    $("#err_address_yubin_nb_1").html(wk_err_msg1);
                }
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }
            // 郵便番号下未入力チェック
            if ($("#yubin_nb_2").val() == "") {
                if (wk_err_msg1 == "") {
                    wk_err_msg1 = "郵便番号が未入力です。";
                    $("#err_address_yubin_nb_1").html(wk_err_msg1);
                }
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#yubin_nb_2").focus();
                    wk_focus_done = 1;
                }
            }
            //郵便番号正規表現チェック
            var postcode = $("#yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
            var re = /^\d{3}-?\d{4}$/;
            var postcode = postcode.match(re);
            if (!postcode) {
                if (wk_err_msg1 == "") {
                    wk_err_msg1 = "正しい郵便番号を半角数字で入力してください。";
                    $("#err_address_yubin_nb_1").html(wk_err_msg1);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#yubin_nb_1").focus();
                        wk_focus_done = 1;
                    }
                }
            }            
            
            //都道府県選択チェック
            if ($("#address_todohuken").val() == 0) {
                wk_err_msg == "";
                wk_err_msg = "都道府県を選択してください。";
                $("#err_address_todohuken").html(wk_err_msg);
            }
            //市区町村/番地未入力チェック
            if ($("#address_shiku").val() == "") {
                wk_err_msg == "";
                wk_err_msg = "市区町村/番地を入力してください。";
                $("#err_address_shiku").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#address_shiku").focus();
                    wk_focus_done = 1;
                }
            }
            //建物/部屋番号未入力チェック
            if ($("#address_tatemono").val() == "") {
                wk_err_msg == "";
                wk_err_msg = "建物/部屋番号を入力してください。";
                $("#err_address_tatemono").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#address_tatemono").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            }

            //エラーがない場合確認画面に画面遷移
            url = '../seminarConfirm/';
            $('form').attr('action', url);
            $('form').submit();
        });
    });
})(jQuery);