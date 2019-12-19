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
        console.log(wk_sel_gender);
        if (wk_sel_gender != "") {
            console.log(1234567890);
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

        /*************************************
         * //画面初期表示で次へボタンを無効にする
         *************************************/
        $('button[type="submit"]').prop("disabled", true);
        /*************************************
         * //画面初期表示で流山市民のvalueを0にする
         *************************************/
        $("input:checkbox[id='nagareyama']").val(0);

        // /************
        //  * //月日取得
        //  ************/
        // //1～12の数字を生成
        // for (var i = 1; i <= 12; i++) {
        //     $('#month').append('<option value="' + i + '">' + i + '</option>');
        // }
        // //1～31の数字を生成
        // for (var i = 1; i <= 31; i++) {
        //     $('#day').append('<option value="' + i + '">' + i + '</option>');
        // }
        // /*********************************
        //  * //うるう年・月ごとの最終日チェック
        //  *********************************/
        // function formSetDay() {
        //     var lastday = formSetLastDay($('#year').val(), $('#month').val());
        //     var option = '';
        //     for (var i = 1; i <= lastday; i++) {
        //       if (i === $('#day').val()) {
        //         option += '<option value="' + i + '" selected="selected">' + i + '</option>\n';
        //       } else {
        //         option += '<option value="' + i + '">' + i + '</option>\n';
        //       }
        //     }
        //     $('#day').html(option);
        //   }
        //   function formSetLastDay(year, month) {
        //     var lastday = new Array('', 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        //     if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0) {
        //       lastday[2] = 29;
        //     }
        //     return lastday[month];
        //   }
        //   $('#year, #month').change(function() {
        //     formSetDay();
        //   });


        /********************************
         * 住所検索ボタン押下処理
         ********************************/
        $("#job_address_search").click(function() {

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
            console.log(val);
            console.log(val2);
            console.log(val3)
            $('#kenmei').val(val);
            $('#sel_math').val(val2);
            $('#sel_chiiki').val(val3);
            var we = $('#sel_math').val();
            console.log(we);
        });
        // /************************
        //  * 性別ボタンチェンジイベント
        //  ************************/
        $("input:radio[name='gender']").change(function() {
            console.log(1342541513);
            //男性hidden設定
            if ($("input:radio[id='gender_1']:checked").val()) {
                var wa = $("input:radio[id='gender_1']:checked").val();
                $("#wk_sel_gender").val(wa);
                var ra = $("#wk_sel_gender").val();
                console.log(ra);           
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_gender').val(test2);
                var wawawa = $('#sel_gender').val();
                console.log(wawawa);
            } else {
            //女性hidden設定
                var wa = $("input:radio[id='gender_2']:checked").val();
                $("#wk_sel_gender").val(wa);
                var ra = $("#wk_sel_gender").val();
                console.log(ra);           
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_gender').val(test2);
                var wawawa = $('#sel_gender').val();
                console.log(wawawa);
            }
        });
        // /************************
        //  * メールアドレスボタンチェンジイベント
        //  ************************/
        $("input:radio[name='mail']").change(function() {
            //男性hidden設定
            if ($("input:radio[id='mail_1']:checked").val()) {
                var wa = $("input:radio[id='mail_1']:checked").val();
                $("#mail").val(wa);
                var ra = $("#mail").val();
                console.log(ra);           
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_mail').val(test2);
                var wawawa = $('#sel_mail').val();
                console.log(wawawa);
            } else {
                //女性hidden設定
                var wa = $("input:radio[id='mail_2']:checked").val();
                $("#mail").val(wa);
                var ra = $("#mail").val();
                console.log(ra);           
                var test1 = $('[name="mail"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_mail').val(test2);
                var wawawa = $('#sel_mail').val();
                console.log(wawawa);
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
                console.log(ra);           
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_merumaga').val(test2);
                var wawawa = $('#sel_merumaga').val();
                console.log(wawawa);    
            } else {
                var wa = $("input:radio[id='merumaga_2']:checked").val();
                $("#merumaga").val(wa);
                var ra = $("#merumaga").val();
                console.log(ra);           
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_merumaga').val(test2);
                var wawawa = $('#sel_merumaga').val();
                console.log(wawawa);    
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
                console.log(ra);           
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_hoho').val(test2);
                var wawawa = $('#sel_hoho').val();
                console.log(wawawa);    
            } else {
                var wa = $("input:radio[id='hoho_2']:checked").val();
                $("#hoho").val(wa);
                var ra = $("#hoho").val();
                console.log(ra);           
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                console.log(test2);
                $('#sel_hoho').val(test2);
                var wawawa = $('#sel_hoho').val();
                console.log(wawawa);    
            }
            // //郵便でお知らせが選ばれていたらvalueに1を設定
            // if ($("input:radio[id='hoho_2']:checked")) {
            //     if ($("input:radio[id='hoho_2']:checked").val() == "") {
            //         console.log(2222);
            //         $("input:radio[id='hoho_2']:checked").val(2);
            //         $("input:radio[id='hoho_1']").val("");
            //         var ew = $("#hoho_2").val();
            //         console.log(ew);   
            //     }  
            // } 
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
                console.log(qa);
                $("#sel_nagareyama").val(qa);
                var ha = $("#sel_nagareyama").val();
                console.log(ha);  
            }
            else {
                // チェックが入っていない場合の処理
                $("input:checkbox[id='nagareyama']").val(0);
                var ww = $("input:checkbox[id='nagareyama']").val();
                $("#sel_nagareyama").val(ww);
                var hu = $("#sel_nagareyama").val();
                console.log(hu);
            }
        });
        /********************************
         * 次へボタン有効化処理
         ********************************/
        $("#doi").change(function() {     
            // チェックが入っていたら有効化
            if ( $(this).is(':checked') ){ 
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
            if($("#month").val()　== 0 || $("#day").val()　== 0) {
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
            } else {
                var test2 = $("#address_yubin_nb_1").val() + $("#yubin_nb_2").val();
                console.log(test2);
                
            }     
            //都道府県選択チェック
            if($("#address_todohuken").val()　== 0) {
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
                    var re = /^[ァ-ンヴー]*$/;
                    var sei = sei.match(re);
                    if (!sei) {
                        wk_err_msg2 == "";
                        wk_err_msg2 = "市区町村/番地(ヨミ)は全角カナで入力してください。";
                        $("#err_address_yomi_shiku").html(wk_err_msg2);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#address_yomi_shiku").focus();
                            wk_focus_done = 1;
                        }
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
            //建物/部屋番号(ヨミ)全角カナチェック
            if ($("#address_yomi_tatemono").val() !== "") {
                if (wk_err_msg3 == "") {
                    var sei = $("#address_yomi_tatemono").val();
                    var re = /^[ァ-ンヴー]*$/;
                    var sei = sei.match(re);
                    if (!sei) {
                        wk_err_msg3 == "";
                        wk_err_msg3 = "建物/部屋番号(ヨミ)は全角カナで入力してください。";
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
            // //メルマガ配信を希望する、かつ、メールアドレス_1を選択している時のvalueの設定
            // if ((document.getElementById("merumaga_1").checked == true) && (document.getElementById("mail_1").checked == true)) {
            //     document.getElementById("mail_1").value = 1;
            //     document.getElementById("mail_2").value = 0;
            // }
            // //メルマガ配信を希望する、かつ、メールアドレス_2を選択している時のvalueの設定
            // if ((document.getElementById("merumaga_1").checked == true) && (document.getElementById("mail_2").checked == true)) {
            //     document.getElementById("mail_1").value = 0;
            //     document.getElementById("mail_2").value = 1;
            // }
            // //メルマガ配信を希望しないを選択している時のvalueの設定
            // if (document.getElementById("merumaga_2").checked == true) {
            //     document.getElementById("mail_1").value = 0;
            //     document.getElementById("mail_2").value = 0;
            // }
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
                    wk_err_msg = "大文字と小文字のアルファベットおよび数字を1文字以上含む、"+ "<br>" + "8桁以上のパスワードを入力してください。";
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
                //(!$('input[name="hoho"]').prop('checked'))
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "NSCAからのお知らせの受信可否を選択してください。";
                $("#err_renraku_hoho").html(wk_err_msg);
               }

            // //連絡方法の希望未選択チェック
            // if ((document.getElementById("hoho_1").checked == false) && (document.getElementById("hoho_2").checked == false)) {   
            //     wk_err_msg == "";
            //     wk_err_msg = "NSCAからのお知らせの受信可否を選択してください。";
            //     $("#err_renraku_hoho").html(wk_err_msg);
            // }
            // //メールでお知らせにチェックがある場合valueに1をセット
            // if (document.getElementById("hoho_1").checked == true) {
            //     document.getElementById("hoho_1").value = 1;
            // }
            // //郵便でお知らせにチェックがある場合valueに0をセット
            // if (document.getElementById("hoho_2").checked == true) {
            //     document.getElementById("hoho_2").value = 0;
            // }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "" || wk_err_msg1 != "" || wk_err_msg2 != "" || wk_err_msg3 != "" || wk_err_msg4 != "" || wk_err_msg5 != "") {
                console.log(111); 
                return false;
             }
             //エラーがない場合確認画面に画面遷移
             url = '../confirmRiyo/';
            $('form').attr('action', url);
            $('form').submit();


        //     // 郵便番号下未入力チェック
        //     if ($("#yubin_nb_2").val() == "") {
        //         if (wk_err_msg == "") {
        //             wk_err_msg = "郵便番号が未入力です。";
        //         }
        //         if (wk_focus_done == 0) {
        //             $("#yubin_nb_2").focus();
        //             wk_focus_done = 1;
        //         }
        //     }
        //     //郵便番号正規表現チェック
        //     var postcode = $("#address_yubin_nb_1").val() + '-' + $("#yubin_nb_2").val();
        //     var re = /^\d{3}-?\d{4}$/;
        //     var postcode = postcode.match(re);
        //     if (!postcode) {
        //         if (wk_err_msg == "") {
        //             wk_err_msg = "正しい郵便番号を半角数字で入力してください。";
        //         }
        //         if (wk_focus_done == 0) {
        //             $("#address_yubin_nb_1").focus();
        //             wk_focus_done = 1;
        //         }
        //     }

             




            //  //郵便番号検索処理
            // jQuery.ajax({
            //     url:  '../../classes/searchPostNo.php',
            //     type: 'POST',
            //     data:
            //     {
            //         postNo1: $("#address_yubin_nb_1").val(),
            //         postNo2: $("#yubin_nb_2").val()
            //     },
            //     success: function(rtn) {
            //         // rtn = 0 の場合は、該当なし
            //         if (rtn == 0) {
            //             $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //             return false;
            //         } else {
            //             //※正常に住所情報を取得できた時の処理を書く場所
            //             wk_msYubinNo = JSON.parse(rtn);
            //             $("#address_todohuken option").filter(function(index){
            //                 return $(this).text() === wk_msYubinNo[7]; 
            //             }).prop("selected", true);
            //             $("#address_shiku").val(wk_msYubinNo[8]);
            //             $("#address_tatemono").val(wk_msYubinNo[9]);
            //             $("#address_yomi_shiku").val(wk_msYubinNo[5]);
            //             $("#address_yomi_tatemono").val(wk_msYubinNo[6]);  
            //         }
            //     },
            //     fail: function(rtn) {
            //         $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //         return false;
            //     },
            //     error: function(rtn) {
            //         $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
            //         return false;
            //     }
            // });
        });
    });
})(jQuery);
