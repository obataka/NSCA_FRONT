(function($){
    $(document).ready(function(){
        console.log(12345);
       
        /**********************
         * マイページへボタン押下時の
         **********************/
        $(".button").click(function() {
            console.log(111);
            location.href = "../../mypage/";
        });
    });
})(jQuery);
