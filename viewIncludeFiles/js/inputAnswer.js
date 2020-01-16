(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
       console.log($("#ceu_id1").val());
       
       jQuery.ajax({
        url:  '../../classes/getCeuQuizSetsumon.php',
        type: 'POST',
        data:
        {
            //ceu_idセット
            ceu_id: $("#ceu_id1").val(),
        },
        success: function(rtn) {
            
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {

                return false;

            } else {
                console.log(1111);
                //※正常にCEUクイズ情報を取得できた時の処理
                getCeuQuizSetsumon = JSON.parse(rtn);
                console.log(getCeuQuizSetsumon);

            }
        },
        fail: function(rtn) {
            return false;
        },
        error: function(rtn) {
            return false;
        }

    });

    });
})(jQuery);
