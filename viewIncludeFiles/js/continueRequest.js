(function($){
    $(document).ready(function(){
        /**********************
         * 継続手続きボタン押下時の処理
         **********************/
        $(".button").click(function() {
            location.href = "../../inputContinueMember/";
        });

         /**********************
         * 退会手続きボタン押下時の処理
         **********************/
        $(".button").click(function() {
            location.href = "../../unsubscride/";
        });
    });
})(jQuery);
