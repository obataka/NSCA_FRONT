(function ($) {
    $(document).ready(function () {

        /*********************************
         * //会員情報取得
         *********************************/
        $.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            getTbkaiinJoho = JSON.parse(rtn);
            //取得した会員情報データを表示する
            $("#kaiin_no").html(getTbkaiinJoho[0]);
            $("#shimei").html(getTbkaiinJoho["shimei_sei"] + " " + getTbkaiinJoho["shimei_mei"]);
            $("#furigana").html(getTbkaiinJoho["furigana_sei"] + " " + getTbkaiinJoho["furigana_mei"]);
            $("#firstlast").html(getTbkaiinJoho["last"] + " " + getTbkaiinJoho["first"]);
            $("#tel").html(getTbkaiinJoho["tel"]);
            $("#address").html("〒" + getTbkaiinJoho["yubin_no"] + "<br>" + getTbkaiinJoho["kemmei"] + getTbkaiinJoho["jusho_1"] + "<br>" + getTbkaiinJoho["jusho_2"]);
            $("#pc_address").html(getTbkaiinJoho["email_1"]);

            //有効資格ラジオボタンの初期表示処理
            if (getTbkaiinJoho["cpraed_hoji_kbn"] == 1) {
                $("input:radio[id='shikaku_1']").prop("checked", true);

                //必ずご確認くださいのブロック非表示
                $("#shikaku_kakunin").empty();
            } else {
                $("input:radio[id='shikaku_2']").prop("checked", true);
                $('#shikaku_yuko').prop("disabled", true);
                $('#shikaku_yuko_month').prop("disabled", true);
                $('#shikaku_yuko_day').prop("disabled", true);
                $('#yuko_kigen').prop("disabled", true);
                $('#yuko_kigen_month').prop("disabled", true);
                $('#yuko_kigen_day').prop("disabled", true);

                //必ずご確認くださいのブロック表示
                $("#shikaku_kakunin").append(`
                <div class="bg_gray kakunin">
					<input id="kakunin" type="checkbox" name="" value="">
					<label class="checkbox" for="kakunin">必ずご確認ください</label>
					<ul class="error_ul">
						<li class="error" id="err_kakunin"></li>
				    </ul>
					<div class="bg_white">
						<div>
							<input id="kakunin_1" type="checkbox" name="" value="">
							<label class="checkbox" for="kakunin_1">有効なCPR/AED資格を保持せず受験した場合、<br>
								その試験結果の有効期限は受験日から1年間であることを確認しました。</label>
							<ul class="error_ul">
								<li class="error" id="err_kakunin_1"></li>
							</ul>
						</div>
						<div>
							<input id="kakunin_2" type="checkbox" name="" value="">
							<label class="checkbox" for="kakunin_2">有効なCPR/AEDの認定証のコピーを提出するまでは、<br>
								試験に合格しても資格認定されないことを確認しました。</label>
							<ul class="error_ul">
								<li class="error" id="err_kakunin_2"></li>
							</ul>
						</div>
					</div>
				</div>
                `);
            }

            if (getTbkaiinJoho["cpraed_ninteibi"] && getTbkaiinJoho["cpraed_yuko_kigembi"]) {
                var shikaku_yuko_val = getTbkaiinJoho["cpraed_ninteibi"].split("/");
                var yuko_kigen_val = getTbkaiinJoho["cpraed_yuko_kigembi"].split("/");
                $("#shikaku_yuko").val(shikaku_yuko_val[0]);
                $("#shikaku_yuko_month").val(shikaku_yuko_val[1]);
                $("#shikaku_yuko_day").val(shikaku_yuko_val[2]);
                $("#yuko_kigen").val(yuko_kigen_val[0]);
                $("#yuko_kigen_month").val(yuko_kigen_val[1]);
                $("#yuko_kigen_day").val(yuko_kigen_val[2]);
            }

            //hiddenタグにパラメータを設定する
            $("#wk_kaiin_no").val(getTbkaiinJoho[0]);
            $("#wk_shimei").val(getTbkaiinJoho["shimei_sei"] + " " + getTbkaiinJoho["shimei_mei"]);
            $("#wk_furigana").val(getTbkaiinJoho["furigana_sei"] + " " + getTbkaiinJoho["furigana_mei"]);
            $("#wk_firstlast").val(getTbkaiinJoho["last"] + " " + getTbkaiinJoho["first"]);
            $("#wk_tel").val(getTbkaiinJoho["tel"]);
            $("#wk_address").val(getTbkaiinJoho["yubin_no"] + getTbkaiinJoho["kemmei"] + getTbkaiinJoho["jusho_1"] + getTbkaiinJoho["jusho_2"]);
            $("#wk_pc_address").val(getTbkaiinJoho["email_1"]);
            $("#wk_shikaku_yuko").val(getTbkaiinJoho["cpraed_ninteibi"]);
            $("#wk_yuko_kigen").val(getTbkaiinJoho["cpraed_yuko_kigembi"]);

        }).fail((rtn) => {
            return false;
        });

        /*********************************
         * //職業取得
         *********************************/
        $.ajax({
            url: '../../classes/Common/getShokugyoList.php'
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    //※正常に職業情報を取得できた時の処理を書く場所
                    getMeishoList = JSON.parse(rtn);
                    $.each(getMeishoList, function (i, value) {
                        $('#job').append('<input id="job_' + value['meisho_cd'] + '" type="checkbox" name="job" value="' + value['meisho_cd'] + '"><label class="checkbox" for="job_' + value['meisho_cd'] + '">' + value['meisho'] + '</label><br>');
                    });
                }
            }
        }).fail((rtn) => {
            return false;
        });

        $("#changeMember").click(function () {
            location.href = "../changeMember/";
        });

        /*********************************
         * //職業チェックイベント
         *********************************/
        //配列と配列の内容を入れる変数の宣言
        var jobVal = "";
        var jobText = "";

        //職業チェック時処理と選択数制限処理
        $("#job").on('change', "input[name='job']", function () {
            //配列にチェックされた値とテキストを代入する
            arrjobVal = $("input[name='job']:checked").map(function () {
                return $(this).val();
            }).get();
            arrjobText = $("input[name='job']:checked").map(function () {
                var text = $(this).attr('id');
                return $('label[for="' + text + '"]').text();
            }).get();

            var chkCnt = $("input[name='job']:checked").length;
            var not = $("input[name='job']").not(':checked');
            //チェックが3つ付いたら、チェックされてないチェックボックスにdisabledを加える
            if (chkCnt >= 3) {
                not.prop("disabled", true);
            } else {
                //3つ以下ならisabledを外す
                not.prop("disabled", false);
            }
        });

        /************************
         * 確認ボタンチェンジイベント
         ************************/
        $("#kakunin").change(function () {
            if ($("input[name='kakunin']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_kakunin").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_kakunin").val(wa);
            }
        });

        /************************
         * 試験ポリシーボタンチェンジイベント
         ************************/
        $("#shiken_policy_doi").change(function () {
            if ($("input[name='shiken_policy_doi']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_shiken_policy_doi").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_shiken_policy_doi").val(wa);
            }
        });

        /************************
         * 試験キャンセルポリシーボタンチェンジイベント
         ************************/
        $("#cancel_policy_doi").change(function () {
            if ($("input[name='cancel_policy_doi']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_cancel_policy_doi").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_cancel_policy_doi").val(wa);
            }
        });

        /************************
         * 倫理規定ボタンチェンジイベント
         ************************/
        $("#rinri_doi").change(function () {
            if ($("input[name='rinri_doi']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_rinri_doi").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_rinri_doi").val(wa);
            }
        });

        /*********************************
         * //有効な資格ラジオボタンチェンジイベント
         *********************************/
        $("input:radio[name='shikaku']").change(function () {
            if (document.getElementById("shikaku_1").checked) {
                $('#shikaku_yuko').prop("disabled", false);
                $('#shikaku_yuko_month').prop("disabled", false);
                $('#shikaku_yuko_day').prop("disabled", false);
                $('#yuko_kigen').prop("disabled", false);
                $('#yuko_kigen_month').prop("disabled", false);
                $('#yuko_kigen_day').prop("disabled", false);

                //確認チェックボックスのチェックオフ
                $('#kakunin').prop('checked', false);
                $('#kakunin_1').prop('checked', false);
                $('#kakunin_2').prop('checked', false);

                //必ずご確認くださいのブロック非表示
                $("#shikaku_kakunin").empty();

            } else {
                $('#shikaku_yuko').prop("disabled", true);
                $('#shikaku_yuko_month').prop("disabled", true);
                $('#shikaku_yuko_day').prop("disabled", true);
                $('#yuko_kigen').prop("disabled", true);
                $('#yuko_kigen_month').prop("disabled", true);
                $('#yuko_kigen_day').prop("disabled", true);
                $('#shikaku_yuko').val("");
                $('#shikaku_yuko_month').val("");
                $('#shikaku_yuko_day').val("");
                $('#yuko_kigen').val("");
                $('#yuko_kigen_month').val("");
                $('#yuko_kigen_day').val("");

                //必ずご確認くださいのブロック表示
                $("#shikaku_kakunin").append(`
                <div class="bg_gray kakunin">
					<input id="kakunin" type="checkbox" name="kakunin" value="">
					<label class="checkbox" for="kakunin">必ずご確認ください</label>
					<ul class="error_ul">
						<li class="error" id="err_kakunin"></li>
				    </ul>
					<div class="bg_white">
						<div>
							<input id="kakunin_1" type="checkbox" name="" value="">
							<label class="checkbox" for="kakunin_1">有効なCPR/AED資格を保持せず受験した場合、<br>
								その試験結果の有効期限は受験日から1年間であることを確認しました。</label>
							<ul class="error_ul">
								<li class="error" id="err_kakunin_1"></li>
							</ul>
						</div>
						<div>
							<input id="kakunin_2" type="checkbox" name="" value="">
							<label class="checkbox" for="kakunin_2">有効なCPR/AEDの認定証のコピーを提出するまでは、<br>
								試験に合格しても資格認定されないことを確認しました。</label>
							<ul class="error_ul">
								<li class="error" id="err_kakunin_2"></li>
							</ul>
						</div>
					</div>
				</div>
                `);
            }
        });

        var wk_shikaku_yuko_month = "";
        var wk_shikaku_yuko_day = "";
        var wk_yuko_kigen_month = "";
        var wk_yuko_kigen_day = "";
        /********************************
       * 認定日,有効期限チェンジイベント
       ********************************/
        $('#shikaku_yuko_month').change(function () {
            wk_shikaku_yuko_month = $('#shikaku_yuko_month').val();

        });

        $('#shikaku_yuko_day').change(function () {
            wk_shikaku_yuko_day = $('#shikaku_yuko_day').val();

        });

        $('#yuko_kigen_month').change(function () {
            wk_yuko_kigen_month = $('#yuko_kigen_month').val();

        });

        $('#yuko_kigen_day').change(function () {
            wk_yuko_kigen_day = $('#yuko_kigen_day').val();

        });
        /********************************
        * 戻るボタン押下時の処理
        ********************************/
        $("#return_button").click(function () {
            url = '../selectCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 次へボタン押下時のエラーチェック
        ********************************/
        $("#next_button").click(function () {
            //エラーメッセージエリア初期化
            $("#err_job").html("");
            $("#err_shikaku_1").html("");
            $("#err_shikaku_yuko").html("");
            $("#err_yuko_kigen").html("");
            $("#err_shikaku_2").html("");
            $("#err_kakunin").html("");
            $("#err_kakunin_1").html("");
            $("#err_kakunin_2").html("");
            $("#err_shiken_policy_doi").html("");
            $("#err_cancel_policy_doi").html("");
            $("#err_rinri_doi").html("");
            $("#err_chui").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";
            var wk_err_msg_1 = "";

            //職業未選択チェック
            if ($('[name="job"]:checked').length == 0) {
                wk_err_msg = "";
                wk_err_msg = "職種がチェックされていません。職種をチェックしてください。";
                $("#err_job").html(wk_err_msg);
            }

            //有効な資格を所持している場合の処理
            if (document.getElementById("shikaku_1").checked == true) {
                //認定日（発行日）入力チェック
                if ($('#shikaku_yuko').val() == "" && $('#shikaku_yuko_month').val() == 0 && $('#shikaku_yuko_day').val() == 0) {
                    wk_err_msg_1 = "認定日（発行日）が入力されていません。認定日（発行日）を入力してください。";
                    $("#err_shikaku_yuko").html(wk_err_msg_1);

                } else if ($('#shikaku_yuko').val() == "" || $('#shikaku_yuko_month').val() == 0 || $('#shikaku_yuko_day').val() == 0) {
                    wk_err_msg_1 = "認定日（発行日）が入力されていません。認定日（発行日）を入力してください。";
                    $("#err_shikaku_yuko").html(wk_err_msg_1);
                }

                //認定日西暦正規表現チェック
                if ($("#shikaku_yuko").val() !== "") {
                    var year = $("#shikaku_yuko").val();
                    var re = /^[0-9]{4}$/;
                    var year = year.match(re);
                    //4桁の半角数字ではない場合
                    if (!year) {
                        wk_err_msg_1 = "";
                        wk_err_msg_1 = "認定日（発行日）が正しくありません。認定日（発行日）を正しく入力してください。";
                        $("#err_shikaku_yuko").html(wk_err_msg_1);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#shikaku_yuko").focus();
                            wk_focus_done = 1;
                        }
                    } else {
                        var today = new Date();
                        var year1 = today.getFullYear();
                        //1900~本年の範囲外の場合
                        if ($("#shikaku_yuko").val() >= year1 || $("#shikaku_yuko").val() <= 1899) {
                            wk_err_msg_1 = "";
                            wk_err_msg_1 = "認定日（発行日）は、1900～現在の年の間で入力してください。";

                            $("#err_shikaku_yuko").html(wk_err_msg_1);
                            //エラー箇所にフォーカスを当てる
                            if (wk_focus_done == 0) {
                                $("#shikaku_yuko").focus();
                                wk_focus_done = 1;
                            }
                        } else {
                            //認定日妥当性チェック
                            var strDate = $('#shikaku_yuko').val() + "/" + $('#shikaku_yuko_month').val() + "/" + $('#shikaku_yuko_day').val(); //変数に認定日を格納する
                            var dateObj = new Date(strDate);    //strDateをDateオブジェクトに変換

                            var y = dateObj.getFullYear();
                            var m = dateObj.getMonth() + 1;
                            var d = dateObj.getDate();

                            //getMonthとgetDateの値が9以下の場合2桁目をゼロ埋めする
                            if (m <= 9) {
                                m = "0" + m;
                            }
                            if (d <= 9) {
                                d = "0" + d;
                            }

                            var objStr = y + "/" + m + "/" + d;

                            if (strDate != objStr) {
                                wk_err_msg_1 = "";
                                wk_err_msg_1 = "認定日（発行日）が正しくありません。認定日（発行日）を正しく入力してください。";

                                $("#err_shikaku_yuko").html(wk_err_msg_1);
                                //エラー箇所にフォーカスを当てる
                                if (wk_focus_done == 0) {
                                    $("#shikaku_yuko").focus();
                                    wk_focus_done = 1;
                                }

                            }

                        }
                    }
                }


                //有効期限入力チェック
                if ($('#yuko_kigen').val() == "" && $('#yuko_kigen_month').val() == 0 && $('#yuko_kigen_day').val() == 0) {
                    wk_err_msg_1 = "";
                    wk_err_msg_1 = "有効期限が入力されていません。有効期限を入力してください。";
                    $("#err_yuko_kigen").html(wk_err_msg_1);

                } else if ($('#yuko_kigen').val() == "" || $('#yuko_kigen_month').val() == 0 || $('#yuko_kigen_day').val() == 0) {
                    wk_err_msg_1 = "";
                    wk_err_msg_1 = "有効期限が入力されていません。有効期限を入力してください。";
                    $("#err_yuko_kigen").html(wk_err_msg_1);

                }

                //有効期限西暦正規表現チェック
                if ($("#yuko_kigen").val() !== "") {
                    var year = $("#yuko_kigen").val();
                    var re = /^[0-9]{4}$/;
                    var year = year.match(re);
                    //4桁の半角数字ではない場合
                    if (!year) {
                        wk_err_msg_1 = "";
                        wk_err_msg_1 = "有効期限が正しくありません。有効期限を正しく入力してください。";
                        $("#err_yuko_kigen").html(wk_err_msg_1);

                        //エラー箇所にフォーカスを当てる
                        if (wk_focus_done == 0) {
                            $("#yuko_kigen").focus();
                            wk_focus_done = 1;
                        }
                    } else {
                        var today = new Date();
                        var year1 = today.getFullYear() + 50;
                        //1900~本年+50の範囲外の場合
                        if ($("#yuko_kigen").val() >= year1 || $("#syuko_kigen").val() <= 1899) {
                            wk_err_msg_1 = "";
                            wk_err_msg_1 = "有効期限は、1900～現在の年+50年の間で入力してください。";

                            $("#err_yuko_kigen").html(wk_err_msg_1);
                            //エラー箇所にフォーカスを当てる
                            if (wk_focus_done == 0) {
                                $("#yuko_kigen").focus();
                                wk_focus_done = 1;
                            }
                        } else {
                            //有効期限日妥当性チェック
                            var strDate = $('#yuko_kigen').val() + "/" + $('#yuko_kigen_month').val() + "/" + $('#yuko_kigen_day').val(); //変数に認定日を格納する
                            var dateObj = new Date(strDate); //strDateをDateオブジェクトに変換
                            var y = dateObj.getFullYear();
                            var m = dateObj.getMonth() + 1;
                            var d = dateObj.getDate();

                            //getMonthとgetDateの値が9以下の場合2桁目をゼロ埋めする
                            if (m <= 9) {
                                m = "0" + m;
                            }
                            if (d <= 9) {
                                d = "0" + d;
                            }

                            var objStr = y + "/" + m + "/" + d;

                            if (strDate != objStr) {
                                wk_err_msg_1 = "";
                                wk_err_msg_1 = "有効期限が正しくありません。有効期限を正しく入力してください。";

                                $("#err_yuko_kigen").html(wk_err_msg_1);
                                //エラー箇所にフォーカスを当てる
                                if (wk_focus_done == 0) {
                                    $("#yuko_kigen").focus();
                                    wk_focus_done = 1;
                                }

                            }

                        }
                    }
                }

            } else {
                //有効な資格を所持していない場合の処理
                if (!$('#kakunin').prop('checked') || !$('#kakunin_1').prop('checked') || !$('#kakunin_2').prop('checked')) {
                    wk_err_msg_1 = "";
                    wk_err_msg_1 = "確認事項がチェックされていません。確認事項をチェックしてください。";
                    $("#err_kakunin").html(wk_err_msg_1);

                }
            }

            if (!$('#shiken_policy_doi').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "試験ポリシーの同意がチェックされていません。試験ポリシーの同意をチェックしてください。";
                $("#err_shiken_policy_doi").html(wk_err_msg);

            }

            if (!$('#cancel_policy_doi').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "試験キャンセルポリシーの同意がチェックされていません。試験キャンセルポリシーの同意をチェックしてください。";
                $("#err_cancel_policy_doi").html(wk_err_msg);

            }

            if (!$('#rinri_doi').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "倫理規定・懲戒方針がチェックされていません。倫理規定・懲戒方針をチェックしてください。";
                $("#err_rinri_doi").html(wk_err_msg);

            }

            if (!$('#chui').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "注意事項がチェックされていません。注意事項をチェックしてください。";
                $("#err_chui").html(wk_err_msg);

            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "" || wk_err_msg_1 != "") {
                return false;
            }

            //配列の内容を変数jobTextとjobValに代入する
            var job_val = [];
            var job_text = [];
            $('input[name=job]:checked').each(function (i) {
                job_val.push($(this).val());
                job_text.push($('label[for="job_' + $(this).val() + '"]').text());
            });
            $.each(job_text, function () {
                jobText = jobText + this + ', ';
            });
            $.each(job_val, function () {
                jobVal = jobVal + this + ', ';
            });

            $('#sel_job').val(jobText);
            $('#wk_sel_job').val(jobVal);

            //hiddenタグに入力した認定日と有効期限を格納する
            if (wk_shikaku_yuko_day || wk_shikaku_yuko_month || wk_yuko_kigen_day || wk_yuko_kigen_month) {
                $('#wk_shikaku_yuko').val($('#shikaku_yuko').val() + "/" + wk_shikaku_yuko_month + "/" + wk_shikaku_yuko_day);
                $('#wk_yuko_kigen').val($('#yuko_kigen').val() + "/" + wk_yuko_kigen_month + "/" + wk_yuko_kigen_day);
            }

            //エラーがない場合出願時必要書類の確認画面に画面遷移
            url = '../entryConfirm/';
            $('form').attr('action', url);
            $('form').submit();

        });
    });
})(jQuery);