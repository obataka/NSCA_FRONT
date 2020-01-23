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
            $.each(getShutokuGakuiMeisho, function (i, value) {
                $('#shutoku_gakui').append('<input id="gakui_' + value[0] + '" type="radio" name="gakui" value=""><label for="gakui_' + value[0] + '">' + value[1] + '</label>');
                if (value[1] == "学士") {
                    $('#shutoku_gakui').append('<br class="sp_br">');
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

        /*********************************
         * //卒業予定日初期設定
         *********************************/
        //現在の年~現在の年+10までの範囲で設定する。
        var thisYear = new Date().getFullYear();
        var tenYears = thisYear + 10;
        for (thisYear; thisYear <= tenYears; thisYear++) {
            $('#yotei_year').append('<option value="' + thisYear + '">' + thisYear + '</option>');
        }

        /********************************
        * 取得学位チェンジイベント
        ********************************/
        $("#shutoku_gakui").on('change', "input:radio[name='gakui']", function () {
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
            if ($('#gakui_bunya option:selected').text() == "その他") {
                $('#gakui_sonota').prop("disabled", false);
            } else {
                $('#gakui_sonota').prop("disabled", true);
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
            $("#err_hitsuyo").html("");
            $("#err_caution_1").html("");
            $("#err_caution_2").html("");
            $("#err_caution_3").html("");

            var wk_err_msg = "";

            if (!$('#hitsuyo').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "注意事項の確認がチェックされていません。注意事項を確認し、チェックしてください。";
                $("#err_hitsuyo").html(wk_err_msg);

            }

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