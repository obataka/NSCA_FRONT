(function ($) {
    $(document).ready(function () {

        /********************************
        * 戻るボタン押下時の処理
        ********************************/
        $("#return_button").click(function () {
            url = '../entryConfirm/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 次へボタン押下時の処理
        ********************************/
        $("#next_button").click(function () {
            $("#err_syorui_1").html("");
            $("#err_syorui_2").html("");

            var wk_err_msg = "";

            if (!$('#syorui_1').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "提出書類確認がチェックされていません。提出書類確認をチェックしてください。";
                $("#err_syorui_1").html(wk_err_msg);
            }

            if (!$('#syorui_2').prop('checked')) {
                wk_err_msg = "";
                wk_err_msg = "提出書類確認がチェックされていません。提出書類確認をチェックしてください。";
                $("#err_syorui_2").html(wk_err_msg);
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            }

            //エラーがない場合支払方法選択画面に画面遷移
            url = '../paymentSelectNoLogin/';
            $('form').attr('action', url);
            $('form').submit();

        });

    });
})(jQuery);