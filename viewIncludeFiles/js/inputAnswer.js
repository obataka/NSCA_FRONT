(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
       console.log($("#ceu_id1").val());
       
        $.ajax({
            url:  '../../classes/getCeuQuizSetsumon.php',
            type: 'POST',
            data:
            {
                //ceu_idセット
                ceu_id: $("#ceu_id1").val(),
            }
        })
        
        // Ajaxリクエストが成功した時発動
        .done( (rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {

                return false;

            } else {
                console.log(1111);
                //※正常にCEUクイズ情報を取得できた時の処理
                getCeuQuizSetsumon = JSON.parse(rtn);
                console.log(getCeuQuizSetsumon);
                
                $('.dai_1').html(getCeuQuizSetsumon[0]["setsumon"]);
                $('.dai_2').html(getCeuQuizSetsumon[1]["setsumon"]);
                $('.dai_3').html(getCeuQuizSetsumon[2]["setsumon"]);
                $('.dai_4').html(getCeuQuizSetsumon[3]["setsumon"]);
            }
        })

        // Ajaxリクエストが失敗した時発動
        .fail( (rtn) => {
            $('.error_ul').html('システムエラーが発生しました。');
            return false;
        })

        // Ajaxリクエストが成功・失敗どちらでも発動
        .always( (data) => {
        });
    
    });
})(jQuery);
