(function ($) {
    $(document).ready(function () {
        //取得学位と学位分野を格納する変数
        var shutoku_gakui = "";
        var gakui_bunya = "";

        //卒業予定日を初期表示時に使用不可にする
        $('#yotei_year').prop("disabled", true);
        $('#yotei_month').prop("disabled", true);
        $('#yotei_day').prop("disabled", true);
        $('#gakui_sonota').prop("disabled", true);

        /*********************************
         * //最終取得学位取得
         *********************************/
        jQuery.ajax({
            url: '../../classes/getShutokuGakui.php',
        }).done((rtn) => {
            getShutokuGakui = JSON.parse(rtn);
            if (getShutokuGakui != "") {
                //卒業予定日初期表示処理
                if (getShutokuGakui['sotsugyo_yoteibi'] != "") {
                    var sotsugyo_yoteibi_val = getShutokuGakui['sotsugyo_yoteibi'].split("/");
                    $('#yotei_year').val(sotsugyo_yoteibi_val[0]);
                    $('#yotei_month').val(sotsugyo_yoteibi_val[1]);
                    $('#yotei_day').val(sotsugyo_yoteibi_val[2]);

                    shutoku_gakui = getShutokuGakui['gakui_kbn'];
                    gakui_bunya = getShutokuGakui['shutoku_gakui_bunya_kbn'];

                    $('#gakui_sonota').val(getShutokuGakui['shutoku_gakui']);

                }

            }

        }).fail((rtn) => {
            return false;
        });

        /*********************************
         * //最終取得学位名称取得
         *********************************/
        jQuery.ajax({
            url: '../../classes/getShutokuGakuiMeisho.php',
        }).done((rtn) => {
            getShutokuGakuiMeisho = JSON.parse(rtn);
            getShutokuGakuiMeisho.reverse();
            $.each(getShutokuGakuiMeisho, function (i, value) {
                $('#shutoku_gakui').prepend('<input id="gakui_' + value[0] + '" type="radio" name="gakui" value="' + value[0] + '"><label for="gakui_' + value[0] + '">' + value[1] + '</label>');
                if (value[1] == "学士") {
                    $('#shutoku_gakui').prepend('<br class="sp_br">');
                }

                //取得学位の値がある場合、初期表示時に選択済みにする。
                if (shutoku_gakui != "") {
                    $("input:radio[id='gakui_" + value[0] + "']").prop("checked", true);
                    if (document.getElementById("gakui_5").checked) {
                        //卒業見込みが選択された場合、卒業予定日を使用可能にする。
                        //それ以外は使用不可にする。
                        $('#yotei_year').prop("disabled", false);
                        $('#yotei_month').prop("disabled", false);
                        $('#yotei_day').prop("disabled", false);
                    } else {
                        $('#yotei_year').prop("disabled", true);
                        $('#yotei_month').prop("disabled", true);
                        $('#yotei_day').prop("disabled", true);
                    }
                }

            });

        }).fail((rtn) => {
            return false;
        });

        /*********************************
         * //取得学位分野または卒業見込みの学位分野取得
         *********************************/
        jQuery.ajax({
            url: '../../classes/getShutokuGakuiBunya.php',
        }).done((rtn) => {
            getShutokuGakuiMeisho = JSON.parse(rtn);
            $.each(getShutokuGakuiMeisho, function (i, value) {
                $('#gakui_bunya').append('<option value="' + value[0] + '">' + value[1] + '</option>');
            });

            //学位分野の値がある場合、初期表示時に選択済みにする。
            if (gakui_bunya != "") {
                $('#gakui_bunya').val(gakui_bunya);
            }

        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 取得学位チェンジイベント
        ********************************/
        $("#shutoku_gakui").on('change', "input:radio[name='gakui']", function () {
            var val = $('input[name="gakui"]:checked').val();
            console.log(val);
            $('#wk_gakui').val(val);
            var text1 = $('[name="gakui"]:checked').attr('id');
            var text2 = $('label[for="' + text1 + '"]').text();
            console.log(text2);
            $('#wk_txt_gakui').val(text2);
            if (document.getElementById("gakui_5").checked) {
                //卒業見込みが選択された場合、卒業予定日を使用可能にする。
                //それ以外は使用不可にする。
                $('#yotei_year').prop("disabled", false);
                $('#yotei_month').prop("disabled", false);
                $('#yotei_day').prop("disabled", false);
            } else {
                $('#yotei_year').val("");
                $('#yotei_year').prop("disabled", true);
                $('#yotei_month').val("");
                $('#yotei_month').prop("disabled", true);
                $('#yotei_day').val("");
                $('#yotei_day').prop("disabled", true);
            }
        });

        /********************************
       * 学位分野チェンジイベント
       ********************************/
        $('#gakui_bunya').change(function () {
            var val = $('#gakui_bunya option:selected').val();
            $("#wk_bunya").val(val);
            var txt = $('#gakui_bunya option:selected').text();
            $("#wk_txt_bunya").val(txt);
            if ($('#gakui_bunya option:selected').text() == "その他") {
                $('#gakui_sonota').prop("disabled", false);
            } else {
                $('#gakui_sonota').prop("disabled", true);
            }

        });

        /************************
         * 必要書類の提出ボタンチェンジイベント
         ************************/
        $("#hitsuyo").change(function () {
            if ($("input[name='hitsuyo']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_hitsuyo").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_hitsuyo").val(wa);
            }
        });

        /************************
         * 注意事項ボタンチェンジイベント
         ************************/
        $("#caution_1").change(function () {
            if ($("input[name='caution_1']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_caution_1").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_caution_1").val(wa);
            }
        });

        $("#caution_2").change(function () {
            if ($("input[name='caution_2']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_caution_2").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_caution_2").val(wa);
            }
        });

        $("#caution_3").change(function () {
            if ($("input[name='caution_3']").prop('checked')) {
                //チェックありのhidden設定
                var wa = 1;
                $("#wk_caution_3").val(wa);
            } else {
                //チェックなしのhidden設定
                var wa = 0;
                $("#wk_caution_3").val(wa);
            }
        });
        /********************************
        * 戻るボタン押下時の処理
        ********************************/
        $("#return_button").click(function () {
            url = '../inputCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 次へボタン押下時の処理
        ********************************/
        $("#next_button").click(function () {
            $("#err_gakui").html("");
            $("#err_yoteibi").html("");
            $("#err_hitsuyo").html("");
            $("#err_caution_1").html("");
            $("#err_caution_2").html("");
            $("#err_caution_3").html("");

            var wk_focus_done = 0;
            var wk_err_msg = "";

            //卒業見込みが選択されている場合
            if (document.getElementById("gakui_5").checked) {
                if ($('#yotei_year').val() == "" && $('#yotei_month').val() == 0 && $('#yotei_day').val() == 0) {
                    wk_err_msg = "";
                    wk_err_msg = "卒業予定日が入力されていません。卒業予定日を入力してください。";
                    $("#err_yoteibi").html(wk_err_msg);

                } else if ($('#yotei_year').val() == "" || $('#yotei_month').val() == 0 || $('#yotei_day').val() == 0) {
                    wk_err_msg = "";
                    wk_err_msg = "卒業予定日が正しくありません。卒業予定日を正しく入力してください。";
                    $("#err_yoteibi").html(wk_err_msg);
                } else {
                    //認定日西暦正規表現チェック
                    if ($("#yotei_year").val() !== "") {
                        var year = $("#yotei_year").val();
                        var re = /^[0-9]{4}$/;
                        var year = year.match(re);
                        //4桁の半角数字ではない場合
                        if (!year) {
                            wk_err_msg = "";
                            wk_err_msg = "卒業予定日が正しくありません。卒業予定日を正しく入力してください。";
                            $("#err_yoteibi").html(wk_err_msg);

                            //エラー箇所にフォーカスを当てる
                            if (wk_focus_done == 0) {
                                $("#yotei_year").focus();
                                wk_focus_done = 1;
                            }
                        } else {
                            var today = new Date();
                            var year1 = today.getFullYear();
                            //1900~本年の範囲外の場合
                            if ($("#yotei_year").val() > year1 + 10 || $("#yotei_year").val() < year1) {
                                wk_err_msg = "";
                                wk_err_msg = "卒業予定日は、現在の年～現在の年+10年の間で入力してください。";

                                $("#err_yoteibi").html(wk_err_msg);
                                //エラー箇所にフォーカスを当てる
                                if (wk_focus_done == 0) {
                                    $("#yotei_year").focus();
                                    wk_focus_done = 1;
                                }
                            } else {
                                //認定日妥当性チェック
                                var strDate = $('#yotei_year').val() + "/" + $('#yotei_month').val() + "/" + $('#yotei_day').val(); //変数に認定日を格納する
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
                                    wk_err_msg = "";
                                    wk_err_msg = "卒業予定日が正しくありません。卒業予定日を正しく入力してください。";
                                    $("#err_yoteibi").html(wk_err_msg);

                                }
                            }
                        }
                    }

                }

            }

            //学位分野でその他が選択されている場合
            if ($('#gakui_bunya option:selected').text() == "その他") {
                if ($('#gakui_sonota').val() == "") {
                    wk_err_msg = "";
                    wk_err_msg = "その他の場合は、学位分野を入力してください。";
                    $("#err_gakui").html(wk_err_msg);
                    //エラー箇所にフォーカスを当てる
                    if (wk_focus_done == 0) {
                        $("#gakui_sonota").focus();
                        wk_focus_done = 1;
                    }
                }
            }

            //必要書類の提出チェック
            if (!$('#hitsuyo').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "必要書類の提出の確認がチェックされていません。注意事項を確認し、チェックしてください。";
                $("#err_hitsuyo").html(wk_err_msg);

            }

            //注意事項の確認チェック
            if (!$('#caution_1').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "注意事項の確認がチェックされていません。注意事項を確認し、チェックしてください。";
                $("#err_caution_1").html(wk_err_msg);

            }

            if (!$('#caution_2').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "注意事項の確認がチェックされていません。注意事項を確認し、チェックしてください。";
                $("#err_caution_2").html(wk_err_msg);

            }

            if (!$('#caution_3').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "注意事項の確認がチェックされていません。注意事項を確認し、チェックしてください。";
                $("#err_caution_3").html(wk_err_msg);

            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            }

            url = '../entryFinalConfirm/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });
})(jQuery);