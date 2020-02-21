(function ($) {
    $(document).ready(function () {
        /************************
         * 入会理由チェンジイベント
         ************************/
        //ラジオボタンが切り替わったら発動
        $("input:radio[name='year']").change(function () {
            if ($("input:radio[id='year_1']:checked").val()) {
                var test1 = $('[name="year"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#year').val(test2);
                $('#wk_year').val(1);
            } else if ($("input:radio[id='year_2']:checked").val()) {
                var test1 = $('[name="year"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#year').val(test2);
                $('#wk_year').val(2);
            } else if ($("input:radio[id='year_3']:checked").val()) {
                var test1 = $('[name="year"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#year').val(test2);
                $('#wk_year').val(3);
            }
        });

        /************************
         * 活動内容チェンジイベント
         ************************/
        //ラジオボタンが切り替わったら発動
        $("input:radio[name='katsudo']").change(function () {
            if ($("input:radio[id='katsudo_1']:checked").val()) {
                var test1 = $('[name="katsudo"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#katsudo').val(test2);
                $('#wk_katsudo').val(1);
            } else {
                var test1 = $('[name="katsudo"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#katsudo').val(test2);
                $('#wk_katsudo').val(2);
            } 
        });

        /************************
         * 資格ボタンチェンジイベント
         ************************/
        $("input[id='shikaku_1']").change(function () {
            if ($("input[id='shikaku_1']:checked").val()) {
                $('#chkCSCS').val(1);
            } else {
                $('#chkCSCS').val(0);
            }
        });

        $("input[id='shikaku_2']").change(function () {
            if ($("input[id='shikaku_2']:checked").val()) {
                $('#chkCPT').val(1);
            } else {
                $('#chkCPT').val(0);
            }
        });

        /***************************************************************
         * 選択済みのコンボ、ラジオ、チェックボックス初期表示処理
         ***************************************************************/
        //資格
        var wk_chk_CSCS = $('#chkCSCS').val();
        if (wk_chk_CSCS != "") {
            $('input[id="shikaku_1"]').prop("checked", true);
        }

        var wk_chk_CPT = $('#chkCPT').val();
        if (wk_chk_CPT != "") {
            $('input[id="shikaku_2"]').prop("checked", true);
        }

        //年
        var wk_year = $('#wk_year').val();
        if (wk_year != "") {
            if (wk_year == 1) {
                $('#year_1').prop("checked", true);
            } else if (wk_year == 2) {
                $('#year_2').prop("checked", true);
            } else if (wk_year == 3) {
                $('#year_3').prop("checked", true);
            } 
        }

        //活動
        var wk_katsudo = $('#wk_katsudo').val();
        if (wk_katsudo != "") {
            if (wk_katsudo == 1) {
                $('#katsudo_1').prop("checked", true);
            } else if (wk_katsudo == 2) {
                $('#katsudo_2').prop("checked", true);
            } 
        }

        /***************************************************************
         * 次へボタン押下時のエラーチェック処理
         ***************************************************************/
        $("#next").click(function () {
            //エラーメッセージエリア初期化
            $("#err_year").html("");
            $("#err_katsudou").html("");
            $("#err_shikaku").html("");
            $("#err_doi").html("");

            var wk_err_msg = "";

            //年未選択チェック
            if (!$('input:radio[name="year"]:checked').val()) {
                wk_err_msg = "年を選択してください。";
                $("#err_year").html(wk_err_msg);
            }

            //活動内容未選択チェック
            if (!$('input:radio[name="katsudo"]:checked').val()) {
                wk_err_msg = "活動内容を選択してください。";
                $("#err_katsudou").html(wk_err_msg);
            }

            //資格未選択チェック
            if (!$('input[name="shikaku"]:checked').val()) {
                wk_err_msg = "資格を選択してください。";
                $("#err_shikaku").html(wk_err_msg);
            }

            //同意未選択チェック
            if (!$('input[name="doi"]:checked').val()) {
                wk_err_msg = "同意するを選択してください。";
                $("#err_doi").html(wk_err_msg);
            }


        });
    });
})(jQuery);
