(function ($) {
    $(document).ready(function () {
        /**********************
         * 継続手続きボタン押下時の処理
         **********************/
        $("#continue").click(function () {
            url = "../../inputContinueMember/";
            $('form').attr('action', url);
            $('form').submit();
        });

        /**********************
        * 退会手続きボタン押下時の処理
        **********************/
        $("#unsubscribe").click(function () {
            location.href = "../../unsubscride/";
        });
    });
})(jQuery);
