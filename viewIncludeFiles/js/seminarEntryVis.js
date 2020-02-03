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
            },

        }).done((rtn) =>{
            console.log(rtn);
        }).fail((rtn) =>{
            console.log(rtn);
            return false;
        });

        /********************************
        * クリアボタン押下処理
        ********************************/
        $("#clear").click(function () {
            //入力内容をクリアする
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
            //
        });
    });
})(jQuery);