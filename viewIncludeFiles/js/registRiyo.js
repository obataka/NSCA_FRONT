(function ($) {
    $(document).ready(function () {

        /****************
         * //都道府県取得
         ****************/
        $.ajax({
            url: '../../classes/getTodofukenList.php',
        })

            // Ajaxリクエストが成功した時発動
            .done((rtn) => {
                if (rtn == 0) {
                    $('.error').html('システムエラーが発生しました。');
                    return false;

                    // rtn = 0 以外の場合は、処理続行
                } else {

                    //※正常に住所情報を取得できた時の処理を書く場所
                    getTodofukenList = JSON.parse(rtn);

                    $.each(getTodofukenList, function (i, value) {
                        $('#address_todohuken').append('<option name="' + value[2] + '" value="' + value[0] + '">' + value[1] + '</option>');
                    });

                    // 修正で入力画面に戻ってきた時、都道府県のセレクトボックスの初期表示処理
                    var test = $('#sel_math').val();

                    // 選択済みの都道府県がある場合
                    if (test != "") {
                        $('#address_todohuken').val(test);
                    }
                }
            })

            // Ajaxリクエストが失敗した時発動
            .fail((rtn) => {
                $('.error').html('システムエラーが発生しました。');
                return false;
            })

            // Ajaxリクエストが成功・失敗どちらでも発動
            .always((data) => {
            });

        /***************************************************************
        * 選択済みのコンボ、ラジオ、チェックボックス初期表示処理
        ***************************************************************/
        //月日セレクトボックス
        var sel_month = $('#sel_month').val();
        if (sel_month) {
            $('#month').val(sel_month);
        }
        var sel_day = $('#sel_day').val();
        if (sel_day) {
            $('#day').val(sel_day);
        }

        // 性別ラジオボタン
        var wk_sel_gender = $('#wk_sel_gender').val();
        if (wk_sel_gender) {
            $('input:radio[name="gender"]').val([wk_sel_gender]);
        }

        //メール受信希望のメールアドレスボタン
        var mail_login = $('#mail_login').val();
        if (mail_login) {
            $('input:radio[name="mail"]').val([mail_login]);
        }

        //ログイン希望のメールアドレスボタン
        var wk_sel_mail_login = $('#wk_sel_mail_login').val();
        if (wk_sel_mail_login) {
            $('input:radio[name="mail_login"]').val([wk_sel_mail_login]);
        }

        //メルマガ受信希望ボタン
        var wk_sel_merumaga = $('#merumaga').val();
        if (wk_sel_merumaga) {
            $('input:radio[name="merumaga"]').val([wk_sel_merumaga]);
        }

        //連絡方法希望ボタン
        var wk_sel_hoho = $('#hoho').val();
        if (wk_sel_hoho) {
            $('input:radio[name="hoho"]').val([wk_sel_hoho]);
        }

        /*************************************
        * //画面初期表示で次へボタンを無効にする
        *************************************/
        $('button[type="submit"]').prop("disabled", true);
        /*************************************
        * //画面初期表示で流山市民のvalueを0にする
        *************************************/
        $("input:checkbox[id='nagareyama']").val(0);

        /********************************
        * 住所検索ボタン押下処理
        ********************************/
        $("#job_address_search").click(function () {

            // エラーメッセージエリア初期化
            $("#err_address_yubin_nb_1").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            // 郵便番号上未入力チェック
            if ($("#address_yubin_nb_1").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "郵便番号が未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#address_yubin_nb_1").focus();
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
            var postcode = $("#address_yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
            var re = /^\d{3}-?\d{4}$/;
            var postcode = postcode.match(re);
            if (!postcode) {
                if (wk_err_msg == "") {
                    wk_err_msg = "正しい郵便番号を半角数字で入力してください。";
                }
                if (wk_focus_done == 0) {
                    $("#address_yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                $("#err_address_yubin_nb_1").html(wk_err_msg);
                return false;
            }

            //郵便番号検索処理
            $.ajax({
                url: '../../classes/searchPostNo.php',
                type: 'POST',
                data:
                {
                    postNo1: $("#address_yubin_nb_1").val(),
                    postNo2: $("#yubin_nb_2").val()
                }
            })

                // Ajaxリクエストが成功した時発動
                .done((rtn) => {

                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                        $("#address_todohuken").val("");
                        $("#address_shiku").val("");
                        $("#address_tatemono").val("");
                        $("#address_yomi_shiku").val("");
                        $("#address_yomi_tatemono").val("");
                        return false;

                        // rtn = 0 以外の場合は、処理続行
                    } else {

                        //※正常に住所情報を取得できた時の処理を書く場所
                        wk_msYubinNo = JSON.parse(rtn);
                        $("#address_todohuken option").filter(function (index) {
                            return $(this).text() === wk_msYubinNo[7];
                        }).prop("selected", true);
                        $("#address_shiku").val(wk_msYubinNo[8] + wk_msYubinNo[9]);
                        $("#address_yomi_shiku").val(wk_msYubinNo[5] + wk_msYubinNo[6]);
                        var val = $('#address_todohuken option:selected').text();
                        var val2 = $('#address_todohuken option:selected').val();
                        var val3 = $('#address_todohuken option:selected').attr('name');
                        $('#kenmei').val(val);
                        $('#sel_math').val(val2);
                        $('#sel_chiiki').val(val3);

                    }
                })

                // Ajaxリクエストが失敗した時発動
                .fail((data) => {
                    $('.error').html('システムエラーが発生しました。');
                    $("#address_todohuken").val("");
                    $("#address_shiku").val("");
                    $("#address_tatemono").val("");
                    $("#address_yomi_shiku").val("");
                    $("#address_yomi_tatemono").val("");
                    return false;
                })

                // Ajaxリクエストが成功・失敗どちらでも発動
                .always((data) => {
                });
        });

        /************************
         * 都道府県チェンジイベント
         ************************/

        //セレクトボックスが切り替わったら発動
        $('#address_todohuken').change(function () {
            var val = $('#address_todohuken option:selected').text();
            var val2 = $('#address_todohuken option:selected').val();
            var val3 = $('#address_todohuken option:selected').attr('name');
            $('#kenmei').val(val);
            $('#sel_math').val(val2);
            $('#sel_chiiki').val(val3);
        });
        /************************
        * 性別ボタンチェンジイベント
        ************************/
        $("input:radio[name='gender']").change(function () {

            //男性hidden設定
            if ($("input:radio[id='gender_1']:checked").val()) {
                var dansei = $("input:radio[id='gender_1']:checked").val();
                $("#wk_sel_gender").val(dansei);
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
            } else {

                //女性hidden設定
                var josei = $("input:radio[id='gender_2']:checked").val();
                $("#wk_sel_gender").val(josei);
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
            }
        });
        /************************
        * メールアドレスボタンチェンジイベント
        ************************/
        $("input:radio[name='mail']").change(function () {

            //mail1設定
            if ($("input:radio[id='mail_1']:checked").val()) {
                var mail1 = $("input:radio[id='mail_1']:checked").val();
                $("#mail").val(mail1);
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_mail').val(test2);
            } else {

                //mail2設定
                var mail2 = $("input:radio[id='mail_2']:checked").val();
                $("#mail").val(mail2);
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_mail').val(test2);
            }
        });
        //ログイン希望
        $("input:radio[name='mail_login']").change(function () {
            //アドレス1hidden設定
            if ($("input:radio[id='mail_login_1']:checked").val()) {
                var log1_val = $("input:radio[id='mail_login_1']:checked").val();
                $("#wk_sel_mail_login").val(log1_val);

                var log1_id = $('[name="mail_login"]:checked').attr('id');
                var log1_txt = $('label[for="' + log1_id + '"]').text();
                $('#sel_mail').val(log1_txt);

            } else {

                //アドレス2hidden設定
                var log2_val = $("input:radio[id='mail_login_2']:checked").val();
                $("#wk_sel_mail_login").val(log2_val);

                var log2_id = $('[name="mail_login"]:checked').attr('id');
                var log2_txt = $('label[for="' + log2_id + '"]').text();
                $('#sel_mail_login').val(log2_txt);
            }
        });
        /************************
        * メルマガ配信希望ラジオボタンチェンジイベント
        ************************/
        $("input:radio[name='merumaga']").change(function () {

            //希望するが選ばれていたらvalueに1を設定
            if ($("input:radio[id='merumaga_1']:checked").val()) {
                var merumaga1 = $("input:radio[id='merumaga_1']:checked").val();
                $("#merumaga").val(merumaga1);
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
            } else {
                var merumaga2 = $("input:radio[id='merumaga_2']:checked").val();
                $("#merumaga").val(merumaga2);
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
            }
        });
        /************************
         * NSCAからのお知らせボタンチェンジイベント
         ************************/
        $("input:radio[name='hoho']").change(function () {

            //メールでお知らせが選ばれていたらvalueに1を設定
            if ($("input:radio[id='hoho_1']:checked").val()) {
                var hoho1 = $("input:radio[id='hoho_1']:checked").val();
                $("#hoho").val(hoho1);
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
            } else {
                var hoho2 = $("input:radio[id='hoho_2']:checked").val();
                $("#hoho").val(hoho2);
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
            }
        });
        /************************
         * 流山市民ボタンチェンジイベント
         ************************/
        // チェックボックスにチェックが入っているかチェック
        $("input:checkbox[name='nagareyama']").on('click', function () {
            if ($(this).prop('checked') == true) {

                // チェックが入っている場合の処理
                $("input:checkbox[id='nagareyama']:checked").val(1);
                var nagareyama1 = $("input:checkbox[id='nagareyama']:checked").val();
                $("#sel_nagareyama").val(nagareyama1);
            }
            else {

                // チェックが入っていない場合の処理
                $("input:checkbox[id='nagareyama']").val(0);
                var nagareyama2 = $("input:checkbox[id='nagareyama']").val();
                $("#sel_nagareyama").val(nagareyama2);
            }
        });
        /********************************
         * 次へボタン有効化処理
         ********************************/
        $("#doi").change(function () {

            // チェックが入っていたら有効化
            if ($(this).is(':checked')) {

                // ボタンを有効化
                $('button[type="submit"]').prop('disabled', false);

            } else {

                // ボタンを無効化
                $('button[type="submit"]').prop('disabled', true);
            }
        });

        /********************************
         * 次へボタン押下時のエラーチェック
         ********************************/
        $("#next_button").click(function () {

            //エラーメッセージエリア初期化
            $("#err_name_sei").html("");
            $("#err_name_mei").html("");
            $("#err_name_sei_kana").html("");
            $("#err_name_mei_kana").html("");
            $("#err_birthday").html("");
            $("#err_gender").html("");
            $("#err_address_yubin_nb_1").html("");
            $("#err_address_todohuken").html("");
            $("#err_address_shiku").html("");
            $("#err_address_tatemono").html("");
            $("#err_address_yomi_shiku").html("");
            $("#err_address_yomi_tatemono").html("");
            $("#err_tel").html("");
            $("#err_keitai_tel").html("");
            $("#err_mail_address_1").html("");
            $("#err_mail_1").html("");
            $("#err_mail_login_1").html("");
            $("#err_mail_address_2").html("");
            $("#err_mail_2").html("");
            $("#err_mail_login_2").html("");
            $("#err_merumaga").html("");
            $("#err_pass_1").html("");
            $("#err_pass_2").html("");
            $("#err_renraku_hoho").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";
            var wk_err_msg1 = "";
            var wk_err_msg2 = "";
            var wk_err_msg3 = "";
            var wk_err_msg4 = "";
            var wk_err_msg5 = "";

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

            //生年月日未入力チェック
            if ($("#year").val() == "") {
                if (wk_err_msg5 == "") {
                    wk_err_msg5 = "生年月日の西暦を入力してください。";
                } else {
                    wk_err_msg5 = wk_err_msg5 + "<br>" + "生年月日の西暦を入力してください。";
                }
                $("#err_birthday").html(wk_err_msg5);

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#year").focus();
                    wk_focus_done = 1;
                }
            }

            //生年月日西暦正規表現チェック
            if ($("#year").val() !== "") {
                var year = $("#year").val();
                var re = /^[0-9]{4}$/;
                var year = year.match(re);

                //4桁の半角数字ではない場合
                if (!year) {
                    if (wk_err_msg5 == "") {
                        wk_err_msg5 = "4桁の西暦を入力してください。";
                    } else {
                        wk_err_msg5 = wk_err_msg5 + "<br>" + "4桁の西暦を入力してください。";
                    }
                    $("#err_birthday").html(wk_err_msg5);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#year").focus();
                        wk_focus_done = 1;
                    }
                } else {
                    var today = new Date();
                    var year1 = today.getFullYear() - 1;

                    //1900~本年-1の範囲外の場合
                    if ($("#year").val() >= year1 || $("#year").val() <= 1899) {
                        if (wk_err_msg5 == "") {
                            wk_err_msg5 = "正しい西暦を入力してください。";
                        } else {
                            wk_err_msg5 = wk_err_msg5 + "<br>" + "正しい西暦を入力してください。";
                        }
                        $("#err_birthday").html(wk_err_msg5);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#year").focus();
                            wk_focus_done = 1;
                        }
                    }
                }
            }

            //月日選択チェック
            if ($("#month").val() == 0 || $("#day").val() == 0) {
                if (wk_err_msg5 == "") {
                    wk_err_msg5 = "月日を選択してください";
                } else {
                    wk_err_msg5 = wk_err_msg5 + "<br>" + "月日を選択してください";
                }
                $("#err_birthday").html(wk_err_msg5);
            }

            //性別ラジオボタン選択チェック
            if (!$("input:radio[name='gender']:checked").val()) {

                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "性別を選択してください。";
                $("#err_gender").html(wk_err_msg);
            }

            // 郵便番号上未入力チェック
            if ($("#address_yubin_nb_1").val() == "") {
                if (wk_err_msg1 == "") {
                    wk_err_msg1 = "郵便番号が未入力です。";
                    $("#err_address_yubin_nb_1").html(wk_err_msg1);
                }

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#address_yubin_nb_1").focus();
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
            var postcode = $("#address_yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
            var re = /^\d{3}-?\d{4}$/;
            var postcode = postcode.match(re);
            if (!postcode) {
                if (wk_err_msg1 == "") {
                    wk_err_msg1 = "正しい郵便番号を半角数字で入力してください。";
                    $("#err_address_yubin_nb_1").html(wk_err_msg1);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#address_yubin_nb_1").focus();
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

            //流山市民のvalueの設定　チェック有り：1　チェック無し：0
            if ($('input[name="nagareyama"]').prop('checked')) {
                $('input[name="nagareyama"]').val = 1;
            } else {
                $('input[name="nagareyama"]').val = 0;
            }

            //市区町村/番地(ヨミ)未入力チェック
            if ($("#address_yomi_shiku").val() == "") {
                if (wk_err_msg2 == "") {
                    wk_err_msg2 == "";
                    wk_err_msg2 = "市区町村/番地(ヨミ)を入力してください。";
                    $("#err_address_yomi_shiku").html(wk_err_msg2);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#address_yomi_shiku").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //建物/部屋番号(ヨミ)未入力チェック
            if ($("#address_yomi_tatemono").val() == "") {
                if (wk_err_msg3 == "") {
                    wk_err_msg3 == "";
                    wk_err_msg3 = "建物/部屋番号(ヨミ)を入力してください。";
                    $("#err_address_yomi_tatemono").html(wk_err_msg3);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#address_yomi_tatemono").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //TEL・携帯未入力チェック
            if ($("#tel").val() == "" && $("#keitai_tel").val() == "") {
                if (wk_err_msg4 == "") {
                    wk_err_msg4 == "";
                    wk_err_msg4 = "TELまたは携帯番号のいずれかを入力してください。";
                    $("#err_tel").html(wk_err_msg4);
                    $("#err_keitai_tel").html(wk_err_msg4);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#tel").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //TEL桁数チェック
            if ($("#tel").val() !== "") {
                if (wk_err_msg4 == "") {
                    var tel = document.getElementById('tel').value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');
                    if (!tel.match(/^[0-9]{10}$/)) {
                        wk_err_msg4 == "";
                        wk_err_msg4 = "TELは10桁の半角数字で入力してください。";
                        $("#err_tel").html(wk_err_msg4);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#tel").focus();
                            wk_focus_done = 1;
                        }
                    }
                }
            }

            //携帯桁数チェック
            if ($("#keitai_tel").val() !== "") {
                if (wk_err_msg4 == "") {
                    var keitaitel = document.getElementById('keitai_tel').value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');
                    if (!keitaitel.match(/^[0-9]{11}$/)) {
                        wk_err_msg4 == "";
                        wk_err_msg4 = "携帯は11桁の半角数字で入力してください。";
                        $("#err_keitai_tel").html(wk_err_msg4);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#keitai_tel").focus();
                            wk_focus_done = 1;
                        }
                    }
                }
            }


            //メールアドレス1・メールアドレス2未入力チェック
            if ($("#mail_address_1").val() == "" && $("#mail_address_2").val() == "") {
                wk_err_msg == "";
                wk_err_msg = "メールアドレス1またはメールアドレス2のいずれかを入力してください。";
                $("#err_mail_address_2").html(wk_err_msg);

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#mail_address_1").focus();
                    wk_focus_done = 1;
                }
            } else {
                //メールアドレス1形式チェック 2019/01/07
                var mail_regex1 = new RegExp('(?:[-!#-\'*+/-9=?A-Z^-~]+\.?(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*|"(?:[!#-\[\]-~]|\\\\[\x09 -~])*")@[-!#-\'*+/-9=?A-Z^-~]+(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*');
                var mail_regex2 = new RegExp('^[^\@]+\@[^\@]+$');
                if ($("#mail_address_1").val().match(mail_regex1) && $("#mail_address_1").val().match(mail_regex2)) {

                    // 全角チェック
                    if ($("#mail_address_1").val().match(/[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/)) {
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                        $("#err_mail_address_1").html(wk_err_msg);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail_address_1").focus();
                            wk_focus_done = 1;
                        }
                    }

                    // 末尾TLDチェック（〜.co,jpなどの末尾ミスチェック用）
                    if (!$("#mail_address_1").val().match(/\.[a-z]+$/)) {

                        //TDLエラー
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレスの形式が不正です。";
                        $("#err_mail_login_1").html(wk_err_msg);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail_address_1").focus();
                            wk_focus_done = 1;
                        }
                    }
                } else {
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                    $("#err_mail_address_1").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail_address_1").focus();
                        wk_focus_done = 1;
                    }
                }

                //メールアドレス2形式チェック　2019/01/07
                var mail_regex1 = new RegExp('(?:[-!#-\'*+/-9=?A-Z^-~]+\.?(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*|"(?:[!#-\[\]-~]|\\\\[\x09 -~])*")@[-!#-\'*+/-9=?A-Z^-~]+(?:\.[-!#-\'*+/-9=?A-Z^-~]+)*');
                var mail_regex2 = new RegExp('^[^\@]+\@[^\@]+$');
                if ($("#mail_address_2").val().match(mail_regex1) && $("#mail_address_2").val().match(mail_regex2)) {

                    // 全角チェック
                    if ($("#mail_address_2").val().match(/[^a-zA-Z0-9\!\"\#\$\%\&\'\(\)\=\~\|\-\^\\\@\[\;\:\]\,\.\/\\\<\>\?\_\`\{\+\*\} ]/)) {
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                        $("#err_mail_address_2").html(wk_err_msg);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail_address_2").focus();
                            wk_focus_done = 1;
                        }
                    }

                    // 末尾TLDチェック（〜.co,jpなどの末尾ミスチェック用）
                    if (!$("#mail_address_2").val().match(/\.[a-z]+$/)) {

                        //TDLエラー
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレスの形式が不正です。";
                        $("#err_mail_login_2").html(wk_err_msg);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#mail_address_2").focus();
                            wk_focus_done = 1;
                        }
                    }
                } else {
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレスに使用する文字を正しく入力してください。";
                    $("#err_mail_address_2").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail_address_2").focus();
                        wk_focus_done = 1;
                    }
                }

                //メールアドレス1重複チェック 2019/01/06
                if ($('#mail_address_1').val() !== "") {
                    $.ajax({
                        url: '../../classes/searchMailAddress1.php',
                        type: 'POST',
                        data:
                        {
                            //メールアドレスセット
                            mail: $("#mail_address_1").val(),
                        }
                    })

                        // Ajaxリクエストが成功した時発動
                        .done((data) => {
                            if (rtn == 0) {
                                return false;
                            } else {
                                //登録済みの場合エラーメッセージを表示
                                wk_err_msg == "";
                                wk_err_msg = "すでにご登録頂いているメールアドレスです。";
                                $("#err_mail_1").html(wk_err_msg);

                                //エラー箇所にフォーカスを当てる
                                if (wk_focus_done == 0) {
                                    $("#mail_address_1").focus();
                                    wk_focus_done = 1;
                                }
                                return false;
                            }
                        })

                        // Ajaxリクエストが失敗した時発動
                        .fail((data) => {
                            return false;
                        })

                        // Ajaxリクエストが成功・失敗どちらでも発動
                        .always((data) => {
                        });
                }

                //メールアドレス2重複チェック 2019/01/06
                if ($('#mail_address_2').val() !== "") {
                    $.ajax({
                        url: '../../classes/searchMailAddress1.php',
                        type: 'POST',
                        data:
                        {
                            //メールアドレスセット
                            mail: $("#mail_address_2").val(),
                        }
                    })

                        // Ajaxリクエストが成功した時発動
                        .done((data) => {
                            if (rtn == 0) {
                                return false;
                            } else {
                                //登録済みの場合エラーメッセージを表示
                                wk_err_msg == "";
                                wk_err_msg = "すでにご登録頂いているメールアドレスです。";
                                $("#err_mail_2").html(wk_err_msg);

                                //エラー箇所にフォーカスを当てる
                                if (wk_focus_done == 0) {
                                    $("#mail_address_2").focus();
                                    wk_focus_done = 1;
                                }
                                return false;
                            }
                        })

                        // Ajaxリクエストが失敗した時発動
                        .fail((data) => {
                            $('.error').html('システムエラーが発生しました。');
                            return false;
                        });
                }

                //ログインするアドレスのチェックボックスが未選択の時 2019/01/06
                if (!$("input:radio[name='mail_login']:checked").val()) {

                    //チェックされていない場合
                    wk_err_msg == "";
                    wk_err_msg = "ログインする時のメールアドレスを選択してください。";
                    $("#err_mail_address_2").html(wk_err_msg);
                }

                //メールアドレス1は入力されているが、ラジオボタンがどちらもチェックされていない場合 2019/01/07
                if (!$("input:radio[id='mail_login_1']:checked").val() && !$("input:radio[id='mail_1']:checked").val()) {
                    if ($('#mail_address_1').val() !== "") {
                        wk_err_msg == "";
                        wk_err_msg = "メール受信とログイン時にお使いにならないメールアドレス1を削除してください。";
                        $("#err_mail_address_1").html(wk_err_msg);
                    }
                }

                //メールアドレス2は入力されているが、ラジオボタンがどちらもチェックされていない場合 2019/01/07
                if (!$("input:radio[id='mail_login_2']:checked").val() && !$("input:radio[id='mail_2']:checked").val()) {
                    if ($('#mail_address_2').val() !== "") {
                        wk_err_msg == "";
                        wk_err_msg = "メール受信とログイン時にお使いにならないメールアドレス2を削除してください。";
                        $("#err_mail_address_2").html(wk_err_msg);
                    }
                }

                //ログインするメールアドレスが1の時、メールアドレス1の未入力チェック 2019/01/06
                if ($("input:radio[id='mail_login_1']:checked").val()) {
                    if (!$('#mail_address_1').val()) {
                        wk_err_msg == "";
                        wk_err_msg = "ログイン時のメールアドレスを入力してください。";
                        $("#err_mail_address_1").html(wk_err_msg);
                    }
                }

                //ログインするメールアドレスが2の時、メールアドレス2の未入力チェック 2019/01/06
                if ($("input:radio[id='mail_login_2']:checked").val()) {
                    if (!$('#mail_address_2').val()) {
                        wk_err_msg == "";
                        wk_err_msg = "ログイン時のメールアドレスを入力してください。";
                        $("#err_mail_address_2").html(wk_err_msg);
                    }
                }

                //メール受信希望未選択チェック
                if (!$("input:radio[name='mail']:checked").val()) {

                    //チェックされていない場合
                    wk_err_msg == "";
                    wk_err_msg = "メール受信希望のメールアドレスを選択してください。";
                    $("#err_mail").html(wk_err_msg);
                }

                //メール受信希望1選択時チェック
                if ($('input[id="mail_1"]').prop('checked')) {
                    if ($("#mail_address_1").val() == "") {
                        $("#err_mail_address_2").html("");
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレス1を入力してください。";
                        $("#err_mail_address_1").html(wk_err_msg);
                    }
                }

                //メール受信希望2選択時チェック
                if ($('input[id="mail_2"]').prop('checked')) {
                    if ($("#mail_address_2").val() == "") {
                        $("#err_mail_address_1").html("");
                        wk_err_msg == "";
                        wk_err_msg = "メールアドレス2を入力してください。";
                        $("#err_mail_address_2").html(wk_err_msg);
                    }
                }

            }



            //メルマガ受信希望選択チェック
            if (!$("input:radio[name='merumaga']:checked").val()) {

                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "メルマガ配信の希望を選択してください。";
                $("#err_merumaga").html(wk_err_msg);
            }

            //パスワード未入力チェック
            if ($("#pass_1").val() == "") {
                wk_err_msg == "";
                wk_err_msg = "パスワードを入力してください。";
                $("#err_pass_1").html(wk_err_msg);

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_1").focus();
                    wk_focus_done = 1;
                }
            }

            //正しいパスワードチェック
            if ($("#pass_1").val() !== "") {
                var pass = $("#pass_1").val();
                var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*?&]{8,}/;
                var pass = pass.match(re);
                if (!pass) {
                    wk_err_msg == "";
                    wk_err_msg = "大文字と小文字のアルファベットおよび数字を1文字以上含む、" + "<br>" + "8桁以上のパスワードを入力してください。";
                    $("#err_pass_1").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#pass_1").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //確認用パスワード未入力チェック
            if ($("#pass_2").val() == "") {
                wk_err_msg == "";
                wk_err_msg = "確認用パスワードを入力してください。";
                $("#err_pass_2").html(wk_err_msg);

                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#pass_2").focus();
                    wk_focus_done = 1;
                }
            }

            //パスワード一致チェック
            if ($("#pass_1").val() !== "" && $("#pass_2").val() !== "") {
                if ($("#pass_1").val() !== $("#pass_2").val()) {
                    wk_err_msg == "";
                    wk_err_msg = "パスワードと確認用パスワードが一致していません。";
                    $("#err_pass_1").html(wk_err_msg);
                    $("#err_pass_2").html(wk_err_msg);

                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#pass_2").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //連絡方法の未選択チェック
            if (!$("input:radio[name='hoho']:checked").val()) {

                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "NSCAからのお知らせの受信可否を選択してください。";
                $("#err_renraku_hoho").html(wk_err_msg);
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "" || wk_err_msg1 != "" || wk_err_msg2 != "" || wk_err_msg3 != "" || wk_err_msg4 != "" || wk_err_msg5 != "") {
                return false;
            }

            //エラーがない場合確認画面に画面遷移
            url = '../confirmRiyo/';
            $('form').attr('action', url);
            $('form').submit();
        });
    });
})(jQuery);
