(function($){
    $(document).ready(function(){

        /****************
        * //都道府県取得
        ****************/
        jQuery.ajax({
            url:  '../../classes/getTodofukenList.php',
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に住所情報を取得できた時の処理を書く場所
                    getTodofukenList = JSON.parse(rtn);


                    $.each(getTodofukenList, function(i, value) {
                        $('#address_todohuken').append('<option name="' + value[2] + '" value="' + value[0] + '">' + value[1] + '</option>');
                    });

                    // 修正で入力画面に戻ってきた時、都道府県のセレクトボックスの初期表示処理
                    var test = $('#sel_math').val();
                    // 選択済みの都道府県がある場合
                    if (test != "") {
                        $('#address_todohuken').val(test);
                    }
                }
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
        });
        /****************
        * //会員情報データ取得
        ****************/
        var ref = document.referrer;// リファラ情報を得る
        var hereHost = window.location.hostname;// 現在ページのホスト(ドメイン)名を得る
        // ホスト名が含まれるか探す正規表現を作る(大文字・小文字を区別しない)
        var sStr = "^https?://" + hereHost;
        var rExp = new RegExp( sStr, "i" );
        if (!ref.match(rExp)) {
            jQuery.ajax({
                url:  '../../classes/getTbkaiinJoho2.php',
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        //※正常に情報を取得できた時入力フォームに表示する
                        getTbkaiinJoho = JSON.parse(rtn);
                        console.log(getTbkaiinJoho);
                        $('#name_sei').val(getTbkaiinJoho[7]);
                        $('#name_mei').val(getTbkaiinJoho[8]);
                        $('#name_sei_kana').val(getTbkaiinJoho[10]);
                        $('#name_mei_kana').val(getTbkaiinJoho[11]);
                        $('#year').val(getTbkaiinJoho[13].slice(0,4));
                        $('#month').val(getTbkaiinJoho[13].slice(5,7));
                        $('#day').val(getTbkaiinJoho[13].slice(8,10));
                        $('input:radio[name="gender"]').val([getTbkaiinJoho[14]]);
                        //性別の値セット処理
                        if ($("input:radio[id='gender_1']:checked").val()) {
                            var wa = $("input:radio[id='gender_1']:checked").val();
                            $("#wk_sel_gender").val(wa);
                            var ra = $("#wk_sel_gender").val();
                            var test1 = $('[name="gender"]:checked').attr('id');
                            var test2 = $('label[for="' + test1 + '"]').text();
                            $('#sel_gender').val(test2);
                            var wawawa = $('#sel_gender').val();
                        } else {
                        //女性hidden設定
                            var wa = $("input:radio[id='gender_2']:checked").val();
                            $("#wk_sel_gender").val(wa);
                            var ra = $("#wk_sel_gender").val();
                            var test1 = $('[name="gender"]:checked').attr('id');
                            var test2 = $('label[for="' + test1 + '"]').text();
                            $('#sel_gender').val(test2);
                            var wawawa = $('#sel_gender').val();
                        }
                        $('#address_yubin_nb_1').val(getTbkaiinJoho[15].slice(0,3));
                        $('#yubin_nb_2').val(getTbkaiinJoho[15].slice(3,7));
                        $('#address_todohuken').val(getTbkaiinJoho[16]);
                        //都道府県セット
                        var val = $('#address_todohuken option:selected').text();
                        var val2 = $('#address_todohuken option:selected').val();
                        var val3 = $('#address_todohuken option:selected').attr('name');
                        $('#kenmei').val(val);
                        $('#sel_math').val(val2);
                        $('#sel_chiiki').val(val3);
                        $('#address_shiku').val(getTbkaiinJoho[19]);
                        $('#address_tatemono').val(getTbkaiinJoho[20]);
                        //流山市民かどうかのチェック
                        if (getTbkaiinJoho[57] == "") {
                            $("input:checkbox[id='nagareyama']:checked").val(1);
                            var qa = $("input:checkbox[id='nagareyama']:checked").val();
                            $("#sel_nagareyama").val(qa);
                        }
                        else {
                            // チェックが入っていない場合の処理
                            $("input:checkbox[id='nagareyama']").val(0);
                            var ww = $("input:checkbox[id='nagareyama']").val();
                            $("#sel_nagareyama").val(ww);
                        }
                            $('#address_yomi_shiku').val(getTbkaiinJoho[21]);
                            $('#address_yomi_tatemono').val(getTbkaiinJoho[22]);
                            $('#tel').val(getTbkaiinJoho[23]);
                            $('#keitai_tel').val(getTbkaiinJoho[25]);
                            $('#mail_address_1').val(getTbkaiinJoho[27]);
                            $('#mail_address_2').val(getTbkaiinJoho[28]);
                            //メール受信希望のメールアドレスを判断
                            if (getTbkaiinJoho[124] == "") {
                                $('input:radio[name="mail"]').val(["1"]);
                            }
                            if (getTbkaiinJoho[126] == "") {
                                $('input:radio[name="mail"]').val(["2"]);
                            }
                            //メールアドレス値セット
                            if ($("input:radio[id='mail_1']:checked").val()) {
                                var wa = $("input:radio[id='mail_1']:checked").val();
                                $("#mail").val(wa);
                                var ra = $("#mail").val();
                                var test1 = $('[name="mail"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_mail').val(test2);
                                var wawawa = $('#sel_mail').val();
                            } else {
                                //メールアドレス値セット
                                var wa = $("input:radio[id='mail_2']:checked").val();
                                $("#mail").val(wa);
                                var ra = $("#mail").val();
                                var test1 = $('[name="mail"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_mail').val(test2);
                                var wawawa = $('#sel_mail').val();
                            }
                            //メルマガ配信希望のチェック
                            if (getTbkaiinJoho[116] == "" || getTbkaiinJoho[117] == "") {
                                $('input:radio[name="merumaga"]').val(["1"]);
                            } else {
                                $('input:radio[name="merumaga"]').val(["2"]);
                            }
                            //メルマガに値セット
                            if ($("input:radio[id='merumaga_1']:checked").val()) {
                                var wa = $("input:radio[id='merumaga_1']:checked").val();
                                $("#merumaga").val(wa);
                                var test1 = $('[name="merumaga"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_merumaga').val(test2);
                            } else {
                                var wa = $("input:radio[id='merumaga_2']:checked").val();
                                $("#merumaga").val(wa);
                                var ra = $("#merumaga").val();
                                var test1 = $('[name="merumaga"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_merumaga').val(test2);
                            }
                            //連絡方法の希望のチェック
                            if (getTbkaiinJoho[114] == "") {
                                $('input:radio[name="hoho"]').val(["2"]);
                            }
                            if (getTbkaiinJoho[115] == "") {
                                $('input:radio[name="hoho"]').val(["1"]);
                            }
                            //メールでお知らせが選ばれていたらvalueに1を設定
                            if ($("input:radio[id='hoho_1']:checked").val()) {
                                var wa = $("input:radio[id='hoho_1']:checked").val();
                                $("#hoho").val(wa);
                                var ra = $("#hoho").val();
                                var test1 = $('[name="hoho"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_hoho').val(test2);
                                var wawawa = $('#sel_hoho').val();
                            } else {
                                var wa = $("input:radio[id='hoho_2']:checked").val();
                                $("#hoho").val(wa);
                                var ra = $("#hoho").val();
                                var test1 = $('[name="hoho"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_hoho').val(test2);
                                var wawawa = $('#sel_hoho').val();
                            }
                    }
                },
                fail: function(rtn) {
                    return false;
                },
                error: function(rtn) {
                    return false;
                }
            });
        }
        /***************************************************************
         * 選択済みのコンボ、ラジオ、チェックボックス初期表示処理
         ***************************************************************/
        //月日セレクトボックス
        var sel_month = $('#sel_month').val();
        if (sel_month != "") {
            $('#month').val(sel_month);
        }
        var sel_day = $('#sel_day').val();
        if (sel_day != "") {
            $('#day').val(sel_day);
        }
        // 性別ラジオボタン
        var wk_sel_gender = $('#wk_sel_gender').val();
        if (wk_sel_gender != "") {
            $('input:radio[name="gender"]').val([wk_sel_gender]);
        }
        //メール受信希望のメールアドレスボタン
        var wk_sel_mail = $('#mail').val();
        if (wk_sel_mail != "") {
            $('input:radio[name="mail"]').val([wk_sel_mail]);
        }
        //メルマガ受信希望ボタン
        var wk_sel_merumaga = $('#merumaga').val();
        if (wk_sel_merumaga != "") {
            $('input:radio[name="merumaga"]').val([wk_sel_merumaga]);
        }
        //連絡方法希望ボタン
        var wk_sel_hoho = $('#hoho').val();
        if (wk_sel_hoho != "") {
            $('input:radio[name="hoho"]').val([wk_sel_hoho]);
        }
        /********************************
         * 住所検索ボタン押下処理
         ********************************/
        $("#street_address_search").click(function() {

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
            jQuery.ajax({
                url:  '../../classes/searchPostNo.php',
                type: 'POST',
                data:
                {
                    postNo1: $("#address_yubin_nb_1").val(),
                    postNo2: $("#yubin_nb_2").val()
                },
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                        return false;
                    } else {
                        //※正常に住所情報を取得できた時の処理を書く場所
                        wk_msYubinNo = JSON.parse(rtn);
                        $("#address_todohuken option").filter(function(index){
                            return $(this).text() === wk_msYubinNo[7];
                        }).prop("selected", true);
                        $("#address_shiku").val(wk_msYubinNo[8] + wk_msYubinNo[9]);
                        $("#address_yomi_shiku").val(wk_msYubinNo[5] + wk_msYubinNo[6]);
                        //都道府県名をkenmeiにセット
                        var val = $('#address_todohuken option:selected').text();
                        $('#kenmei').val(val);
                    }
                },
                fail: function(rtn) {
                    $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                    return false;
                },
                error: function(rtn) {
                    $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                    return false;
                }
            });
        });
        /************************
         * 都道府県チェンジイベント
         ************************/
        //セレクトボックスが切り替わったら発動
        $('#address_todohuken').change(function() {
            var val = $('#address_todohuken option:selected').text();
            var val2 = $('#address_todohuken option:selected').val();
            var val3 = $('#address_todohuken option:selected').attr('name');
            $('#kenmei').val(val);
            $('#sel_math').val(val2);
            $('#sel_chiiki').val(val3);
        });
        // /************************
        //  * 性別ボタンチェンジイベント
        //  ************************/
        $("input:radio[name='gender']").change(function() {
            //男性hidden設定
            if ($("input:radio[id='gender_1']:checked").val()) {
                var wa = $("input:radio[id='gender_1']:checked").val();
                $("#wk_sel_gender").val(wa);
                var ra = $("#wk_sel_gender").val();
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
                var wawawa = $('#sel_gender').val();
            } else {
            //女性hidden設定
                var wa = $("input:radio[id='gender_2']:checked").val();
                $("#wk_sel_gender").val(wa);
                var ra = $("#wk_sel_gender").val();
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
                var wawawa = $('#sel_gender').val();
            }
        });
        // /************************
        //  * メールアドレスボタンチェンジイベント
        //  ************************/
        $("input:radio[name='mail']").change(function() {
            //メールアドレス値セット
            if ($("input:radio[id='mail_1']:checked").val()) {
                var wa = $("input:radio[id='mail_1']:checked").val();
                $("#mail").val(wa);
                var ra = $("#mail").val();
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_mail').val(test2);
                var wawawa = $('#sel_mail').val();
            } else {
                //メールアドレス値セット
                var wa = $("input:radio[id='mail_2']:checked").val();
                $("#mail").val(wa);
                var ra = $("#mail").val();
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_mail').val(test2);
                var wawawa = $('#sel_mail').val();
            }
        });
        // /************************
        //  * メルマガ配信希望ラジオボタンチェンジイベント
        //  ************************/
        $("input:radio[name='merumaga']").change(function() {
            //希望するが選ばれていたらvalueに1を設定
            if ($("input:radio[id='merumaga_1']:checked").val()) {
                var wa = $("input:radio[id='merumaga_1']:checked").val();
                $("#merumaga").val(wa);
                var ra = $("#merumaga").val();
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
                var wawawa = $('#sel_merumaga').val();
            } else {
                var wa = $("input:radio[id='merumaga_2']:checked").val();
                $("#merumaga").val(wa);
                var ra = $("#merumaga").val();
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
                var wawawa = $('#sel_merumaga').val();
            }
        });
        /************************
         * NSCAからのお知らせボタンチェンジイベント
         ************************/
        $("input:radio[name='hoho']").change(function() {
            //メールでお知らせが選ばれていたらvalueに1を設定
            if ($("input:radio[id='hoho_1']:checked").val()) {
                var wa = $("input:radio[id='hoho_1']:checked").val();
                $("#hoho").val(wa);
                var ra = $("#hoho").val();
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
                var wawawa = $('#sel_hoho').val();
            } else {
                var wa = $("input:radio[id='hoho_2']:checked").val();
                $("#hoho").val(wa);
                var ra = $("#hoho").val();
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
                var wawawa = $('#sel_hoho').val();
            }
        });
        /************************
         * 流山市民ボタンチェンジイベント
         ************************/
        // チェックボックスにチェックが入っているかチェック
        $("input:checkbox[name='nagareyama']").on('click', function() {
            if($(this).prop('checked') == true){
                // チェックが入っている場合の処理
                $("input:checkbox[id='nagareyama']:checked").val(1);
                var qa = $("input:checkbox[id='nagareyama']:checked").val();
                $("#sel_nagareyama").val(qa);
            }
            else {
                // チェックが入っていない場合の処理
                $("input:checkbox[id='nagareyama']").val(0);
                var ww = $("input:checkbox[id='nagareyama']").val();
                $("#sel_nagareyama").val(ww);
            }
        });
        /********************************
        * クリアボタン押下時の処理
        ********************************/
        $(".btn_gray").click(function() {
            jQuery.ajax({
                url:  '../../classes/getTbkaiinJoho2.php',
                success: function(rtn) {
                    // rtn = 0 の場合は、該当なし
                    if (rtn == 0) {
                        return false;
                    } else {
                        //※正常に情報を取得できた時入力フォームに表示する
                        getTbkaiinJoho = JSON.parse(rtn);
                        $('#name_sei').val(getTbkaiinJoho[7]);
                        $('#name_mei').val(getTbkaiinJoho[8]);
                        $('#name_sei_kana').val(getTbkaiinJoho[10]);
                        $('#name_mei_kana').val(getTbkaiinJoho[11]);
                        $('#year').val(getTbkaiinJoho[13].slice(0,4));
                        $('#month').val(getTbkaiinJoho[13].slice(5,7));
                        $('#day').val(getTbkaiinJoho[13].slice(8,10));
                        $('input:radio[name="gender"]').val([getTbkaiinJoho[14]]);
                        //性別の値セット処理
                        if ($("input:radio[id='gender_1']:checked").val()) {
                            var wa = $("input:radio[id='gender_1']:checked").val();
                            $("#wk_sel_gender").val(wa);
                            var ra = $("#wk_sel_gender").val();
                            var test1 = $('[name="gender"]:checked').attr('id');
                            var test2 = $('label[for="' + test1 + '"]').text();
                            $('#sel_gender').val(test2);
                            var wawawa = $('#sel_gender').val();
                        } else {
                        //女性hidden設定
                            var wa = $("input:radio[id='gender_2']:checked").val();
                            $("#wk_sel_gender").val(wa);
                            var ra = $("#wk_sel_gender").val();
                            var test1 = $('[name="gender"]:checked').attr('id');
                            var test2 = $('label[for="' + test1 + '"]').text();
                            $('#sel_gender').val(test2);
                            var wawawa = $('#sel_gender').val();
                        }
                        $('#address_yubin_nb_1').val(getTbkaiinJoho[15].slice(0,3));
                        $('#yubin_nb_2').val(getTbkaiinJoho[15].slice(3,7));
                        $('#address_todohuken').val(getTbkaiinJoho[16]);
                        //都道府県名をkenmeiにセット
                        var val = $('#address_todohuken option:selected').text();
                        $('#kenmei').val(val);
                        $('#address_shiku').val(getTbkaiinJoho[19]);
                        $('#address_tatemono').val(getTbkaiinJoho[20]);
                        //流山市民かどうかのチェック
                        if (getTbkaiinJoho[57] == "") {
                            $("#nagareyama").prop("checked", true);
                            $('#nagareyama').val("1");
                        }
                            $('#address_yomi_shiku').val(getTbkaiinJoho[21]);
                            $('#address_yomi_tatemono').val(getTbkaiinJoho[22]);
                            $('#tel').val(getTbkaiinJoho[23]);
                            $('#keitai_tel').val(getTbkaiinJoho[25]);
                            $('#mail_address_1').val(getTbkaiinJoho[27]);
                            $('#mail_address_2').val(getTbkaiinJoho[28]);
                            //メール受信希望のメールアドレスを判断
                            if (getTbkaiinJoho[124] == "") {
                                $('input:radio[name="mail"]').val(["1"]);
                            }
                            if (getTbkaiinJoho[126] == "") {
                                $('input:radio[name="mail"]').val(["2"]);
                            }
                            //メールアドレス値セット
                            if ($("input:radio[id='mail_1']:checked").val()) {
                                var wa = $("input:radio[id='mail_1']:checked").val();
                                $("#mail").val(wa);
                                var ra = $("#mail").val();
                                var test1 = $('[name="mail"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_mail').val(test2);
                                var wawawa = $('#sel_mail').val();
                            } else {
                                //メールアドレス値セット
                                var wa = $("input:radio[id='mail_2']:checked").val();
                                $("#mail").val(wa);
                                var ra = $("#mail").val();
                                var test1 = $('[name="mail"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_mail').val(test2);
                                var wawawa = $('#sel_mail').val();
                            }
                            //メルマガ配信希望のチェック
                            if (getTbkaiinJoho[116] == "" || getTbkaiinJoho[117] == "") {
                                $('input:radio[name="merumaga"]').val(["1"]);
                            } else {
                                $('input:radio[name="merumaga"]').val(["2"]);
                            }
                            //メルマガに値セット
                            if ($("input:radio[id='merumaga_1']:checked").val()) {
                                var wa = $("input:radio[id='merumaga_1']:checked").val();
                                $("#merumaga").val(wa);
                                var ra = $("#merumaga").val();
                                var test1 = $('[name="merumaga"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_merumaga').val(test2);
                                var wawawa = $('#sel_merumaga').val();
                            } else {
                                var wa = $("input:radio[id='merumaga_2']:checked").val();
                                $("#merumaga").val(wa);
                                var ra = $("#merumaga").val();
                                var test1 = $('[name="merumaga"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_merumaga').val(test2);
                                var wawawa = $('#sel_merumaga').val();
                            }
                            //連絡方法の希望のチェック
                            if (getTbkaiinJoho[114] == "") {
                                $('input:radio[name="hoho"]').val(["2"]);
                            }
                            if (getTbkaiinJoho[115] == "") {
                                $('input:radio[name="hoho"]').val(["1"]);
                            }
                            //メールでお知らせが選ばれていたらvalueに1を設定
                            if ($("input:radio[id='hoho_1']:checked").val()) {
                                var wa = $("input:radio[id='hoho_1']:checked").val();
                                $("#hoho").val(wa);
                                var ra = $("#hoho").val();
                                var test1 = $('[name="hoho"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_hoho').val(test2);
                                var wawawa = $('#sel_hoho').val();
                            } else {
                                var wa = $("input:radio[id='hoho_2']:checked").val();
                                $("#hoho").val(wa);
                                var ra = $("#hoho").val();
                                var test1 = $('[name="hoho"]:checked').attr('id');
                                var test2 = $('label[for="' + test1 + '"]').text();
                                $('#sel_hoho').val(test2);
                                var wawawa = $('#sel_hoho').val();
                            }
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
        /********************************
        * 次へボタン押下時のエラーチェック
        ********************************/
        $("#next_button").click(function() {
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
            $("#err_mail_address_2").html("");
            $("#err_mail").html("");
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
                    wk_err_msg5 = wk_err_msg5 + "<br>" +"生年月日の西暦を入力してください。";
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
                    if($("#year").val() >= year1 || $("#year").val() <= 1899){
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
            if($("#month").val() == 0 || $("#day").val() == 0) {
                if (wk_err_msg5 == "") {
                wk_err_msg5 = "月日を選択してください";
                } else {
                    wk_err_msg5 = wk_err_msg5 + "<br>" + "月日を選択してください";
                }
                $("#err_birthday").html(wk_err_msg5);
            }

            //性別ラジオボタン選択チェック
            if (!$("input:radio[name='gender']:checked").val()) {
                //(!$('input[name="gender"]').prop('checked'))
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "性別を選択してください。";
                $("#err_gender").html(wk_err_msg);
            }
            // 郵便番号上3桁未入力チェック
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
            // 郵便番号下4桁未入力チェック
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
            } else {
                var test2 = $("#address_yubin_nb_1").val() + $("#yubin_nb_2").val();
            }
            //都道府県選択チェック
            if($("#address_todohuken").val() == 0) {
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
            //市区町村/番地(ヨミ)全角カナチェック
            if ($("#address_yomi_shiku").val() !== "") {
                if (wk_err_msg2 == "") {
                    var sei = $("#address_yomi_shiku").val();
                    var re = /^[ァ-ンｧ-ﾝﾞﾟ0-9０-９]+$/;
                    var sei = sei.match(re);
                    if (!sei) {
                        wk_err_msg2 == "";
                        wk_err_msg2 = "市区町村/番地はカタカナと数字で、空白を入れないで入力してください。";
                        $("#err_address_yomi_shiku").html(wk_err_msg2);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#address_yomi_shiku").focus();
                            wk_focus_done = 1;
                        }
                    }
                }
            }
            //建物/部屋番号(ヨミ)全角カナチェック
            if ($("#address_yomi_tatemono").val() !== "") {
                if (wk_err_msg3 == "") {
                    var sei = $("#address_yomi_tatemono").val();
                    var re = /^[ァ-ンｧ-ﾝﾞﾟ0-9０-９]+$/;
                    var sei = sei.match(re);
                    if (!sei) {
                        wk_err_msg3 == "";
                        wk_err_msg3 = "建物/部屋番号はカタカナと数字で、空白を入れないで入力してください。";
                        $("#err_address_yomi_tatemono").html(wk_err_msg3);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#address_yomi_tatemono").focus();
                            wk_focus_done = 1;
                        }
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
                    var tel = document.getElementById('tel').value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,'');
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
                    var keitaitel = document.getElementById('keitai_tel').value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,'');
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
                    $("#err_mail_address_1").html(wk_err_msg);
                    $("#err_mail_address_2").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#mail_address_1").focus();
                        wk_focus_done = 1;
                    }
            }
            //メール受信希望未選択チェック
            if (!$("input:radio[name='mail']:checked").val()) {
            //if (!$('input[name="mail"]').prop('checked')) {
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
                    wk_err_msg = "メールアドレス_1を入力してください。";
                    $("#err_mail_address_1").html(wk_err_msg);
                }
            }
            //メール受信希望2選択時チェック
            if ($('input[id="mail_2"]').prop('checked')) {
                if ($("#mail_address_2").val() == "") {
                    $("#err_mail_address_1").html("");
                    wk_err_msg == "";
                    wk_err_msg = "メールアドレス_2を入力してください。";
                    $("#err_mail_address_2").html(wk_err_msg);
                }
            }
            //メルマガ受信希望選択チェック
            if (!$("input:radio[name='merumaga']:checked").val()) {
                //(!$('input[name="merumaga"]').prop('checked'))
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "メルマガ配信の希望を選択してください。";
                $("#err_merumaga").html(wk_err_msg);
            }
            //連絡方法の未選択チェック
            if (!$("input:radio[name='hoho']:checked").val()) {
                //(!$('input[name="hoho"]').prop('checked'))
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
             url = '../changeConfirmRiyo/';
            $('form').attr('action', url);
            $('form').submit();
        });
    });
})(jQuery);
