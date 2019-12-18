(function ($) {
    $(document).ready(function () {
        /*************************************************
        * 内容を修正するボタン押下時に値を保持して画面遷移する
        **************************************************/
        $("#return_button").click(function () {
            url = '../registMember/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /******************************************
        * 次へボタン押下時に値を保持して決済方法選択に画面遷移する。
        *******************************************/
        $("#next_button").click(function () {
            url = '../paymentSelect/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });


})(jQuery);