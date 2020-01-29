(function($){
    $(document).ready(function(){
    
        /************************
        *継続教育(CEU)についてにurlセット
        *************************/
        $("#kyoiku a").attr("href", "http://www.nsca-japan.or.jp/ceu/")

        /************************
        *特別プログラム(*D)にurlセット
        *************************/
        $("#program a").attr("href", "https://member.nsca-japan.or.jp/etc/ceu/d_pgm.html")

        /************************
        *特別プログラム(*D)にurlセット
        *************************/
        $("#ceu_kanri a").attr("href", "http://www.nsca-japan.or.jp/explain/trans_from_cc_japan.html")

        /************************
        *特別プログラム(*D)にurlセット
        *************************/
        $("#qa a").attr("href", "http://www.nsca-japan.or.jp/06_qanda/ceu.html")



        /*************
        *CEU取得状況を取得
        **************/
        $.ajax({
            url:  '../../classes/getCeuSyutokuJokyo.php',  
        })

        // Ajaxリクエストが成功した時発動
        .done( (rtn) => {

              // rtn = 0 の場合
            if (rtn == 0) {

                console.log(0);               

            } else {

                console.log(1);
                getCeuSyutokuJokyo = JSON.parse(rtn);
                console.log(getCeuSyutokuJokyo);
                //
                var category_a = getCeuSyutokuJokyo['category_a_gokei'];
                var dig = Number(category_a);
                var Num = dig.toFixed(2);
                $('#category_a').text(Num);
                
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
