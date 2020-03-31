(function ($) {
    $(document).ready(function () {

        $(document).on('change', '#shikaku_99', function () {
            if ($('#shikaku_99').is(':checked')) {
                // テキストボックスを有効化
                $('#shikaku_sonota').prop('disabled', false);
            } else {
                // テキストボックスを無効化
                $('#shikaku_sonota').prop('disabled', true);
            }
        });

        $(document).on('change', '#bunya_99', function () {
            if ($('#bunya_99').is(':checked')) {
                // テキストボックスを有効化
                $('#bunya_sonota').prop('disabled', false);
            } else {
                // テキストボックスを無効化
                $('#bunya_sonota').prop('disabled', true);
            }
        });
        /****************
         * //都道府県取得
         ****************/
        $.ajax({
            url: '../../classes/Common/getTodofukenList.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に住所情報を取得できた時の処理を書く場所
                getTodofukenList = JSON.parse(rtn);
                $.each(getTodofukenList, function (i, value) {
                    $('#address_todohuken').append('<option name="' + value['kemmei'] + '" value="' + value['ken_no'] + '">' + value['kemmei'] + '</option>');
                    $('#office_todohuken').append('<option name="' + value['kemmei'] + '" value="' + value['ken_no'] + '">' + value['kemmei'] + '</option>');
                });
                // 修正で入力画面に戻ってきた時、都道府県のセレクトボックスの初期表示処理
                var test1 = $('#sel_math').val();
                // 選択済みの都道府県がある場合
                if (test1 != "") {
                    $('#address_todohuken').val(test1);
                }
                // 修正で入力画面に戻ってきた時、所属先都道府県のセレクトボックスの初期表示処理
                var test2 = $('#sel_office_math').val();
                // 選択済みの都道府県がある場合
                if (test2 != "") {
                    $('#office_todohuken').val(test2);
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /*********************************
         * //職業取得
         *********************************/
        $.ajax({
            url: '../../classes/Common/getShokugyoList.php'
        }).done((rtn) => {
            if (rtn == 0) {
                return false;
            } else {
                //※正常に職業情報を取得できた時の処理を書く場所
                getMeishoList = JSON.parse(rtn);
                $.each(getMeishoList, function (i, value) {
                    $('#job_1').append('<option value="' + value['meisho_cd'] + '">' + value['meisho'] + '</option>');
                    $('#job_2').append('<option value="' + value['meisho_cd'] + '">' + value['meisho'] + '</option>');
                    $('#job_3').append('<option value="' + value['meisho_cd'] + '">' + value['meisho'] + '</option>');
                });

                // 修正で入力画面に戻ってきた時、職業のセレクトボックスの初期表示処理
                var test1 = $('#sel_shoku_1').val();
                // 選択済みの職業がある場合
                if (test1 != "") {
                    $('#job_1').val(test1);
                }

                var test2 = $('#sel_shoku_2').val();
                // 選択済みの職業がある場合
                if (test2 != "") {
                    $('#job_2').val(test2);
                }

                var test3 = $('#sel_shoku_3').val();
                // 選択済みの職業がある場合
                if (test3 != "") {
                    $('#job_3').val(test3);
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /*********************************
        * //NSCA以外の認定資格取得
        *********************************/
        $.ajax({
            url: '../../classes/Common/getShikakuList.php'
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に資格情報を取得できた時の処理を書く場所
                getShikakuList = JSON.parse(rtn);
                $.each(getShikakuList, function (i, value) {
                    $('#nintei-shikaku-wrap').append('<div><input id="shikaku_' + value['meisho_cd'] + '" type="checkbox" name="shikaku" value="' + value['meisho_cd']
                    + '"><label class="checkbox" for="shikaku_' + value['meisho_cd'] + '">' + value['meisho'] + '</label></div>');
                });

                // NSCA以外の認定資格：確認画面からの戻りなどで、すでに選択済みの値がある場合は選択状態にするための処理
                var wk_sel_shikaku_1 = $('#wk_sel_shikaku').val();
                if (wk_sel_shikaku_1 != "") {
                    // 選択されたNSCAの以外の認定資格がある場合
                    // 文字列に存在する半角スペースを除去してから
                    // 「,」で分割し、配列に格納
                    var arr_sel_shikaku = wk_sel_shikaku_1.split(',');
                    $.each(arr_sel_shikaku, function () {
                        var wk_sel_shikaku_2 = this.replace(" ", "");
                        var wk_sel_shikaku_name = '#shikaku_' + wk_sel_shikaku_2;
                        $(wk_sel_shikaku_name).prop("checked", true);
                    });
                }
                //テキストボックス初期表示処理
                if ($('#shikaku_99').is(':checked')) {
                    // テキストボックスを有効化
                    $('#shikaku_sonota').prop('disabled', false);
                } else {
                    // テキストボックスを無効化
                    $('#shikaku_sonota').prop('disabled', true);
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /*********************************
        * //興味のある地域取得
        *********************************/
        $.ajax({
            url: '../../classes/Common/getChiikiList.php'
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に地域情報を取得できた時の処理を書く場所
                getAreaList = JSON.parse(rtn);
                $.each(getAreaList, function (i, value) {
                    $('#Area').append('<input id="chiiki_' + value['meisho_cd'] + '" type="checkbox" name="chiiki" value="' 
										+ value['meisho_cd'] + '"><label class="checkbox" for="chiiki_' + value['meisho_cd'] + '">' + value['chiikimei'] + '</label>');
                    if (value[1] == "甲信越") {
                        $('#Area').append('<br class="sp_no">');
                    }
                });

                // 興味のある地域：確認画面からの戻りなどで、すでに選択済みの値がある場合は選択状態にするための処理
                var wk_sel_k_chiiki_1 = $('#wk_sel_k_chiiki').val();
                if (wk_sel_k_chiiki_1 != "") {
                    // 選択された興味のある地域がある場合
                    // 文字列に存在する半角スペースを除去してから
                    // 「,」で分割し、配列に格納
                    var arr_sel_k_chiiki = wk_sel_k_chiiki_1.split(',');
                    $.each(arr_sel_k_chiiki, function () {
                        var wk_sel_k_chiiki_2 = this.replace(" ", "");
                        var wk_sel_k_chiiki_name = '#chiiki_' + wk_sel_k_chiiki_2;
                        $(wk_sel_k_chiiki_name).prop("checked", true);
                    });
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /*********************************
        * //興味のある分野取得
        *********************************/
        $.ajax({
            url: '../../classes/Common/getBunyaList.php'
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に分野情報を取得できた時の処理を書く場所
                getBunyaList = JSON.parse(rtn);
                $.each(getBunyaList, function (i, value) {
                    $('#Bunya').append('<input id="bunya_' + value['meisho_cd'] + '" type="checkbox" name="bunya" value="' + value['meisho_cd'] 
                    + '"><label class="checkbox" for="bunya_' + value['meisho_cd'] + '">' + value['meisho'] + '</label><br>');
                });

                //興味のある分野：確認画面からの戻りなどで、すでに選択済みの値がある場合は選択状態にするための処理
                var wk_sel_bunya_1 = $('#wk_sel_bunya').val();
                if (wk_sel_bunya_1 != "") {
                    // 選択された興味のある分野がある場合
                    // 文字列に存在する半角スペースを除去してから
                    // 「,」で分割し、配列に格納
                    var arr_sel_bunya = wk_sel_bunya_1.split(',');
                    $.each(arr_sel_bunya, function () {
                        var wk_sel_bunya_2 = this.replace(" ", "");
                        var wk_sel_bunya_name = '#bunya_' + wk_sel_bunya_2;
                        $(wk_sel_bunya_name).prop("checked", true);
                    });
                }
                //テキストボックス初期表示処理
                if ($('#bunya_99').is(':checked')) {
                    // テキストボックスを有効化
                    $('#bunya_sonota').prop('disabled', false);
                } else {
                    // テキストボックスを無効化
                    $('#bunya_sonota').prop('disabled', true);
                }

            }
        }).fail((rtn) => {
            return false;
        });

        /***************************************************************
         * 選択済みのコンボ、ラジオ、チェックボックス初期表示処理
         ***************************************************************/
        //会員種別ラジオボタン
        var wk_kaiinType = $('#kaiinType').val();
        var data = "";
        data = `<th><span class="required">必須</span>学生証</th>
                <td class="file">
                    <label for="file_front_up" id="input_label_front" class="button">アップロード（表面）</label>
                    <input type="file" id="file_front_up" name="file_front" accept="image/*">
                    <p id="file_front_thumb"></p>
                    <ul class="error_ul">
                        <li class="error" id="err_file_front"></li>
                    </ul>
                    <label for="file_back_up" id="input_label_back" class="button">アップロード（裏面）</label>
                    <input type="file" id="file_back_up" name="file_back"  accept="image/*">
                    <p id="file_back_thumb"></p>
                    <ul class="error_ul">
						<li class="error" id="err_file_back"></li>
					</ul>
					<ul class="up_text">
						<li>アップロードできるファイル形式は、JPG(jpg/jpeg)、PNG(png)、GIF(gif)となります。</li>
						<li>学生会員の方は必ずアップロードしてください。</li>
						<li>不鮮明なデータをお送り頂いた場合は、無効になります。</li>
						<li>有効期限、顔写真が明瞭で、学生証と認識できるかを事前にご確認ください。</li>
						<li>学生証の裏面に有効期限等がある場合は、裏面もアップロードしてください。</li>
						<li>NSCAジャパンにて学生証を確認するまでは、お手続きは完了いたしません。<br>
							学生証の確認には1週間程度かかる場合があります。</li>
					</ul>
				</td>
                `;
        if (wk_kaiinType != "") {
            if (wk_kaiinType == "利用会員(無料)") {
                $('#kaiin_select_0').prop("checked", true);
                $('#gakuseisho').empty();
            } else if (wk_kaiinType == "NSCA正会員") {
                $('#kaiin_select_1').prop("checked", true);
                $('#gakuseisho').empty();
            } else if (wk_kaiinType == "学生会員") {
                $('#kaiin_select_2').prop("checked", true);
                $('#gakuseisho').append(data);
            }
        }

        //英文購読オプション
        var wk_sel_option = $('#wk_sel_option').val();
        if (wk_sel_option != "") {
            $('input[name="option"]').prop("checked", true);
        }

        //月日セレクトボックス
        var sel_month = $('#sel_month').val();
        if (sel_month != "") {
            $('#month').val(sel_month);
        }
        var sel_day = $('#sel_day').val();
        if (sel_day != "") {
            $('#day').val(sel_day);
        }

        //性別ラジオボタン
        var wk_sel_gender = $('#wk_sel_gender').val();
        if (wk_sel_gender != "") {
            $('input:radio[name="gender"]').val([wk_sel_gender]);
        }

        //流山市民のチェック
        var wk_sel_nagareyama = $('#wk_sel_nagareyama').val();
        if (wk_sel_nagareyama != "") {
            $('input[name="nagareyama"]').prop("checked", true);
        }

        //メルマガ受信希望ボタン
        var wk_sel_merumaga = $('#wk_sel_merumaga').val();
        if (wk_sel_merumaga != "") {
            $('input:radio[name="merumaga"]').val([wk_sel_merumaga]);
        }

        //連絡方法希望ボタン
        var sel_hoho = $('#sel_hoho').val();
        if (sel_hoho != "") {
            if (sel_hoho == "メールでお知らせ") {
                $('#hoho_1').prop("checked", true);
            } else if (sel_hoho == "郵便でお知らせ") {
                $('#hoho_2').prop("checked", true);
            }
        }

        //郵便配達先希望ボタン
        var sel_yubin = $('#sel_yubin').val();
        if (sel_yubin != "") {
            if (sel_yubin == "自宅") {
                $('#yubin_1').prop("checked", true);
            } else if (sel_yubin == "勤務先／所属先") {
                $('#yubin_2').prop("checked", true);
            }
        }

        //ウェブサイト記載ボタン
        var sel_web = $('#sel_web').val();
        if (sel_web != "") {
            if (sel_web == "希望する") {
                $('#web_1').prop("checked", true);
            } else if (sel_web == "希望しない") {
                $('#web_2').prop("checked", true);
            }
        }

        //アンケート協力ボタン
        var sel_qa = $('#sel_qa').val();
        if (sel_qa != "") {
            if (sel_qa == "協力する") {
                $('#qa_1').prop("checked", true);
            } else if (sel_qa == "協力しない") {
                $('#qa_2').prop("checked", true);
            }
        }

        /*************************************
         * //画面初期表示で流山市民のvalueを0にする
         *************************************/
        $("input:checkbox[id='nagareyama']").val(0);

        /************************
         * ファイルアップロードイベント
         ************************/

        //サムネイル画像表示(表)
        $(document).on('change', "input[id='file_front_up']", function () {
            var file = $(this).prop('files')[0];

            // 画像以外は処理を停止
            if (!file.type.match('image.*')) {
                // クリア
                $(this).val('');
                $('#file_front_thumb').html('');
                return;
            }

            // 画像表示
            var reader = new FileReader();
            reader.onload = function () {
                var img_src = $('<img>').attr('src', reader.result);
                $('#file_front_thumb').html(img_src);
            }
            reader.readAsDataURL(file);
        });

        //サムネイル画像表示(裏)
        $(document).on('change', "input[id='file_back_up']", function () {
            var file = $(this).prop('files')[0];

            // 画像以外は処理を停止
            if (!file.type.match('image.*')) {
                // クリア
                $(this).val('');
                $('#file_back_thumb').html('');
                return;
            }

            // 画像表示
            var reader = new FileReader();
            reader.onload = function () {
                var img_src = $('<img>').attr('src', reader.result);
                $('#file_back_thumb').html(img_src);
            }
            reader.readAsDataURL(file);
        });


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
            $.ajax({
                url: '../../classes/Common/searchPostNo.php',
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
                    $("#address_todohuken").val("");
                    $("#address_shiku").val("");
                    $("#address_tatemono").val("");
                    $("#address_yomi_shiku").val("");
                    $("#address_yomi_tatemono").val("");
                    return false;
                } else {
                    //※正常に住所情報を取得できた時の処理を書く場所
                    wk_msYubinNo = JSON.parse(rtn);
                    $("#address_todohuken option").filter(function (index) {
                        return $(this).text() === wk_msYubinNo['kemmei_kana'];
                    }).prop("selected", true).change();
                    $("#address_shiku").val(wk_msYubinNo['jusho_1'] + wk_msYubinNo['jusho_2']);
                    $("#address_yomi_shiku").val(wk_msYubinNo['jusho_1_kana'] + wk_msYubinNo['jusho_2_kana']);
                }
            }).fail((rtn) => {
                $("#err_address_yubin_nb_1").html("郵便番号から住所を取得できません");
                $("#address_todohuken").val("");
                $("#address_shiku").val("");
                $("#address_tatemono").val("");
                $("#address_yomi_shiku").val("");
                $("#address_yomi_tatemono").val("");
                return false;
            });
        });

        /********************************
        * 住所検索ボタン押下処理(所属先)
        ********************************/
        $("#job_address_search").click(function () {
            // エラーメッセージエリア初期化
            $("#err_address_yubin_nb_2").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            // 郵便番号上未入力チェック
            if ($("#office_yubin_nb_1").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "郵便番号が未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#office_yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }

            // 郵便番号下未入力チェック
            if ($("#office_yubin_nb_2").val() == "") {
                if (wk_err_msg == "") {
                    wk_err_msg = "郵便番号が未入力です。";
                }
                if (wk_focus_done == 0) {
                    $("#office_yubin_nb_2").focus();
                    wk_focus_done = 1;
                }
            }

            //郵便番号正規表現チェック
            var postcode = $("#office_yubin_nb_1").val() + '-' + $("#office_yubin_nb_2").val();
            var re = /^\d{3}-?\d{4}$/;
            var postcode = postcode.match(re);
            if (!postcode) {
                if (wk_err_msg == "") {
                    wk_err_msg = "正しい郵便番号を半角数字で入力してください。";
                }
                if (wk_focus_done == 0) {
                    $("#office_yubin_nb_1").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                $("#err_address_yubin_nb_2").html(wk_err_msg);
                return false;
            }

            //郵便番号検索処理
            $.ajax({
                url: '../../classes/Common/searchPostNo.php',
                type: 'POST',
                data:
                {
                    postNo1: $("#office_yubin_nb_1").val(),
                    postNo2: $("#office_yubin_nb_2").val()
                },
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    $("#err_address_yubin_nb_2").html("郵便番号から住所を取得できません");
                    $("#office_todohuken").val("");
                    $("#office_shiku").val("");
                    $("#office_tatemono").val("");
                    $("#office_yomi_shiku").val("");
                    $("#office_yomi_tatemono").val("");
                    return false;
                } else {
                    //※正常に住所情報を取得できた時の処理を書く場所
                    wk_msYubinNo = JSON.parse(rtn);
                    $("#office_todohuken option").filter(function (index) {
                        return $(this).text() === wk_msYubinNo['kemmei_kana'];
                    }).prop("selected", true).change();
                    $("#office_shiku").val(wk_msYubinNo['jusho_1'] + wk_msYubinNo['jusho_2']);
                }
            }).fail((rtn) => {
                $("#err_address_yubin_nb_2").html("郵便番号から住所を取得できません");
                $("#office_todohuken").val("");
                $("#office_shiku").val("");
                $("#office_tatemono").val("");
                $("#office_yomi_shiku").val("");
                $("#office_yomi_tatemono").val("");
                return false;
            });
        });

        /************************
         * 会員種別ラジオボタンチェンジイベント
         ************************/
        var wk_cmControl;
        // 会費データ取得処理
        $.ajax({
            url: '../../classes/Common/getCmControl.php',
            type: 'POST',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                $("#err_kaihi").html("会費データが取得できません");
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
            }
        }).fail((rtn) => {
            $("#err_kaihi").html("会費データが取得できません");
            return false;
        });
        $("input:radio[name='kaiin_select']").change(function () {
            if ($("input:radio[id='kaiin_select_0']:checked").val()) {
                $("#kaiin").text("利用会員(無料)");
                $('#gakuseisho').empty();
                //利用会員(無料)hidden設定
                $("#kaihi").val("無料");
                console.log($("#kaihi").val());
                var sbt = $("input:radio[id='kaiin_select_0']:checked").val();
                $("#kaiinSbt").val(sbt);
                var test1 = $('[name="kaiin_select"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#kaiinType').val(test2);
            } else if ($("input:radio[id='kaiin_select_1']:checked").val()) {
                $("#kaiin").text("NSCA正会員");
                $('#gakuseisho').empty();
                //NSCA正会員hidden設定
                $("#kaihi").val(Math.floor(wk_cmControl['20']).toLocaleString());
                console.log($("#kaihi").val());
                var sbt = $("input:radio[id='kaiin_select_1']:checked").val();
                $("#kaiinSbt").val(sbt);
                var test1 = $('[name="kaiin_select"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#kaiinType').val(test2);
            } else {
                $("#kaiin").text("学生会員");
                $('#gakuseisho').append(data);
                //学生会員hidden設定
                $("#kaihi").val(Math.floor(wk_cmControl['21']).toLocaleString());
                console.log($("#kaihi").val());
                var sbt = $("input:radio[id='kaiin_select_2']:checked").val();
                $("#kaiinSbt").val(sbt);
                var test1 = $('[name="kaiin_select"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#kaiinType').val(test2);
            }
        });

        /************************
         * 英文購読オプションチェンジイベント
         ************************/
        $("#option").change(function () {
            if ($("input[name='option']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_sel_option").val(wa);
                var test = 'あり';
                $('#sel_option').val(test);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_sel_option").val(wa);
                var test = 'なし';
                $('#sel_option').val(test);
            }
        });

        // /************************
        //  * 性別ボタンチェンジイベント
        //  ************************/
        $("input:radio[name='gender']").change(function () {
            //男性hidden設定
            if ($("input:radio[id='gender_1']:checked").val()) {
                var wa = $("input:radio[id='gender_1']:checked").val();
                $("#wk_sel_gender").val(wa);
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
            } else {
                //女性hidden設定
                var wa = $("input:radio[id='gender_2']:checked").val();
                $("#wk_sel_gender").val(wa);
                var test1 = $('[name="gender"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_gender').val(test2);
            }
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
        //所属先都道府県の場合
        $('#office_todohuken').change(function () {
            var val = $('#office_todohuken option:selected').text();
            var val2 = $('#office_todohuken option:selected').val();
            var val3 = $('#office_todohuken option:selected').attr('name');
            $('#office_kenmei').val(val);
            $('#sel_office_math').val(val2);
            $('#sel_office_chiiki').val(val3);
        });

        /************************
         * 流山市民ボタンチェンジイベント
         ************************/
        $("#nagareyama").change(function () {
            if ($("input[name='nagareyama']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_sel_nagareyama").val(wa);
                var test = '流山市民です。';
                $('#sel_nagareyama').val(test);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_sel_nagareyama").val(wa);
                var test = '流山市民ではありません。';
                $('#sel_nagareyama').val(test);
                var wawawa = $('#sel_nagareyama').val();
            }
        });

        // /************************
        //  * メルマガ配信希望ラジオボタンチェンジイベント
        //  ************************/
        $("input:radio[name='merumaga']").change(function () {
            //希望するが選ばれていたらvalueに1を設定
            if ($("input:radio[id='merumaga_1']:checked").val()) {
                var wa = $("input:radio[id='merumaga_1']:checked").val();
                $("#wk_sel_merumaga").val(wa);
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
            } else {
                var wa = $("input:radio[id='merumaga_2']:checked").val();
                $("#wk_sel_merumaga").val(wa);
                var test1 = $('[name="merumaga"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_merumaga').val(test2);
            }
        });

        /************************
         * 職業チェンジイベント
         ************************/
        //セレクトボックスが切り替わったら発動
        $('#job_1').change(function () {
            var val = $('#job_1 option:selected').text();
            var val2 = $('#job_1 option:selected').val();
            $('#shoku_1').val(val);
            $('#sel_shoku_1').val(val2);
        });

        $('#job_2').change(function () {
            var val = $('#job_2 option:selected').text();
            var val2 = $('#job_2 option:selected').val();
            $('#shoku_2').val(val);
            $('#sel_shoku_2').val(val2);
        });

        $('#job_3').change(function () {
            var val = $('#job_3 option:selected').text();
            var val2 = $('#job_3 option:selected').val();
            $('#shoku_3').val(val);
            $('#sel_shoku_3').val(val2);
        });

        //配列と配列の内容を入れる変数の宣言
        var shikakuVal = "";
        var shikakuText = "";
        /************************
         * NSCA以外の認定資格チェンジイベント
         ************************/
        //配列にチェックされた値とテキストを代入する
        $("#nintei-shikaku-wrap").on('change', "input[name='shikaku']", function () {
            arrShikakuVal = $("input[name='shikaku']:checked").map(function () {
                return $(this).val();
            }).get();
            arrShikakuText = $("input[name='shikaku']:checked").map(function () {
                var text = $(this).attr('id');
                return $('label[for="' + text + '"]').text();
            }).get();
        });

        /************************
         * NSCAからのお知らせボタンチェンジイベント
         ************************/
        $("input:radio[name='hoho']").change(function () {
            //メールでお知らせが選ばれていたらvalueに1を設定
            if ($("input:radio[id='hoho_1']:checked").val()) {
                var wa = $("input:radio[id='hoho_1']:checked").val();
                $("#wk_sel_hoho").val(wa);
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
            } else {
                var wa = $("input:radio[id='hoho_2']:checked").val();
                $("#wk_sel_hoho").val(wa);
                var test1 = $('[name="hoho"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_hoho').val(test2);
            }
        });

        /************************
         * 郵便物配達先の希望ボタンチェンジイベント
         ************************/
        $("input:radio[name='yubin']").change(function () {
            //自宅が選ばれていたらvalueに0を設定
            if ($("input:radio[id='yubin_1']:checked").val()) {
                var wa = $("input:radio[id='yubin_1']:checked").val();
                $("#wk_sel_yubin").val(wa);
                var test1 = $('[name="yubin"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_yubin').val(test2);
            } else {
                var wa = $("input:radio[id='yubin_2']:checked").val();
                $("#wk_sel_yubin").val(wa);
                var test1 = $('[name="yubin"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_yubin').val(test2);
            }
        });
        /************************
         * 興味のある地域チェンジイベント
         ************************/
        //配列と配列の内容を入れる変数の宣言
        var chiikiVal = "";
        var chiikiText = "";
        //配列にチェックされた値とテキストを代入する
        $("#Area").on('change', "input[name='chiiki']", function () {
            arrChiikiVal = $("input[name='chiiki']:checked").map(function () {
                return $(this).val();
            }).get();

            arrChiikiText = $("input[name='chiiki']:checked").map(function () {
                var text = $(this).attr('id');
                return $('label[for="' + text + '"]').text();
            }).get();
        });

        /************************
         * ウェブサイト掲載ボタンチェンジイベント
         ************************/
        $("input:radio[name='web']").change(function () {
            //メールでお知らせが選ばれていたらvalueに1を設定
            if ($("input:radio[id='web_1']:checked").val()) {
                var wa = $("input:radio[id='web_1']:checked").val();
                $("#wk_sel_web").val(wa);
                var test1 = $('[name="web"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_web').val(test2);
            } else {
                var wa = $("input:radio[id='web_2']:checked").val();
                $("#wk_sel_web").val(wa);
                var test1 = $('[name="web"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_web').val(test2);
            }
        });
        /************************
         * アンケート協力ボタンチェンジイベント
         ************************/
        $("input:radio[name='qa']").change(function () {
            //メールでお知らせが選ばれていたらvalueに1を設定
            if ($("input:radio[id='qa_1']:checked").val()) {
                var wa = $("input:radio[id='qa_1']:checked").val();
                $("#wk_sel_qa").val(wa);
                var test1 = $('[name="qa"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_qa').val(test2);
            } else {
                var wa = $("input:radio[id='qa_2']:checked").val();
                $("#wk_sel_qa").val(wa);
                var test1 = $('[name="qa"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_qa').val(test2);
            }
        });

        /************************
         * 興味のある分野チェンジイベント
         ************************/
        //配列と配列の内容を入れる変数の宣言
        var bunyaVal = "";
        var bunyaText = "";
        //配列にチェックされた値とテキストを代入する
        $("#Bunya").on('change', "input[name='bunya']", function () {
            arrBunyaVal = $("input[name='bunya']:checked").map(function () {
                return $(this).val();
            }).get();

            arrBunyaText = $("input[name='bunya']:checked").map(function () {
                var text = $(this).attr('id');
                return $('label[for="' + text + '"]').text();
            }).get();
        });

        /********************************
          * クリアボタン押下時の処理
          ********************************/
        $("#clear").click(function () {
            document.continueConfirmMemberForm.reset();
        });

        /********************************
          * 退会をご希望の方はこちらボタン押下時の処理
          ********************************/
        $("#unsubscribe").click(function () {
            location.href = "../../unsubscride/";
        });

        /********************************
          * 次へボタン押下時のエラーチェック
          ********************************/
        $("#next").click(function () {
            //エラーメッセージエリア初期化
            $("#err_kaiin_select").html("");
            $("#err_file_front").html("");
            $("#err_file_back").html("");
            $("#err_riyu").html("");
            $("#err_name_sei").html("");
            $("#err_name_mei").html("");
            $("#err_name_sei_kana").html("");
            $("#err_name_mei_kana").html("");
            $("#err_name_last").html("");
            $("#err_name_first").html("");
            $("#err_birthday").html("");
            $("#err_gender").html("");
            $("#err_address_yubin_nb_1").html("");
            $("#err_address_todohuken").html("");
            $("#err_address_shiku").html("");
            $("#err_address_tatemono").html("");
            $("#err_tel").html("");
            $("#err_keitai_tel").html("");
            $("#err_fax").html("");
            $("#err_merumaga").html("");
            $("#err_renraku_hoho").html("");
            $("#err_yubin").html("");
            $("#err_web").html("");
            $("#err_qa").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";
            var wk_err_msg1 = "";
            var wk_err_msg2 = "";
            var wk_err_msg3 = "";
            var wk_err_msg4 = "";
            var wk_err_msg5 = "";

            //会員種別ラジオボタン選択チェック
            if (!$('input:radio[name="kaiin_select"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "会員種別を選択してください。";
                $("#err_kaiin_select").html(wk_err_msg);
            }

            if ($('#kaiinType').val() == "学生会員") {
                //学生証(表)チェック 学生会員のみ
                //inputフィールドの文字数を取得
                var fileCheck = $('#file_front_up').val().length;
                if (fileCheck == 0 && !$('#file_front').val()) {
                    wk_err_msg = "ファイルを選択してください。";
                    $("#err_file_front").html(wk_err_msg);
                    wk_err_msg = "";
                }

            }

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
                wk_err_msg = "フリガナ(セイ)を入力してください。";
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
                    wk_err_msg = "フリガナ(セイ)は全角カナで入力してください。";
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
                wk_err_msg = "フリガナ(メイ)を入力してください。";
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
                    wk_err_msg = "フリガナ(メイ)は全角カナで入力してください。";
                    $("#err_name_mei_kana").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#name_mei_kana").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //Last(姓)未入力チェック
            if ($("#name_last").val() == "") {
                wk_err_msg = "Last(姓)を入力してください。";
                $("#err_name_last").html(wk_err_msg);
                wk_err_msg = "";
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_last").focus();
                    wk_focus_done = 1;
                }
            }
            //First(名)未入力チェック
            if ($("#name_first").val() == "") {
                wk_err_msg = "";
                wk_err_msg = "First(名)を入力してください。";
                $("#err_name_first").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#name_first").focus();
                    wk_focus_done = 1;
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
            if (!$('input:radio[name="gender"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "性別を選択してください。";
                $("#err_gender").html(wk_err_msg);
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
                wk_err_msg = "市区町村／番地を入力してください。";
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

            //市区町村/番地(ヨミ)カナチェック
            if ($("#address_yomi_shiku").val() !== "") {
                if (wk_err_msg2 == "") {
                    var sei = $("#address_yomi_shiku").val();
                    var re = /^[ァ-ンヴー|ｧ-ﾝﾞﾟ\-|0-9]*$/;
                    var sei = sei.match(re);
                    if (!sei) {
                        wk_err_msg2 == "";
                        wk_err_msg2 = "市区町村／番地(ヨミ)はカナで入力してください。";
                        $("#err_address_yomi_shiku").html(wk_err_msg2);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#address_yomi_shiku").focus();
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
            //FAX桁数チェック
            if ($("#fax").val() !== "") {
                if (wk_err_msg4 == "") {
                    var tel = document.getElementById('fax').value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');
                    if (!tel.match(/^[0-9]{10}$/)) {
                        wk_err_msg4 == "";
                        wk_err_msg4 = "FAXは10桁の半角数字で入力してください。";
                        $("#err_fax").html(wk_err_msg4);
                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#fax").focus();
                            wk_focus_done = 1;
                        }
                    }
                }
            }

            //メルマガ受信希望選択チェック
            if (!$('input:radio[name="merumaga"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "メルマガ配信の希望を選択してください。";
                $("#err_merumaga").html(wk_err_msg);
            }

            //その他記述未入力チェック(NSCA以外の認定資格)
            if ($('textarea[name="shikaku_sonota"]').val() == "" && $('#shikaku_99').is(':checked')) {
                wk_err_msg = "";
                wk_err_msg = "NSCA以外の認定資格を記述してください。";
                $("#err_shikaku").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#shikaku_sonota").focus();
                    wk_focus_done = 1;
                }
            }

            //連絡方法の未選択チェック
            if (!$('input:radio[name="hoho"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "NSCAからのお知らせの受信可否を選択してください。";
                $("#err_renraku_hoho").html(wk_err_msg);
            }

            //郵便物配達先の希望の未選択チェック
            if (!$('input:radio[name="yubin"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "郵便物配達先の希望を選択してください。";
                $("#err_yubin").html(wk_err_msg);
            }

            //ウェブサイト掲載の希望の未選択チェック
            if (!$('input:radio[name="web"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "ウェブサイト掲載の希望を選択してください。";
                $("#err_web").html(wk_err_msg);
            }

            //アンケート協力の希望の未選択チェック
            if (!$('input:radio[name="qa"]:checked').val()) {
                //チェックされていない場合
                wk_err_msg == "";
                wk_err_msg = "アンケート協力の希望を選択してください。";
                $("#err_qa").html(wk_err_msg);
            }
            //その他記述未入力チェック(興味のある分野)
            if ($('textarea[name="bunya_sonota"]').val() == "" && $('#bunya_99').is(':checked')) {
                wk_err_msg = "";
                wk_err_msg = "興味のある分野を記述してください。";
                $("#err_bunya").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#bunya_sonota").focus();
                    wk_focus_done = 1;
                }
            }
            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "" || wk_err_msg1 != "" || wk_err_msg2 != "" || wk_err_msg3 != "" || wk_err_msg4 != "" || wk_err_msg5 != "") {
                return false;
            }
            //その他(記述)の記述部分のhidden設定
            riyu_sonota = $('textarea[name="riyu_sonota"]').val();
            $('#sel_riyu_sonota').val(riyu_sonota);

            shikaku_sonota = $('textarea[name="shikaku_sonota"]').val();
            $('#sel_shikaku_sonota').val(shikaku_sonota);

            bunya_sonota = $('textarea[name="shikaku_sonota"]').val();
            $('#sel_bunya_sonota').val(bunya_sonota);

            //配列の内容を変数shikakuTextとshikakuValに代入する
            var vals1_val = [];
            var vals1_text = [];
            $('input[name=shikaku]:checked').each(function (i) {
                vals1_val.push($(this).val());
                vals1_text.push($('label[for="shikaku_' + $(this).val() + '"]').text());
            });
            $.each(vals1_text, function () {
                shikakuText = shikakuText + this + ', ';
            });
            $.each(vals1_val, function () {
                shikakuVal = shikakuVal + this + ', ';
            });

            //配列の内容を変数chiikiTextとchiikiValに代入する
            var vals2_val = [];
            var vals2_text = [];
            $('input[name=chiiki]:checked').each(function (i) {
                vals2_val.push($(this).val());
                vals2_text.push($('label[for="chiiki_' + $(this).val() + '"]').text());
            });
            $.each(vals2_text, function () {
                chiikiText = chiikiText + this + ', ';
            });
            $.each(vals2_val, function () {
                chiikiVal = chiikiVal + this + ', ';
            });

            //配列の内容を変数bunyaTextとbunyaValに代入する
            var vals3_val = [];
            var vals3_text = [];
            $('input[name=bunya]:checked').each(function (i) {
                vals3_val.push($(this).val());
                vals3_text.push($('label[for="bunya_' + $(this).val() + '"]').text());
            });
            $.each(vals3_text, function () {
                bunyaText = bunyaText + this + ', ';
            });
            $.each(vals3_val, function () {
                bunyaVal = bunyaVal + this + ', ';
            });

            $('#sel_shikaku').val(shikakuText);
            $('#wk_sel_shikaku').val(shikakuVal);
            $('#sel_k_chiiki').val(chiikiText);
            $('#wk_sel_k_chiiki').val(chiikiVal);
            $('#sel_bunya').val(bunyaText);
            $('#wk_sel_bunya').val(bunyaVal);

            //エラーがない場合確認画面に画面遷移
            url = '../continueMemberConfirm/';
            $('form').attr('action', url);
            $('form').submit();

        });

    });
})(jQuery);
