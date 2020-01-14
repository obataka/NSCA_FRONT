(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
       jQuery.ajax({
        url:  '../../classes/getCeuQuizJoho.php',
        success: function(rtn) {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                //※正常に住所情報を取得できた時の処理を書く場所
                getCeuQuizJoho = JSON.parse(rtn);
                console.log(getCeuQuizJoho);
                // $.each(getTodofukenList, function(i, value) {
                //     $('#address_todohuken').append('<option name="' + value[2] + '" value="' + value[0] + '">' + value[1] + '</option>');
                // });
            }
        },
        fail: function(rtn) {
            return false;
        },
        error: function(rtn) {
            return false;
        }
    });








        /**********************
         * マイページへボタン押下時の処理
         **********************/
        $(".button").click(function() {
            location.href = "../../mypage/";
        });
    });
})(jQuery);
